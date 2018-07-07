<?php

namespace Framework\Service\Foundation\Middleware\Web;

use Closure;
use Exception;
use Framework\Service\Foundation\Request;
use Framework\Service\Foundation\Application;
use Framework\Service\Exception\AuthException;

/**
 * auth检查
 */
class CheckAuth {

    protected $objApp;

    public function __construct(Application $objApp) {
        $this->objApp = $objApp;
    }

    /**
     * 中间件处理
     */
    public function handle(Request $objRequest, Closure $mixNext) {
        if (!$this->checkAuth($objRequest)) {
            throw new AuthException('登录验证失败');
        }
        $this->objApp->instance('user', 123);
        return $mixNext($objRequest);
    }

    /**
     * auth检查
     */
    protected function checkAuth($objRequest) {
        return true;
    }

}
