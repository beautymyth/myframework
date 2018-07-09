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
        'uri_wrong' => 'http://www.sina.com',
        'auth_wrong' => 'http://www.baidu.com',
        'controller_wrong' => 'http://www.163.com'
    ],
    /**
     * 路由
     * 1.配置uri对应的控制器
     * 2.如果没配置，则使用默认uri结构处理
     */
    'route' => [
        'login' => 'Common\\LoginController'
    ]
];

