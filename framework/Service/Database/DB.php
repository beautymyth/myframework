<?php

namespace Framework\Service\Database;

use Exception;
use Framework\Facade\Log;

class DB {

    /**
     * 当前执行操作的表
     */
    protected $strMainTable = '';

    /**
     * 设置操作表
     */
    public function setMainTable($strTable) {
        $this->strTable = $strTable;
    }

    /**
     * 执行insert语句
     * <br>涉及表如果分表的话，表名使用[]包裹；涉及多个分表的话需要分表条件一致
     * @param string $strSql 需要执行的语句
     * @param array $arrParams 参数
     * @param bool $blnGetInsertID 是否要获取自增长主键，默认为true。
     * <br>true:如果有自增长主键的话返回主键ID,否则返回受影响行数
     * <br>false:始终返回受影响行数
     * @return int 主键或影响行数，如果出错返回-100
     */
    protected function executeInsert($strSql, array $arrParams = array(), $blnGetInsertID = true) {
        try {
            //1.初始化信息
            $strMainTable = strtolower($strMainTable);
            $this->initInfo(array(array('table_name' => $strMainTable, 'param' => $arrParams)));
            //2.sql检查
            if (!$this->checkSqlStandard('insert', $strMainTable, $strSql, $strErrMsg)) {
                throw new Exception($strErrMsg);
            }
            //3.分表处理
            $strSql = $this->dealFenBiao($strSql, $strMainTable, $arrParams);
            //4.具体处理
            $dateStartTime = $this->curMicroTime();
            $intRes = $this->getPDO()->executeInsert($strSql, $arrParams, $blnGetInsertID);
            $dateEndTime = $this->curMicroTime();
            //5.返回结果
            return $intRes;
        } catch (Exception $e) {
            $dateEndTime2 = $this->curMicroTime();
            Log::getInstance()->log($e->getMessage(), Log::LOG_SQLERR, $strSql, json_encode($arrParams), $dateStartTime, $dateEndTime2, $this->getConnectInfo()['master']['db_type']);
            return -100;
        } finally {
            Log::getInstance()->log('executeInsert', Log::LOG_SQLINFO, $strSql, json_encode($arrParams), $dateStartTime, isset($dateEndTime) ? $dateEndTime : $dateEndTime2, $this->getConnectInfo()['master']['db_type']);
        }
    }

}
