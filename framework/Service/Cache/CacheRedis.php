<?php

namespace Framework\Service\Cache;

use Framework\Contract\Cache\Cache as CacheContract;

/**
 * 缓存的redis实现
 */
class CacheRedis implements CacheContract {

    /**
     * 复用redis连接类
     */
    use RedisConnect;

    protected $value = '';

    public function get() {
        $objReadHander = $this->getReadHander();
        return is_null($objReadHander) ? '' : $objReadHander->get('test');
    }

    public function set($value) {
        $objWriteHander = $this->getWriteHander();
        return is_null($objWriteHander) ? false : $objWriteHander->set('test', $value);
    }

}
