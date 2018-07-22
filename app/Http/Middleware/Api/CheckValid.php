<?php

namespace App\Http\Middleware\Api;

use Closure;
use Framework\Facade\Log;
use Framework\Facade\Des;
use Framework\Facade\Config;
use Framework\Contract\Http\Request;
use App\Exception\Api\ValidException;
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
            throw new ValidException('接口签名信息错误');
        }
        //运行下一个中间件
        return $mixNext($objRequest);
    }

    /**
     * 有效性检查
     */
    protected function checkValid($objRequest) {
        //1.请求参数是否有sign_key与from_domain
        $arrParam = $objRequest->getAllParam();
        Log::log(json_encode($arrParam));
        if (!isset($arrParam['sign_key']) || empty($arrParam['sign_key'])) {
            return false;
        }
        if (!isset($arrParam['from_domain']) || empty($arrParam['from_domain'])) {
            return false;
        }
        $strSignKey = $arrParam['sign_key'];
        $strFromDomain = $arrParam['from_domain'];

        //2.根据参数生成签名
        unset($arrParam['sign_key']);
        ksort($arrParam);
        $strParam = http_build_query($arrParam);

        //3.签名校验
        $strNew = Des::md5($strParam, Config::get('app.md5_key.mhr'));
        Log::log($strNew);
        if ($strSignKey == $strNew) {
            return true;
        }
        return false;
    }

}
