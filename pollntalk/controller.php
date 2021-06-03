<?php
/*
 * pollntalk controller server
 * ajax control 처리
 */
require_once ('./core/util/common.php');

$mode = "";
require_once ('./init.php');

if ($mode == "")
    echo ("FALSE");

$path = "./app/ctrl/" . $mode . ".php";

// 해당 경로를 페이지에 포함시킨다.
require_once ($path);
unset($_POST);
?>