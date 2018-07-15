<?php

/**
 * redis配置
 */
return [
    /**
     * 主服务器优先配置在前面
     */
    'server' => [
        ['host' => '127.0.0.1', 'port' => '6379']
    ],
    /**
     * 超时时间
     */
    'timeout' => 3,
    /**
     * 持久连接id
     */
    'persistent_id' => 'messagecenter'
];

