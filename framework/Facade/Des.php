<?php

namespace Framework\Facade;

/**
 * @method static string set()
 * @method static string get()
 *
 * @see \Framework\Service\Security\Des
 */
class Des extends Facade {

    /**
     * 获取外观名称
     */
    protected static function getFacadeAccessor() {
        return 'des';
    }

}
