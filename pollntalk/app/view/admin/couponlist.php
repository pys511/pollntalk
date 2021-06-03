<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200829
 *  투표 목록
 */
try
{
    $keyword        = $_POST["keyword"];
    $page           = $_GET["page"];
    // 문의 사항 처리
    $vote           = new CApp_Handler_Coupon_Ctrl();
    $count          = $vote->getCouponListCount($keyword);
    $paging         = $vote->makePaging($count, $page);
    $result         = $vote->getCouponList($keyword, $paging);
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<!doctype html>
<html id="start" xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once ('./app/view/admin/header.php');
?>
<body id="body">
	<div id="mobilemenu" class="mobileMenu" style="display: none;">
		<!-- 서브메뉴 -->
	</div>
	<div class="pageArea">
<?php
require_once ('./app/view/admin/common.php');
?>	
		<div id="content" class="pageBox">
			<!-- content -->
			<div class="contentArea">
<?php
require_once ('./app/view/admin/submenu.php');
?>	
            	<div class="contentBox">
					<div class="boardTitle">
						<img src="/app/images/admin/title_mark.gif" /> 
						<span>쿠폰 목록</span>
					</div>
					<div class="boardBox">
						<div class="boardField">
							<span class="fieldShortShort">선택</span> 
							<span class="fieldNumber">쿠폰 번호</span>
							<span class="fieldNumber">쿠폰 유형</span>
							<span class="fieldCommon">쿠폰 이름</span>
							<span class="fieldNumber">구매인원</span> 
							<span class="fieldNumber">남은 쿠폰</span>
							<span class="fieldNumber">유효기간</span> 
						</div>
						<div class="boardList">
							<ul>
<?php
// 목록이 없을 경우
if (count($result) <= 0 || $result == false) 
{
?>
        						<li id="noData">
									<div class="boardListItem">
										<div class="borderListItemGuide">
											<span>등록된 컨텐츠가 없습니다.</span>
										</div>
									</div>
								</li>
<?php
} // 목록이 있을 경우
else 
{
    // $length = count($result);
    foreach ($result as $items) 
    {
        $coupon_seq             = $items["COUPON_SEQ"];
        $coupon_index           = $items["COUPON_INDEX"];
        $coupon_type            = $items["COUPON_TYPE_NAME"];
        $coupon_name            = $items["COUPON_NAME"];
        $coupon_count           = $items["COUPON_COUNT"];
        $coupon_ext_count       = $items["COUPON_EXT_COUNT"];
        $coupon_ext_cur_count   = $items["COUPON_CUR_EXT_COUNT"];
        if ($coupon_ext_cur_count != "")
            $coupon_ext_count   = $coupon_ext_cur_count;
        $coupon_expire_date     = $items["COUPON_EXPIRE_DATE"];
?>
        						<li id="sample_advertiselist">
									<div class="boardListItem">
										<div class="fieldShortShort">
											<input id="vote_coupon_seq" name="vote_coupon_seq[]" type="checkbox" value="<?php echo($coupon_seq); ?>" />
										</div>
										<a id="adverName" href="/admin_manager.php?mode=couponregister&coupon_seq=<?php echo($coupon_seq); ?>">
											<span class="fieldNumber"><?php echo($coupon_index); ?></span>
											<span class="fieldNumber"><?php echo($coupon_type); ?></span>
											<span class="fieldCommon"><?php echo($coupon_name); ?></span>
										</a> 
										<span class="fieldNumber"><?php echo($coupon_count); ?></span>
										<span class="fieldNumber"><?php echo($coupon_ext_count); ?></span>
										<span class="fieldNumber"><?php echo($coupon_expire_date); ?></span>
									</div>
								</li>
<?php
    }
?>
        					</ul>
						</div>
					</div>
					<!-- 페이징 -->
					<div class="boardListButtonBox">
						<div class="buttonLeftBox">
							<a id="boardprev" href="#"><span class="buttonText">◀</span></a>
						</div>
						<div id="adverpaging" class="boardPaging">
							<div id="pageSample" class="buttonLeftBox">
								<a id="page" href="#"><span id="pageText" class="buttonText"></span></a>
							</div>
						</div>
						<div class="buttonLeftBox">
							<a id="boardnext" href="#"><span class="buttonText">▶</span></a>
						</div>
					</div>
<?php
}
?>        			
					<!-- 버튼 -->
					<div class="boardListButtonBox">
						<div class="buttonBox">
							<a href="/admin_manager.php?mode=couponregister"><span
								class="buttonText">등록하기</span></a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
<?php
require_once ('./app/view/admin/footer.php');
?>
</body>
</html>