<?php
/**
 *  @auth   : YS PARK
 *  @date   : 20200529
 *  공지 사항 작성 관리자 페이지
 *  1 : 공지사항
 *  2 : 1대1
 *  3 : faq
 */

$kind   = "";
$sub    = $_GET["sub"];
$num    = $_GET["num"];
if ($sub == "notice")
    $kind   = "1";
else if ($sub == "qna")
    $kind   = "2";
else 
    $kind   = "3";
try 
{
    // 공지 사항 처리
    $exec           = "";
    $board          = new CApp_Handler_Admin_board();
    if($num != "")
    {
        $exec       = "register";
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
<form id="frmBoard" action="/controller.php?mode=board_proc" method="post">
<input type="hidden" id="exec" name="exec" value="<?php echo($exec); ?>" />
<input type="hidden" id="pagename" name="pagename" value="<?php echo($sub); ?>" />
<input type="hidden" id="NUM" name="NUM" value="<?php echo($num); ?>" />
<input type="hidden" id="TYPE" name="TYPE" value="2" /> 
<input type="hidden" id="KIND" name="KIND" value="<?php echo($kind); ?>" />
<input type="hidden" id="CONTEXT" name="CONTEXT" value="<?php echo($context);?>" />
<div class="boardarea">
	<div class="boardviewbox">
		<div class="tabmenu">
<?php
if ($sub == "notice")
{
    echo ("<div class='tabbuttonbox'>
			        <button type='button' class='tabbuttonon'>
			        <span class='title'>공지사항/이벤트</span>
			        </button>
			        </div>
			        <div class='tabbuttonbox'>
			        <a href='/?mode=customer&sub=qna'>
                    <button type='button' class='tabbuttonoff'>                        				        
                    <span class='disabletitle'>자주하는 질문</span>
			        </button>
                    </a>
			        </div>
			        <div class='tabbuttonbox'>
                    <a href='/?mode=customer&sub=support'>
			        <button type='button' class='tabbuttonoff'>
			        <span class='disabletitle'>1:1 고객지원</span>
			        </button>
			        </a>
                    </div>");
}
else if ($sub == "qna")
{
    echo ("<div class='tabbuttonbox'>
                    <a href='/?mode=customer&sub=notice'>
			        <button type='button' class='tabbuttonoff'>
			        <span class='disabletitle'>공지사항/이벤트</span>
			        </button>
                    </a>
			        </div>
			        <div class='tabbuttonbox'>
			        <button type='button' class='tabbuttonon'>
			        <span class='title'>자주하는 질문</span>
			        </button>
			        </div>
			        <div class='tabbuttonbox'>
			        <a href='/?mode=customer&sub=support'>
                    <button type='button' class='tabbuttonoff'>
			        <span class='disabletitle'>1:1 고객지원</span>
			        </button>
                    </a>
			        </div>");
}
else
{
    echo ("<div class='tabbuttonbox'>
                    <a href='/?mode=customer&sub=notice'>
			        <button type='button' class='tabbuttonoff'>
			        <span class='disabletitle'>공지사항/이벤트</span>
			        </button>
                    </a>
			        </div>
			        <div class='tabbuttonbox'>
                    <a href='/?mode=customer&sub=qna'>
			        <button type='button' class='tabbuttonoff'>
			        <span class='disabletitle'>자주하는 질문</span>
			        </button>
                    </a>
			        </div>
			        <div class='tabbuttonbox'>
			        <button type='button' class='tabbuttonon'>
			        <span class='title'>1:1 고객지원</span>
			        </button>
			        </div>");
}
?>
		</div>
		<!-- 게시판 안내 -->
		<div class="boardguide">
<?php 
if ($sub == "notice")
{
?>
			<div class="boardtopic">
				<span>공지사항/이벤트</span>
			</div>
			<div class="boarddoc">
				<!--<span>필요한 서비스/기능이나 에러가 있으면 알려주세요.</span>-->
			</div>
<?php 
}
else if ($sub == "qna")
{
?>			
			<div class="boardtopic">	
				<span>자주하는 질문</span>
			</div>
			<div class="boarddoc">
				<!--<span>필요한 서비스/기능이나 에러가 있으면 알려주세요.</span>-->
			</div>
<?php 
}
else
{
?>	
			<div class="boardtopic">			
				<span>1:1 고객지원</span>
			</div>
			<div class="boarddoc">
				<!--<span>필요한 서비스/기능이나 에러가 있으면 알려주세요.</span>-->
			</div>
<?php 
}
?>

		</div>
		<div class="boardcontent">
			<!-- 게시판 보기 시작  -->
			<div class="boardsubjectbox">
				<input id="board_subject" name="SUBJECT" type="text" class="boardwritesubject" placeholder="제목을 입력하세요." value="<?php echo($result["SUBJECT"]); ?>" />
			</div>
			<div class="boardcontext">
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
							<img class="buttonLeft" src="/app/images/buttonBack_01.gif"  alt="버튼 테두리" />
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
							<a href="javascript:insertForeColor('colorPane', 'btnSetBackColor', 'dvColorPane')"> 
								<img src="/app/images/button_18.png" alt="글자색" />
							</a> 
							<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
						</div>
						<div class="contentListButton">
							<img class="buttonLeft" src="/app/images/buttonBack_01.gif" alt="버튼 테두리" /> 
							<a href="javascript:insertBackColor('colorPane', 'btnSetBackColor', 'dvColorPane')"> 
								<img src="/app/images/button_19.png" alt="배경색" />
							</a> 
							<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
						</div>
					</div>
					<div class="buttonLongGroup">
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
									<span style="font-style: italic;">파일등록</span>
								</a>
							</div>
							<img class="buttonRight" src="/app/images/buttonBack_03.gif" alt="버튼 테두리" />
						</div>
					</div>
				</div>
				<div class="contentTextArea">
					<select id="viewfilelist" name="viewfilelist" size="3">
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
					<div class="boardbuttonbox">
    					<div class="boardbuttonright">
        					<button type="button" id="deleteFile" onclick="javascript:deleteBoardFile('viewfilelist')">
        						<span>파일삭제</span>
        					</button>
    					</div>
					</div>
					<iframe id="textEdit" name="textEdit" style="width: 100%; height: calc(100vh - 400px); border: 1px #BFBFBF solid;"></iframe>
					<textarea id="htmlEdit" name="htmlEdit" style="display:none;width: 100%; height: calc(100vh - 450px); border: 1px #BFBFBF solid;"></textarea>
				</div>
				<input type="hidden" id="board_context" name="board_context" />
				<input type="hidden" id="image_list" name="image_list" />
				<input type="hidden" id="file_list" name="file_list" />
			</div>
			<div class="boardbuttonbox">
				<div class="boardbuttonright">
					<button type="button" onclick="javascript:registerBoard('frmBoard', 'board_subject', 'textEdit', 'board_context', 'viewfilelist', 'file_list', 'image_list')">
						<span>등록하기</span>
					</button>
				</div>
			</div>
			<!-- 게시판 보기 끝 -->
		</div>
		<!-- 텝 컨텐츠 끝 -->
	</div>
</div>
</form>
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
<form id="frmFileUpload" method="post" target="uploadFrame" enctype="multipart/form-data">
	<input type="file" id="uploadFile" name="uploadFile" style="display: none" onchange="javascript:insertEditFile('uploadFrame', 'frmFileUpload')" />
	<input type="file" id="uploadImage" name="uploadImage" style="display: none" accept="image/*" onchange="javascript:insertEditImage('uploadFrame', 'frmFileUpload')" />
</form>
<iframe src="#" id="uploadFrame" name="uploadFrame" width="0"height="0" frameborder="0" style="width: 0px; height: 0px;"> </iframe>
<?php require_once ('./app/view/common/editor_js.php'); ?>
<script type="text/javascript">
	var num 	= "<?php echo($num); ?>";
	if(num != '')
	{
		var context	= document.getElementById("CONTEXT").value;
		setContext('textEdit', context);
	}
</script>