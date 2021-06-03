<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20201029
 *  포인트 이력 목록
 */
try
{
    $page           = $_GET["page"];
    $keyword        = $_POST["keyword"];
    // 문의 사항 처리
    $pointInfo      = new CApp_Handler_Point_Ctrl();
    $count          = $pointInfo->getPointLogListCount($keyword);
    $paging         = $pointInfo->makePaging($count, $page);
    $result         = $pointInfo->getPointLogList($keyword, $paging);
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
						<span>포인트 이력</span>
					</div>
					<div class="boardBox">
						<div class="boardField">
							<span class="fieldShortShort">선택</span> 
							<span class="fieldNumber">발급일</span>
							<span class="fieldDefault">받은 회원</span> 
							<span class="fieldCommon">받은 위치</span>
							<span class="fieldNumber">포인트</span> 
							<span class="fieldNumber">발급 종류</span>
							<span class="fieldNumber">비고</span> 
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
        $logSeq             = $items["POINT_LOG_SEQ"];
        $memberSeq          = $items["MEMBER_SEQ"];
        $memberName         = $items["MEMBER_NAME"];
        $pointPosition      = $items["POINT_POSITION"];
        $pointPositionName  = $items["POINT_POSITION_NAME"];
        $pointKind          = $items["POINT_KIND"];
        $pointKindName      = $items["POINT_KIND_NAME"];
        $pointType          = $items["POINT_TYPE"];
        $pointTypeName      = $items["POINT_TYPE_NAME"];
        $point              = $items["POINT"];
        $pointRegidate      = $items["POINT_REGI_DATE"];
?>
        						<li id="sample_advertiselist">
									<div class="boardListItem">
										<div class="fieldShortShort">
											<input id="vote_form_seq" name="vote_form_seq[]" type="checkbox" value="<?php echo($logSeq); ?>" />
											<!-- <span id="member_seq" class="fieldNumber"></span> -->
										</div>
										<a id="adverName" href="/admin_manager.php?mode=memberinfo&member_seq=<?php echo($memberSeq); ?>">
											<span class="fieldNumber"><?php echo($pointRegidate); ?></span>
											<span class="fieldDefault"><?php echo($memberName); ?></span>
											<span class="fieldCommon"><?php echo($pointPositionName); ?></span>
										</a> 
										<span class="fieldNumber"><?php echo($point); ?></span>
										<span class="fieldNumber"><?php echo($pointKindName); ?></span>
										<span class="fieldNumber"><?php echo($pointTypeName); ?></span>
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
							<a id="boardprev" href="/admin_manager.php?mode=pointlog&page=<?php echo($paging["boardprev"])?>">
								<span class="buttonText">◀</span>
							</a>
						</div>
						<div id="adverpaging" class="boardPaging">
<?php
// print_r($paging);
for ($i = (integer) $paging["start"]; $i <= (integer) $paging["end"]; $i ++) 
{
?>
							<div id="pageSample" class="buttonLeftBox">
								<a id="page" href="/admin_manager.php?mode=pointlog&page=<?php echo($i)?>">
									<span id="pageText" class="buttonText">
										<?php echo($i)?>  
									</span>
								</a>
							</div>
<?php
}
?>
						</div>
						<div class="buttonLeftBox">
							<a id="boardnext" href="/admin_manager.php?mode=adminlist&page=<?php echo($i)?>">
								<span class="buttonText">▶</span>
							</a>
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