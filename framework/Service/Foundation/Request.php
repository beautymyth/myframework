<?php

namespace Framework\Service\Foundation;

/**
 * 请求
 */
class Request {

    /**
     * get，post
     */
    protected $arrParam = [];

    /**
     * cookie
     */
    protected $arrCookie = [];

    /**
     * file
     */
    protected $arrFile = [];

    /**
     * 创建请求实例
     */
    public function __construct() {
        $this->init();
    }

    /**
     * 初始化数据
     */
    protected function init() {
        $this->arrParam = array_merge((array) filter_input_array(INPUT_GET), (array) filter_input_array(INPUT_POST));
        $this->arrCookie = filter_input_array(INPUT_COOKIE);
        $this->arrFile = $_FILES;
    }

    /**
     * 获取单个参数
     * @param string $strParamName 参数名
     * @param string $strDefault 当获取不到参数时，返回的默认值
     */
    public function getParam($strParamName, $strDefault = '') {
        return isset($this->arrParam[$strParamName]) ? $this->arrParam[$strParamName] : $strDefault;
    }

    /**
     * 获取所有参数
     */
    public function getAllParam($strParamName, $strDefault = '') {
        return $this->arrParam;
    }

    /**
     * 获取cookie
     * @param string $strCookieName cookie名
     */
    public function getCookie($strCookieName) {
        return isset($this->arrCookie[$strCookieName]) ? $this->arrCookie[$strCookieName] : '';
    }

    /**
     * 获取uri
     */
    public function getUri() {
        $strUri = $_SERVER['REQUEST_URI'];
        $strUri = trim($strUri, '/');
        $strUri = explode('?', $strUri)[0];
        return $strUri;
    }

    /**
     * 判断是否ajax请求
     */
    public function isAjax() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") {
            return true;
        }
        return false;
    }

    /**
     * 获取请求的二级目录
     */
    public function getSecondDir() {
        return explode('/', $this->getUri())[0];
    }

}
