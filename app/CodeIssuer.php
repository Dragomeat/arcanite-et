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

use Exception;

/**
 * Class CodeIssuer.
 */
class CodeIssuer
{
    /**
     * @param string $issuer
     *
     * @return Code
     */
    public function issue(string $issuer): Code
    {
        try {
            return new Code(
                $issuer,
                random_int(1000, 9999)
            );
        } catch (Exception $e) {
        }
    }
}
