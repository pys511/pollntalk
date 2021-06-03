<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200806
 *  회원가입 화면
 */
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Expires" content="-1"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link type="text/css" rel="stylesheet" href="/app/css/popup.css?v=1.5" />
<link type="text/css" rel="stylesheet" media="screen and (max-width: 800px)" href="/app/css/mobile.css?v=1.0" />
<link type="text/css" rel="stylesheet" href="/app/css/button.css" />
<title>온라인 투표 설문 폴앤톡</title>
</head>
<body>
	<form id="sign_up" name="sign_up" action="/popup.php?mode=sign_up_end" method="POST">
		<input type="hidden" name="authNum" id="authNum"/>
		<div class="popcontxtarea">
			<div class="popcontxtbox popcontxttitle">
				<span>회원가입</span> <a id="closeJoinPopup" href="#"> 
				<img src="/app/images/close.png" />
				</a>
			</div>
		</div>
		<div class="popcontxtarea">
			<div class="popcontxtbox">
				<div class="shortinputer">
					<input class="shortInputtext" type="text" id="email" name="email" placeholder="이메일주소" />
					<button id="checkEmail" class="shortInputButton">
						<span>중복확인</span>
					</button>
				</div>
			</div>
		</div>
		<div class="popcontxtarea">
			<div class="popcontxtbox">
				<div class="shortinputer">
					<input class="shortInputtext" type="text" id="inputAuthNum" name="inputAuthNum" placeholder="인증번호 입력" />
					<button id="checkAuth" name="checkAuth" class="shortInputButton">
						<span>인증 확인</span>
					</button>
				</div>
				<span class="guidetext">오른쪽 인증번호 발송 버튼을 클릭하여 입력하신 이메일 주소로 인증번호를 받아 인증번호를 입력하세요. 인증 후 이메일을 변경하면 재인증하셔야 합니다.</span>
				<button type="button" id="auth" name="auth" class="defaultbutton">
					<span>인증번호 발송</span>
				</button>
			</div>
		</div>
		<div class="popcontxtarea">
			<div class="popcontxtbox">
				<div class="inputer">
					<input type="password" id="password1" name="password1" placeholder="비밀번호(8~16자리 영문, 숫자포함)" />
				</div>
			</div>
		</div>
		<div class="popcontxtarea">
			<div class="popcontxtbox">
				<div class="inputer">
					<input type="password" id="password2" name="password2" placeholder="비밀번호확인" name="password2" />
				</div>
			</div>
		</div>
		<div class="popcontxtarea">
			<div class="popcontxtbox">
				<div class="inputer">
					<input type="text" id="u_name" name="u_name" placeholder="이름" />
				</div>
			</div>
		</div>
		<div class="popcontxtarea">
			<div class="popcontxtbox">
				<div class="shortinputer">
					<input class="shortInputtext" type="text" id="n_name" name="n_name" placeholder="닉네임" />
					<button id="checkN_name" class="shortInputButton">
						<span>중복확인</span>
					</button>
				</div>
			</div>
		</div>
		<div class="popcontxtarea">
			<div class="popcontxtbox">
				<div class="lineinputer">
					<input type="hidden" id="b_birth" name="b_birth" /> 
					<select id="b_year">
						<option value="-">생일 년</option>
<?php
$year = date("Y");
for ($i = $year; $i >= 1900; $i --) 
{
?>
						<option value="<?php echo($i); ?>"><?php echo($i); ?></option>
<?php
}
?>
					</select> 
					<select id="b_month">
						<option value="-">생일 월</option>
<?php
for ($i = 1; $i <= 12; $i ++) 
{
?>
						<option value="<?php echo($i); ?>"><?php echo($i); ?></option>
<?php
}
?>
					</select> 
					<select id="b_day">
						<option value="-">생일 일</option>
<?php
for ($i = 1; $i <= 31; $i ++) 
{
?>
						<option value="<?php echo($i); ?>"><?php echo($i); ?></option>
<?php
}
?>
					</select> 
					<input type="radio" id="female" name="gender" value="f" />
					<label for="female"> <span class="agreetext">여자</span>
					</label> 
					<input type="radio" id="male" name="gender" value="m" /> 
					<label for="male"> <span class="agreetext">남자</span>
					</label>
				</div>
			</div>
		</div>
		<div class="popcontxtarea">
			<div class="popcontxtbox">
				<div class="lineinputer">
					<select id="abode" name="abode">
						<option value="-">거주지 선택</option>
						<option value="01">서울특별시</option>
						<option value="02">부산광역시</option>
						<option value="03">대구광역시</option>
						<option value="04">인천광역시</option>
						<option value="05">광주광역시</option>
						<option value="06">대전광역시</option>
						<option value="07">울산광역시</option>
						<option value="08">세종특별자치시</option>
						<option value="11">경기도</option>
						<option value="12">강원도</option>
						<option value="13">충청북도</option>
						<option value="14">충청남도</option>
						<option value="15">전라북도</option>
						<option value="16">전라남도</option>
						<option value="17">경상북도</option>
						<option value="18">경상남도</option>
						<option value="20">제주특별자치도</option>
					</select>
				</div>
			</div>
		</div>
		<div class="popcontxtarea">
			<div class="linkbox">
				<div class="linkitem short">
					<a id="cert" href="/app/view/popup/rules.php" onclick="window.open(this.href,'','width=600, height=500, scrollbars=no'); return false;">
						<span>이용약관</span>
					</a>
				</div>
				<div class="linkline"></div>
				<div class="linkitem longlong">
					<a id="cert" href="/app/view/popup/privacy_policy.php" onclick="window.open(this.href,'','width=600, height=500, scrollbars=no'); return false;">
						<span>개인정보처리방침</span>
					</a>
				</div>
				<div class="linkitem shortshort">
					<input type="checkbox" class="agree" name="agree" id="agree" /> 
					<label for="agree"> 
						<span>동의</span>
					</label>
				</div>
			</div>
		</div>
		<div class="popcontxtarea">
			<div class="popcontxtbox">
				<div class="popupbutton">
					<a id="validateForm" style="text-decoration: none"> 
						<span>회원가입</span>
					</a>
				</div>
			</div>
		</div>
	</form>
	<div id="popupBox" style="display: none;"></div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js" charset="utf-8">
	</script>
	<script type="text/javascript" src="/resource/core_js.js?v=1.1" charset="utf-8">
	</script>
	<script type="text/javascript" src="/app/js/signup.js" charset="utf-8">
	</script>
</body>
</html>