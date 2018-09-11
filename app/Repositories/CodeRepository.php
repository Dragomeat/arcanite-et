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

use App\Code;

/**
 * Interface CodeRepository
 */
interface CodeRepository
{
    /**
     * @param string $issuer
     * @return Code
     */
    public function issue(string $issuer): Code;

    /**
     * @param string $issuer
     * @return Code|null
     */
    public function forIssuer(string $issuer): ?Code;

    /**
     * @param Code $code
     * @return void
     */
    public function remove(Code $code): void;

    /**
     * @param Code $code
     * @return void
     */
    public function save(Code $code): void;
}
