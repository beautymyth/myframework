<?php

namespace Framework\Service\Log;

class Log {

    /**
     * 应用实例
     */
    protected $objApp;

    /**
     * 日志目录
     */
    private $strLogDir = '';

    /**
     * 单个日志大小限制，最大值1024 * 1024 * 20 = 20M
     */
    private $intLogSize = 20971520;

    /**
     * 日志类型数组
     */
    private $arrValidType = array('INFO', 'ERR', 'SQLINFO', 'SQLERR');

    /**
     * 创建日志实例
     */
    public function __construct($objApp) {
        $this->objApp = $objApp;
        $this->strLogDir = $this->objApp->make('path.storage') . DIRECTORY_SEPARATOR . 'log' . DIRECTORY_SEPARATOR;
    }

    /**
     * 记录日志
     * @param type $str
     */
    public function log($strContent = '', $strLogType = 'INFO') {
        //检查日志类型是否正确    
        if (!in_array($strLogType, $this->arrValidType)) {
            return;
        }

        //创建日志目录
        if (!$this->createDir()) {
            return;
        }
        if (($strFileName = $this->getFileName($strLogType)) == '') {
            return;
        }

        //拼接内容
        $strLine = "----------------------------------------------------------------------";
        $strContent = sprintf(
                "%s\r\n"
                . "Date:[%s]\r\n"
                . "Memo:[%s]\r\n", $strLine, date('Y-m-d H:i:s'), $strContent);

        //写日志
        if (!file_exists($strFileName)) {
            //如果文件未存在直接写
            file_put_contents("{$strFileName}", "{$strContent}", FILE_APPEND | LOCK_EX);
            @chmod($strFileName, 0775);
        } else {
            //如果文件已存在，判断是否可写
            if (is_writable($strFileName)) {
                file_put_contents("{$strFileName}", "{$strContent}", FILE_APPEND | LOCK_EX);
            }
        }
    }

    /**
     * 创建日志目录
     */
    private function createDir() {
        $strLogDir = $this->strLogDir . date('Ym');
        if (!is_dir($strLogDir)) {
            if (@mkdir($strLogDir, 0777, true)) {
                @chmod($strLogDir, 0775);
                return true;
            }
        } else {
            return true;
        }
        return false;
    }

    /**
     * 获取文件名
     */
    private function getFileName($strLogType) {
        $strFileNameReg = date('Y-m-d') . $strLogType;
        $strFileNameReal = date('Y-m-d') . $strLogType . '.log';
        $intFileCount = 0;
        $strLogDir = $this->strLogDir . date('Ym') . '/';
        $arrFileExists = scandir($strLogDir);
        if ($arrFileExists) {
            //自然排序文件
            sort($arrFileExists, SORT_NATURAL);
            //循环日志目录
            foreach ($arrFileExists as $strTmpFileName) {
                //得到某天某种类型的日志
                if (strpos($strTmpFileName, $strFileNameReg) !== false) {
                    if (strnatcmp($strTmpFileName, $strFileNameReal) > 0) {
                        $strFileNameReal = $strTmpFileName;
                        $intFileCount++;
                    }
                }
            }
            //如果单个日志文件超过长度限制，则新建一个日志文件
            if (file_exists($strLogDir . $strFileNameReal)) {
                if (filesize($strLogDir . $strFileNameReal) > $this->intLogSize) {
                    $intFileCount++;
                }
            }
            return $intFileCount > 0 ? $strLogDir . $strFileNameReg . $intFileCount . '.log' : $strLogDir . $strFileNameReg . '.log';
        }
        return '';
    }

}
