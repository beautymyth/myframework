<?php

namespace Framework\Service\Cache;

use Framework\Contract\Cache\Cache as CacheContract;

/**
 * 缓存的redis实现
 */
class CacheRedis implements CacheContract {

    protected $value = '';

    public function get() {
        return $this->value;
    }

    public function set($value) {
        $this->value = 'redis' . $value;
    }

}
