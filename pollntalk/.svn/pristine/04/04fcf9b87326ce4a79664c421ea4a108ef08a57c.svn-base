<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200529
 *  회원정보 관리자 페이지
 */
try 
{
    $is_register = $_GET["is_register"];
    // 문의 사항 처리
    if ($is_register == "")
        $member_seq = $_GET["member_seq"];
    else 
    {
        if ($_SESSION["member_id"] != "")
            $member_seq = $_GET["is_register"];
    }
    
    $member = new CApp_Handler_Admin_member();
    $result = $member->getMemberInfo($member_seq);
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
<script type="text/javascript">
<?php
if ($is_register != "") 
{
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
            	<form id="frmMember" method="post" action="/admin_controller.php?mode=member_proc">
					<input type="hidden" id="member_seq" name="member_seq" value="<?php echo($member_seq); ?>" />
					<input type="hidden" id="proc" name="proc" />
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> <span>회원 정보</span>
						</div>
						<!-- 관리자 등록 -->
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>이름</span>
								</div>
								<div class="boardInputBox">
									<input id="uname" name="uname" class="defaultInput" type="text" value="<?php echo($result["nname"]); ?>" style="-webkit-ime-mode: active; -moz-ime-mode: active; -ms-ime-mode: active; ime-mode: active;" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>닉네임</span>
								</div>
								<div class="boardInputBox">
									<input id="nname" name="nname" class="defaultInput" type="text" value="<?php echo($result["uname"]); ?>" style="-webkit-ime-mode: active; -moz-ime-mode: active; -ms-ime-mode: active; ime-mode: active;" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>파일 업로드</span>
								</div>
								<div class="boardImageInputBox">
<?php
// 이미지 출력
if ($result["pic"] == "") 
{
?>
	           						<img id="imageFile" src="/app/images/admin/photo.png" width="75" height="75" />
<?php
} 
else 
{
?>
	           						<img id="imageFile" src="/<?php echo($result["pic"]); ?>" width="75" height="75" />
<?php
}
?>
            						<div id="fileupload" class="buttonBox">
										<a href="javascript:void(0);"><span class="buttonText">파일 업로드</span></a>
									</div>
									<input type="hidden" id="temp_path" name="temp_path" value="<?php echo($result["pic"]); ?>" /> 
									<input type="hidden" id="real_name" name="real_name" value="<?php echo($result["pic"]); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>이메일</span>
								</div>
								<div class="boardInputBox">
									<input id="email" name="email" class="defaultInput" type="text" value="<?php echo($result["email"]); ?>" style="-webkit-ime-mode: inactive; -moz-ime-mode: inactive; -ms-ime-mode: active; ime-mode: inactive;" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>생년월일</span>
								</div>
								<div class="boardInputBox">
									<input  class="defaultInput" type="text" id="b_birth" name="b_birth" value="<?php echo($result["birthday"]); ?>"/> 
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>성별</span>
								</div>
								<div class="boardInputBox">
									<select id="gender" name="gender" class="inputSelect">
										<option value="-" <?php if ($result["gender"] == "") echo("selected");?>>성별 선택</option>
										<option value="m" <?php if ($result["gender"] == "m") echo("selected");?>>남성</option>
										<option value="f" <?php if ($result["gender"] == "f") echo("selected");?>>여성</option>
									</select> 
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>지역</span>
								</div>
								<div class="boardInputBox">
									<select id="abode" name="abode">
                						<option value="-" <?php if ($result["abode"] == "-") echo("selected");?>>거주지 선택</option>
                						<option value="01" <?php if ($result["abode"] == "01") echo("selected");?>>서울특별시</option>
                						<option value="02" <?php if ($result["abode"] == "02") echo("selected");?>>부산광역시</option>
                						<option value="03" <?php if ($result["abode"] == "03") echo("selected");?>>대구광역시</option>
                						<option value="04" <?php if ($result["abode"] == "04") echo("selected");?>>인천광역시</option>
                						<option value="05" <?php if ($result["abode"] == "05") echo("selected");?>>광주광역시</option>
                						<option value="06" <?php if ($result["abode"] == "06") echo("selected");?>>대전광역시</option>
                						<option value="07" <?php if ($result["abode"] == "07") echo("selected");?>>울산광역시</option>
                						<option value="08" <?php if ($result["abode"] == "08") echo("selected");?>>세종특별자치시</option>
                						<option value="11" <?php if ($result["abode"] == "11") echo("selected");?>>경기도</option>
                						<option value="12" <?php if ($result["abode"] == "12") echo("selected");?>>강원도</option>
                						<option value="13" <?php if ($result["abode"] == "13") echo("selected");?>>충청북도</option>
                						<option value="14" <?php if ($result["abode"] == "14") echo("selected");?>>충청남도</option>
                						<option value="15" <?php if ($result["abode"] == "15") echo("selected");?>>전라북도</option>
                						<option value="16" <?php if ($result["abode"] == "16") echo("selected");?>>전라남도</option>
                						<option value="17" <?php if ($result["abode"] == "17") echo("selected");?>>경상북도</option>
                						<option value="18" <?php if ($result["abode"] == "18") echo("selected");?>>경상남도</option>
                						<option value="20" <?php if ($result["abode"] == "20") echo("selected");?>>제주특별자치도</option>
                					</select>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>등급</span>
								</div>
								<div class="boardInputBox">
									<select id="grade" name="grade" class="inputSelect">
										<option value="-" <?php if ($result["grade"] == "") echo("selected");?>>회원등급 선택</option>
										<option value="0" <?php if ($result["grade"] == "0") echo("selected");?>>일반회원</option>
										<option value="1" <?php if ($result["grade"] == "1") echo("selected");?>>인증회원</option>
										<option value="2" <?php if ($result["grade"] == "2") echo("selected");?>>VIP회원</option>
									</select>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>가입일</span>
								</div>
								<div class="boardInputBox">
									<span><?php echo($result["regidate"]); ?></span>
								</div>
							</div>
						</div>
						<!-- 버튼 -->
						<div class="boardListButtonBox">
							<div id="updateMember" class="buttonBox">
								<a href="#"><span class="buttonText">수정하기</span></a>
							</div>
							<div id="withdrawalMember" class="buttonBox">
								<a href="#"><span class="buttonText">탈퇴처리</span></a>
							</div>
							<div id="sendMessage" class="buttonBox">
								<a href="/admin_manager.php?mode=messagelist&member_seq=<?php echo($member_seq); ?>"><span class="buttonText">쪽지 보내기</span></a>
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
	<script type="text/javascript" src="/app/js/admin_member_register.js?v=1.0" charset="utf-8">
	</script>
	<iframe src="#" id="uploadFrame" name="uploadFrame" width="0" height="0" frameborder="0" style="width: 0px; height: 0px;"> </iframe>
</body>
</html>