<?php
/*
 * mypage vote
 */
$votesub    = "";
$keyword    = "";

if (array_key_exists(CONST_WEB_MESSAGE::VOTESUB, $_GET))
    $votesub = $_GET[CONST_WEB_MESSAGE::VOTESUB];
else
    $votesub = "participate";

// 기본은 member
if ($votesub == "")
    $votesub = "participate"; // 추후 기본으로 할 페이지로 할 것.

$votesubcontentpath = "./app/view/page/mypage_vote_" . $votesub . ".php";

$vote               = new CApp_Handler_Vote_Ctrl();
$makeCount          = $vote->getVoteListCountByMember($_SESSION["member_seq"], $keyword);
$participantCount   = $vote->getParticipantVoteCountByMe();

$subscribe          = new CApp_Handler_Subscribe_Ctrl();
$subscribeYouCount  = $subscribe->getSubscribeListToYouCount($keyword);
$subscribeMeCount   = $subscribe->getSubscribeListToMeCount($keyword);
?>
<div class="messagecontent">
	<!-- 투표함 상황 시작 -->
	<div class="messagestatus">
		<div class="messagestatustitle <?php if ($votesub == "make") echo("title");?>" >
			<a href="/?mode=mypage&sub=vote&votesub=make"> <span>만든 투표(<?php echo($makeCount); ?>)</span>
			</a>
		</div>
		<div class="messagestatustitle <?php if ($votesub == "participate") echo("title");?>">
			<a href="/?mode=mypage&sub=vote&votesub=participate"> <span>참여 투표(<?php echo($participantCount); ?>)</span>
			</a>
		</div>
		<div class="messagestatustitle <?php if ($votesub == "subscribe") echo("title");?>">
			<a href="/?mode=mypage&sub=vote&votesub=subscribe"> <span>구독 투표(<?php echo($subscribeYouCount); ?>)</span>
			</a>
		</div>
		<div class="messagestatustitle <?php if ($votesub == "mymember") echo("title");?>">
			<a href="/?mode=mypage&sub=vote&votesub=mymember"> <span>내 투표 구독 회원(<?php echo($subscribeMeCount); ?>)</span>
			</a>
		</div>
	</div>
	<!-- 투표함 상황 끝 -->
	<!-- 투표함 버튼 영역 시작 -->
<?php
// mypage content page
require_once ($votesubcontentpath);
?>
	<!-- 투표함 게시판 끝 -->
</div>