<?php
/**
 * 	@auth : JEON JY
 * 	@date : 20200530
 * 	공통 처리
 */
session_start();

require_once ('./core/util/common/message_info.php');
require_once ('./core/lib/util/CException.php');

// http header 정의
header("Expires:Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// 클래스와 인터페이스 첫 글자 정의
define("CLASS_NAME_PREFIX", "C");
define("INTERFACE_NAME_PREFIX", "I");

/**
 *
 * 	@auth : JEON JY
 * 	@date : 20200530
 * 	autoload class
 */
class CAutoLoader
{

    private static $m_autoloader = null;

    private function __construct ()
    {}

    public static function instance ()
    {
        if (self::$m_autoloader == null)
            self::$m_autoloader = new CAutoLoader();

        return self::$m_autoloader;
    }

    public function start ()
    {
        spl_autoload_register(array(
                $this,
                "load"
        ));
    }

    /*
     * class 이름을 읽고 이름에서 해당 class의 경로를 추출하여 require한다.
     * class 이름 : 첫번째 경로_두번째 경로_세번째 경로_이름 (ex : CApp_Handler_Pollntalk_Main ->
     * /app/handler/pollntalk/CApp_Handler_Pollntalk_Main.php
     */
    public function load($strClassName)
    {
        $strTempName = substr($strClassName, strlen(CLASS_NAME_PREFIX), strlen($strClassName));
        $arrClassName = explode("_", strtolower($strTempName));
        $nNameCount = count($arrClassName);
        if ($nNameCount < 3 || $nNameCount > 4) {
            throw new CException(null, ExceptionType::FATAL, "지정된 이름의 객체 정의가 잘못되었습니다. 다시 확인해보시기 바랍니다. class name[" .$strClassName . "]");
            return;
        }

        $strClassFilePath = "";
        for ($i = 0; $i < count($arrClassName) - 1; $i ++) {
            $strClassFilePath .= $arrClassName[$i];
            $strClassFilePath .= "/";
        }

        $strClassFilePath = "./" . $strClassFilePath . $strClassName . ".php";
        if (@file_exists($strClassFilePath))
            require_once ($strClassFilePath);
        else
            throw new CException(null, ExceptionType::FATAL, "지정된 이름의 객체를 찾지 못했습니다. 다시 확인해보시기 바랍니다. class name[" .$strClassName . "], path[" . $strClassFilePath . "]");

        return;
    }
}

/*
 * error handling 함수
 */
function alda_error_handler ($errno, $errstr, $errfile, $errline)
{
    $errMessage = $errstr . "[" . $errfile . "][" . $errline . "]";
    CCore_Lib_Util_Logger::instance()->write($errno, $errMessage);
    // CCore_Lib_Util_Logger::instance()->write($errno, $errstr);
}

try 
{
    CAutoLoader::instance()->start();
} 
catch (CException $ex) 
{
    $ex->executeException();
}

set_error_handler('alda_error_handler');
?>