<?php

namespace Framework\Facade;

use Framework\Contract\Cache\Cache as CacheContract;

/**
 * @method static string set()
 * @method static string get()
 *
 * @see \Framework\Service\Cache\CacheRedis
 */
class Cache extends Facade {

    /**
     * 获取外观名称
     */
    protected static function getFacadeAccessor() {
        return CacheContract::class;
    }

}
