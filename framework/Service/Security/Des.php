<?php

namespace Framework\Service\Security;

class Des {

    /**
     * 计算字符串的md5散列值
     * @param string $strValue 需要计算的字符串
     * @param string $strSalt 盐值
     */
    public function md5($strValue, $strSalt = '') {
        return md5(md5($strValue) . $strSalt);
    }

    /**
     * 对密码进行加密
     * 需要https才行
     * @param string $strPassword 密码
     */
    public function passwordHash($strPassword) {
        return password_hash($strValue, PASSWORD_BCRYPT);
    }

    /**
     * 对密码进行验证
     * @param string $strPassword 明码
     * @param string $strPasswordHash 加密的密码
     */
    public function passwordVerify($strPassword, $strPasswordHash) {
        return password_verify($strPassword, $strPasswordHash);
    }

}
