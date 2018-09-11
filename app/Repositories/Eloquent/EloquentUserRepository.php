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

namespace App\Repositories\Eloquent;

use App\Repositories\UserRepository;
use App\User;

/**
 * Class EloquentUserRepository.
 */
class EloquentUserRepository implements UserRepository
{
    /**
     * @param string $id
     *
     * @return User|null
     */
    public function find(string $id): ?User
    {
        return User::find($id);
    }

    /**
     * @param string $email
     *
     * @return User|null
     */
    public function byEmail(string $email): ?User
    {
        return User::whereEmail($email)->first();
    }

    /**
     * @param User $user
     *
     * @return void
     */
    public function save(User $user): void
    {
        $user->save();
    }
}
