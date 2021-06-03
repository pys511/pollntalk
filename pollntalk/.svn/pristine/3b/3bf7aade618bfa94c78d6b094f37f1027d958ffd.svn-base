<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  문의 사항 관리자 페이지
 */
try 
{
    $cateSeq    = $_GET["cateSeq"];
    $cateCtrl   = new CApp_Handler_Category_Ctrl();
    $depth1Cate = $cateCtrl->getCategoryList();
    $depth2Cate = array();
    if ($cateSeq != "")
        $depth2Cate = $cateCtrl->getCategorySubList($cateSeq);

    $subCateSeq = $_GET["subCateSeq"];
    $cateInfo   = array();
    if ($subCateSeq != "")
        $cateInfo = $cateCtrl->getCategoryInfo($subCateSeq);

    if ($subCateSeq != "")
        $cateSeq = $subCateSeq;
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
            	<form id="frmCategory" method="post" action="/admin_controller.php?mode=cate_proc">
					<input type="hidden" id="cate_seq" name="cate_seq" value="<?php echo($cateSeq); ?>" />
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> <span>카테고리 등록</span>
						</div>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>카테고리 이름</span>
								</div>
								<div class="boardInputBox">
									<input id="cate_name" name="cate_name" class="defaultInput" type="text" value="<?php echo($cateInfo[0]["CATE_NAME"]); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>상위 카테고리</span>
								</div>
								<div class="boardInputBox">
									<select id="cate_parent_seq" name="cate_parent_seq" class="inputSelect">
										<option value="0">-</option>
<?php
for ($i = 0; $i < count($depth1Cate); $i ++) 
{
    $cate_seq   = $depth1Cate[$i]["CATE_SEQ"];
    $cate_name  = $depth1Cate[$i]["CATE_NAME"];
    
    $selected   = "";
    if ($cateInfo[0]["CATE_SEQ"] == $cate_seq)
        $selected = "selected"
?>									
										<option value="<?php echo($cate_seq);?>" <?php echo($selected);?>><?php echo($cate_name); ?></option>
<?php
}
?>
            						</select>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>카테고리 사진</span>
								</div>
								<div class="boardImageInputBox">
									<!-- <img id="imageFile" src="/app/images/admin/photo.png" width="75" height="75" /> -->
<?php
$cate_image_path = "/app/images/admin/photo.png";
if ($cateInfo[0]["CATE_REAL_IMAGE_PATH"] != "")
    $cate_image_path = $cateInfo[0]["CATE_REAL_IMAGE_PATH"];

?>
	           						<img id="imageFile" src="<?php echo($cate_image_path); ?>" width="160" height="160" />
									<div id="fileupload" class="buttonBox">
										<a href="javascript:void(0);">
											<span class="buttonText">파일 업로드</span>
										</a>
									</div>
									<input type="hidden" id="temp_path" name="temp_path" value="<?php echo($cate_image_path); ?>" /> 
									<input type="hidden" id="real_name" name="real_name" value="<?php echo($cate_image_path); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>카테고리 설명</span>
								</div>
								<div class="boardInputBox">
									<input id="cate_text" name="cate_text" class="longInput" type="text" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>본인인증 여부</span>
								</div>
								<div class="boardInputBox">
									<input id="cate_is_cert" name="cate_is_cert" class="longInput" type="checkbox" value="1" />
								</div>
							</div>
						</div>
						<!-- 버튼 -->
						<div class="boardListButtonBox">
							<div class="buttonBox">
								<a id="resetCategory" href="javascript:void(0)">
									<span class="buttonText">리셋</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="deleteCategory" href="javascript:void(0)">
									<span class="buttonText">삭제하기</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="registerCategory" href="javascript:void(0)">
									<span class="buttonText">등록하기</span>
								</a>
							</div>
						</div>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="categorybox">
									<span>1차 카테고리 선택</span> 
									<select id="cate_1dept_seq" name="cate_1dept_seq" size="10">
<?php
for ($i = 0; $i < count($depth1Cate); $i ++) 
{
    $cate_seq = $depth1Cate[$i]["CATE_SEQ"];
    $cate_name = $depth1Cate[$i]["CATE_NAME"];
    $selected = "";
    if ($cateSeq == $cate_seq)
        $selected = "selected";
?>									
										<option value="<?php echo($cate_seq);?>" <?php echo($selected);?>><?php echo($cate_name); ?></option>
<?php
}
?>
                                    </select>
								</div>
								<div class="categorybox">
									<span>2차 카테고리 선택</span> 
									<select id="cate_2dept_seq" name="cate_2dept_seq" size="10">
<?php
for ($i = 0; $i < count($depth2Cate); $i ++) 
{
    $cate_seq = $depth2Cate[$i]["CATE_SEQ"];
    $cate_name = $depth2Cate[$i]["CATE_NAME"];
?>	
										<option value="<?php echo($cate_seq);?>"><?php echo($cate_name); ?></option>
<?php
}
?>                                        
									</select>
								</div>
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
	<script type="text/javascript" src="/app/js/category_register.js?v=1.5" charset="utf-8">
	</script>
	<!-- admin 정보 등록 js -->
	<iframe src="#" id="uploadFrame" name="uploadFrame" width="0"height="0" frameborder="0" style="width: 0px; height: 0px;"> </iframe>
</body>
</html>