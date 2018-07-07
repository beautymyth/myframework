<?php

namespace Framework\Service\Foundation\BootStrap;

use Exception;
use Framework\Service\Foundation\Application;
use Framework\Contract\Exception\ExceptionHandler as ExceptionHandlerContract;

class HandleExceptions {

    /**
     * 应用实例
     */
    protected $objApp;

    public function bootStrap(Application $objApp) {
        $this->objApp = $objApp;

        set_exception_handler([$this, 'handleException']);
    }

    /**
     * 处理未捕捉的异常
     * @param Exception $objException
     */
    public function handleException(Exception $objException) {
        $this->getHandleException()->report($objException);

        if (!$this->objApp->runningInConsole()) {
            //非控制台运行，生成http响应并发送
            $this->getHandleException()->render($objException)->send();
        }
    }

    /**
     * 获取异常处理实例
     */
    protected function getHandleException() {
        return $this->objApp->make(ExceptionHandlerContract::class);
    }

}
