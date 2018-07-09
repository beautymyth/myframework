<?php

namespace App\Http\Controller\Common;

use Framework\Service\Foundation\Controller as BaseController;

class LoginController extends BaseController {
    
    /**
     * 依赖注入，使用外部类
     */
    public function __construct() {
        
    }

    /**
     * 控制器方法对应的中间件
     */
    protected $arrMiddleware = [
        'default' => []
    ];

    public function view() {
        //设置模板里需要的变量
    }

}
