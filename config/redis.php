<?php

/**
 * redis配置
 */
return [
    /**
     * 主服务器优先配置在前面
     */
    'server' => [
        ['host' => '10.100.3.106', 'port' => '6379'],
        ['host' => '10.100.2.235', 'port' => '6379']
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

