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

namespace App;

use App\Notifications\VerifyIssuer;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon $updated_at
 * @property Carbon $created_at
 */
class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable, Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];
}
