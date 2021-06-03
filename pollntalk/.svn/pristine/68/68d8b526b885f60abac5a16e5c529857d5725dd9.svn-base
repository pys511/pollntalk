<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  application 설정 관리 
 *  singleton으로 처리
 */
class CCore_Util_Factory_Config
{
    private static  $m_instance = null;
    private         $m_config   = null;
    
    private function __construct ()
    {
        
    }

    /*
     * instance 반환
     */
    public static function instance ()
    {
        if (is_null(self::$m_instance))
            self::$m_instance = new CCore_Util_Factory_Config();

        return self::$m_instance;
    }

    /*
     * config 정보를 받는다.
     */
    public function setConfig ($array)
    {
        $this->m_config = $array;

        return;
    }

    /*
     * config 정보를 반환한다.
     */
    public function getConfig ($key)
    {
        return $this->m_config[$key];
    }
}