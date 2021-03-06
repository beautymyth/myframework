<?php

/**
 * 自动加载类
 */
class Loader {

    /**
     * 路径映射
     */
    public static $arrVendorMap = array(
        'App' => BASE_PATH . '/app',
        'Framework' => BASE_PATH . '/framework'
    );

    /**
     * 自动加载器
     */
    public static function autoLoad($strClassName) {
        $strFileName = self::findFile($strClassName);
        if (file_exists($strFileName)) {
            self::includeFile($strFileName);
        }
    }

    /**
     * 获取文件路径
     */
    private static function findFile($strClassName) {
        //顶级命名空间
        $strVendor = substr($strClassName, 0, strpos($strClassName, '\\'));
        //文件根目录
        $strVendorDir = isset(self::$arrVendorMap[$strVendor]) ? self::$arrVendorMap[$strVendor] : '';
        //文件路径
        $strFilePath = substr($strClassName, strlen($strVendor)) . '.php';
        //返回文件路径
        return strtr($strVendorDir . $strFilePath, '\\', DIRECTORY_SEPARATOR);
    }

    /**
     * 加载文件
     */
    private static function includeFile($strFileName) {
        if (is_file($strFileName)) {
            include $strFileName;
        }
    }

}

/**
 * 注册自动加载
 */
spl_autoload_register('Loader::autoLoad');
