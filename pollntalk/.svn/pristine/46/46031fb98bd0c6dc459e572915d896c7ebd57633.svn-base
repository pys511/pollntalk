<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20210118
 *  메인 알림 조회
 */
try
{
    $product    = new CApp_Handler_Util_Common();
    $result     = $product->getAlertMessage();
    $json       = json_encode($result, JSON_UNESCAPED_UNICODE);
    echo ($json);
}
catch (CException $ex)
{
    $ex->printException();
}
exit();
?>