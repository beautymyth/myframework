<?php

namespace Framework\Service\Foundation;

use Framework\Facade\Config;
use Framework\Service\Foundation\Request;
use Framework\Service\Foundation\Pipeline;
use Framework\Service\Foundation\Application;
use Framework\Service\Exception\ControllerException;

/**
 * 路由
 */
class Router {

    /**
     * 应用实例
     */
    protected $objApp;
    
    /**
     *控制器命名空间
     */
    protected $strNameSpace='App\\Http\\Controller\\';

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
                        ->then(function($objRequest) {
                            $this->runController($objRequest);
                        });
    }

    /**
     * 获取中间件
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
     * 运行控制器
     */
    protected function runController($objRequest) {
        $strController = $this->findController($objRequest);
        var_dump($strController);
    }

    /**
     * 查找控制器
     */
    protected function findController($objRequest) {
        //配置查找
        $strController = Config::get('app.route.' . $objRequest->getUri());
        if (!empty($strController)) {
            return $strController;
        }
        //文件查找
        //抛出异常
        throw new ControllerException(json_encode(['Location' => true]));
    }

}
