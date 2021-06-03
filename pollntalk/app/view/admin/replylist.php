<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20201013
 *  댓글 목록
 */
try 
{
    $keyword        = "";
    $page           = $_GET["page"];
    $vote_seq       = $_GET["vote_seq"];
    $vote_form_seq  = $_GET["vote_form_seq"];
    $host_kind      = $_GET["host_kind"];
    if ($vote_seq != "")
        $host_kind      = "1";
    if ($vote_form_seq != "")
        $vote_form_seq  = "2";
    $vote           = new CApp_Handler_Vote_Ctrl();
    $result         = $vote->getVoteInfoByAdmin($vote_seq);
    
    $replyCtrl  = new CApp_Handler_Reply_Ctrl();
    $count      = $replyCtrl->getReplyListByKindCount($vote_seq, $host_kind, $keyword);
} 
catch (CException $ex) 
{
    $ex->printException();
}
?>
<!doctype html>
<html id="start" xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once ('./app/view/admin/header.php');
?>
<body id="body">
	<div id="mobilemenu" class="mobileMenu" style="display: none;">
		<!-- 서브메뉴 -->
	</div>
	<div class="pageArea">
<?php
require_once ('./app/view/admin/common.php');
?>	
    	<div id="content" class="pageBox">
    		<!-- content -->
    		<div class="contentArea">
<?php
require_once ('./app/view/admin/submenu.php');
?>	
    			<div class="contentBox">
    				<div class="boardTitle">
    					<img src="/app/images/admin/title_mark.gif" />
            			<span>댓글 목록</span>
    				</div>
    				<form id="frmReply" name="frmReply" action="/admin_controller.php?mode=reply_proc" method="post">
    					<input type="hidden" id="reply_vote_seq" name="reply_vote_seq" value="<?php echo($vote_seq); ?>" />
    					<input type="hidden" id="reply_vote_form_seq" name="reply_vote_form_seq" value="<?php echo($vote_form_seq); ?>" />
    					<input type="hidden" id="reply_seq" name="reply_seq" />
    					<input type="hidden" id="reply_proc" name="reply_proc" />
    					<select id="host_kind" name="host_kind">
    						<option value="-" <?php if ($host_kind == "") { echo("selected"); } ?>>답글 위치 선택</option>
    						<option value="1" <?php if ($host_kind == "1") { echo("selected"); } ?>>투표/설문</option>
    						<option value="2" <?php if ($host_kind == "2") { echo("selected"); } ?>>투표양식</option>
    					</select>
					
						<div class="boardBox">
<?php 
if ($vote_seq != "")
{
?>
        					<div class="boardWriteItem">
        						<div class="boardName">
        							<span>투표/설문 제목</span>
        						</div>
        						<div class="boardInputBox">
        							<a href="/admin_manager.php?mode=voteinfo&vote_seq=<?php echo($vote_seq)?>">
        								<span>[<?php echo($vote_seq); ?>]<?php echo($result["VOTE_SUBJECT"]); ?></span>
        							</a>
        						</div>
        					</div>
<?php 
}
?>
        					<div class="boardWriteItem">
								<div class="boardName">
									<span>댓글 현황</span>
								</div>
								<div class="boardInputBox">
									<span>현황 : <?php echo($count); ?></span>
								</div>
							</div>
<?php 
if ($vote_seq != "")
{
?>
        					<div class="boardWriteItem">
        						<div class="boardName">
        							<span>댓글 등록</span>
        						</div>
        						<div class="boardImageInputBox">
        							<textarea id="replycontext" name="replycontext" cols="100" rows="5"></textarea>
        							<!-- 버튼 -->
                					<div class="boardListButtonBox">
                						<div class="buttonBox">
                							<a id="registerReply" href="javascript:void(0);">
                								<span class="buttonText">등록하기</span>
                							</a>
                						</div>
                					</div>
        						</div>
        					</div>
<?php 
}
?>
        				</div>
        				<div class="boardBox">
        					<div class="boardField">
        						<span class="fieldShortShort">선택</span> 
        						<span class="fieldDefault">번호</span> 
        						<span class="fieldShort">투표/설문</span> 
        						<span class="fieldCommon">댓글내용</span>
        						<span class="fieldShort">답글수</span>
        						<span class="fieldShort">작성자</span>
        						<span class="fieldNumber">등록일</span> 
        						<span class="fieldNumber">답글</span>
        						<span class="fieldNumber">삭제여부</span> 
        						<!-- <span class="fieldNumber">작성일</span> -->
        					</div>
        					<div class="boardList">
        						<ul>
<?php
try
{
    $paging     = $replyCtrl->makePaging($count, $page);
    $result     = $replyCtrl->getReplyListByKind($vote_seq, $host_kind, $keyword, $paging);
    // 목록이 없을 경우
    if (count($result) <= 0 || $result == false) 
    {
?>
            						<li id="noData">
    									<div class="boardListItem">
    										<div class="borderListItemGuide">
    											<span>등록된 컨텐츠가 없습니다.</span>
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
            $reply_count    = "0";
            $replySeq       = $items["REPLY_SEQ"];
            $replyContext   = $items["REPLY_CONTEXT"];
            $replyParent    = $items["PARENT_SEQ"];
            $replyWriterSeq = $items["REPLY_WRITER_SEQ"];
            $replyWriter    = $items["NNAME"];
            $voteSeq        = $items["HOST_SEQ"];
            $subReplyCount  = $items["SUBREPLY_COUNT"];
            if ($subReplyCount == "")
                $subReplyCount  = "0";
            $regiDate       = $items["REPLY_REGI_DATE"];
?>
            						<li id="replyitem_<?php echo($replySeq); ?>">
            							<div class="boardListItem">
    										<div class="fieldShortShort">
    											<input id="reply_seq_<?php echo($replySeq); ?>" name="reply_seq[]" type="checkbox" value="<?php echo($replySeq); ?>" />
    										</div>
    										<span class="fieldDefault"><?php echo($replySeq); ?></span>
    										<a href="/admin_manager.php?mode=voteinfo&vote_seq=<?php echo($voteSeq)?>">
    											<span class="fieldShort"><?php echo($voteSeq); ?></span>
    										</a> 
    										<span class="fieldCommon"><?php echo($replyContext); ?></span>
    										<span class="fieldNumber"><?php echo($subReplyCount); ?></span>
    										<a href="/admin_manager.php?mode=memberinfo&member_seq=<?php echo($replyWriterSeq); ?>">
    											<span class="fieldShort"><?php echo($replyWriter); ?></span>
    										</a>
    										<span class="fieldNumber"><?php echo($regiDate); ?></span>
    										<a href="javascript:viewSubReply('<?php echo($replySeq); ?>');">
    											<span class="fieldNumber">답글보기</span>
    										</a>
    										<a href="javascript:removeReply('<?php echo($replySeq); ?>');">
    											<span class="fieldNumber">삭제</span>
    										</a>
    									</div>
    									<div class="boardListItem subreplyarea" id="subreply_<?php echo($replySeq); ?>" style="display:none">
    										<div class="replybox">
    											<textarea class="replycontext" id="subreplycontext_<?php echo($replySeq); ?>" name="subreplycontext_<?php echo($replySeq); ?>" cols="85" rows="3"></textarea>
    											<button type="button" onclick="javascript:registerSubReply('<?php echo($replySeq); ?>');">
        											<span>등록</span>
        										</button>
    										</div>
    										<div class="replybox subreplyitem" style="display:none">
    											<ul class="subreplybox">
    												<li class="subreplysample" style="display:none">
    													<div class="fieldShortShort">
                											<span>ㄴ</span>
                										</div>
                										<span class="fieldLong subreplycontext">
                										</span>
                										<a class="subreplywriterlink" href="#">
                    										<span class="fieldShort subreplywriter">
                    										</span>
                										</a>
                										<span class="fieldNumber subreplyregidate"></span>
                										<a class="deletesubreply" href="#">
                											<span class="fieldNumber">삭제</span>
                										</a>
    												</li>
    											</ul>
    										</div>
    									</div>
    								</li>
<?php
        }
    }
}
catch (CException $ex)
{
    $ex->executeException();   
}
?>
            					</ul>
    						</div>
    					</div>
    					<!-- 페이징 -->
    					<div class="boardListButtonBox">
    						<div class="buttonLeftBox">
    							<a id="boardprev" href="/admin_manager.php?mode=replylist&vote_seq=<?php echo($vote_seq);?>&page=<?php echo($paging["boardprev"])?>">
    								<span class="buttonText">◀</span>
    							</a>
    						</div>
<?php
// print_r($paging);
for ($i = (integer) $paging["start"]; $i <= (integer) $paging["end"]; $i ++) 
{
?>
    						<div id="adverpaging" class="boardPaging">
    							<div id="pageSample" class="buttonLeftBox">
    								<a id="page" href="/admin_manager.php?mode=replylist&vote_seq=<?php echo($vote_seq);?>&page=<?php echo($i)?>">
    									<span id="pageText" class="buttonText">
    										<?php echo($i)?>
    									</span>
    								</a>
    							</div>
    						</div>
<?php
}
?>
    						<div class="buttonLeftBox">
    							<a id="boardnext" href="/admin_manager.php?mode=replylist&vote_seq=<?php echo($vote_seq);?>&page=<?php echo($paging["boardnext"])?>">
    								<span class="buttonText">▶</span>
    							</a>
    						</div>
						</div>
					</form>
        		</div>
			</div>
		</div>
	</div>
	<form id="frmSubReply" action="/admin_controller.php?mode=register_subreply_proc" method="post" >
		<input type="hidden" id="parent_replyseq" name="parent_replyseq" />
		<input type="hidden" id="parent_vote_seq" name="parent_vote_seq" value="<?php echo($vote_seq); ?>" />
		<input type="hidden" id="parent_vote_form_seq" name="parent_vote_form_seq" value="<?php echo($vote_form_seq); ?>" />
		<input type="hidden" id="subreply_context" name="subreply_context" />
	</form>
<?php
require_once ('./app/view/admin/footer.php');
?>
	<script type="text/javascript" src="/app/js/admin_reply_list.js?v=1.4" charset="utf-8">
	</script>
<?php 
if ($_GET["replyresult"] != "")
{
?>
<script type="text/javascript">
    var replyresult	= "<?php echo($_GET["replyresult"]); ?>";
    if (replyresult == "REPLY_FALSE")
       	alert("댓글을 등록하는데 실패하였습니다. 잠시 후에 다시 시도해보시기 바랍니다.");
</script>
<?php 
}
?>
</body>
</html>