<?php
// 1. config 정보를 받는다.
CCore_Util_Factory_Config::instance()->setConfig(
        array(
                CONST_CONFIG_FILED::APP_VERSION => "1.0",
                CONST_CONFIG_FILED::DB_HOST => "localhost",
                CONST_CONFIG_FILED::DB_NAME => "pollntalk",
                CONST_CONFIG_FILED::DB_USER => "root",
                CONST_CONFIG_FILED::DB_PASSWD => "password1!",
                CONST_CONFIG_FILED::LOG_PATH => "./app/log",
                CONST_CONFIG_FILED::FILE_PATH => "/work/project/pollntalk/app/file"
        ));

// 2. mode를 받아 호출할 page의 경로를 받는다.
// ex) http://url/?mode=모드명
if (array_key_exists(CONST_WEB_MESSAGE::MODE, $_GET))
    $mode = $_GET[CONST_WEB_MESSAGE::MODE];

$siteimagepath  = "/";
?>