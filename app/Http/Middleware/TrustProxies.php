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

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

/**
 * Class TrustProxies.
 */
class TrustProxies extends Middleware
{
    /**
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
