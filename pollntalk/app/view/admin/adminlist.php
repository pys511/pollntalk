<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  문의 사항 관리자 페이지
 */
try {
    // 문의 사항 처리
    $admin  = new CApp_Handler_Admin_Ctrl();
    $count  = $admin->getAdminListCount();
    $page   = $_GET["page"];
    $paging = $admin->makePaging($count, $page);
    $result = $admin->getAdminList($_POST, $paging);
    // print_r($_SESSION);
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
						<span>관리자 목록</span>
					</div>
					<div class="boardBox">
						<div class="boardField">
							<span style="width: 5%">번호</span> 
							<span style="width: 15%">이름</span>
							<span style="width: 15%">아이디</span> 
							<span style="width: 20%">연락처</span>
							<span style="width: 15%">이메일</span>
							<span style="width: 20%">최종로그인</span> 
							<span style="width: 10%">등급</span>
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
} 
// 목록이 있을 경우
else 
{
    // $length = count($result);
    foreach ($result as $items) 
    {
?>
        						<li>
									
										<div class=boardListItem>
											<span id="user_seq" style="width: 5%">
            									<?php echo($items["admin_seq"]); ?>
            								</span>
											<a id="memberName" href="/admin_manager.php?mode=adminregister&admin_seq=<?php echo($items["admin_seq"]); ?>">
												<span style="width: 15%">
            										<?php echo($items["admin_name"]); ?>
            									</span> 
            									<span style="width: 15%">
            										<?php echo($items["admin_id"]); ?>
            									</span>
											</a>
											<span style="width: 20%">
            									<?php echo($items["phone_number"]); ?>
            								</span>
            								<span style="width: 15%">
            									<?php echo($items["admin_mail"]); ?>
            								</span> 
            								<span style="width: 20%">
            									<?php echo($items["last_login"]); ?>
            								</span> 
            								<span style="width: 10%">
            									<?php echo($items["admin_grade"]); ?>
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
						<div id="registerAdmin" class="buttonBox">
							<a href="/admin_manager.php?mode=adminregister">
								<span class="buttonText">등록하기</span>
							</a>
						</div>
						<div class="buttonLeftBox">
							<a id="boardprev" href="/admin_manager.php?mode=adminlist&page=<?php echo($paging["boardprev"])?>">
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
								<a id="page" href="/admin_manager.php?mode=adminlist&page=<?php echo($i)?>">
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
							<a id="boardnext" href="/admin_manager.php?mode=adminlist&page=<?php echo($paging["boardnext"])?>">
								<span class="buttonText">▶</span>
							</a>
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