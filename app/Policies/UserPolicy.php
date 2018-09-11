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

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class UserPolicy
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $authenticated
     * @param User $profile
     * @return bool
     */
    public function update(User $authenticated, User $profile): bool
    {
        return $authenticated->id === $profile->id;
    }
}
