<?php
/**
 * This file is part of the arcanite-et package.
 *
 *  (c) Artem Prosvetov <dragomeat@dragomeat.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmRequest;
use App\Repositories\CodeRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Class ConfirmController.
 */
class ConfirmController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * @var CodeRepository
     */
    private $codes;

    /**
     * ConfirmController constructor.
     *
     * @param UserRepository $users
     * @param CodeRepository $codes
     */
    public function __construct(UserRepository $users, CodeRepository $codes)
    {
        $this->users = $users;
        $this->codes = $codes;
    }

    /**
     * @return View
     */
    public function showConfirmForm(): View
    {
        return view('auth.confirm');
    }

    /**
     * @param ConfirmRequest $request
     *
     * @return RedirectResponse
     */
    public function confirm(ConfirmRequest $request): RedirectResponse
    {
        $code = (int) $request->get('code');
        $issuer = $request->get('issuer');

        $issuedCode = $this->codes->forIssuer($issuer);

        if ($issuedCode === null || $issuedCode->getValue() !== $code) {
            throw ValidationException::withMessages([
                'code' => [trans('auth.failed')],
            ]);
        }

        $user = $this->findOrCreate(['email' => $issuer, 'name' => $issuer]);

        $this->getGuard()->login($user, true);

        $request->session()->regenerate();

        $this->codes->remove($issuedCode);

        return redirect()->route('users.show', $user->id);
    }

    /**
     * @param array $attributes
     *
     * @return User
     */
    protected function findOrCreate(array $attributes): User
    {
        return $this->users->byEmail($attributes['email']) ?? tap(
                new User($attributes),
                function (User $user) {
                    $this->users->save($user);
                }
            );
    }

    /**
     * @return StatefulGuard
     */
    protected function getGuard(): StatefulGuard
    {
        return Auth::guard();
    }
}
