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

/**
 * Class Code.
 */
class Code
{
    /**
     * @var string
     */
    private $issuer;

    /**
     * @var int
     */
    private $value;

    /**
     * AuthCode constructor.
     *
     * @param string $issuer
     * @param int    $value
     */
    public function __construct(string $issuer, int $value)
    {
        $this->issuer = $issuer;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getIssuer(): string
    {
        return $this->issuer;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
