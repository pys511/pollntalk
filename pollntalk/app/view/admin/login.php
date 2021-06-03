<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  관리자 로그인 페이지
 */
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
				<form id="frmLogin" method="post" action="/admin_manager.php?mode=main">
					<div class="loginArea">
						<img src="/app/images/admin/title_01.gif" alt="관리자 로그인" />
						<div class="loginBox">
							<input id="adminid" name="adminid" type="text" class="loginInputText" value="아이디" />
						</div>
						<div class="loginBox">
							<input id="adminpw" name="adminpw" type="password" class="loginInputText" value="비밀번호" /> 
							<a id="login" href="#"> 
								<img src="/app/images/admin/btnLogin.gif" alt="로그인" />
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/app/js/admin_login.js">
</script>
<?php
require_once ('./app/view/admin/footer.php');
?>	
</body>
</html>