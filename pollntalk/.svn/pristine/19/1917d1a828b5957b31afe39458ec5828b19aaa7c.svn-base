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
    // 1대1 고객지원 처리
    $num            = $_GET["num"];
    $exec           = "";
    if($num != "")
    {
        $exec       = "register";
        $board      = new CApp_Handler_Admin_board();
        $result     = $board->getBoardContext($num);
        $context    = $result["CONTEXT"];
        $context    = str_replace("\"", "'", $context);
        //$context    = htmlspecialchars($result["CONTEXT"], ENT_QUOTES);
    }
    else 
        $exec   = "update";
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
					<form id="frmBoard" action="/admin_controller.php?mode=board_proc" method="post">
						<input type="hidden" id="exec" name="exec" value="<?php echo($exec); ?>"/>
						<input type="hidden" id="pagename" name="pagename" value="boardsupport"/>
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> 
							<span>1대1 고객지원 작성</span>
						</div>
						<!-- 게시판 등록 -->
						<div class="boardBox">
							<input type="hidden" id="NUM" name="NUM" value="<?php echo($num); ?>" /> 
							<input type="hidden" id="TYPE" name="TYPE" value="1" /> 
							<input type="hidden" id="KIND" name="KIND" value="1" />
							<input type="hidden" id="CONTEXT" name="CONTEXT" />
							<div class="boardWriteItem">
								<div class="boardName">
									<span>제목</span>
								</div>
								<div class="boardInputBox">
									<input id="board_subject" name="SUBJECT" type="text" class="longInput" value = "<?php if($num != ""){ echo($result["SUBJECT"]); } else {}?>">
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>내용</span>
								</div>
								<div class="boardContextBox" id="context">
									<div class="subContentWriteControl">
										<div class="buttonFontGroup">
											<div class="contentListButton">
												<select size="1" id="selFontName" onChange="selectFontName('textEdit', 'selFontName')">
													<option value="굴림">굴림</option>
													<option value="궁서">궁서</option>
													<option value="돋움">돋움</option>
													<option value="바탕">바탕</option>
												</select>
											</div>
											<div class="contentListButton">
												<select size="1" id="selFontSize" onChange="selectFontSize('textEdit', 'selFontSize')">
													<option value="8">8pt</option>
													<option value="9">9pt</option>
													<option value="10">10pt</option>
													<option value="12">12pt</option>
													<option value="14">14pt</option>
													<option value="18">18pt</option>
													<option value="24">24pt</option>
													<option value="36">36pt</option>
												</select>
											</div>
										</div>
										<div class="buttonStyleGroup">
											<div class="contentListButton">
												<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" />
												<div class="buttonText">
													<a href="javascript:setEditCommand('textEdit', 'Bold')">
														<span style="font-weight: bold;">가</span>
													</a>
												</div>
												<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
											</div>
											<div class="contentListButton">
												<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" />
												<div class="buttonText">
													<a href="javascript:setEditCommand('textEdit', 'Underline')">
														<span style="text-decoration: underline;">가</span>
													</a>
												</div>
												<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
											</div>
											<div class="contentListButton">
												<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" />
												<div class="buttonText">
													<a href="javascript:setEditCommand('textEdit', 'Italic')">
														<span style="font-style: italic;">가</span>
													</a>
												</div>
												<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
											</div>
											<div class="contentListButton">
												<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" />
												<div class="buttonText">
													<a href="javascript:setEditCommand('textEdit', 'strikeThrough')">
														<span style="text-decoration: line-through">가</span>
													</a>
												</div>
												<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
											</div>
										</div>
										<div class="buttonContextGroup">
											<div class="contentListButton">
												<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" />
												<div class="buttonText">
													<a href="javascript:setEditCommand('textEdit', 'JustifyLeft')">
														<img class="buttonContextShort" src="/app/images/button_14.gif" alt="문단 버튼" /> 
														<img class="buttonContextLarge" src="/app/images/button_14_01.gif" alt="문단 버튼" />
													</a>
												</div>
												<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
											</div>
											<div class="contentListButton">
												<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" />
												<div class="buttonText">
													<a href="javascript:setEditCommand('textEdit', 'JustifyCenter')">
														<img class="buttonContextShort" src="/app/images/button_15.gif" alt="문단 버튼" /> 
														<img class="buttonContextLarge" src="/app/images/button_15_01.gif" alt="문단 버튼" />
													</a>
												</div>
												<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
											</div>
											<div class="contentListButton">
												<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" />
												<div class="buttonText">
													<a href="javascript:setEditCommand('textEdit', 'JustifyRight')">
														<img class="buttonContextShort" src="/app/images/button_16.gif" alt="문단 버튼" /> 
														<img class="buttonContextLarge" src="/app/images/button_16_01.gif" alt="문단 버튼" />
													</a>
												</div>
												<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
											</div>
										</div>
										<div class="buttonExtraGroup">
											<div class="contentListButton">
												<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" /> 
												<a id="btnSetForeColor" href="javascript:insertForeColor()"> 
													<img src="/app/images/button_18.png" alt="글자색" />
												</a> 
												<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
											</div>
											<div class="contentListButton">
												<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" /> 
												<a id="btnSetBackColor" href="javascript:insertBackColor()"> 
													<img src="/app/images/button_19.png" alt="배경색" />
												</a> 
												<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
											</div>
										</div>
										<div class="buttonExtraGroup">
											<div class="contentListButton">
												<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" />
												<div class="buttonText">
													<a href="javascript:setEditCommand('textEdit', 'createLink')">
														<span style="font-weight: bold;">URL</span>
													</a>
												</div>
												<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
											</div>
											<div class="contentListButton">
												<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" />
												<div class="buttonText">
													<a href="javascript:viewHTML('btnViewHTML', 'htmlEdit', 'textEdit')"> 
														<span id="btnViewHTML" style="font-style: italic;">HTML</span>
													</a>
												</div>
												<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
											</div>
											<div class="contentListButton">
												<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" />
												<div class="buttonText">
													<a href="javascript:findImageFile()"> 
														<img class="buttonContextShort" src="/app/images/button_17.gif" alt="문단 버튼" /> 
														<img class="buttonContextLarge" src="/app/images/button_17_01.gif" alt="문단 버튼" />
													</a>
												</div>
												<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
											</div>
											<div class="contentListButton">
												<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" />
												<div class="buttonText">
													<a href="javascript:findFile()"> 
														<span>파일등록</span>
													</a>
												</div>
												<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
											</div>
										</div>

									</div>
									<div class="contentTextArea">
										<select id="viewfilelist" name="viewfilelist" size="5">
<?php 
try
{
    $result = $board->getBoardFileList($num);
}
catch (CException $ex)
{
    $ex->printException();
}

foreach ($result as $item)
{
?>
											<option value="<?php echo(ATTACH_FILE_SEQ); ?>"><?php echo($item["FILE_NAME"]); ?></option>
<?php 
}
?>
										</select>
										<button type="button" id="deleteFile" onclick="javascript:deleteBoardFile('viewfilelist')">
											<span>파일삭제</span>
										</button>
										<iframe id="textEdit" name="textEdit" style="width: 100%; height: calc(100vh - 450px); border: 1px #BFBFBF solid;"></iframe>
										<textarea id="htmlEdit" name="htmlEdit" style="display:none;width: 100%; height: calc(100vh - 450px); border: 1px #BFBFBF solid;"></textarea>
									</div>
									<input type="hidden" id="board_context" name="board_context" />
									<input type="hidden" id="image_list" name="image_list" />
									<input type="hidden" id="file_list" name="file_list" />
								</div>
							</div>
						</div>
						<!-- 버튼 -->
						<div class="boardListButtonBox">
							<div id="registerBoard" class="buttonBox">
								<a href="javascript:registerBoard('frmBoard', 'board_subject', 'textEdit', 'board_context', 'viewfilelist', 'file_list', 'image_list')">
									<span class="buttonText">등록하기</span>
								</a>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
	<div class="colorPane" id="colorPane" style="float:left;display:none;width:100%;">
		<table id="dvColorPane" border="0" cellspacing="0" cellpadding="0" style="position:absolute;width:320px;border:1 solid #000000;">
			<tr>
				<td bgcolor="#000000" onclick="selectForeColor('textEdit', '#000000')">　</td>
				<td bgcolor="#FFFFFF" onclick="selectForeColor('textEdit', '#FFFFFF')">　</td>
				<td bgcolor="#FF0000" onclick="selectForeColor('textEdit', '#FF0000')">　</td>
				<td bgcolor="#FF9933" onclick="selectForeColor('textEdit', '#FF9933')">　</td>
				<td bgcolor="#FFFF00" onclick="selectForeColor('textEdit', '#FFFF00')">　</td>
				<td bgcolor="#00FF00" onclick="selectForeColor('textEdit', '#00FF00')">　</td>
			</tr>
			<tr>
				<td bgcolor="#C0C0C0" onclick="selectForeColor('textEdit', '#C0C0C0')">　</td>
				<td bgcolor="#808080" onclick="selectForeColor('textEdit', '#808080')">　</td>
				<td bgcolor="#800000" onclick="selectForeColor('textEdit', '#800000')">　</td>
				<td bgcolor="#808000" onclick="selectForeColor('textEdit', '#808000')">　</td>
				<td bgcolor="#008000" onclick="selectForeColor('textEdit', '#008000')">　</td>
				<td bgcolor="#00FFFF" onclick="selectForeColor('textEdit', '#00FFFF')">　</td>
			</tr>
			<tr>
				<td bgcolor="#008080" onclick="selectForeColor('textEdit', '#008080')">　</td>
				<td bgcolor="#FF00FF" onclick="selectForeColor('textEdit', '#FF00FF')">　</td>
				<td bgcolor="#B0C4DE" onclick="selectForeColor('textEdit', '#B0C4DE')">　</td>
				<td bgcolor="#0000FF" onclick="selectForeColor('textEdit', '#0000FF')">　</td>
				<td bgcolor="#000080" onclick="selectForeColor('textEdit', '#000080')">　</td>
				<td bgcolor="#800080" onclick="selectForeColor('textEdit', '#800080')">　</td>
			</tr>
		</table>
	</div>
<?php
require_once ('./app/view/common/editor_js.php');
require_once ('./app/view/admin/footer.php');
?>
	<!-- <script type="text/javascript" src="/app/js/editor.js?v=1.21">
	</script> -->
	<form id="frmFileUpload" method="post" target="uploadFrame" enctype="multipart/form-data">
		<input type="file" id="uploadFile" name="uploadFile" style="display: none" onchange="javascript:insertEditFile('uploadFrame', 'frmFileUpload')" />
		<input type="file" id="uploadImage" name="uploadImage" style="display: none" accept="image/*" onchange="javascript:insertEditImage('uploadFrame', 'frmFileUpload')" />
	</form>
	<iframe id="uploadFrame" name="uploadFrame" width="0"height="0" frameborder="0" style="width: 0px; height: 0px;"> </iframe>
</body>
</html>