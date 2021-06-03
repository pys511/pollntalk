<?php 
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200806
 *  회원가입 처리 화면
 */
try
{
    
    $memberCtrl     = new CApp_Handler_Member_Ctrl();
    $result         = $memberCtrl->updateMember($_POST);
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
</head>
<body>
<?php
if ($result < 0)
{
?>
<div class="popcontxtarea">
	<div class="popcontxtbox popcontxttitle">
		<span>회원정보수정 처리 중에 문제가 발생하였습니다.</span>
		<a id="closeEndPopup" href="#">
			<img src="/app/images/close.png" />
		</a>
	</div>
</div>
<div class="popcontxtarea">
	<div class="popmessagebox">
		<div class="popmessage">
			<p>
				<span class="title">폴앤톡</span>
				<span>회원정보수정에 실패하였습니다.</span>
			</p>
			<p>
				<span>잠시 문제가 발생하여 회원정보수정을 처리하지 못했습니다. 이에 대해 죄송하고 잠시 후에 다시 시도해주시기 바랍니다.</span>
			</p>
		</div>
	</div>
</div>
<?php
}
else
{
?>
<div class="popcontxtarea">
	<div class="popcontxtbox popcontxttitle">
		<span>회원정보수정이 완료되었습니다.</span>
		<a id="closeEndPopup" href="#">
			<img src="/app/images/close.png" />
		</a>
	</div>
</div>
<div class="popcontxtarea">
	<div class="popmessagebox">
		<div class="popmessage">
			<p>
				<span class="title">폴앤톡</span>
				<span>을 이용해 주셔서 항상 감사드립니다.</span>
			</p>
		</div>
	</div>
</div>
<div class="popcontxtarea">
	<div class="popcontxtbox">
		<div class="popupbutton">
			<a id="closePopup" style="text-decoration: none">
				<span>창닫기</span>
			</a>
		</div>
	</div>
</div>
<?php
}
?>
<div id="popupBox" style="display:none;">
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js" charset="utf-8">
</script>
<script type="text/javascript" src="/resource/core_js.js?v=1.1" charset="utf-8">
</script>
<script type="text/javascript" src="/app/js/modificationend.js" charset="utf-8">
</script>
</body>