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

use App\Code;
use App\Http\Controllers\Controller;
use App\Http\Requests\IssueRequest;
use App\Mail\AuthAttempted;
use App\Repositories\CodeRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;

/**
 * Class IssueController.
 */
class IssueController extends Controller
{
    use ThrottlesLogins;

    /**
     * @var CodeRepository
     */
    private $codes;

    /**
     * IssueController constructor.
     *
     * @param CodeRepository $codes
     */
    public function __construct(CodeRepository $codes)
    {
        $this->codes = $codes;
    }

    /**
     * @return View
     */
    public function showIssueForm(): View
    {
        return view('auth.issue');
    }

    /**
     * @param IssueRequest $request
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return RedirectResponse
     */
    public function issue(IssueRequest $request): RedirectResponse
    {
        $issuer = $request->get('email');

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $this->sendLockoutResponse($request);
        }

        if ($this->isCodeNotIssuedFor($issuer)) {
            $code = $this->createNewCode($issuer);

            Mail::to($issuer)->send(new AuthAttempted($code));

            $this->clearLoginAttempts($request);

            return redirect()->to(
                URL::temporarySignedRoute(
                    'auth.confirm',
                    now()->addMinutes(5),
                    compact('issuer')
                )
            );
        }

        $this->incrementLoginAttempts($request);

        $this->sendFailedLoginResponse($request);
    }

    /**
     * @param string $issuer
     *
     * @return bool
     */
    protected function isCodeNotIssuedFor(string $issuer): bool
    {
        return $this->codes->forIssuer($issuer) === null;
    }

    /**
     * @param string $issuer
     *
     * @return Code
     */
    protected function createNewCode(string $issuer): Code
    {
        return tap($this->codes->issue($issuer), function (Code $code) {
            $this->codes->save($code);
        });
    }

    /**
     * @param IssueRequest $request
     *
     * @return void
     */
    protected function sendFailedLoginResponse(IssueRequest $request): void
    {
        throw ValidationException::withMessages([
            'email' => [trans('issue.timeout')],
        ]);
    }

    /**
     * @return string
     */
    protected function username(): string
    {
        return 'email';
    }
}
