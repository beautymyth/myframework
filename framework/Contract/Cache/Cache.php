<?php

namespace Framework\Contract\Cache;

/**
 * 缓存接口
 */
interface Cache {

    public function set($value);

    public function get();
}
