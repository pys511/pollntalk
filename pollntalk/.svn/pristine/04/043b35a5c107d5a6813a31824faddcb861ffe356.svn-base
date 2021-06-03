<?php
/**
 * @auth   	: JEON JY
 * @date	: 20201203
 * 쿠폰 처리
 */
try
{
    //print_r($_POST);
    //exit;
    $exec       = $_GET["exec"];
    $couponCtrl = new CApp_Handler_Coupon_Ctrl();
    if ($exec != "del")
    {
        $result     = $couponCtrl->registerCouponInfo($_POST);
        $procName   = "등록";
    }
    else
    {
        $result     = $couponCtrl->deleteCouponInfo($_POST);
        $procName   = "삭제";
    }
        
    if (! $result)
    {
?>
<script>
		alert("<?php echo($procName); ?>하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=couponregister";
</script>
<?php
    }
    else
    {
?>
<script>
		alert("<?php echo($procName); ?>되었습니다.");
		location.href	= "/admin_manager.php?mode=couponregister&coupon_seq=<?php echo($result); ?>";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>