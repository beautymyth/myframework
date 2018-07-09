<?php

namespace Framework\Service\Exception;

use Exception;
use Framework\Service\Foundation\Response;
use Framework\Service\Foundation\Application;

/**
 * 控制器异常
 */
class ControllerException extends Exception {

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
        $arrMessage = json_decode($objException->getMessage(), true);
        if (isset($arrMessage['Location'])) {
            //需要重定向
            return $objApp->make(Response::class, ['arrHeader' => ['Location' => [$objApp->make('config')->get('app.redirect.controller_wrong')]]]);
        }
        return $objApp->make(Response::class, ['arrContent' => ['success' => 0, 'err_msg' => $arrMessage['err_msg']]]);
    }

}
