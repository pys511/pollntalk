<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  관리자 메인 페이지
 */
try {
    // 로그인 처리 후 session에 저장
    // 로그인 상태라면 skip
    $login = new CApp_Handler_Admin_Ctrl();
    $result = $login->loginAdmin($_POST);
    // print_r($_SESSION);
} catch (CException $ex) {
    $ex->printException();
}
?>
<!doctype html>
<html id="start" xmlns="http://www.w3.org/1999/xhtml">
<head id="head">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" rel="stylesheet" href="/app/css/admin/common.css" />
<link type="text/css" rel="stylesheet" href="/app/css/admin/default.css" />
<link type="text/css" rel="stylesheet" href="/app/css/admin/main.css" />
<title>알찬스 관리자 모드</title>
<script type="text/javascript">
<?php
if (! $result) {
    ?>
	alert("아이디 또는 비밀번호를 잘못 입력하였습니다.");
	location.href	= "/admin_manager.php?mode=login";
<?php
}
?>
    </script>
</head>
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
            	<div class="summeryArea">
					<div class="summeryBox">
						<div class="summeryTitle">
							<span>회원 접속 현황</span>
						</div>
						<div class="summeryList">
							<div class="summeryContext">
								<div class="summeryKey">
									<span>전체 회원</span>
								</div>
								<div class="summeryValue">
									<span>4332934명</span>
								</div>
							</div>
							<div class="summeryContext">
								<div class="summeryKey">
									<span>오늘 가입자</span>
								</div>
								<div class="summeryValue">
									<span>4332934명</span>
								</div>
							</div>
							<div class="summeryContext">
								<div class="summeryKey">
									<span>오늘 접속자</span>
								</div>
								<div class="summeryValue">
									<span>4332934명</span>
								</div>
							</div>

						</div>
					</div>
				</div>
				<div class="summeryArea">
					<div class="summeryBox">
						<div class="summeryTitle">
							<span>서버 현황 [2016-08-05]</span>
						</div>
						<div class="summeryList">
							<div class="summeryContext">
								<div class="summeryKey">
									<span>ROOT SERVER</span>
								</div>
								<div class="summeryValue">
									<span>43329322234건</span>
								</div>
							</div>
							<div class="summeryContext">
								<div class="summeryKey">
									<span>REQ SERVER</span>
								</div>
								<div class="summeryValue">
									<span>4332932324건</span>
								</div>
							</div>
							<div class="summeryContext">
								<div class="summeryKey">
									<span>RESP SERVER</span>
								</div>
								<div class="summeryValue">
									<span>234323215646건</span>
								</div>
							</div>
							<div class="summeryContext">
								<div class="summeryKey">
									<span>DB SERVER</span>
								</div>
								<div class="summeryValue">
									<span>234323215646건</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>