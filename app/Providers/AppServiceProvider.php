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

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\CodeRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Cache\CacheCodeRepository;
use App\Repositories\Eloquent\EloquentUserRepository;

/**
 * Class AppServiceProvider
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, EloquentUserRepository::class);
        $this->app->bind(CodeRepository::class, CacheCodeRepository::class);
    }
}
