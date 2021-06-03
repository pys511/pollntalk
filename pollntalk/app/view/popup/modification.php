<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200917
 *  회원정보 수정 화면
 */
try
{
    $result = null;
    if ($_SESSION["member_seq"] != "")
    {
        $memberCtrl     = new CApp_Handler_Member_Ctrl();
        $result         = $memberCtrl->recvMemberInfo($_SESSION);
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
</head>
<body>
<form id="modification" name="modification" action="/popup.php?mode=modification_end" method="POST">
	<div class="popcontxtarea">
		<div class="popcontxtbox popcontxttitle">
			<span>회원정보 수정</span>
			<a id="closemodificationPopup" href="#">
				<img src="/app/images/close.png" />
			</a>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popcontxtbox">
			<div class="shortinputer">
				<input class="shortInputtext" type="text" id="email" name="email" placeholder="이메일주소" value="<?php echo($result[0]['email']); ?>" readonly />
			</div>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popcontxtbox">
			<div class="inputer">
				<input type="password" id="password1" name="password1" placeholder="비밀번호(8~16자리 영문, 숫자, 특수문자 포함)" />
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
				<?php if($result[0]['cert'] == "1"){
				    ?>
				    <input type="text" id="u_name" name="u_name" placeholder="이름" value="<?php echo($result[0]['uname']); ?>" readonly/>
				<?php
				}else{
				 ?>
				    <input type="text" id="u_name" name="u_name" placeholder="이름" value="<?php echo($result[0]['uname']); ?>"/>
				<?php
				}?>
				
			</div>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popcontxtbox">
			<div class="shortinputer">
				<input type="hidden" id="pre_n_name" name="pre_n_name" placeholder="이전닉네임" value="<?php echo($result[0]['nname']); ?>"/>
				<input class="shortInputtext" type="text" id="n_name" name="n_name" placeholder="닉네임" value="<?php echo($result[0]['nname']); ?>" readonly/>
			</div>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popcontxtbox">
			<span>생년월일 입력</span>
			<div class="lineinputer">
				<input type="hidden" id="b_birth" name="b_birth" />
				<?php if($result[0]['cert'] == "1"){
				    ?>
				    <select id="b_year" readonly style='background-color:#ffffff' onFocus='this.initialSelect = this.selectedIndex;' onChange='this.selectedIndex = this.initialSelect;'>
				    <?php
				}
				else{
				    ?>
				    <select id="b_year">
				    <?php
				}
				    ?>
					<option value="-">생일 년</option>
<?php
$year = date("Y"); 
for ($i = $year; $i >= 1900; $i--)
{
    if(substr($result[0]['birthday'], 0, 4) == $i)
    {
?>					
					<option value="<?php echo($i); ?>" selected="selected"><?php echo($i); ?></option>
<?php }else{
?>
    				<option value="<?php echo($i); ?>"><?php echo($i); ?></option>
<?php 
    }
}
?>
				</select>
				<?php if($result[0]['cert'] == "1"){
				    ?>
				    <select id="b_month" readonly style='background-color:#ffffff' onFocus='this.initialSelect = this.selectedIndex;' onChange='this.selectedIndex = this.initialSelect;'>
				    <?php
				}
				else{
				    ?>
				    <select id="b_month">
				    <?php
				}
				    ?>
					<option value="-">생일 월</option>
<?php
for ($i = 1; $i <= 12; $i++)
{
    if(substr($result[0]['birthday'], 5, 2) == $i)
    {
        ?>
					<option value="<?php echo($i); ?>" selected="selected"><?php echo($i); ?></option>
<?php }else{
?>
    				<option value="<?php echo($i); ?>"><?php echo($i); ?></option>
<?php 
    }
}
?>
				</select>
				<?php if($result[0]['cert'] == "1"){
				    ?>
				    <select id="b_day" readonly style='background-color:#ffffff' onFocus='this.initialSelect = this.selectedIndex;' onChange='this.selectedIndex = this.initialSelect;'>
				    <?php
				}
				else{
				    ?>
				    <select id="b_day">
				    <?php
				}
				    ?>
					<option value="-">생일 일</option>
<?php
for ($i = 1; $i <= 31; $i++)
{
    if(substr($result[0]['birthday'], 8, 2) == $i)
    {
        ?>
					<option value="<?php echo($i); ?>" selected="selected"><?php echo($i); ?></option>
<?php }else{
?>
    				<option value="<?php echo($i); ?>"><?php echo($i); ?></option>
<?php 
    }
}
?>
				</select>
<?php 
if($result[0]["gender"] == "f")
{
?>
				<input type="radio" id="female" name="gender" value="f" checked="checked" <?php if($result[0]['cert'] == "1"){echo "onclick='return(false);'";}?>/>
				<label for="female">
					<span class="agreetext">여자</span>
				</label>
				<input type="radio" id="male" name="gender" value="m" <?php if($result[0]['cert'] == "1"){echo "onclick='return(false);'";}?>/>
				<label for="male">
					<span class="agreetext">남자</span>
				</label>
<?php
}else{
?>
				<input type="radio" id="female" name="gender" value="f" <?php if($result[0]['cert'] == "1"){echo "onclick='return(false);'";}?>/>
				<label for="female">
					<span class="agreetext">여자</span>
				</label>
				<input type="radio" id="male" name="gender" value="m" checked="checked" <?php if($result[0]['cert'] == "1"){echo "onclick='return(false);'";}?>/>
				<label for="male">
					<span class="agreetext">남자</span>
				</label>
<?php
}
?>
			</div>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popcontxtbox">
			<div class="lineinputer">
				<select id="abode" name="abode">
					<option value="-">거주지 선택</option>
					<option value="01" <?php if($result[0]["abode"]=="01"){echo ("selected='selected'");}?>>서울특별시</option>
					<option value="02" <?php if($result[0]["abode"]=="02"){echo ("selected='selected'");}?>>부산광역시</option>
					<option value="03" <?php if($result[0]["abode"]=="03"){echo ("selected='selected'");}?>>대구광역시</option>
					<option value="04" <?php if($result[0]["abode"]=="04"){echo ("selected='selected'");}?>>인천광역시</option>
					<option value="05" <?php if($result[0]["abode"]=="05"){echo ("selected='selected'");}?>>광주광역시</option>
					<option value="06" <?php if($result[0]["abode"]=="06"){echo ("selected='selected'");}?>>대전광역시</option>
					<option value="07" <?php if($result[0]["abode"]=="07"){echo ("selected='selected'");}?>>울산광역시</option>
					<option value="08" <?php if($result[0]["abode"]=="08"){echo ("selected='selected'");}?>>세종특별자치시</option>
					<option value="11" <?php if($result[0]["abode"]=="11"){echo ("selected='selected'");}?>>경기도</option>
					<option value="12" <?php if($result[0]["abode"]=="12"){echo ("selected='selected'");}?>>강원도</option>
					<option value="13" <?php if($result[0]["abode"]=="13"){echo ("selected='selected'");}?>>충청북도</option>
					<option value="14" <?php if($result[0]["abode"]=="14"){echo ("selected='selected'");}?>>충청남도</option>
					<option value="15" <?php if($result[0]["abode"]=="15"){echo ("selected='selected'");}?>>전라북도</option>
					<option value="16" <?php if($result[0]["abode"]=="16"){echo ("selected='selected'");}?>>전라남도</option>
					<option value="17" <?php if($result[0]["abode"]=="17"){echo ("selected='selected'");}?>>경상북도</option>
					<option value="18" <?php if($result[0]["abode"]=="18"){echo ("selected='selected'");}?>>경상남도</option>
					<option value="20" <?php if($result[0]["abode"]=="20"){echo ("selected='selected'");}?>>제주특별자치도</option>
				</select>
			</div>
		</div>
	</div>
	<div class="popcontxtarea">
		<div class="popcontxtbox">
			<div class="popupbutton">
				<a id="updateForm" style="text-decoration: none">
					<span>회원정보수정</span>
				</a>
			</div>
		</div>
	</div>
</form>
<div id="popupBox" style="display:none;">
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js" charset="utf-8">
</script>
<script type="text/javascript" src="/resource/core_js.js?v=1.1" charset="utf-8">
</script>
<script type="text/javascript" src="/app/js/modification.js" charset="utf-8">
</script>
</body>
</html>