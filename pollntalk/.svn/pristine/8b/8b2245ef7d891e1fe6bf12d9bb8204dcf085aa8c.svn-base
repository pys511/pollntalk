<?php
/*
 * pollntalk webserver
 */
require_once ('./core/util/common.php');

$mode = "";
require_once ('./init.php');

try 
{
    $member = null;
    if ($_SESSION["member_seq"] != "") 
    {
        $memberCtrl = new CApp_Handler_Member_Ctrl();
        $member = $memberCtrl->recvMemberInfo($_SESSION);
    }
} 
catch (CException $ex) 
{
    $ex->printException();
}

// 기본은 main
if ($mode == "")
    $mode = "main"; // 추후 기본으로 할 페이지로 할 것.

$contentPath = "./app/view/page/" . $mode . ".php";
?>
<!doctype html>
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
			<meta http-equiv="Cache-Control" content="no-cache"/>
            <meta http-equiv="Expires" content="-1"/>
            <meta http-equiv="Pragma" content="no-cache"/>
			<meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <link rel=" shortcut icon" href="/app/images/favicon.ico" />
            <link rel="icon" href="/app/images/favicon.ico" />
			<link type="text/css" rel="stylesheet" href="/app/css/common.css?v=1.40" />
			<link type="text/css" rel="stylesheet" media="screen and (max-width: 800px)" href="/app/css/mobile.css?v=1.0" />
<?php
// require css page
$css_mode       = $mode;
$css_sub_check  = explode("_", $css_mode);
if ($css_sub_check[1] == "votelist")
    $css_mode   = "votelist";
require_once ('./app/view/head/css_' . $css_mode . '.php');
?>
<title>온라인 투표 설문 폴앤톡</title>
</head>
<body>
	<!-- 메시지 박스 시작 -->
	<form id="frmMessage" method="post" action="/controller.php?mode=message_proc">
		<input type="hidden" id="recv_member_seq" name="recv_member_seq" />
		<input type="hidden" id="cur_pos" name="cur_pos" value="<?php echo($mode); ?>" />
		<input type="hidden" id="message_type" name="message_type" value="2"/>
    	<div id="messagebox" class="messagearea" style="display:none">
    		<div class="messagebox">
    			<div class="messageboxtop">
    				<div class="messagetitle">
    					<span class="messagetitletext">메시지 보내기</span>
    					<img id="messageclose" class="messageclose" src="/app/images/small_close.png" />
    				</div>
    				<div class="messagesender">
    					<span id="sendername" class="messagesendertext">받는 이 : </span>
    				</div>
    			</div>
    			<textarea id="messagecontext" name="messagecontext"></textarea>
    			<div class="messageboxbottom">
    				<button type="button" id="messagebutton" class="messagebutton">
    					<span>보내기</span>
    				</button>
    			</div>
    		</div>
    	</div>
	</form>
	<!-- 메시지 박스 끝 -->
	<!-- 보안코드 박스 시작 -->
	<form id="frmSecureCheck" method="post" action="/controller.php?mode=secure_proc">
		<input type="hidden" id="secure_vote_seq" name="secure_vote_seq"/>
		<div id="securebox" class="messagearea" style="display:none">
    		<div class="securebox">
    			<div class="messageboxtop">
    				<div class="messagetitle">
    					<span class="messagetitletext">보안코드를 입력하세요.</span>
    					<img id="secureboxclose" class="messageclose" src="/app/images/small_close.png" />
    				</div>
    			</div>
    			<input type="text" id="securecode" name="securecode" />
    			<div class="messageboxbottom">
    				<button type="button" id="checksecurecode" class="messagebutton">
    					<span>확인하기</span>
    				</button>
    			</div>
    		</div>
    	</div>
	</form>
	<!-- 보안코드 박스 끝 -->
	<!-- 구독 폼 시작 -->
	<form id="frmSubscribe" method="post" action="/controller.php?mode=subscribe_proc">
		<input type="hidden" id="subscribe_member_seq" name="subscribe_member_seq" />
	</form>
	<!-- 공지 및 메시지 알림 영역 시작 -->
	<div class="alert">
		<input type="hidden" id="alert_message_seq" name="alert_message_seq" />
		<input type="hidden" id="member_seq" name="member_seq" value="<?php echo($_SESSION["memeber_seq"]); ?>" />
    	<div id="alertarea" class="alertarea">
    		<div class="alertbox">
    			<img id="alertimage" class="alertmark" src="/app/images/alert.png" />
    			<span id="alertmessage" class="alertMessage">[메시지] 메시지를 준비하고 있습니다. 잠시만 기다려주시기 바랍니다. [폴액톡]</span>
    			<a id="alertlink" href="/">
    				<img class="alerter" src="/app/images/direct.png" />
    			</a>
    		</div>
    	</div>
    	<div class="alertbuttonarea">
    		<div class="alertbox">
    			<button id="alertbutton" type="button" class="alertbutton">
    				<span id="alertbuttonname">▼ 알람보기</span>
    			</button>
    		</div>
    	</div>
	</div>
	<!-- 공지 및 메시지 알림 영역 끝 -->
	<!-- 구독 폼 끝 -->
	<div class="page">
		<!-- 공통 상단 시작 -->
		<div class="top">
			<!-- 상단 로고 영역 시작 -->
			<div class="toparea">
				<div class="logo">
					<div class="logobox">
						<a href="/"> 
    						<img class="logowindow" src="/app/images/logo.png?v=1.1" alt="폴앤톡 로고" /> 
    						<img class="logomobile" src="/app/images/mobile_logo.png?v=1.0" alt="폴앤톡 로고" />
						</a>
					</div>
					<a id="mobilemenubutton" href="#"> 
						<img class="mobilemenubutton" src="/app/images/mobile_menu.png" />
					</a>
				</div>
				<!-- 로그인, 회원가입 버튼 시작 -->
<?php
if ($_SESSION["member_seq"] == "") 
{
?>			
				<div id="loginBox" class="accountbox">
					<div class="login">
						<a id="login" href="#"> 
							<img src="/app/images/login.png" /> 
							<span>로그인</span>
						</a>
					</div>
					<div class="join">
						<a id="join" href="#"> <img src="/app/images/join.png" /> <span>회원가입</span>
						</a>
					</div>
				</div>
				<!-- 로그인, 회원가입 버튼 끝 -->
<?php
} 
else 
{
?>
				<!-- 로그아웃, 회원정보 시작 -->
				<div id="memberBox" class="memberbox">
					<div class="logout">
						<a id="loginout" href="#"> 
							<img src="/app/images/login.png" /> 
							<span>로그아웃</span>
						</a>
					</div>
					<div class="member" <?php if ($mode == "mypage") {?> select<?php } else {?> noselect<?php } ?>">
						<a href="/?mode=mypage&sub=member"> 
							<img src="<?php echo($member[0]['pic']); ?>" style="width: 20px"/> <span><?php echo($member[0]["nname"]); ?></span>
						</a>
					</div>
				</div>
				<!-- 로그아웃, 회원정보 버튼 끝 -->
<?php
}
?>
			</div>
			<!-- 상단 로고 영역 끝 -->
			<!-- top 메뉴 영역 시작 -->
			<div class="menubar">
				<div class="menuarea">
					<div class="menuitem">
						<div class="menusign <?php if ($mode == "votelist") {?> select<?php } else {?> noselect <?php } ?>">
							<a href="/?mode=votelist"> 
								<span>투표리스트</span>
							</a>
						</div>
					</div>
					<div class="menuitem">
						<div class="menusign <?php if ($mode == "votewrite") {?> select<?php } else {?> noselect <?php } ?>">
<?php 
if ($_SESSION["member_seq"] != "")
{
?>
							<a href="/?mode=votewrite">
<?php
}
else
{
?> 
							<a href="#" onclick="callLogin()">
<?php    
}
?>
								<span>투표만들기</span>
							</a>
						</div>
					</div>
					<div class="menuitem">
						<div class="menusign <?php if ($mode == "voteform") {?> select<?php } else {?> noselect <?php } ?>">
							<a href="/?mode=voteformlist"> 
								<span>투표양식</span>
							</a>
						</div>
					</div>
					<div class="menuitem">
						<div class="menusign <?php if ($mode == "customer") {?> select<?php } else {?> noselect <?php } ?>">
							<a href="/?mode=customer&sub=notice"> 
								<span>고객센터</span>
							</a>
						</div>
					</div>
					<div class="menuitem">
						<div class="menusign <?php if ($mode == "mypage") {?> select<?php } else {?> noselect <?php } ?>">
<?php 
if ($_SESSION["member_seq"] != "")
{
?>
							<a href="/?mode=mypage&sub=member">
<?php
}
else
{
?>
							<a href="#" onclick="callLogin()">
<?php    
}
?>
							 <span>마이페이지</span>
							</a>
						</div>
					</div>
				</div>
			</div>
<?php 
$keyword    = $_POST["search"];
if ($keyword == "")
    $keyword    = $_GET["search"];
?>
			<!-- top 메뉴 영역 끝 -->
			<!-- 검색 영역 시작 -->
			<div class="searchbar">
				<div class="searcharea">
					<!-- 검색 입력란 시작 -->
					<div class="searchbox">
						<form id="frmSearch" method="post" action="/index.php?mode=search">
    						<input id="search" name="search" type="text" class="search" placeholder="검색어를 입력하세요." value="<?php echo($keyword); ?>" />
    						<a id="goSearch" href="javascript:void(0);">
    							<img src="/app/images/search.png" />
    						</a>
						</form>
					</div>
					<!-- 검색 입력란 끝 -->
					<!-- 추천 검색어 시작 -->
					<div class="recommandsearch">
						<span class="recommandtitle">추천검색어</span>
<?php 
try
{
    $searchCtrl     = new CApp_Handler_Search_Ctrl();
    $keywordlist    = $searchCtrl->getkeywordListMain();
    for ($i = 0; $i < count($keywordlist); $i++)
    {
        $keywordName    = $keywordlist[$i]["KEYWORD_NAME"];
?>
						<div class="searchitem">
							<a href="javascript:setSearchKeyword('<?php echo($keywordName)?>')">
								<span><?php echo($keywordName); ?></span>
							</a>
						</div>
<?php 
    }
}
catch (CException $ex)
{
    $ex->printException();
}

?>
					</div>
					<!-- 추천 검색어 끝 -->
				</div>
			</div>
			<!-- 검색 영역 끝 -->
		</div>
		<!-- 공통 상단 끝 -->
		<!-- 컨텐츠 시작-->
<?php
// content page
require_once ($contentPath);
?>
	<!-- 컨텐츠 끝-->
		<!-- 하단 시작 -->
		<div class="footer">
			<!-- 하단 메뉴 시작 -->
			<div class="footermenuarea">
				<div class="footermenubox">
					<div class="footermenu fspace">
						<img class="wfootermenu" src="/app/images/footer_menu_01.png" /> 
						<img class="mfootermenu" src="/app/images/footer_menu_m_01.png" />
						<div class="footermenuitem mfooterline">
							<a href='/?mode=customer&sub=notice'>
								<span class="footermenutitle">공지사항</span>
							</a> 
							<span class="footermenutext">폴앤톡에서 알려드리는 공지사항과 이벤트입니다.</span>
						</div>
					</div>
					<div class="footermenu fspace">
						<img class="wfootermenu" src="/app/images/footer_menu_02.png" /> 
						<img class="mfootermenu" src="/app/images/footer_menu_m_02.png" />
						<div class="footermenuitem mfooterline">
							<a href='/?mode=customer&sub=faq'>
								<span class="footermenutitle">자주하는 질문</span>
							</a> 
							<span class="footermenutext">폴앤톡에 대한 정보가 궁금하다면 이용해주세요.</span>
						</div>
					</div>
					<div class="footermenu">
						<img class="wfootermenu" src="/app/images/footer_menu_03.png" /> 
						<img class="mfootermenu" src="/app/images/footer_menu_m_03.png" />
						<div class="footermenuitem">
							<a href='/?mode=customer&sub=support'>
								<span class="footermenutitle">1:1 고객지원</span>
							</a> 
							<span class="footermenutext">필요한 서비스/기능이나 에러가 있으면 알려주세요.</span>
						</div>
					</div>
				</div>
			</div>
			<!-- 하단 메뉴 끝 -->
			<!-- 하단 공통 시작 -->
			<div class="footercommonarea">
				<div class="footercommonbox">
					<img src="/app/images/footer_logo.png?v=1.1" />
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
									<span>주소 : 경기도 평택시 서탄면 수월암2길 88-12, 2층 1호 (우편번호 17704)</span>
									<span>사업자등록번호 : 578-76-00226</span>
								</div>
								<div class="footerguide">
									<span>통신판매업신고 : 2020-경기평택-0299호</span> 
									<span>대표 : 고형석</span>
									<span>이메일 : pollntalk@naver.com</span>
								</div>
								<div class="footerguide">
									<span>대표전화 : 070-7633-4520</span>
								</div>
								<div class="footerguide fbottom">
									<span>Copyrightⓒ 2020 PS VALTEC Corp. All Right Reserved.</span>
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
		<!-- 모바일 추천 검색어 시작 -->
		<div id="mobilesearchbox" class="mrecommsearchlayer" style="display: none">
			<div class="mrecommsearcharea">
				<div class="msearch">
					<img id="closesearch" class="msearchclose" src="/app/images/search_close.png" />
					<!-- 검색 입력란 시작 -->
					<div class="msearchbox">
						<input type="text" class="search" value="검색어를 입력하세요." /> 
						<img src="/app/images/search.png" />
					</div>
					<!-- 검색 입력란 끝 -->
				</div>
				<div class="mrecommsearch">
					<div class="mrecommtitle">
						<span>추천 검색어</span>
					</div>
					<div class="mrecommlist">
						<ul>
							<li><span class="mrecommnumber">1</span> <span>코로나</span></li>
							<li><span class="mrecommnumber">2</span> <span>애플</span></li>
							<li><span class="mrecommnumber">3</span> <span>부동산</span></li>
							<li><span class="mrecommnumber">4</span> <span>야구</span></li>
							<li><span class="mrecommnumber">5</span> <span>맛집</span></li>
							<li><span class="mrecommnumber">6</span> <span>1인 가구</span></li>
							<li><span class="mrecommnumber">7</span> <span>영화</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- 모바일 추천 검색어 끝 -->
		<!-- 모바일 메뉴 시작 -->
		<div id="mobilemenubox" class="mmenulayer" style="display: none;">
			<div class="mobilemenuarea">
				<div class="mobilemenu">
					<div class="mobilemenubox">
						<div class="menutop">
							<img class="mobilelogo" src="/app/images/mobile_logo.png" /> 
							<a id="mmenuclose" href="#"> 
								<img class="close" src="/app/images/close.png" />
							</a>
						</div>
					</div>
					<!-- 로그인, 회원가입 버튼 시작 -->
					<div class="accountbox">
						<div class="login">
							<a id="mlogin" href="#"> 
							<img src="/app/images/mobile_login.png" />
								<span>로그인</span>
							</a>
						</div>
						<div class="join">
							<a id="mjoin" href="#"> 
								<img src="/app/images/mobile_join.png" />
								<span>회원가입</span>
							</a>
						</div>
					</div>
					<div class="menubox">
						<ul>
							<li>
								<a href="/?mode=votelist"> 
									<span>투표리스트</span>
								</a>
							</li>
							<li>
								<a href="/?mode=votewrite"> 
									<span>투표만들기</span>
								</a>
							</li>
							<li><span>투표양식</span></li>
							<li><span>고객센터</span></li>
							<li><span>마이페이지</span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- 모바일 메뉴 끝 -->
		<!-- 팝업 메뉴 시작 -->
		<div id="popupmenubox" class="popupmenubox" style="display:none">
			<div id="subscribe" class="memuitem bline">
				<span class="menuname">구독하기</span>
				<span class="menuarrow">></span>
			</div>
			<div id="messageLink" class="memuitem">
				<span class="menuname">쪽지보내기</span>
				<span class="menuarrow">></span>
			</div>
		</div>
		<!-- 팝업 메뉴 끝 -->
		<!-- 팝업 시작 -->
		<div id="popup" class="layerarea" style="display: none">
			<div class="layerbox">
				<div class="popuparea">
					<div id="popupBox" class="popupbox"></div>
				</div>
			</div>
		</div>
		<div id="calendarPopup" style="display: none">
			<div class="popuparea">
				<div id="calendarpopupBox" class="popupbox"></div>
			</div>
		</div>
		<!-- 팝업 끝 -->
		<!-- 세금계산서 신청 시작 -->
		<div class="layerarea" style="display: none">
			<div class="layerbox">
				<div class="popuparea">
					<div class="popupbox">
						<div class="popcontxtarea">
							<div class="popcontxtbox popcontxttitle bsline">
								<span>세금계산서</span> <img src="images/close.png" />
							</div>
						</div>
						<div class="popcontxtarea">
							<div class="popcontxtbox">
								<div class="continputer">
									<div class="inputbox biline">
										<div class="inputrec">
											<div class="inputfield">
												<span>사업자등록증번호</span>
											</div>
											<input class="inputlong" type="text" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="popcontxtarea">
							<div class="popcontxtbox">
								<div class="continputer">
									<div class="inputbox">
										<div class="inputrec">
											<div class="inputfield">
												<span>회사명</span>
											</div>
											<input class="inputlong" type="text" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="popcontxtarea">
							<div class="popcontxtbox">
								<div class="continputer">
									<div class="inputbox">
										<div class="inputrec">
											<div class="inputfield">
												<span>대표자</span>
											</div>
											<input class="inputlong" type="text" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="popcontxtarea">
							<div class="popcontxtbox">
								<div class="continputer">
									<div class="inputbox biline">
										<div class="inputrec">
											<div class="inputfield">
												<span>주소</span>
											</div>
											<input class="inputshort" type="text" />
											<div class="inputbutton">
												<span>주소찾기</span>
											</div>
										</div>
										<div class="inputrec">
											<div class="inputfield"></div>
											<input class="inputlong" type="text" />
										</div>
										<div class="inputrec">
											<div class="inputfield"></div>
											<input class="inputlong" type="text" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="popcontxtarea">
							<div class="popcontxtbox">
								<div class="continputer">
									<div class="inputbox">
										<div class="inputrec">
											<div class="inputfield">
												<span>이메일</span>
											</div>
											<input class="inputlong" type="text" />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="popcontxtarea">
							<div class="popcontxtbox">
								<div class="popupbutton">
									<span>신청하기</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 세금계산서 신청 끝 -->
	</div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.0.min.js" charset="utf-8">
	</script>
	<script type="text/javascript" src="/resource/core_js.js?v=1.3" charset="utf-8">
	</script>
	<script type="text/javascript" src="/app/js/common.js?v=1.31" charset="utf-8">
	</script>
<?php
require_once ('./app/view/common/footer.php');
?>
</body>
</html>
<?php
unset($_POST);
?>