<?php
/*
 * pollntalk webserver
 */
require_once ('./core/util/common.php');

$mode = "";
require_once ('./init.php');

if ($mode == "")
    $mode = "main"; // 추후 기본으로 할 페이지로 할 것.

$path = "./app/view/popup/" . $mode . ".php";

// 3. 해당 경로를 페이지에 포함시킨다.
require_once ($path);
unset($_POST);
?>