<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20201108
 *  마이 페이지 만든 투표 목록
 */
try
{
    $cate_seq       = $_GET["cate_seq"];
    $cate_sub_seq   = $_GET["cate_sub_seq"];
    $keyword        = $_POST["keyword"];
    $page           = $_GET["page"];
    $member_seq     = $_SESSION['member_seq'];
    // 문의 사항 처리
    $vote           = new CApp_Handler_Vote_Ctrl();
    $count          = $vote->getVoteListCountByMember($member_seq, $keyword);
    $paging         = $vote->makePaging($count, $page);
    $result         = $vote->getVoteListByMember($member_seq, $keyword, $paging);
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<div class="messagebuttonbox">
	<button class="messagebutton">
		<span>답장</span>
	</button>
	<button class="messagebutton">
		<span>삭제</span>
	</button>
</div>
<!-- 투표함 버튼 영역 끝 -->
<!-- 투표함 게시판 시작  -->
<div class="board">
	<!-- 투표함 필드 시작 -->
	<div class="boardfieldbox">
		<div class="lareashort">
			<div class="boardcate">
				<span>카테고리</span>
			</div>
		</div>
		<div class="rarealong">
			<div class="boardtitleshortshort">
				<span>내용</span>
			</div>
			<div class="boarddateshort">
				<span>날짜</span>
			</div>
			<div class="boardshortshort">
				<span>참여</span>
			</div>
			<div class="boardshortshort">
				<span>댓글</span>
			</div>
			<div class="boardshortshort">
				<span>좋아요</span>
			</div>
			<div class="boardshortshort">
				<span>구독</span>
			</div>
			<div class="boardshort">
				<span>종류</span>
			</div>
			<div class="boardshort">
				<span>상태</span>
			</div>
		</div>
	</div>
	<!-- 투표함 필드 끝 -->
	<!-- 투표함 게시판 목록 시작 -->
	<div class="boardlist">
		<!-- 투표함 게시판 목록 시작 -->
		<ul>
<?php
// 목록이 없을 경우
if (count($result) <= 0 || $result == false) 
{
?>
			<li id="noData">
				<div class="longarea">
					<div class="boardlonglong">
						<span>등록된 투표가 없습니다.</span>
					</div>
				</div>
			</li>
<?php
} // 목록이 있을 경우
else 
{
    // $length = count($result);
    foreach ($result as $items)
    {
        $vote_seq           = $items["VOTE_SEQ"];
        $vote_writer_name   = $items["VOTE_WRITER_NAME"];
        $vote_kind          = $items["VOTE_KIND"];
        $vote_type          = $items["VOTE_TYPE"];
        $vote_subject       = $items["VOTE_SUBJECT"];
        $vote_cate_seq      = $items["VOTE_CATE_SEQ"];
        $vote_cate_name     = $items["VOTE_CATE_NAME"];
        $vote_cate_sub_seq  = $items["VOTE_CATE_SUB_SEQ"];
        $vote_cate_sub_name = $items["VOTE_CATE_SUB_NAME"];
        $vote_resource_type = $items["VOTE_RESOURCE_TYPE"];
        $vote_url           = $items["VOTE_URL"];
        $vote_view_count    = $items["VOTE_VIEW_COUNT"];
        $vote_use_count     = $items["VOTE_USE_COUNT"];
        $vote_regi_date     = $items["VOTE_REGI_DATE"];
        $vote_is_open       = $items["VOTE_IS_OPEN"];
        $cate_name          = $vote_cate_name;
        if ($cate_name == "")
            $cate_name = $vote_cate_sub_name;
        
            
?>
			<li>
				<div class="lareashort">
					<div class="boardcate">
						<span><?php echo($vote_cate_name); if ($vote_cate_sub_name != "") { echo("&nbsp;>&nbsp;"); echo($vote_cate_sub_name); } ?></span>
					</div>
					<div class="boarddateshort mview">
						<span><?php echo($vote_regi_date); ?></span>
					</div>
				</div>
				<div class="rarealong">
					<div class="boardtitleshortshort">
						<a href="/?mode=mypage&sub=vote&votesub=info&vote_seq=<?php echo($vote_seq); ?>">
							<span><?php echo($vote_subject); ?></span>
						</a>
					</div>
					<div class="boarddateshort wview">
						<span><?php echo($vote_regi_date); ?></span>
					</div>
					<div class="boardshortshort">
						<span class="boardshortfield">참여:</span> <span>452</span>
					</div>
					<div class="boardshortshort">
						<span class="boardshortfield">댓글:</span> <span>545</span>
					</div>
					<div class="boardshortshort">
						<span class="boardshortfield">좋아요:</span> <span>785</span>
					</div>
					<div class="boardshortshort">
						<span class="boardshortfield">구독:</span> <span>23</span>
					</div>
					<div class="boardshort">
						<span>일반투표</span>
					</div>
					<div class="boardshort">
						<span><?php ?></span>
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
			<div class="pagingbutton pageleft pagenavinoselect"></div>
			<div class="pagingbutton">
				<span>1</span>
			</div>
			<div class="pagingbutton pageselect">
				<span>2</span>
			</div>
			<div class="pagingbutton">
				<span>3</span>
			</div>
			<div class="pagingbutton">
				<span>4</span>
			</div>
			<div class="pagingbutton">
				<span>5</span>
			</div>
			<div class="pagingbutton">
				<span>6</span>
			</div>
			<div class="pagingbutton">
				<span>7</span>
			</div>
			<div class="pagingbutton">
				<span>8</span>
			</div>
			<div class="pagingbutton">
				<span>9</span>
			</div>
			<div class="pagingbutton">
				<span>10</span>
			</div>
			<div class="pagingbutton pageright pagenaviselect"></div>
		</div>
		<!-- 페이징 끝 -->
	</div>
	<!-- 투표함 게시판 목록 영역 끝 -->
<?php 
}
?>
</div>