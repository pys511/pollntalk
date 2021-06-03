<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 202001008
 *  패스워드 변경
 */
$_GET["email"]
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link type="text/css" rel="stylesheet" href="css/common.css" />
<link type="text/css" rel="stylesheet" href="css/sub.css" />
<link type="text/css" rel="stylesheet" href="css/checkpwd.css" />
<title>온라인 투표 설문 폴앤톡</title>
</head>
<body>
<div class="page">
	<!-- 공통 상단 시작 -->
	<div class="top bline">
		<!-- 상단 로고 영역 시작 -->
		<div class="toparea">
			<div class="logo">
				<div class="logobox">
					<a href="/"> 
						<img class="logowindow" src="images/logo.png?v=1.1" alt="폴앤톡 로고" /> 
						<img class="logomobile" src="images/mobile_logo.png?v=1.0" alt="폴앤톡 로고" />
					</a>
				</div>
				<a id="mobilemenubutton" href="#"> 
					<img class="mobilemenubutton" src="images/mobile_menu.png" />
				</a>
			</div>
			<!-- 로그인, 회원가입 버튼 끝 -->
		</div>
		<!-- 상단 로고 영역 끝 -->
	</div>
	<!-- 공통 상단 끝 -->
	<!-- 컨텐츠 시작-->
	<form id="password_change" name="password_change" action="/controller.php?mode=password_change_ctrl" method="POST">
	<input type="hidden" name="email" id="email" value="<?php echo $_GET["email"];?>" />
    	<div class="content">
    		<div class="pwdarea">
    			<div class="pwdbox">
    				<div class="pwdInputbox">
    					<div class="pwdInputtitle">
    						<span>비밀번호 변경하기</span>
    					</div>
    					<div class="pwdInputdoc">
    						<span>회원님의 이메일로 보내진 인증번호를 입력한 후 새로운 비밀번호로 변경하시기 바랍니다.</span>
    					</div>
    					<div class="pwdInputItem">
    						<div class="pwdInputfield">
    							<span>인증번호</span>
    						</div>
    						<div class="pwdInputer">
    							<input type="text" name="authNum" id="authNum"/>
    						</div>
    					</div>
    					<div class="pwdInputItem">
    						<div class="pwdInputfield">
    							<span>비밀번호 입력</span>
    						</div>
    						<div class="pwdInputer">
    							<input type="password" name="password1" id="password1"/>
    						</div>
    					</div>
    					<div class="pwdInputItem">
    						<div class="pwdInputfield">
    							<span>비밀번호 확인</span>
    						</div>
    						<div class="pwdInputer">
    							<input type="password" name="password2" id="password2"/>
    						</div>
    					</div>
    				</div>
    				<div class="buttonbox">
    					<div class="buttonright">
    						<a id="changeForm" style="text-decoration: none"> 
    							<button><span>변경하기</span></button>
    						</a>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
	</form>
	<!-- 컨텐츠 끝-->
	<!-- 하단 시작 -->
	<div class="footer">
		<!-- 하단 메뉴 시작 -->
		<div class="footermenuarea">
			<div class="footermenubox">
				<div class="footermenu fspace">
					<img class="wfootermenu" src="images/footer_menu_01.png" />
					<img class="mfootermenu" src="images/footer_menu_m_01.png" />
					<div class="footermenuitem mfooterline">
						<span class="footermenutitle">공지사항 / 이벤트</span>
						<span class="footermenutext">폴앤톡에서 알려드리는 공지사항과 이벤트입니다.</span>
					</div>
				</div>
				<div class="footermenu fspace">
					<img class="wfootermenu" src="images/footer_menu_02.png" />
					<img class="mfootermenu" src="images/footer_menu_m_02.png" />
					<div class="footermenuitem mfooterline">
						<span class="footermenutitle">자주하는<br/>질문</span>
						<span class="footermenutext">폴앤톡에 대한 정보가 궁금하다면 이용해주세요.</span>
					</div>
				</div>
				<div class="footermenu">
					<img class="wfootermenu" src="images/footer_menu_03.png" />
					<img class="mfootermenu" src="images/footer_menu_m_03.png" />
					<div class="footermenuitem">
						<span class="footermenutitle">서비스요청 / 에러신고</span>
						<span class="footermenutext">필요한 서비스/기능이나 에러가 있으면 알려주세요.</span>
					</div>
				</div>
			</div>	
		</div>
		<!-- 하단 메뉴 끝 -->
		<!-- 하단 공통 시작 -->
		<div class="footercommonarea">
			<div class="footercommonbox">
				<img src="images/footer_logo.png" />
				<div class="footercommon">
					<!-- 하단 안내 메뉴 시작 -->
					<div class="footerlayer">
						<div class="footerguidemenu">
							<span class="glspace grspace">서비스 소개</span>
							<span class="grspace">이용약관</span>
							<span class="grspace">개인정보처리방침</span>
							<span class="grspace">이메일 무단수집거부</span>
							<span>책임의 한계와 법적고지</span>
						</div>
					</div>
					<!-- 하단 안내 메뉴 끝 -->
					<!-- 하단 안내 시작 -->
					<div class="footerlayer">
						<div class="footerguidebox">
							<div class="footerguide">
								<span>피에스발텍</span>
								<span>주소 : 경기도 평택시 서탄면 수월암2길 88-12, 2층 1호</span>
								<span>사업자등록번호 : 578-76-00226</span>
							</div>
							<div class="footerguide">
								<span>통신판매업신고 : 2020-경기평택-*****</span>
								<span>개인정보책임자 : 고형석</span>
								<span>이메일 : admin@pollntalk.com</span>
							</div>
							<div class="footerguide">
								<span>대표전화 : 070-7633-4520</span>
							</div>
							<div class="footerguide fbottom">
								<span>Copyright(c) 2020 PS VALTEC Corp. All right Reserved.</span>
							</div>
						</div>
					</div>
				</div>
				<!-- 하단 안내 끝 -->
			</div>
		</div>
		<!-- 하단 공통 끝 -->
	</div>
	<!-- 하단 끝 -->
</div>
<script type="text/javascript" src="/app/js/password_change.js" charset="utf-8">
	</script>
</body>
</html>