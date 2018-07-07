<?php

namespace Framework\Service\Foundation\Middleware\All;

use Closure;
use Exception;
use Framework\Service\Foundation\Request;
use Framework\Service\Exception\UriException;

/**
 * uri检查
 */
class CheckUri {

    /**
     * 有效的uri规则
     * 1.空
     * 2.控制器对应的文件夹(+)+文件+方法
     */
    protected $arrValidPattern = [
        '/^\s*$/i',
        '/^([a-z]+\/)*([a-z]+)$/i'
    ];

    /**
     * 不需要重定向的访问
     * 1.api
     */
    protected $strNotRedirectPattren = '/^(api)\/.+$/i';

    /**
     * 中间件处理
     */
    public function handle(Request $objRequest, Closure $mixNext) {
        if (!$this->checkUri($objRequest)) {
            throw new UriException($this->getMessage($objRequest));
        }
        
        return $mixNext($objRequest);
    }

    /**
     * uri检查，符合任意规则即可
     */
    protected function checkUri($objRequest) {
        foreach ($this->arrValidPattern as $strPattern) {
            if (preg_match($strPattern, $objRequest->getUri())) {
                return true;
            }
        }
        return false;
    }

    /**
     * 获取异常信息
     */
    protected function getMessage($objRequest) {
        if ($objRequest->isAjax()) {
            return json_encode(['err_msg' => '访问地址错误']);
        }
        if (preg_match($this->strNotRedirectPattren, $objRequest->getUri())) {
            return json_encode(['err_msg' => '访问地址错误']);
        }
        return json_encode(['Location' => true]);
    }

}