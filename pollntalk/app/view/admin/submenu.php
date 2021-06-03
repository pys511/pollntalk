<?php
?>
<div class="subMenu" style="display: block;">
	<div id="subpagemenu" class="sideMenu" style="display: block;">
		<!-- 서브 메뉴 -->
		<ul id="submenu" class="menuCategory">
			<li class="menuCateItem">
				<div class="menuCateTitle">
					<a id="submenu02" href="/admin_manager.php?mode=adminlist"> 
						<span>관리자 관리</span>
					</a>
				</div>
				<ul id="adminmenu" class="menuItem">
					<li>
						<a href="/admin_manager.php?mode=adminlist">
							<span>관리자 목록</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=adminregister">
							<span>관리자 등록</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="menuCateItem">
				<div class="menuCateTitle">
					<a id="submenu02" href="/admin_manager.php?mode=mainsetting"> 
						<span>사이트 설정</span>
					</a>
				</div>
				<ul id="adminmenu" class="menuItem">
					<li>
						<a href="/admin_manager.php?mode=mainsetting">
							<span>메인 메시지 / 이미지 관리</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=adversetting">
							<span>광고 관리</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=searchkeyword">
							<span>검색어</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="menuCateItem">
				<div class="menuCateTitle">
					<a id="submenu02" href="/admin_manager.php?mode=memberlist"> 
						<span>회원 관리</span>
					</a>
				</div>
				<ul id="adminmenu" class="menuItem">
					<li>
						<a href="/admin_manager.php?mode=memberlist">
							<span>회원 목록</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=authmemberlist">
							<span>본인 인증 회원 목록</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=outmemberlist">
							<span>탈퇴 회원 목록</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=emaillist">
							<span>이메일 발송</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=email">
							<span>수신 거부 목록</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="menuCateItem">
				<div class="menuCateTitle">
					<a id="submenu02" href="/admin_manager.php?mode=category"> 
						<span>투표관리</span>
					</a>
				</div>
				<ul id="adminmenu" class="menuItem">
					<li>
						<a href="/admin_manager.php?mode=category">
							<span>카테고리 관리</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=votelist&vote_kind=1">
							<span>일반 투표 목록</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=votelist&vote_kind=2">
							<span>이벤트 투표 목록</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=voteformlist">
							<span>구독 현황</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=voteformlist">
							<span>투표 양식 등록</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="menuCateItem">
				<div class="menuCateTitle">
					<a id="submenu02" href="/admin_manager.php?mode=category"> 
						<span>포인트 관리</span>
					</a>
				</div>
				<ul id="adminmenu" class="menuItem">
					<li>
						<a href="/admin_manager.php?mode=pointregister">
							<span>포인트 설정 등록</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=pointlog">
							<span>포인트 이력</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="menuCateItem">
				<div class="menuCateTitle">
					<a id="submenu02" href="/admin_manager.php?mode=product"> 
						<span>상품/판매 관리</span>
					</a>
				</div>
				<ul id="adminmenu" class="menuItem">
					<li>
						<a href="/admin_manager.php?mode=product">
							<span>상품 등록</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=salelist">
							<span>판매 이력</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=bankaccount">
							<span>입금 계좌 관리</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="menuCateItem">
				<div class="menuCateTitle">
					<a id="submenu02" href="/admin_manager.php?mode=couponlist"> 
						<span>쿠폰 관리</span>
					</a>
				</div>
				<ul id="adminmenu" class="menuItem">
					<li>
						<a href="/admin_manager.php?mode=couponlist">
							<span>쿠폰 목록</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=couponregister">
							<span>쿠폰 등록</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=couponlog">
							<span>쿠폰 발급 이력</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="menuCateItem">
				<div class="menuCateTitle">
					<a id="submenu02" href="/admin_manager.php?mode=replylist"> 
						<span>커뮤니티 관리</span>
					</a>
				</div>
				<ul id="adminmenu" class="menuItem">
					<li>
						<a href="/admin_manager.php?mode=replylist">
							<span>댓글 목록</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=messagelist">
							<span>쪽지 관리</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="menuCateItem">
				<div class="menuCateTitle">
					<a id="submenu03" href="/admin_manager.php?mode=boardnoticelist">
						<span>고객센터</span>
					</a>
				</div>
				<ul id="servermenu" class="menuItem">
					<li>
						<a href="/admin_manager.php?mode=boardnoticelist">
							<span>공지사항 목록</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=boardsupportlist">
							<span>1:1고객지원 목록</span>
						</a>
					</li>
					<li>
						<a href="/admin_manager.php?mode=boardfaqlist">
							<span>자주하는 질문 목록</span>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>