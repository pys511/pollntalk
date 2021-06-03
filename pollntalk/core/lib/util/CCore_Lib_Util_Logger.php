<?php

/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  log 처리
 */
class CCore_Lib_Util_Logger extends CCore_Lib_Util_File
{

    private static $m_instance = null;

    private function __construct ()
    {}

    public static function instance ()
    {
        if (self::$m_instance == null) {
            self::$m_instance = new CCore_Lib_Util_Logger();
            // $path = "/work/web/DBServer/app/log"; //
            // $configMap->getPath(CONST_CONFIG_FILED::LOG_PATH);
            $path = CCore_Util_Factory_Config::instance()->getConfig(
                    CONST_CONFIG_FILED::LOG_PATH);
            $arrTime = getdate(time());

            // $this->m_strLogFileName .= "log_".$strFileName."_";
            $fileName = "log-";
            $fileName .= $arrTime['year'];
            $fileName .= self::$m_instance->getComplateNumber(
                    (string) $arrTime['mon']);
            $fileName .= self::$m_instance->getComplateNumber(
                    (string) $arrTime['mday']);
            $fileName .= self::$m_instance->getComplateNumber(
                    (string) $arrTime['hours']);
            $fileName .= ".log";

            self::$m_instance->init($path . "/" . $fileName);
        }

        return self::$m_instance;
    }

    public function write ($errorNo, $errorMessage)
    {
        $arrTime = getdate();
        $timeMessage = "[";
        $timeMessage .= $arrTime['year'];
        $timeMessage .= $this->getComplateNumber((string) $arrTime['mon']);
        $timeMessage .= $this->getComplateNumber((string) $arrTime['mday']);
        $timeMessage .= $this->getComplateNumber((string) $arrTime['hours']);
        $timeMessage .= $this->getComplateNumber(
                (string) $arrTime['minutes']);
        $timeMessage .= $this->getComplateNumber(
                (string) $arrTime['seconds']);
        $timeMessage .= "]";

        $message = $timeMessage . $errorMessage . "\r\n";
        $this->writeFile($message);

        return;
    }

    private function getComplateNumber ($nNumber)
    {
        if (strlen($nNumber) < 2)
            $nNumber = "0" . $nNumber;

        return $nNumber;
    }
}