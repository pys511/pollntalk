<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200809
 *  로그인 화면
 */
try
{
    $result = null;
    if ($_POST["email"] != "")
    {
        $memberCtrl     = new CApp_Handler_Member_Ctrl();
        $result         = $memberCtrl->loginMember($_POST);
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link type="text/css" rel="stylesheet" href="/app/css/popup.css?v=1.8" />
<link type="text/css" rel="stylesheet" media="screen and (max-width: 800px)" href="/app/css/mobile.css?v=1.0" />
<link type="text/css" rel="stylesheet" href="/app/css/button.css" />

<title>온라인 투표 설문 폴앤톡</title>
<?php 
if (!is_null($result))
{
    if (!$result)
    {
?>
    <script type="text/javascript">
    alert("가입되지 않은 이메일 주소이거나 잘못된 비밀번호입니다.");
    </script>
<?php
    }
    else 
    {
?>
    <script type="text/javascript">
    parent.refleshPage();
    </script>
<?php 
    }
}
?>
</head>
<body>
<form id="loginForm" name="loginForm" action="/popup.php?mode=login" method="POST">
    <div class="popcontxtarea">
    	<div class="popcontxtbox popcontxttitle">
    		<span>로그인</span>
    		<a id="closeLoginPopup" href="#">
    			<img src="/app/images/close.png" />
    		</a>
    	</div>
    </div>
    <div class="popcontxtarea">
    	<div class="popcontxtbox">
    		<div class="inputer">
    			<input name="email" id="email" type="text" placeholder="이메일" />
    			<img src="/app/images/init.png" />
    		</div>
    	</div>
    </div>
    <div class="popcontxtarea">
    	<div class="popcontxtbox">
    		<div class="inputer">
    			<input name="password" id="password" type="password" placeholder="비밀번호" />
    			<img src="/app/images/init.png" />
    		</div>
    	</div>
    </div>
    <div class="popcontxtarealspace">
    	<div class="popcontxtbox">
    		<input id="saveemail" type="checkbox" />
    		<label for="saveemail"><span>이메일 저장</span></label>
    	</div>
    </div>
    <div class="popcontxtarea">
    	<div class="popcontxtbox">
    		<div class="popupbutton">
    			<a id="loginbutton" href="javascript:void(0)">
    				<span>로그인</span>
    			</a>
    		</div>
    	</div>
    </div>
    <div class="popcontxtarealspace">
    	<div class="linkbox">
    		<div class="linkitem long">
    			<a id="findPass" href="#">
    				<span>비밀번호 찾기</span>
    			</a>	
    		</div>
    		<div class="linkline">
    		</div>
    		<div class="linkitem short">
    			<a id="sign_up" href="#">
    				<span>회원가입</span>	
    			</a>
    		</div>
    		<div class="linkline">
    		</div>
    		<div class="linkitem long">
    			<a id="support" href="#">
    				<span>1:1고객지원</span>	
    			</a>
    		</div>
    	</div>
    </div>
</form>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js" charset="utf-8">
</script>
<script type="text/javascript" src="/app/js/login.js?ver=1.0" charset="utf-8">
</script>
</body>
</html>