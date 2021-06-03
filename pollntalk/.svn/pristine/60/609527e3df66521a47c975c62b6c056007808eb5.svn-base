<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200809
 *  로그인 화면
 */
try
{
     $upload         = new CApp_Handler_Util_Fileupload();
     $result         = $upload->uploadPicFile();
     if (!$result)
         $result  = "FALSE";
     else 
         echo("<script>parent.refleshPage();parent.closePopup();</script>");
     
         $result = json_encode ( $result, JSON_UNESCAPED_UNICODE);
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
<form id="file_up" name="file_up" action="/popup.php?mode=file_up" method="post" enctype="multipart/form-data">
    <div class="popcontxtarea">
		<div class="popcontxtbox popcontxttitle">
			<span>대표사진 올리기</span>
			<a id="closeFileUpPopup" href="#">
				<img src="/app/images/close.png" />
			</a>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popcontxtbox">
			<span>사진은 jpg, png, gif 파일만 올릴수 있습니다.</span>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popcontxtbox">
			<div class="shortinputer">
    			<input class="shortInputtext" type="text" id="file" name="file" readonly="readonly" placeholder="선택파일" />
				<label for="upload" class="shortInputButton">찾아보기</label> 
				<input type="file" name="myPic" id="upload" class="file_upload" accept="image/jpeg, image/png, image/gif"/>
    		</div>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popcontxtbox">
			<div class="popupbutton">
				<a id="fileUpButton" style="text-decoration: none">
					<span>사진 올리기</span>
				</a>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js" charset="utf-8">
</script>
<script type="text/javascript" src="/resource/core_js.js?v=1.1" charset="utf-8">
</script>
<script type="text/javascript" src="/app/js/fileup.js" charset="utf-8">
</script>
</body>
</html>