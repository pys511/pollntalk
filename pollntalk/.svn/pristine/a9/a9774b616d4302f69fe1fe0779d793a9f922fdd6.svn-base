<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200913
 */

try
{
    $replyCtrl  = new CApp_Handler_Reply_Ctrl();
    $result     = $replyCtrl->getSubReplyList($_POST["parent_replyseq"]);
    if (! $result)
    {
        echo ("FALSE");
        exit();
    }
    
    $json       = json_encode($result, JSON_UNESCAPED_UNICODE);
    echo ($json);
}
catch (CException $ex)
{
    $ex->printException();
}
exit();
?>