<?php

/**
 *  db 처리
 */
class CCore_Util_Factory_Database extends CCore_Lib_Routines_Factory
{

    const DB_HOSTNAME = "dbhost";

    const DB_NAME = "dbname";

    const DB_USER = "dbuser";

    const DB_PASSWORD = "dbpassword";

    private static $m_factory = null;

    private static $m_connection = null;

    public function __construct ()
    {}

    public static function instance ()
    {
        if (self::$m_factory == null)
            self::$m_factory = new CCore_Util_Factory_Database();

        return self::$m_factory;
    }

    public function create ()
    {
        if (self::$m_connection == null) {
            try {
                $hostName = CCore_Util_Factory_Config::instance()->getConfig(
                        CONST_CONFIG_FILED::DB_HOST);
                $dbName = CCore_Util_Factory_Config::instance()->getConfig(
                        CONST_CONFIG_FILED::DB_NAME);
                $dbUser = CCore_Util_Factory_Config::instance()->getConfig(
                        CONST_CONFIG_FILED::DB_USER);
                $dbPassword = CCore_Util_Factory_Config::instance()->getConfig(
                        CONST_CONFIG_FILED::DB_PASSWD);
                $dsn = "mysql:host=" . $hostName . ";dbname=" . $dbName .
                        ";charset=utf8";
                self::$m_connection = new PDO($dsn, $dbUser, $dbPassword);
            } catch (PDOException $ex) {
                throw new CException($ex, ExceptionType::ERROR,
                        "[1]DB 접속에 실패하였습니다.");
            }
        }

        return self::$m_connection;
    }
}
?>