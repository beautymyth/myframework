<?php

namespace App\Http\Controller\Api;

use Framework\Facade\Config;
use Framework\Contract\Cache\Cache;
use App\Http\Middleware\Api\CheckValid;
use Framework\Service\Foundation\Controller as ControllerBase;

class PageController extends ControllerBase {

    protected $objCache;

    /**
     * 控制器方法对应的中间件
     * 方法名(小写):方法对应的中间件
     */
    protected $arrMiddleware = [
        'func' => [CheckValid::class]
    ];

    public function __construct(Cache $objCache) {
        $this->objCache = $objCache;
    }

    public function func() {
        $this->objCache->set(microtime());
        var_dump($this->objCache->get());
    }

    public function funcB() {
        var_dump('funcB');
    }

}
