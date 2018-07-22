<?php

namespace App\Http\Controller\Api;

use Framework\Facade\Des;
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
        return ['success' => 1, 'content' => $this->objCache->get()];
    }

    public function funcB() {
        $a = Des::passwordHash('abc123');
        $b = password_verify('123456', $a);
        return ['aa' => Des::md5('111', 'aa'), 'bb' => $a, 'cc' => $b];
    }

}
