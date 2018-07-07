<?php

namespace Framework\Facade;

/**
 * @method static string get()
 *
 * @see \Framework\Service\Auth\User
 */
class User extends Facade {

    /**
     * 获取外观名称
     */
    protected static function getFacadeAccessor() {
        return 'user';
    }

}
