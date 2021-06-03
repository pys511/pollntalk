<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20201123
 *  구독 신청 하기
 */
try
{
    if ($_SESSION["member_seq"] == "")
    {
        echo("-1");
        exit;
    }
    
    $subscribe  = new CApp_Handler_Subscribe_Ctrl();
    $result     = $subscribe->setSubscribe($_POST);
    if (!$result)
        echo("FALSE");
    else if ($result)
        echo("-1");
    else
        echo("TRUE");
}
catch (CException $ex)
{
    $ex->printException();
}
?>