<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  문의 사항 관리자 페이지
 */
try {
    // 문의 사항 처리
    $ask = new CApp_Handler_Admin_ask();
    $result = $ask->getAskList();
    // print_r($_SESSION);
} catch (CException $ex) {
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
						<img src="/app/images/admin/title_mark.gif" /> <span>자료실</span>
					</div>
					<div class="boardBox">
						<div class="boardField">
							<span class="fieldNumber">선택</span> <span class="fieldNumber">날짜</span>
							<span class="fieldCommon">회사명/성명</span> <span class="fieldCommon">휴대폰
								번호</span> <span class="fieldCommon">이메일 주소</span>

						</div>
						<div class="boardList">
							<ul>
<?php
// 목록이 없을 경우
if (count($result) <= 0 || $result == false) {
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
else {
    // $length = count($result);
    foreach ($result as $items) {
        ?>
        						<li id="sample_advertiselist">
									<div class="boardListItem">
										<div class="boardListItemCell">
											<input id="ir_seq" name="ir_seq[]" type="checkbox"
												value="<?php echo($items["ir_seq"]); ?>" />
											<!-- <span id="member_seq" class="fieldNumber"></span> -->
										</div>
										<div class="borderListItemBox">
											<div class="boardListItemTop">
												<a id="adverName" href="#"> <span class="fieldNumber">
        												<?php echo($items["ir_seq"]); ?>
        											</span> <span class="fieldCommon">
        												<?php echo($items["ir_comp_name"]); ?>
        											</span> <span class="fieldCommon">
        												<?php echo($items["ir_comp_phone"]); ?>
        											</span>
												</a>
											</div>
											<div class="boardListItemBottom">
												<span class="fieldCommon">
        											<?php echo($items["ir_comp_email"]); ?>
        										</span>
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
            	</div>
			</div>
		</div>
	</div>
<?php
require_once ('./app/view/admin/footer.php');
?>
</body>
</html>