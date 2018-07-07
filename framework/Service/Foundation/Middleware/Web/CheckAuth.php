<?php

namespace Framework\Service\Foundation\Middleware\Web;

use Closure;
use Exception;
use Framework\Service\Auth\User;
use Framework\Service\Foundation\Request;
use Framework\Service\Foundation\Application;
use Framework\Service\Exception\AuthException;

/**
 * auth检查
 */
class CheckAuth {

    protected $objApp;
    
    /**
     * 不需要检查的uri规则
     */
    protected $arrNotCheckPattern = [
        '/^\s*$/i',
        '/^([a-z]+\/)*([a-z]+)$/i'
    ];

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

        return $mixNext($objRequest);
    }

    /**
     * auth检查
     */
    protected function checkAuth($objRequest) {
        $strCookie = $objRequest->getCookie('UserInfo');
        //cookie为空
        if (empty($strCookie)) {
            return false;
        }
        //解析错误
        $arrCookie = json_decode($strCookie, true);
        if (!is_array($arrCookie)) {
            return false;
        }
        //生成用户信息
        $objUser = new User($arrCookie);
        if (!$objUser->check()) {
            return false;
        }
        //记录用户信息到容器
        $this->objApp->instance('user', $objUser);
        return true;
    }

}
