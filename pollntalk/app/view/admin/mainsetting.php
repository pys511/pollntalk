<?php
/**
 *  @auth   : PARK Y.S.
 *  @date   : 20210411
 *  메인화면 셋팅
 */
try
{
    $seq        = $_GET["main_seq"];
    $mainCtrl   = new CApp_Handler_Main_Ctrl();
    $result     = $mainCtrl->getText($seq);
    
    $mText1         = $result["M_TEXT1"];
    $mText1Color    = $result["M_TEXT1_COLOR"];
    $mText2         = $result["M_TEXT2"];
    $mText2Color    = $result["M_TEXT2_COLOR"];
    $realImage      = $result["M_REAL_IMAGE"];
    $originImage    = $result["M_ORIGIN_IMAGE"];
    $mBackColor     = $result["M_BACKCOLOR"];
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once ('./app/view/admin/header.php');
?>
<body>
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
            	<form id="frmMain" name="frmMain" method="post" action="/admin_controller.php?mode=maintext_proc">
            		<input type="hidden" id="seq" name="seq" value="<?php echo($seq);?>" />
            		<input type="hidden" id="proc" name="proc" />
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> 
							<span>메인 문구</span>
						</div>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>문구1</span>
								</div>
								<div class="boardInputBox">
									<input id="main_text1" name="main_text1" class="middleInput" type="text" value="<?php echo($mText1); ?>" placeholder="첫번째 줄 문구"/>
									<input id="main_color1" name="main_color1" type="text" class="defaultInput" value="<?php echo($mText1Color);?>" placeholder="첫번째 줄 글자색" />								</div>
								<div class="boardName">
									<span>문구2</span>
								</div>
								<div class="boardInputBox">
									<input id="main_text2" name="main_text2" class="middleInput" type="text" value="<?php echo($mText2); ?>" placeholder="두번째 줄 문구"/>
									<input id="main_color2" name="main_color2" type="text" class="defaultInput" value="<?php echo($mText2Color);?>" placeholder="두번째 줄 글자색" />
								</div>
							</div>
						</div>
						<!-- 버튼 -->
				   <!-- <div class="boardListButtonBox">
							<div class="buttonBox">
								<a id="registerMainText2" href="javascript:void(0)">
									<span class="buttonText">문구2 등록하기</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="registerMainText1" href="javascript:void(0)">
									<span class="buttonText">문구1 등록하기</span>
								</a>
							</div>
						</div> -->
					</div>
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> 
							<span>메인 사진</span>
						</div>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>이미지 업로드</span>
								</div>
								<div class="boardImageInputBox">
									<input id="main_backcolor" name="main_backcolor" type="text" class="defaultInput" value="<?php echo($mBackColor);?>"  placeholder="배경색" />
									<!-- <img id="imageFile" src="/app/images/admin/photo.png" width="75" height="75" /> -->
<?php
// 이미지 출력
if ($realImage == "") 
{
?>
	           						<img id="imageFile" src="/app/images/admin/photo.png" width="250" />
<?php
} 
else 
{
?>
	           						<img id="imageFile" src="/<?php echo($realImage); ?>" width="500" />
<?php
}
?>
            						<div id="fileupload" class="buttonBox">
										<a href="javascript:void(0);">
											<span class="buttonText">이미지 업로드</span>
										</a>
									</div>
									<input type="hidden" id="temp_path" name="temp_path" value="<?php echo($originImage); ?>" /> 
									<input type="hidden" id="real_name" name="real_name" value="<?php echo($originImage); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>공개 여부</span>
								</div>
								<div class="boardInputBox">
									<input type="checkbox" name="is_open" id="is_open" value='1' />
								</div>
							</div>
						</div>
						<!-- 버튼 -->
						<div class="boardListButtonBox">
							<div class="buttonBox">
								<a id="resetMain" href="javascript:void(0)">
									<span class="buttonText">리셋하기</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="deleteMain" href="javascript:void(0)">
									<span class="buttonText">삭제하기</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="registerMain" href="javascript:void(0)">
									<span class="buttonText">등록하기</span>
								</a>
							</div>
						</div>
					</div>
<?php 
$imageList  = $mainCtrl->getTextList();
?>
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> 
							<span>이미지 목록</span>
						</div>
						<div class="boardWriteItem">
							<div class="banklistbox">
								<select id="main_info_list" name="main_info_list" size="10">
<?php 									
for ($i = 0; $i < count($imageList); $i++)
{
    $seq            = $imageList[$i]["MAIN_SEQ"];
    $mainText1      = $imageList[$i]["M_TEXT1"];
    $mainText2      = $imageList[$i]["M_TEXT2"];
    //$realImage      = $imageList[$i]["M_REAL_IMAGE"];
    //$originImage    = $imageList[$i]["M_ORIGIN_IMAGE"];
?>
									<option value="<?php echo($seq); ?>" ><?php echo($mainText1);?></option>
<?php
}
?>
							    </select>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- 파일을 업로드할 폼 -->
	<form id="frmFileUpload" method="post" action="/controller.php?mode=image_upload" target="uploadFrame" enctype="multipart/form-data">
		<input type="file" id="uploadName" name="uploadName" style="display: none" accept="image/*" />
	</form>
<?php
require_once ('./app/view/admin/footer.php');
?>
	<!-- admin 정보 등록 js -->
	<script type="text/javascript" src="/app/js/admin_main_register.js?v=1.2" charset="utf-8">
	</script>
	<!-- admin 정보 등록 js -->
	<iframe src="#" id="uploadFrame" name="uploadFrame" width="0" height="0" frameborder="0" style="width: 0px; height: 0px;"> 
	</iframe>
</body>
</html>