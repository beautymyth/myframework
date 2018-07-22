<?php

namespace Framework\Service\Http;

use Framework\Contract\Http\Request as RequestContract;

/**
 * console请求
 */
class ConsoleRequest implements RequestContract {

    /**
     * argv
     */
    protected $arrParam = [];

    /**
     * uri
     */
    protected $strUri = '';

    /**
     * 创建请求实例
     */
    public function __construct($argv = []) {
        $this->init($argv);
    }

    /**
     * 初始化数据
     */
    protected function init($argv) {
        $this->strUri = count($argv) >= 2 ? $argv[1] : '';
        $this->arrParam = array_slice($argv, 2);
    }

    /**
     * 获取所有参数
     */
    public function getAllParam() {
        return $this->arrParam;
    }

    /**
     * 获取uri
     */
    public function getUri() {
        return strtolower($this->strUri);
    }

    /**
     * 判断是否ajax请求
     */
    public function isAjax() {
        return true;
    }

    /**
     * 获取请求的二级目录
     */
    public function getSecondDir() {
        return 'console';
    }

}
