<?php

namespace Framework\Service\Exception;

use Exception;
use Framework\Service\Foundation\Response;
use Framework\Service\Foundation\Application;

/**
 * 登录异常
 */
class AuthException extends Exception {

    /**
     * 异常记录
     * @param Application $objApp
     * @param Exception $objException
     */
    public function report(Application $objApp, Exception $objException) {
        
    }

    /**
     * 生成异常的http响应
     * @param Application $objApp
     * @param Exception $objException
     */
    public function render(Application $objApp, Exception $objException) {
        return $objApp->make(Response::class, ['arrHeader' => ['Location' => [$objApp->make('config')->get('app.redirect.auth_wrong')]]]);
    }

}
