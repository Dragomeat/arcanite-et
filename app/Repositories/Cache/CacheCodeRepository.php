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

namespace App\Repositories\Cache;

use App\Code;
use App\CodeIssuer;
use App\Repositories\CodeRepository;
use Illuminate\Contracts\Cache\Repository as CacheRepository;

/**
 * Class CacheCodeRepository
 */
class CacheCodeRepository implements CodeRepository
{
    /**
     * @var CacheRepository
     */
    private $cache;

    /**
     * @var CodeIssuer
     */
    private $issuer;

    /**
     * CacheCodeRepository constructor.
     * @param CacheRepository $cache
     * @param CodeIssuer $issuer
     */
    public function __construct(CacheRepository $cache, CodeIssuer $issuer)
    {
        $this->cache = $cache;
        $this->issuer = $issuer;
    }

    /**
     * @param string $issuer
     * @return Code
     */
    public function issue(string $issuer): Code
    {
        return $this->issuer->issue($issuer);
    }

    /**
     * @param string $issuer
     * @return Code|null
     */
    public function forIssuer(string $issuer): ?Code
    {
        return $this->cache->get($this->getStoreKey($issuer));
    }

    /**
     * @param Code $code
     * @return void
     */
    public function remove(Code $code): void
    {
        $this->cache->forget(
            $this->getStoreKey($code->getIssuer())
        );
    }

    /**
     * @param Code $code
     * @return void
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function save(Code $code): void
    {
        $this->cache->set(
            $this->getStoreKey($code->getIssuer()),
            $code,
            5
        );
    }

    /**
     * @param string $issuer
     * @return string
     */
    protected function getStoreKey(string $issuer): string
    {
        return sprintf('codes:%s', $issuer);
    }
}
