<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20201119
 *  나를 구독한 회원 목록
 */
try
{
    $page           = $_GET["page"];
    
    $paging         = $subscribe->makePaging($count, $page);
    $result         = $subscribe->getSubscribeListToMe($keyword, $paging);
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<div class="messagebuttonbox">
	<button class="messagebutton">
		<span>삭제</span>
	</button>
</div>
<!-- 투표함 버튼 영역 끝 -->
<!-- 투표함 게시판 시작  -->
<div class="board">
	<!-- 투표함 필드 시작 -->
	<div class="boardfieldbox">
		<div class="larealonglonglong">
			<div class="boardcheckbox">
				<input type="checkbox" />
			</div>
			<div class="boardmember">
				<span>투표함 회원</span>
			</div>
		</div>
		<div class="rareashortshortshort">
			<div class="boarddefaultlong">
				<span>참여 횟수</span>
			</div>
			<div class="boarddatelong">
				<span>구독신청일</span>
			</div>
		</div>
	</div>
	<!-- 투표함 필드 끝 -->
	<!-- 투표함 게시판 목록 시작 -->
	<div class="boardlist">
		<!-- 투표함 게시판 목록 시작 -->
		<ul>
<?php
$i  = 0;
foreach ($result as $items)
{
    $subscribe_seq      = $items["SUBSCRIBE_SEQ"];
    $memberSeq          = $items["MEMBER_SEQ"];
    $nname              = $items["NNAME"];
    $pic                = $items["PIC"];
    $respCount          = $items["VOTE_RESP_CNT"];
    $subscribeCount     = $items["SUBSCRIBE_CNT"];
    $voteCount          = $items["VOTE_CNT"];
    $newVoteCount       = $items["NEW_VOTE_CNT"];
    $regiDate           = $items["REGI_DATE"];
    
    $className  = "class='mrspace'";
    $ext        = $i % 2;
    $i++;
    
    ///?mode=mypage&sub=vote&votesub=mymember
?>
			<li>
				<div class="larealonglonglong">
					<div class="boardcheckbox">
						<input id="subscribe_seq_<?php echo($i); ?>" name="subscribe_seq[]" type="checkbox" value="<?php echo($subscribe_seq); ?>" />
					</div>
					<div class="boardmember">
						<img src="/<?php echo($pic); ?>" /> 
						<span><?php echo($nname); ?></span>
					</div>
				</div>
				<div class="rareashortshortshort">
					<div class="boarddefaultlong">
						<span class="boardshortfield">참여 횟수:</span> 
						<span><?php echo($respCount); ?></span>
					</div>
					<div class="boarddatelong">
						<span><?php echo($regiDate); ?></span>
					</div>
				</div>
			</li>
<?php 
}
?>
		</ul>
		<!-- 투표함 게시판 목록 끝 -->
		<!-- 페이징 시작 -->
		<div class="paging">
			<!-- <div class="pagingbutton pageleftend pagenavinoselect"></div> -->
			<a id="boardprev" href="/?mode=mypage&sub=vote&votesub=mymember&page=<?php echo($paging["boardprev"])?>">
				<div class="pagingbutton pageleft pagenavinoselect">
				</div>
			</a>
<?php
// print_r($paging);
for ($i = (integer) $paging["start"]; $i <= (integer) $paging["end"]; $i ++) 
{
    if ($page == "")
        $page   = "1";
        ///?mode=mypage&sub=vote&votesub=subscribe
?>
			<div class="pagingbutton <?php if($page == $i) echo("pageselect"); ?>">
				<a id="page" href="/?mode=mypage&sub=vote&votesub=mymember&page=<?php echo($i)?>">
					<span><?php echo($i)?></span>
				</a>
			</div>
<?php
}
?>
			<a id="boardprev" href="/?mode=mypage&sub=vote&votesub=mymember&page=<?php echo($paging["boardnext"])?>">
				<div class="pagingbutton pageright pagenaviselect">
				</div>
			</a>
		</div>
		<!-- 페이징 끝 -->
	</div>
	<!-- 투표함 게시판 목록 영역 끝 -->
</div>