<?php
/*
 *  mypage
 */
$sub   = "";

if (array_key_exists(CONST_WEB_MESSAGE::SUB, $_GET))
    $sub    = $_GET[CONST_WEB_MESSAGE::SUB];
else
    $sub    = "member";
    
//기본은 member
if ($sub == "")
    $sub   = "member";   //추후 기본으로 할 페이지로 할 것.
    
$subcontentPath   = "./app/view/page/mypage_".$sub.".php";
?>
<div class="content">
	<div class="mypagearea">
		<div class="mypagebox">
			<div class="tabmenu">
				<div class="tabbuttonbox">
					<?php
					if ($sub == "member"){
					?>
					<button class="tabbuttonon" onclick="location.href='/?mode=mypage&sub=member'">
						<span class="title">회원정보</span>
					</button>
					<?php     
					}else{
					?>
					<button class="tabbuttonoff" onclick="location.href='/?mode=mypage&sub=member'">
					   <span class="disabletitle">회원정보</span>
					</button>
					<?php
				    }
					?>
				</div>
				<div class="tabbuttonbox">
					<?php
					if ($sub == "message"){
					?>
					<button class="tabbuttonon" onclick="location.href='/?mode=mypage&sub=message'">
						<span class="title">쪽지</span>
					</button>
					<?php     
					}else{
					?>
					<button class="tabbuttonoff" onclick="location.href='/?mode=mypage&sub=message'">
					   <span class="disabletitle">쪽지</span>
					</button>
					<?php
				    }
					?>
				</div>
				<div class="tabbuttonbox">
					<?php
					if ($sub == "vote"){
					?>
					<button class="tabbuttonon" onclick="location.href='/?mode=mypage&sub=vote&votesub=make'">
						<span class="title">투표함</span>
					</button>
					<?php     
					}else{
					?>
					<button class="tabbuttonoff" onclick="location.href='/?mode=mypage&sub=vote&votesub=make'">
					   <span class="disabletitle">투표함</span>
					</button>
					<?php
				    }
					?>
				</div>
				<div class="tabbuttonbox">
					<?php
					if ($sub == "point"){
					?>
					<button class="tabbuttonon" onclick="location.href='/?mode=mypage&sub=point'">
						<span class="title">포인트</span>
					</button>
					<?php     
					}else{
					?>
					<button class="tabbuttonoff" onclick="location.href='/?mode=mypage&sub=point'">
					   <span class="disabletitle">포인트</span>
					</button>
					<?php
				    }
					?>
				</div>
				<div class="tabbuttonbox">
					<?php
					if ($sub == "coupon"){
					?>
					<button class="tabbuttonon" onclick="location.href='/?mode=mypage&sub=coupon'">
						<span class="title">구입쿠폰</span>
					</button>
					<?php     
					}else{
					?>
					<button class="tabbuttonoff" onclick="location.href='/?mode=mypage&sub=coupon'">
					   <span class="disabletitle">구입쿠폰</span>
					</button>
					<?php
				    }
					?>
				</div>
				<div class="tabbuttonbox">
					<?php
					if ($sub == "mall"){
					?>
					<button class="tabbuttonon" onclick="location.href='/?mode=mypage&sub=mall'">
						<span class="title">포인트 Mall</span>
					</button>
					<?php     
					}else{
					?>
					<button class="tabbuttonoff" onclick="location.href='/?mode=mypage&sub=mall'">
					   <span class="disabletitle">포인트 Mall</span>
					</button>
					<?php
				    }
					?>
				</div>
			</div>
			<!-- 텝 컨텐츠 시작 -->
<?php 
//mypage content page
require_once ($subcontentPath);
?>
			<!-- 텝 컨텐츠 끝 -->
		</div>
	</div>
</div>