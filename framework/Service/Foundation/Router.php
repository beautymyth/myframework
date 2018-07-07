<?php

namespace Framework\Service\Foundation;

use Framework\Service\Foundation\Request;
use Framework\Service\Foundation\Pipeline;
use Framework\Service\Foundation\Application;

/**
 * 路由
 */
class Router {

    protected $objApp;

    /**
     * 创建路由实例
     */
    public function __construct(Application $objApp) {
        $this->objApp = $objApp;
    }

    public function runRoute(Request $objRequest) {
        $arrMiddleware = $this->getMiddleware($objRequest);

        return (new Pipeline($this->objApp))
                        ->send($objRequest)
                        ->through($arrMiddleware)
                        ->then(function() {
                            $this->run();
                        });
    }

    /**
     * 获取请求需要经过的中间件
     */
    protected function getMiddleware($objRequest) {
        $arrMiddleware = $this->objApp->make('config')->get('app.middleware.' . $objRequest->getSecondDir());
        //未配置则使用web的中间件
        if ($arrMiddleware === '') {
            $arrMiddleware = $this->objApp->make('config')->get('app.middleware.web');
        }
        return $arrMiddleware;
    }

    /**
     * 
     */
    protected function run() {
        var_dump($this->objApp->make('user'));
        var_dump('run');
    }

}
