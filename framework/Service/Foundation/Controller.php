<?php

namespace Framework\Service\Foundation;

abstract class Controller {

    /**
     * 控制器方法对应的中间件
     * default:默认所有方法都会使用这里配置的中间件
     * 如果需要根据方法配置，需要进行添加
     */
    protected $arrMiddleware = [
        'default' => []
    ];
    
    /**
     * 显示视图
     */
    protected function view() {
        //加载页面
    }

    /**
     * 调用控制器的方法
     */
    public function callAction($strMethod, $arrArguments) {
        call_user_func_array([$this, $strMethod], $arrArguments);
    }

    /**
     * 控制器没有对应的方法
     */
    public function __call($strMethod, $arrArguments) {
        //访问的是页面，加载视图
        //找不到页面，跳转到配置页面
        //找不到页面方法，抛出找不到方法异常
    }

}
