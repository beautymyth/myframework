<?php

namespace App\Service\MessageQueue;

use Framework\Facade\Log;
use Framework\Facade\Config;
use Framework\Service\MessageQueue\QueueConsumerBase;

class SendWeChatMsg extends QueueConsumerBase {

    /**
     * 初始化连接
     */
    public function init($intWorkId) {
        $this->intWorkId = $intWorkId;
        //设置初始化参数
        $arrInitParam = [
            'exchange_name' => Config::get('messagequeue.message.queue.exchange_name'),
            'exchange_type' => Config::get('messagequeue.message.queue.exchange_type'),
            'ae_exchange' => Config::get('messagequeue.message.queue.ae_exchange'),
            'queue_bind' => Config::get('messagequeue.message.queue.queue_bind'),
            'queue_listen' => Config::get('messagequeue.message.wechat_consumer.queue_listen'),
            'is_requeue' => Config::get('messagequeue.message.wechat_consumer.is_requeue')
        ];
        //调用父类构建方法
        return $this->build($arrInitParam);
    }

    /**
     * 从队列接收消息，进行业务处理
     * 必须要返回true or false
     * @return boolean true：处理成功 false：处理失败
     */
    protected function receiveMessage($strMessage) {
        //为消息增加uid值，失败记录redis次数，当达到一定次数直接返回true，不进入队列再循环
        Log::log($this->intWorkId . '[x] Received ' . $strMessage . '_' . microtime());
        return false;
    }

}
