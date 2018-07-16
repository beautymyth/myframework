<?php

namespace App\Http\Middleware\Api;

use Closure;
use Exception;
use Framework\Service\Foundation\Request;
use Framework\Service\Foundation\Application;

/**
 * 有效性检查
 */
class CheckValid {

    /**
     * 应用实例
     */
    protected $objApp;

    /**
     * 创建实例
     */
    public function __construct(Application $objApp) {
        $this->objApp = $objApp;
    }

    /**
     * 中间件处理
     */
    public function handle(Request $objRequest, Closure $mixNext) {
        if (!$this->checkValid($objRequest)) {
            
        }
        //运行下一个中间件
        return $mixNext($objRequest);
    }

    /**
     * 有效性检查
     */
    protected function checkValid($objRequest) {
        return true;
    }

}
