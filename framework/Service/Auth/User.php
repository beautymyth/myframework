<?php

namespace Framework\Service\Auth;

class User {

    /**
     * 用户信息
     */
    protected $arrUserInfo = [];

    public function __construct($arrUserInfo) {
        $this->arrUserInfo = $arrUserInfo;
    }

    /**
     * 检查用户信息完整性
     */
    public function check() {
        if (isset($this->arrUserInfo['user_id']) && !empty($this->arrUserInfo['user_id']) && isset($this->arrUserInfo['user_name']) && !empty($this->arrUserInfo['user_name'])) {
            return true;
        }
        return false;
    }

    public function getUserId() {
        return $this->arrUserInfo['user_id'];
    }

    public function getUserName() {
        return $this->arrUserInfo['user_name'];
    }

}
