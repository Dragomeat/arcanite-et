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

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class UserController
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $users;

    /**
     * UserController constructor.
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * @param User $user
     * @return View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(User $user): View
    {
        $this->authorize('show', $user);

        return view('users.show', compact('user'));
    }

    /**
     * @param User $user
     * @param UpdateProfileRequest $request
     * @return RedirectResponse
     */
    public function update(User $user, UpdateProfileRequest $request): RedirectResponse
    {
        $user->name = $request->get('name');

        $this->users->save($user);

        return redirect()->back();
    }
}
