<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200829
 *  투표 목록
 */
try 
{
    $cate_seq       = $_GET["cate_seq"];
    $cate_sub_seq   = $_GET["cate_sub_seq"];
    $keyword        = $_POST["keyword"];
    $page           = $_GET["page"];
    // 문의 사항 처리
    $vote           = new CApp_Handler_Vote_Ctrl();
    $count          = $vote->getVoteFormListCount();
    $paging         = $vote->makePaging($count, $page);
    $result         = $vote->getAdminVoteFormList($cate_seq, $cate_sub_seq, $keyword, $paging);
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
						<span>투표 양식 목록</span>
					</div>
					<div class="boardBox">
						<div class="boardField">
							<span class="fieldShortShort">선택</span> <span class="fieldNumber">등록일</span>
							<span class="fieldDefault">카테고리</span> <span class="fieldCommon">제목</span>
							<span class="fieldNumber">조회수</span> <span class="fieldNumber">사용수</span>
							<span class="fieldNumber">전환율</span> <span class="fieldNumber">이용율</span>
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
        $vote_form_seq      = $items["VOTE_FORM_SEQ"];
        $vote_writer_id     = $items["VOTE_WRITER_ID"];
        $vote_form_kind     = $items["VOTE_FORM_KIND"];
        $vote_type          = $items["VOTE_TYPE"];
        $vote_subject       = $items["VOTE_SUBJECT"];
        $vote_cate_seq      = $items["VOTE_CATE_SEQ"];
        $vote_cate_name     = $items["VOTE_CATE_NAME"];
        $vote_cate_sub_seq  = $items["VOTE_CATE_SUB_SEQ"];
        $vote_cate_sub_name = $items["VOTE_CATE_SUB_NAME"];
        $vote_resource_type = $items["VOTE_RESOURCE_TYPE"];
        $vote_url           = $items["VOTE_URL"];
        $vote_view_count    = $items["VOTE_VIEW_COUNT"];
        $vote_use_count     = $items["VOTE_USE_COUNT"];
        $vote_regi_date     = $items["VOTE_REGI_DATE"];
        $cate_name          = $vote_cate_name;
        if ($cate_name == "")
            $cate_name = $vote_cate_sub_name;
?>
        						<li id="sample_advertiselist">
									<div class="boardListItem">
										<div class="fieldShortShort">
											<input id="vote_form_seq" name="vote_form_seq[]" type="checkbox" value="<?php echo($vote_form_seq); ?>" />
											<!-- <span id="member_seq" class="fieldNumber"></span> -->
										</div>
										<a id="adverName" href="/admin_manager.php?mode=voteform&vote_form_seq=<?php echo($vote_form_seq); ?>">
											<span class="fieldNumber"><?php echo($vote_regi_date); ?></span>
											<span class="fieldDefault"><?php echo($cate_name); ?></span>
											<span class="fieldCommon"><?php echo($vote_subject); ?></span>
										</a> 
										<span class="fieldNumber"><?php echo($vote_view_count); ?></span>
										<span class="fieldNumber"><?php echo($vote_use_count); ?></span>
										<span class="fieldNumber"><?php echo($vote_use_count); ?></span>
										<span class="fieldNumber"><?php echo($vote_use_count); ?></span>
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
							<a href="/admin_manager.php?mode=voteform"><span
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