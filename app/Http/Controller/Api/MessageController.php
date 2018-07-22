<?php

namespace App\Http\Controller\Api;

use App\Http\Model\Api\MessageModel;
use Framework\Service\Foundation\Controller as ControllerBase;

class MessageController extends ControllerBase {

    protected $objMessageModel;

    public function __construct(MessageModel $objMessageModel) {
        $this->objMessageModel = $objMessageModel;
    }

    public function send() {
        $this->objMessageModel->sendMessage();
        return ['success' => 1];
    }

}
