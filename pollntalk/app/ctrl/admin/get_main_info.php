<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200412
 *
 */
try
{
    $mainCtrl   = new CApp_Handler_Main_Ctrl();
    $main_seq   = $_POST["seq"];
    $result     = $mainCtrl->getText($main_seq);
    if (! $result)
    {
        echo ("FALSE");
        exit();
    }
    // trigger_error ( print_r($result, true), E_USER_ERROR );
    $json       = json_encode($result, JSON_UNESCAPED_UNICODE);
    //trigger_error($json, E_USER_ERROR);
    echo ($json);
}
catch (CException $ex)
{
    $ex->printException();
}
exit();
?>