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

namespace App\Repositories;

use App\User;

/**
 * Interface UserRepository.
 */
interface UserRepository
{
    /**
     * @param string $id
     *
     * @return User|null
     */
    public function find(string $id): ?User;

    /**
     * @param string $email
     *
     * @return User|null
     */
    public function byEmail(string $email): ?User;

    /**
     * @param User $user
     *
     * @return void
     */
    public function save(User $user): void;
}
