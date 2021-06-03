<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  문의 사항 관리자 페이지
 */
try {
    $is_register = $_GET["is_register"];
    // 문의 사항 처리
    if ($is_register == "")
        $admin_seq = $_GET["admin_seq"];
    else {
        if ($_SESSION["admin_id"] != "")
            $admin_seq = $_GET["is_register"];
    }

    $member = new CApp_Handler_Admin_Ctrl();
    $result = $member->getAdminInfo($admin_seq);
} catch (CException $ex) {
    $ex->printException();
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once ('./app/view/admin/header.php');
?>
<script type="text/javascript">
<?php
if ($is_register != "") {
    ?>
	alert("등록되었습니다.");
<?php
    $_GET["is_register"] = "";
}
?>
</script>
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
            	<form id="frmMember" method="post"
					action="/controller.php?mode=adminregister_proc">
					<input type="hidden" id="admin_seq" name="admin_seq"
						value="<?php echo($admin_seq); ?>" />
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> <span>관리자 등록</span>
						</div>
						<!-- 관리자 등록 -->
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>이름</span>
								</div>
								<div class="boardInputBox">
									<input id="admin_name" name="admin_name" class="defaultInput"
										type="text" value="<?php echo($result[0]["admin_name"]); ?>"
										style="-webkit-ime-mode: active; -moz-ime-mode: active; -ms-ime-mode: active; ime-mode: active;" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>파일 업로드</span>
								</div>
								<div class="boardImageInputBox">
									<!-- <img id="imageFile" src="/app/images/admin/photo.png" width="75" height="75" /> -->
<?php
// 이미지 출력
if ($result[0]["imagePath"] == "") {
    ?>
	           						<img id="imageFile" src="/app/images/admin/photo.png"
										width="75" height="75" />
<?php
} else {
    ?>
	           						<img id="imageFile"
										src="<?php echo($result[0]["imagePath"]); ?>" width="75"
										height="75" />
<?php
}
?>
            						<div id="fileupload" class="buttonBox">
										<a href="javascript:void(0);"><span class="buttonText">파일 업로드</span></a>
									</div>
									<input type="hidden" id="temp_path" name="temp_path"
										value="<?php echo($result[0]["imagePath"]); ?>" /> <input
										type="hidden" id="real_name" name="real_name"
										value="<?php echo($result[0]["imagePath"]); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>아이디</span>
								</div>
								<div class="boardInputBox">
									<input id="admin_id" name="admin_id" class="defaultInput"
										type="text" value="<?php echo($result[0]["admin_id"]); ?>"
										style="-webkit-ime-mode: inactive; -moz-ime-mode: inactive; -ms-ime-mode: active; ime-mode: inactive;" />
									<div id="idCheck" class="buttonBox">
										<a href="javascript:void(0);"><span class="buttonText">중복체크</span></a>
									</div>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>비밀번호</span>
								</div>
								<div class="boardInputBox">
									<input id="admin_pw" name="admin_pw" class="defaultInput"
										type="password"
										style="-webkit-ime-mode: inactive; -moz-ime-mode: inactive; -ms-ime-mode: inactive; ime-mode: inactive;" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>비밀번호 확인</span>
								</div>
								<div class="boardInputBox">
									<input id="admin_pw_re" name="admin_pw_re" class="defaultInput"
										type="password"
										style="-webkit-ime-mode: inactive; -moz-ime-mode: inactive; -ms-ime-mode: inactive; ime-mode: inactive;" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>연락처</span>
								</div>
								<div class="boardInputBox">
									<input type="hidden" id="phonenumber" name="phonenumber" /> <select
										id="phone_comp" name="phone_comp" class="inputSelect">
										<option value="010"
											<?php if ($result[0]["phone_comp"] == "010") echo("selected");?>>010</option>
										<option value="011"
											<?php if ($result[0]["phone_comp"] == "011") echo("selected");?>>011</option>
										<option value="016"
											<?php if ($result[0]["phone_comp"] == "016") echo("selected");?>>016</option>
										<option value="018"
											<?php if ($result[0]["phone_comp"] == "018") echo("selected");?>>018</option>
										<option value="019"
											<?php if ($result[0]["phone_comp"] == "019") echo("selected");?>>019</option>
									</select> <span>-</span> <input id="phone_first"
										name="phone_first"
										value="<?php echo($result[0]["phone_first"]); ?>"
										class="shortInput" type="text" /> <span>-</span> <input
										id="phone_second" name="phone_second"
										value="<?php echo($result[0]["phone_second"]); ?>"
										class="shortInput" type="text" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>이메일</span>
								</div>
								<div class="boardInputBox">
									<input id="admin_mail" name="admin_mail" class="defaultInput"
										type="text"
										style="-webkit-ime-mode: inactive; -moz-ime-mode: inactive; -ms-ime-mode: inactive; ime-mode: inactive;" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>등급</span>
								</div>
								<div class="boardInputBox">
									<select id="grade" name="grade" class="inputSelect">
										<option value="0"
											<?php if ($result[0]["grade"] == "0") echo("selected");?>>마스터
											관리자</option>
										<option value="1"
											<?php if ($result[0]["grade"] == "1") echo("selected");?>>주
											관리자</option>
										<option value="2"
											<?php if ($result[0]["grade"] == "2") echo("selected");?>>서브
											관리자</option>
									</select>
								</div>
							</div>
						</div>
						<!-- 버튼 -->
						<div class="boardListButtonBox">
							<div id="registerAdmin" class="buttonBox">
								<a href="#"><span class="buttonText">등록하기</span></a>
							</div>
							<div id="updateAdmin" class="buttonBox">
								<a href="#"><span class="buttonText">수정하기</span></a>
							</div>
							<div id="deleteAdmin" class="buttonBox">
								<a href="#"><span class="buttonText">삭제하기</span></a>
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
	<script type="text/javascript" src="/app/js/admin_register.js"
		charset="utf-8">
	</script>
	<iframe src="#" id="uploadFrame" name="uploadFrame" width="0"
		height="0" frameborder="0" style="width: 0px; height: 0px;"> </iframe>
</body>
</html>