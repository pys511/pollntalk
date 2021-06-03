<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200806
 *  회원가입 처리 화면
 */
try {

    $memberCtrl = new CApp_Handler_Member_Ctrl();
    $result = $memberCtrl->signupMember($_POST);
} catch (CException $ex) {
    $ex->printException();
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<meta http-equiv="Cache-Control" content="no-cache"/>
<meta http-equiv="Expires" content="-1"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link type="text/css" rel="stylesheet" href="/app/css/popup.css?v=1.8" />
<link type="text/css" rel="stylesheet" media="screen and (max-width: 800px)" href="/app/css/mobile.css?v=1.0" />
<link type="text/css" rel="stylesheet" href="/app/css/button.css" />
<title>온라인 투표 설문 폴앤톡</title>
</head>
<body>
<?php
if ($result < 0) {
    ?>
<div class="popcontxtarea">
		<div class="popcontxtbox popcontxttitle">
			<span>회원가입 처리 중에 문제가 발생하였습니다.</span> <a id="closeJoinPopup" href="#">
				<img src="/app/images/close.png" />
			</a>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popcontxtbox">
			<div class="popupbutton">
				<a href="/app/view/page/sign_up.php" style="text-decoration: none">
					<span>회원가입</span>
				</a>
			</div>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popmessagebox">
			<div class="popmessage">
				<p>
					<span class="title">폴앤톡</span> <span>에 가입을 신청해주셔서 감사드립니다.</span>
				</p>
				<p>
					<span>잠시 문제가 발생하여 회원가입을 처리하지 못했습니다. 이에 대해 죄송하고 잠시 후에 다시 시도해주시기
						바랍니다.</span>
				</p>
			</div>
		</div>
	</div>
<?php
} else 
    if ($result == 0) {
        ?>
<div class="popcontxtarea">
		<div class="popcontxtbox popcontxttitle">
			<span>이미 가입이 되었습니다.</span> <a id="closeJoinPopup" href="#"> <img
				src="/app/images/close.png" />
			</a>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popcontxtbox">
			<div class="popupbutton">
				<a id="goLogin" style="text-decoration: none"> <span>로그인 </span>
				</a>
			</div>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popmessagebox">
			<div class="popmessage">
				<p>
					<span class="title">폴앤톡</span> <span>에 가입을 해주셔서 감사드립니다.</span>
				</p>
				<p>
					<span>로그인을 하시면 </span> <span class="title">폴앤톡 </span> <span>서비스를
						이용하실 수 있습니다.</span>
				</p>
			</div>
		</div>
	</div>
<?php
    } else {
        
        $templateArray = [
            "title" => "pollntalk 가입을 환영합니다.",
            "context" => "pollntalk 가입을 환영합니다.",
            "buttonname" => "폴엔톡",
            "buttonlink" => "http://pollntalk2021.cafe24.com/",
            "template" => "./app/view/template/mail_template.html"
        ];
        
        
        $templateBody = CApp_Handler_Util_Email::instance()->setTemplate($templateArray);
        
        $mailArray = [
            'mailTo' => $_POST['email'],
            'subject' => 'pollntalk 가입을 환영합니다.',
            'mailFrom' => 'pollntalk@naver.com',
            'mail_context' => $templateBody,
            'file_list' => ''
        ];
        
        $result = CApp_Handler_Util_Email::instance()->sendEmail($mailArray);
        ?>
<div class="popcontxtarea">
		<div class="popcontxtbox popcontxttitle">
			<span>회원가입이 완료되었습니다.</span> <a id="closeJoinPopup" href="#"> <img
				src="/app/images/close.png" />
			</a>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popcontxtbox">
			<div class="popupbutton">
				<a id="goLogin" style="text-decoration: none"> <span>로그인 </span>
				</a>
			</div>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popmessagebox">
			<div class="popmessage">
				<p>
					<span>폴앤톡에 가입을 해주셔서 감사드립니다.</span>
				</p>
				<br>
				<p>
					<span>로그인을 하시면 폴앤톡 서비스를 이용하실 수 있습니다.</span>
				</p>
			</div>
		</div>
	</div>
<?php
    }
?>
<div id="popupBox" style="display: none;"></div>
	<script type="text/javascript"
		src="https://code.jquery.com/jquery-3.5.0.min.js" charset="utf-8">
</script>
	<script type="text/javascript" src="/resource/core_js.js?v=1.1" charset="utf-8">
</script>
	<script type="text/javascript" src="/app/js/signupend.js" charset="utf-8">
</script>
</body>