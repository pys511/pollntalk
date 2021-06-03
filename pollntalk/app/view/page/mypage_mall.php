<?php 
/**
 *  @auth   : JEON JY
 *  @date   : 20201029
 *  포인트 몰
 */
try
{
    $page           = $_GET["page"];
    $keyword        = "";
    // 문의 사항 처리
    $coupon         = new CApp_Handler_Coupon_Ctrl();
    $count          = $coupon->getCouponListOfMallCount($keyword);
    $paging         = $coupon->makePaging($count, $page);
    $result         = $coupon->getCouponListOfMall($keyword, $paging);
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<div class="messagecontent">
	<!-- 구입 쿠폰 상황 시작 -->
	<div class="messagestatus">
		<div class="messagestatustitle title">
			<span>구입 쿠폰</span>
		</div>
		<div class="messagestatustitle">
			<span>진행 쿠폰</span>
		</div>
	</div>
	<!-- 텝 컨텐츠 시작 -->
	<div class="tabcontent">
		<!-- 쿠폰 목록 시작 -->
		<div class="malllistbox">
			<ul>
<?php
$i  = 0;
foreach ($result as $items)
{
    $coupon_seq                 = $items["COUPON_SEQ"];
    $coupon_name                = $items["COUPON_NAME"];
    $coupon_context             = $items["COUPON_CONTEXT"];
    $coupon_image_context       = $items["COUPON_IMAGE_PATH"];
    $coupon_expire_date_name    = $items["COUPON_NO_EXPIRE_NAME"];
    
    $className  = "class='mrspace'";
    $ext        = $i % 2;
    $i++;
?>		
				<li <?php if ($ext == 0) { echo($className); } ?> >
					<a href="/?mode=mypage&sub=mallcoupon&coupon_seq=<?php echo($coupon_seq); ?>">
    					<div id="mallitem_<?php echo($coupon_seq); ?>" class="mallitem">
    						<input type="hidden" class="couponitem" id="mallitem_value_<?php echo($coupon_seq); ?>" name="mallitem_value_<?php echo($coupon_seq); ?>" value="<?php echo($coupon_seq); ?>" />
    						<div class="mallitembox">
    							<div class="mallitemtitle">
    								<span><?php echo($coupon_name); ?></span>
    							</div>
    							<div class="mallitemcontext">
    								<div class="mallitemimg">
    									<img src="/<?php echo($coupon_image_context); ?>" width="173" />
    								</div>
    								<div class="malliteminfo">
    									<div class="mallitemdoc">
    										<span><?php echo($coupon_context); ?></span>
    									</div>
    									<div class="mallitemdate">
    										<span class="mallfield">유효기간:</span> 
    										<span class="stress"><?php echo($coupon_expire_date_name); ?></span>
    									</div>
    								</div>
    							</div>
    						</div>
    					</div>
					</a>
				</li>
<?php 
}
?>
			</ul>
			<!-- 페이징 시작 -->
			<div class="paging">
				<!-- <div class="pagingbutton pageleftend pagenavinoselect"></div> -->
				<a id="boardprev" href="/?mode=mypage_coupon&page=<?php echo($paging["boardprev"])?>">
    				<div class="pagingbutton pageleft pagenavinoselect">
    				</div>
    			</a>
<?php
// print_r($paging);
for ($i = (integer) $paging["start"]; $i <= (integer) $paging["end"]; $i ++) 
{
    if ($page == "")
        $page   = "1";
?>
				<div class="pagingbutton <?php if($page == $i) echo("pageselect"); ?>">
					<a id="page" href="/?mode=mypage_coupon&page=<?php echo($i)?>">
						<span><?php echo($i)?></span>
					</a>
				</div>
<?php
}
?>
				<a id="boardprev" href="/?mode=mypage_coupon&page=<?php echo($paging["boardnext"])?>">
					<div class="pagingbutton pageright pagenaviselect">
					</div>
				</a>
				<!-- <div class="pagingbutton pagerightend pagenavinoselect"></div> -->
			</div>
			<!-- 페이징 끝 -->
		</div>
		<!-- 쿠폰 목록 끝 -->
	</div>
	<!-- 텝 컨텐츠 끝 -->
</div>			