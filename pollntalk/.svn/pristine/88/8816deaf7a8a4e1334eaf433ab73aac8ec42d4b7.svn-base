<?php
?>
<div id="top" class="pageBox">
	<!-- TOP -->
	<div class="contentTitle">
		<img class="logo" src="/app/images/admin/logo.png" alt="로고" />
	</div>
</div>
<div id="menu" class="pageBox">
	<!-- menu -->
	<div class="mainMenu">
		<div class="menuBoxMobile">
			<a id="menuMobileButton" href="javascript:void(0)"><img
				src="/app/images/admin/mobile_menu.gif" alt="메뉴버튼" /></a>
		</div>
		<div class="menuBox">
			<a href="/admin_manager.php?mode=main"><span>메인</span></a> <span>|</span>
			<a href="/admin_manager.php?mode=adminlist"><span>관리자 관리</span></a> <span>|</span>
			<a href="/admin_manager.php?mode=mainsetting"><span>사이트 설정</span></a> <span>|</span>
			<a href="/admin_manager.php?mode=memberlist"><span>회원 관리</span></a> <span>|</span>
			<a href="/admin_manager.php?mode=category"><span>투표 관리</span></a> <span>|</span>
			<a href="/admin_manager.php?mode=pointregister"><span>포인트 관리</span></a> <span>|</span>
			<a href="/admin_manager.php?mode=product"><span>상품/판매 관리</span></a> <span>|</span>
			<a href="/admin_manager.php?mode=couponlist"><span>쿠폰 관리</span></a> <span>|</span>
			<a href="/admin_manager.php?mode=replylist"><span>커뮤니티 관리</span></a> <span>|</span>
			<a href="/admin_manager.php?mode=boardnoticelist"><span>고객센터</span></a>
		</div>
		<div id="member" class="adminmember">
<?php
// 관리자 login 여부
if ($_SESSION["admin_id"] == "") 
{
?>            	
            	<div id="beforeLogin" class="memberLogin">
				<a id="loginMember" href="/admin_manager.php?mode=login"><span>로그인</span></a>
			</div>
<?php
} 
else 
{
?>
            	<div id="afterLogin" class="memberInfo">
				<a id="logoutAdmin" href="/admin_manager.php?mode=logout"><span>로그아웃</span></a>
			</div>
<?php
}
?>
            	</div>
	</div>
</div>