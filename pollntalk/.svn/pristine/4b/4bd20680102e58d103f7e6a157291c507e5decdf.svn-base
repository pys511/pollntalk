<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200829
 *  내 투표 목록
 */
try
{
    $page           = $_GET["page"];
    // 문의 사항 처리
    $vote           = new CApp_Handler_Coupon_Ctrl();
    $count          = $vote->getCouponLogCountByMember();
    $paging         = $vote->makePaging($count, $page);
    $result         = $vote->getCouponLogByMember($paging);
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
	</div>
	<div class="pointstatus">
		<!-- 쿠폰 목록 영역 시작 -->
		<div class="table">
			<div class="tablebox">
				<div class="tableborder">
					<div class="tablefield">
						<div class="defaulttableitem wrline">
							<span>구입 쿠폰</span>
						</div>
						<div class="defaulttableitemshort wrline">
							<span>구입일</span>
						</div>
						<div class="defaulttableitemshort wrline">
							<span>포인트 사용</span>
						</div>
						<div class="defaulttableitemshort wrline">
							<span>쿠폰 유효기간</span>
						</div>
						<div class="defaulttableitemshort">
							<span>사용현황</span>
						</div>
					</div>
					<div class="tablelist">
						<!-- 쿠폰 요약 목록 시작 -->
						<ul>
<?php 
// $length = count($result);
foreach ($result as $items)
{
    $coupon_seq             = $items["COUPON_SEQ"];
    $coupon_index           = $items["COUPON_INDEX"];
    $coupon_name            = $items["COUPON_NAME"];
    $coupon_log_status_name = $items["COUPON_LOG_STATUS_NAME"];
    $coupon_no_expire_name  = $items["COUPON_NO_EXPIRE_NAME"];
    $issued_type            = $items["COUPON_ISSUED_TYPE"];
    $issued_type_name       = $items["COUPON_ISSUED_TYPE_NAME"];
    $coupon_issued_date     = $items["COUPON_ISSUED_REGI_DATE"];
?>
							<li>
								<div class="defaulttableli">
									<div class="defaulttableitem wrline">
										<div class="defaulttablefield mline">
											<span>쿠폰명</span>
										</div>
										<div class="defaulttabledata mrline">
											<span><?php echo($coupon_name); ?></span>
										</div>
									</div>
									<div class="defaulttableitemshort wrline">
										<div class="defaulttablefield mline">
											<span>구입일</span>
										</div>
										<div class="defaulttabledata mrline">
											<span><?php echo($coupon_issued_date); ?></span>
										</div>
									</div>
<?php 
if ($issued_type != "1")
{
?>
									<div class="defaulttableitemshort wrline">
										<div class="defaulttablefield mline">
											<span>포인트 사용</span>
										</div>
										<div class="defaulttabledata mrline">
											<span><?php echo($issued_type_name); ?></span>
										</div>
									</div>
<?php 
}
else 
{
    $issued_used_point      = $items["COUPON_USED_POINT"];
?>
									<div class="pointnumbershort wrline">
										<div class="defaulttablefield mline">
											<span>포인트 사용</span>
										</div>
										<div class="defaulttabledata mrline">
											<span><?php echo($issued_used_point); ?></span>
										</div>
									</div>
<?php 
}
?>
									<div class="defaulttableitemshort wrline">
										<div class="defaulttablefield mline">
											<span>쿠폰 유효기간</span>
										</div>
										<div class="defaulttabledata mrline">
											<span><?php echo($coupon_no_expire_name); ?></span>
										</div>
									</div>
									<div class="defaulttableitemshort ">
										<div class="defaulttablefield mline mbline">
											<span>프린트</span>
										</div>
										<div class="defaulttabledata mrline mbline">
											<button type="button">
												<span>프린트</span>
											</button>
										</div>
									</div>
								</div>
							</li>
<?php 
}
?>
						</ul>
					</div>
				</div>
				<!-- 쿠폰 요약 목록 끝 -->
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
		</div>
		<!-- 쿠폰 목록 영역 끝 -->
	</div>
	<!-- 쿠폰 현황 끝 -->
</div>