<?php

namespace App\Http\Controller\Web\Common;

use Framework\Service\Foundation\Controller as BaseController;

class LoginController extends BaseController {

    /**
     * 控制器方法对应的中间件
     * 方法名(小写):方法对应的中间件
     */
    protected $arrMiddleware = [
    ];

    /**
     * 依赖注入，使用外部类
     */
    public function __construct() {
        
    }

    /**
     * 获取视图模板里填充的数据
     */
    protected function getViewData() {
        return ['title' => 'hello world','content'=>'你好'];
    }

    public function login() {
        var_dump('login');
    }

}
