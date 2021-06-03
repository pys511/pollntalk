<?php
/**
 *  @auth   : YS PARK
 *  @date   : 20210418
 *  Email LIst
 */
try
{
    // Email LIST
    $maillist      = new CApp_Handler_Admin_mail();
    $count      = $maillist->getEmailCount();
    $page       = $_GET["page"];
    $paging     = $maillist->makePaging($count, $page);
    $result     = $maillist->getMailList($paging);
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
						<span>자주하는 질문</span>
					</div>
					<div class="boardBox">
						<div class="boardField">
							<span style="width: 10%">번호</span>
							<span style="width: 20%">보낸사람</span>
							<span style="width: 50%">제목</span>
							<span style="width: 20%">보낸날짜</span> 
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
else 
{
    // $length = count($result);
    foreach ($result as $items) 
    {
?>
        						<li id="sample_advertiselist">
									<div class="boardListItem">
										<span style="width: 10%"> <?php echo($items["MAIL_NUM"]); ?>
        								</span> 
        								<span style="width: 20%"> <?php echo($items["MAIL_TO"]); ?>
        								</span>
        								<a id="adverName" href="/admin_manager.php?mode=emailview&num=<?php echo($items["MAIL_NUM"]); ?>"> 
        									<span style="width: 50%"> <?php echo($items["MAIL_SUBJECT"]); ?>
        									</span>
        								</a> 
        								<span style="width: 20%"> <?php echo($items["MAIL_SEND_DATE"]); ?>
        								</span>
									</div>
								</li>
<?php
    }
}
?>
        					</ul>
						</div>
					</div>
					<!-- 페이징 -->
					<div class="boardListButtonBox">
						<div class="buttonLeftBox">
							<a id="boardprev" href="/admin_manager.php?mode=emaillist&page=<?php echo($paging["boardprev"])?>">
								<span class="buttonText">◀</span>
							</a>
						</div>
						<div id="adverpaging" class="boardPaging">
<?php
// print_r($paging);
for ($i = (integer) $paging["start"]; $i <= (integer) $paging["end"]; $i ++) 
{
?>
    						<div class="buttonLeftBox">
								<a id="page" href="/admin_manager.php?mode=emaillist&page=<?php echo($i)?>">
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
							<a id="boardnext" href="/admin_manager.php?mode=emaillist&page=<?php echo($paging["boardnext"])?>">
								<span class="buttonText">▶</span>
							</a>
						</div>
					</div>
					<!-- 버튼 -->
					<div class="boardListButtonBox">
						<div class="buttonBox">
							<a href="/admin_manager.php?mode=emailwrite">
							<span class="buttonText">메일 쓰기</span></a>
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