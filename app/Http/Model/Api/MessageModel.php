<?php

namespace App\Http\Model\Api;

use Framework\Facade\Log;
use Framework\Facade\Config;
use Framework\Service\MessageQueue\QueueProducerBase;

class MessageModel extends QueueProducerBase {

    /**
     * 初始化连接
     */
    protected function init() {
        //设置初始化参数
        $arrInitParam = [
            'exchange_name' => Config::get('messagequeue.message.queue.exchange_name'),
            'exchange_type' => Config::get('messagequeue.message.queue.exchange_type'),
            'ae_exchange' => Config::get('messagequeue.message.queue.ae_exchange'),
            'queue_bind' => Config::get('messagequeue.message.queue.queue_bind')
        ];
        //调用父类构建方法
        return $this->build($arrInitParam);
    }

    /**
     * 推送消息到队列
     */
    public function sendMessage() {
        var_dump('before init' . microtime());
        if ($this->init()) {
            var_dump('after init' . microtime());
            $arrMessage = [];
            for ($i = 1; $i <= 1; $i++) {
                $arrMessage[] = ['message' => rand(1, 100), 'route_key' => 'message.wechat'];
            }
            $arrFailMessage = [];
            $intFailCount = 0;
            $strQueueName = Config::get('messagequeue.message.producer.exchange_send');
            $blnFlag = $this->send($strQueueName, $arrMessage, $arrFailMessage, $intFailCount);
            var_dump('after send' . microtime());
            if (!$blnFlag) {
                //失败处理
                echo json_encode($arrFailMessage) . PHP_EOL;
                echo $intFailCount . PHP_EOL;
            }
        }
    }

}
