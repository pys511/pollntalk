<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20201021
 *  메시지 전송
 */
try
{
    $message    = new CApp_Handler_Message_Ctrl();
    $result     = $message->sendMessage($_POST);
    if (!$result)
        echo("FALSE");
    else
        echo("TRUE");
}
catch (CException $ex)
{
    $ex->printException();
}
?>