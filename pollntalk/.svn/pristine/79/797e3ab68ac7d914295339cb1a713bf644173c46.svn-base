<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200806
 */

try
{
    $pointCtrl  = new CApp_Handler_Point_Ctrl();
    $result     = $pointCtrl->getPointByPosition($_POST["point_position"]);
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