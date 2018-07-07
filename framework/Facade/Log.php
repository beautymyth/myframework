<?php

namespace Framework\Facade;

/**
 * @method static string log()
 *
 * @see \Framework\Service\Log\Log
 */
class Log extends Facade {

    /**
     * 获取外观名称
     */
    protected static function getFacadeAccessor() {
        return 'log';
    }

}
