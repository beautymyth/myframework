<?php

namespace App\Service;

use Framework\Contract\Cache\Cache;

class test {

    protected $objCache;

    public function __construct(Cache $objCache,$fsd) {
        $this->objCache = $objCache;
    }

    public function get() {
        return $this->objCache->get();
    }

    public function set($value) {
        $this->objCache->set($value);
    }

}
