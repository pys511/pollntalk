<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20200921
 *  쿠폰 구매 처리
 */
try
{
    $coupon_seq     = $_POST["coupon_seq"];
    $couponCtrl     = new CApp_Handler_Coupon_Ctrl();
    $result         = $couponCtrl->buyCoupon($coupon_seq);
    if (! $result)
        echo ("FALSE");
    else
        echo ("TRUE");
}
catch (CException $ex)
{
    $ex->printException();
}
?>