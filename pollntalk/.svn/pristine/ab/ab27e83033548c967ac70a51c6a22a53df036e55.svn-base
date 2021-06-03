<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20201106
 */

try
{
    $couponCtrl = new CApp_Handler_Coupon_Ctrl();
    $result     = $couponCtrl->getCouponInfoByIndex($_POST["coupon_index"]);
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