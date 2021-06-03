<?php
/**
 *  @auth   : YS PARK
 *  @date   : 20210418
 *  EMAIL VIEW  페이지
 */
try 
{
    // 공지 사항 처리
    $num    = $_GET["num"];
    $mail  = new CApp_Handler_Admin_mail();
    
    $result = $mail->getBoardContext($num);
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
            <!-- 컨탠츠 -->
				<div class="contentBox">
					<form id="frmMailInfo" action="/admin_controller.php?mode=mail_delete" method="post">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> <span>MAIL</span>
						</div>
						<!-- 관리자 등록 -->
						<div class="boardBox">
							<input type="hidden" id="num" name="num" value="<?php echo($result["MAIL_NUM"]); ?>"/> 
							<div class="boardWriteItem">
								<div class="boardName">
									<span>제목</span>
								</div>
								<div class="boardInputBox">
									<span id="board_subject"><?php echo($result["MAIL_SUBJECT"]); ?></span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>받는사람</span>
								</div>
								<div class="boardInputBox">
									<span id="writer"><?php echo($result["MAIL_TO"]); ?></span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>보낸 날짜</span>
								</div>
								<div class="boardInputBox">
									<span id="update_date"><?php echo($result["MAIL_SEND_DATE"]); ?></span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>내용</span>
								</div>
								<div class="boardContextBox" id="context"><?php echo($result["MAIL_CONTEXT"]); ?></div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>첨부파일</span>
								</div>
								<div class="boardContextBox">
<?php 
try
{
    $result = $mail->getMailAttachList($num);
}
catch (CException $ex)
{
    $ex->printException();
}
?>								
									<ul>
<?php 
foreach ($result as $item)
{
?>
										<li>
											<a href="/admin_controller.php?mode=mail_att_download&fileName=<?php echo($item["FILE_NAME"]); ?>">
												<span><?php echo($item["FILE_NAME"]); ?></span>
											</a>
										</li>
<?php 
}
?>										
									</ul>
								</div>
							</div>
						</div>
						<!-- 버튼 -->
						<div class="boardListButtonBox">
							<div id="registerArticle" class="buttonBox">
								<a href="/admin_manager.php?mode=emailwrite&num=<?php echo($num); ?>">
									<span class="buttonText">다시보내기</span>
								</a>
							</div>
							<div id="deleteArticle" class="buttonBox">
								<a href="javascript:deleteMail('frmMailInfo')">
									<span class="buttonText">삭제하기</span>
								</a>
							</div>
							<div id="boardListBack" class="buttonBox">
								<a href="/admin_manager.php?mode=emaillist">
								<span class="buttonText">목 록</span>
								</a>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
<?php
require_once ('./app/view/common/editor_js.php');
require_once ('./app/view/admin/footer.php');
?>
</body>
</html>