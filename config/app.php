<?php

/**
 * 网站基本的配置
 */
return [
    /**
     * 外观
     * 1.提供框架类中方法的静态访问
     */
    'facade' => [
        'Config' => Framework\Facade\Config::class,
        'Log' => Framework\Facade\Log::class,
        'Cache' => Framework\Facade\Cache::class,
        'Request' => Framework\Facade\Request::class,
        'User' => Framework\Facade\User::class
    ],
    /**
     * 服务提供者
     * 1.单例的绑定
     * 2.接口到实现的绑定
     * 3.实例的绑定
     * 
     * 其它类的使用方式，可不通过服务提供者
     */
    'provider' => [
        /**
         * 框架
         */
        Framework\Provider\Cache\CacheServiceProvider::class,
        Framework\Provider\View\ViewServiceProvider::class,
    /**
     * 应用
     */
    ],
    /**
     * 中间件
     * 1.http请求需要通过的检查
     * 2.注意会按顺序检查
     * 3.按照uri中第一个/前进行匹配
     */
    'middleware' => [
        /**
         * 所有请求都需经过
         */
        'all' => [
            Framework\Service\Foundation\Middleware\All\CheckUri::class
        ],
        /**
         * api请求需要经过
         */
        'api' => [
        ],
        /**
         * web请求需要经过
         * 1.非登记的二级域名，都算web
         */
        'web' => [
            Framework\Service\Foundation\Middleware\Web\CheckAuth::class
        ]
    ],
    /**
     * 重定向配置
     */
    'redirect' => [
        'uri_empty' => 'http://www.qq.com',
        'uri_wrong' => 'http://www.sina.com',
        'auth_wrong' => 'http://www.baidu.com',
        'controller_wrong' => 'http://www.163.com'
    ],
    /**
     * 显式的二级目录
     * 1.不配置默认为web
     */
    'second_dir' => ['api', 'web'],
    /**
     * uri解析控制器规则
     * 1.配置的二级目录，认为uri包含控制器与控制器方法
     */
    'uri_resolve_rule' => ['api'],
    /**
     * 路由
     * 1.配置uri对应的控制器
     * 2.如果没配置，则使用默认uri结构处理
     */
    'route' => [
        'login' => 'Web\\Common\\LoginController',
        'login/login' => 'Web\\Common\\LoginController@login'
    ],
    /**
     * 视图
     * 1.配置uri对应的视图
     * 2.如果没配置，则使用默认uri结构处理
     */
    'view' => [
        'login' => 'web/common/login.view'
    ]
];

