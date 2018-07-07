<?php

namespace Framework\Service\Exception;

use Exception;
use Framework\Service\Foundation\Response;
use Framework\Service\Foundation\Application;

/**
 * 应用异常
 */
class ApplicationException extends Exception {

    /**
     * 生成异常的http响应
     * @param Exception $objException
     */
    public function render(Application $objApp, Exception $objException) {
        return $objApp->make(Response::class, ['arrContent' => ['success' => 0, 'err_msg' => '应用异常，请稍后再试']]);
    }

}
