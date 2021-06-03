<?php
/**
 *  @auth   : YS PARK
 *  @date   : 20200529
 *  공지 사항 관리자 페이지
 *  1 : 공지사항
 *  2 : 1대1 
 *  3 : faq
 */
try 
{
    // 공지 사항 처리
    $num    = $_GET["num"];
    $board  = new CApp_Handler_Admin_board();
    
    $board->updateBoardCount($num);
    $result = $board->getBoardContext($num);
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
					<form id="frmBoardInfo" action="/admin_controller.php?mode=board_proc" method="post">
						<input type="hidden" id="NUM" name="NUM" value="<?php echo($num); ?>" />
						<input type="hidden" id="kind" name="kind" value="2" />
						<input type="hidden" id="pagename" name="pagename" value="boardnotice" />  
						<input type="hidden" id="exec" name="exec" value="delete" />
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> <span>자주하는 질문</span>
						</div>
						<!-- 관리자 등록 -->
						<div class="boardBox">
							<input type="hidden" id="num" name="num" value="<?php echo($result["NUM"]); ?>"/> 
							<div class="boardWriteItem">
								<div class="boardName">
									<span>제목</span>
								</div>
								<div class="boardInputBox">
									<span id="board_subject"><?php echo($result["SUBJECT"]); ?></span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>작성자</span>
								</div>
								<div class="boardInputBox">
									<span id="writer"><?php echo($result["NAME"]); ?></span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>등록일</span>
								</div>
								<div class="boardInputBox">
									<span id="update_date"><?php echo($result["CREATE_DATE"]); ?></span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>조회수</span>
								</div>
								<div class="boardInputBox">
									<span id="view_count"><?php echo($result["COUNT"]); ?></span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>내용</span>
								</div>
								<div class="boardContextBox" id="context"><?php echo($result["CONTEXT"]); ?></div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>첨부파일</span>
								</div>
								<div class="boardContextBox">
<?php 
try
{
    $result = $board->getBoardFileList($num);
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
											<a href="/controller.php?mode=file_download&file_seq=<?php echo($item["ATTACH_FILE_SEQ"]); ?>">
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
								<a href="/admin_manager.php?mode=boardfaqwrite&num=<?php echo($num); ?>">
									<span class="buttonText">수정하기</span>
								</a>
							</div>
							<div id="deleteArticle" class="buttonBox">
								<a href="javascript:deleteBoard('frmBoardInfo')">
									<span class="buttonText">삭제하기</span>
								</a>
							</div>
							<div id="boardListBack" class="buttonBox">
								<a href="/admin_manager.php?mode=boardfaqlist">
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