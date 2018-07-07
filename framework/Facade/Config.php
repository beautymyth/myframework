<?php

namespace Framework\Facade;

/**
 * @method static string get()
 *
 * @see \Framework\Service\Config\Config
 */
class Config extends Facade {

    /**
     * 获取外观名称
     */
    protected static function getFacadeAccessor() {
        return 'config';
    }

}
