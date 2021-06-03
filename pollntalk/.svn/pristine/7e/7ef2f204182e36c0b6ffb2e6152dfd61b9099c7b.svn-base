<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20201129
 *  포인트 몰 쿠폰 정보
 */
 try
 {
     $CouponSeq          = $_GET["coupon_seq"];
     $coupon             = new CApp_Handler_Coupon_Ctrl();
     $result             = $coupon->getCouponInfo($CouponSeq);
     
     $couponSeq          = $result["COUPON_SEQ"];
     $couponIndex        = $result["COUPON_INDEX"];
     $couponName         = $result["COUPON_NAME"];
     $couponContext      = $result["COUPON_CONTEXT"];
     $couponImage        = $result["COUPON_IMAGE_PATH"];
     $couponCount        = $result["COUPON_COUNT"];
     $couponContext      = $result["COUPON_CONTEXT"];
     $couponUsedPoint    = $result["COUPON_USED_POINT"];
     $couponCurExtCount  = $result["COUPON_CUR_EXT_COUNT"];
     if ($couponCurExtCount == "")
         $couponCurExtCount = "0";
     $noExpire           = $result["COUPON_NO_EXPIRE"];
     $couponExpireDate   = $result["COUPON_EXPIRE_DATE"];
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<!-- 텝 컨텐츠 시작 -->
<div class="tabcontent">
	<!-- 쿠폰 구매 시작 -->
	<div class="couponarea">
		<div class="couponbox">
			<input type="hidden" id="coupon_seq" name="coupon_seq" value="<?php echo($couponSeq); ?>" />
			<div class="couponimg">
				<img src="/<?php echo($couponImage); ?>" width="278" />
			</div>
			<div class="couponinfobox">
				<div class="coupontitle">
					<span><?php echo($couponName); ?></span>
				</div>
				<div class="coupondoc">
					<span><?php echo($couponContext); ?></span>
				</div>
				<div class="coupondata">
					<div class="couponitem">
						<span class="couponfield">유효기간 :</span>
<?php 
if ($noExpire == "1")
{
?>
						<span class="stress">무제한</span>
<?php 
}
else 
{
?>
						<span class="stress"><?php echo($couponExpireDate); ?></span>
<?php
}
?>
					</div>
					<div class="couponitem">
						<span class="couponfield">구매 인원 :</span> 
						<span class="stress"><?php echo($couponCurExtCount); ?> / <?php echo($couponCount); ?></span>
					</div>
					<div class="couponitem">
						<span class="couponfield">차감 포인트 :</span> 
						<span class="stress"><?php echo($couponUsedPoint); ?>p</span>
					</div>
				</div>
				<?php 
    						  if($_SESSION["cert"] == "1"){
    						?>
    							<div id="buyCoupon" class="couponbutton">
					<a href="javascript:void(0)"><span>구매하기</span></a>
				</div>
    						<?php
    						  }else{
    						?>
    							<div id="buyCouponCert" class="couponbutton">
					<a href="javascript:void(0)"><span>구매하기</span></a>
				</div>
    						<?php
    						  }
    						?>
			</div>
		</div>
	</div>
	<!-- 쿠폰 구매 끝 -->
</div>
<!-- 텝 컨텐츠 끝 -->