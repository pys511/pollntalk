<?php
try
{
    $vote_form_seq      = $_GET["vote_form_seq"];
    $page               = $_GET["page"];
    
    $voteForm           = new CApp_Handler_Vote_Ctrl();
    $result             = $voteForm->getVoteFormInfo($vote_form_seq);
    $voteForm->updateViewCountVoteForm($vote_form_seq);
    
    $cateCtrl           = new CApp_Handler_Category_Ctrl();
    $depth1Cate         = $cateCtrl->getCategoryList();
    
    $vote_kind          = $result["VOTE_FORM_KIND"];
    $vote_type          = $result["VOTE_TYPE"];
    $vote_subject       = $result["VOTE_SUBJECT"];
    $vote_cate1_seq     = $result["VOTE_CATE_SEQ"];
    $vote_cate1_name    = $result["VOTE_CATE_NAME"];
    $cate_2dept_seq     = $result["VOTE_CATE_SUB_SEQ"];
    $cate_2dept_name    = $result["VOTE_CATE_SUB_NAME"];
    $vote_real_name     = $result["VOTE_RESOURCE_PATH"];
    $vote_real_type     = $result["VOTE_RESOURCE_TYPE"];
    $vote_context       = $result["VOTE_FORM_CONTEXT"];
    $vote_view_count    = $result["VOTE_VIEW_COUNT"];
    $vote_url           = $result["VOTE_URL"];

    if ($vote_real_name =="")
    {
        if ($vote_real_type != "3")
            $vote_real_name = "app/images/no_sample.png";
            else
                $vote_real_name = "/app/view/common/no_video.php";
    }
    else
    {
        if ($vote_real_type == "3")
        {
            $videoUrls      = explode("/", $vote_real_name);
            $videoLast      = $videoUrls[count($videoUrls) - 1];
            $vote_real_name = "https://www.youtube.com/embed/".$videoLast;
        }
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<div class="content">
	<!-- 카테고리 영역 시작 -->
	<div class="defaultarea grayback">
<?php
require_once ('./app/view/common/category.php');
?>
	</div>
	<!-- 카테고리 영역 끝 -->
	<!-- 광고 베너 영역 시작 -->
	<div class="adverbannerarea boundray">
		<div class="adverbannerbox">
<?php 
$adsetCtrl      = new CApp_Handler_Util_AdSetting();
$adverInfo      = $adsetCtrl->getAdverByPosition("4");
?>
    	<a href="javascript:window.open('http://<?php echo($adverInfo["ad_url"]); ?>');"><img class="wad" src="/<?php echo($adverInfo["ad_tempimg"]); ?>" /></a> 
    	<a href="javascript:window.open('http://<?php echo($adverInfo["ad_url"]); ?>');"><img class="mad" src="/<?php echo($adverInfo["ad_mtempimg"]); ?>" /></a>
<?php 

?>
		</div>
	</div>
	<!-- 광고 베너 영역 끝 -->
	<!-- 투표 보기 영역 시작 -->
	<div class="voteview">
		<!-- 투표 정보 보기 시작 -->
		<form id="frmVote" method="post" action="/index.php?mode=votewrite">
		<input type="hidden" id="vote_form_seq" name="vote_form_seq" value="<?php echo($vote_form_seq); ?>" />
		<div class="voteviewarea vvwbsline">
			<div class="voteviewbox">
				<div class="voteinfobox">
<?php 
if ($vote_real_type != "3")
{
?>
					<img class="voteinfoimg" src="<?php echo($vote_real_name); ?>" width="350" />
<?php
}
else 
{
?>
					<iframe class="voteinfovideo" src="<?php echo($vote_real_name); ?>" width="350" height="350" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="<?php if ($vote_real_type == "3") echo("visibility:visible;display:block;"); else echo("visibility:hidden;display:none;"); ?>">
    				</iframe>
<?php 
}
?>					
					<div class="voteinfo">
						<div class="votetitle">
							<span class="strong vvwrspace">제목 : </span>
							<span class="title"><?php echo($vote_subject); ?></span>
						</div>
						<div class="votecate">
							<span class="strong vvwrspace">카테고리 : </span>
							<span class="catetext">
<?php 
echo($vote_cate1_name);
if ($cate_2dept_name != "")
    echo("&nbsp;>&nbsp;".$cate_2dept_name);
?>
							</span>
						</div>
						<div class="voteexplain">
							<span class="strong vvwrspace">설명 : </span>
							<span class="default"><?php echo($vote_context); ?></span>
						</div>
						<div class="voteext">
							<span class="strong vvwrspace">관련링크 : </span>
							<span class="normal"><?php echo($vote_url); ?></span>
						</div>
						<div class="voteext">
							<span class="strong vvwrspace">조회수 : </span>
							<span class="stress vvwrspace"><?php echo($vote_view_count); ?></span>
							<span class="divtxt vvwrspace">/</span>
							<span class="strong vvwrspace">사용수 : </span>
							<span class="stress vvwrspace">589</span>
							<span class="divtxt vvwrspace">/</span>
							<span class="strong vvwrspace">사용 회원수 : </span>
							<span class="stress vvwrspace">50</span>
						</div>
						<div class="votebuttonlongbox downpos">
							<button id="vote_use1" class="stressvotebutton rpos voteuse">
								<span>이 투표양식 사용하기</span>
							</button>
						</div>
					</div>
				</div>
				<!-- 투표 정보 보기 끝 -->
			</div>
		</div>
		<!-- 투표 정보 보기 끝 -->
		<!-- 투표 내용 시작 -->
		<div class="voteviewarea">
			<div class="voteviewbox">
				<div class="voteviewcontext">
					<ul>
<?php
try
{
    $questions = $voteForm->getVoteFormQuestions($vote_form_seq);
    $i = 0;
    foreach ($questions as $questionItem) 
    {
        $i++;
        $question_resource_path     = $questionItem["QUESTION_RESOURCE_PATH"];
        $question_resource_type     = $questionItem["QUESTION_RESOURCE_TYPE"];
        $question_real_path         = "";
        if ($question_resource_path == "")
        {
            if ($question_resource_type != "3")
                $question_real_path = "app/images/admin/photo.png";
                else
                    $question_real_path = "/app/view/common/no_video.php";
        }
        else
        {
            if ($question_resource_type == "3")
            {
                $videoUrls      = explode("/", $question_resource_path);
                $videoLast      = $videoUrls[count($videoUrls) - 1];
                $question_real_path     = "https://www.youtube.com/embed/".$videoLast;
            }
            else
            {
                if ($question_resource_type == "1")
                    $question_real_path = "/".$question_resource_path;
                else
                    $question_real_path = $question_resource_path;
            }
        }
        //$question_resource_path = "app/images/admin/photo.png";
        $question_resp_type         = $questionItem["QUESTION_RESP_TYPE"];
        $question_seq               = $questionItem["QUESTION_SEQ"];
        $question_index             = $questionItem["QUESTION_INDEX"];
        $question_subject           = $questionItem["QUESTION_SUBJECT"];
?>
						<li class="awibspace">
							<div class="voteviewcontextbox">
								<div class="questionfieldbox">
<?php 
        if ($question_resource_type != "3" && $question_resource_type != "0")
        {
?>
									<img class="voteinfoimg" src="<?php echo($question_real_path); ?>" width="210" />
<?php
        }
        else 
        {
?>
                					<iframe class="voteinfovideo" src="<?php echo($question_real_path); ?>" width="250" height="250" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="<?php if ($question_resource_type == "3") echo("visibility:visible;display:block;"); else echo("visibility:hidden;display:none;"); ?>">
                    				</iframe>
<?php 
        }
?>		
									<div class="questionfieldcont">
										<div class="questionfield">
											<span>질문</span>
										</div>
										<div class="questiontext">
											<span><?php echo($question_subject); ?></span>
										</div>
									</div>
								</div>
								<div class="questionarrow">
									<img src="/app/images/title_arrow.png" />
								</div>
<?php 
        $answers        = $voteForm->getVoteFormAnswers($vote_form_seq, $question_seq);
        $answerCount    = count($answers);
        if ($answerCount > 0)
        {
?>								
								<div class="answerbox">
									<ul class="longanswer">
<?php
            $j  = 0;
            foreach ($answers as $answerItem) 
            {
                $j++;
                $answer_resource_path     = $answerItem["ANSWER_RESOURCE_PATH"];
                $answer_resource_type     = $answerItem["ANSWER_RESOURCE_TYPE"];
                $answer_real_path         = "";
                if ($answer_resource_path == "")
                {
                    if ($answer_resource_type != "3")
                        $answer_real_path = "app/images/admin/photo.png";
                        else
                            $answer_real_path = "/app/view/common/no_video.php";
                }
                else
                {
                    if ($answer_resource_type == "3")
                    {
                        $videoUrls      = explode("/", $answer_resource_path);
                        $videoLast      = $videoUrls[count($videoUrls) - 1];
                        $answer_real_path   = "https://www.youtube.com/embed/".$videoLast;
                    }
                    else
                    {
                        if ($answer_resource_type == "1")
                            $answer_real_path   = "/".$answer_resource_path;
                        else
                            $answer_real_path   = $answer_resource_path;
                    }
                }
                $answer_text        = $answerItem["ANSWER_TEXT"];
                $is_correct         = $answerItem["IS_CORRECT"];
?>
										<li>
											<div class="answeritem longitem <?php if ($answerCount > $j) { ?>awibline<?php } ?>">
												<div class="answeritembox">
<?php 
                if ($answer_resource_type != "3" && $answer_resource_type != "0")
                {
?>
													<img class="voteinfoimg" src="<?php echo($answer_real_path); ?>" width="210" />
<?php
                }
                else 
                {
?>
                                					<iframe class="voteinfovideo" src="<?php echo($answer_real_path); ?>" width="210" height="210" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="<?php if ($answer_resource_type == "3") echo("visibility:visible;display:block;"); else echo("visibility:hidden;display:none;"); ?>">
                                    				</iframe>
<?php 
                }
?>	
													<div class="answeritemtext">
														<input class="agree" type="checkbox" />
														<label for="nopublic">
															<span><?php echo($answer_text); ?></span>
														</label>
													</div>
<?php 
                if ($is_correct == "1")
                {
?>
													<div class="answeritemtext">
														<span class="stress">[정답]</span>
													</div>
<?php 
                }
?>
												</div>
											</div>
										</li>
<?php
            }
?>
									</ul>
								</div>
<?php 
        }
?>								
							</div>
						</li>
<?php
    }
}
catch (CException $ex)
{
    $ex->executeException();
}
?>
					</ul>
				</div>
				<div class="voteviewbtncont vvwbspace">
					<div class="votebuttonlonglongbox">
						<button id="vote_use2" class="stressvotebutton rpos voteuse">
							<span>이 투표양식 사용하기</span>
						</button>
					</div>
				</div>
			</div>
		</div>
		</form>
		<!-- 투표 내용 끝 -->
<?php 
$replyCtrl      = new CApp_Handler_Reply_Ctrl();
$count          = $replyCtrl->getReplyListByVoteFormCount($vote_form_seq);
$paging         = $replyCtrl->makePaging($count, $page);
$replyList      = $replyCtrl->getReplyListByVoteForm($vote_form_seq, $paging);
?>
		<!-- 댓글 시작 -->
		<div class="voteviewarea">
			<div class="replybox">
				<form id="frmReply" name="frmReply" action="/controller.php?mode=reply_proc" method="post">
				<input type="hidden" id="reply_vote_seq" name="reply_vote_seq" value="<?php echo($vote_form_seq); ?>" />
				<input type="hidden" id="reply_page" name="reply_page" value="voteform" />
				<input type="hidden" id="host_kind" name="host_kind" value="2" />
				<input type="hidden" id="reply_seq" name="reply_seq" />
				<input type="hidden" id="reply_proc" name="reply_proc" />
				<div class="replyfield">
					<span>댓글 </span><span class="title"><?php echo($count); ?></span>
				</div>
				<div class="replyinputer">
					<textarea id="replycontext" name="replycontext" placeholder="여러분의 소중한 댓글을 입력해주세요."></textarea>
					<button type="button" class="votebutton rpos" id="registerReply">
						<span>댓글 달기</span>
					</button>
				</div>
				<div class="replylist">
					<ul class="subreplylist" id="replylist">
<?php 
    foreach ($replyList as $replyItem)
    {
        $replySeq       = $replyItem["REPLY_SEQ"];
        $nickName       = $replyItem["NNAME"];
        $picPath        = $replyItem["PIC"];
        $replyDate      = $replyItem["REPLY_REGI_DATE"];
        $replyContext   = $replyItem["REPLY_CONTEXT"];
        $subReplyCount  = $replyItem["SUBREPLY_COUNT"];
?>
						<li class="replyitembox" id="replyitem_<?php echo($replySeq); ?>">
							<div class="replyitem">
								<div class="replytop">
									<div class="userinfo">
										<img src="<?php echo($picPath); ?>" />
										<span class="normal"><?php echo($nickName); ?></span>
									</div>
									<div class="replydate">
										<span><?php echo($replyDate); ?></span>
									</div>
									<div class="replyctrl">
										<a href="javascript:removeReply('<?php echo($replySeq); ?>');"><span>삭제</span></a>
									</div>
									<div class="replyctrl goreply" >
										<span>답글수 : <?php echo($subReplyCount); ?></span>
									</div>
								</div>
								<div class="replybottom" onclick="javascript:viewSubReply('<?php echo($replySeq); ?>')">
									<span><?php echo($replyContext); ?></span>
								</div>
							</div>
							<div id="subreply_<?php echo($replySeq); ?>" class="replyitem subreplyarea" style="display:none">
								<div class="subreply">
    								<div class="subreply subreplyinputer">
    									<img src="/app/images/reply.png" />
    									<textarea class="subreplycontext"  id="subreplycontext_<?php echo($replySeq); ?>" name="subreplycontext_<?php echo($replySeq); ?>"></textarea>
    									<button type="button" class="votebutton rpos" id="registersubReply" onclick="javascript:registerSubReply('<?php echo($replySeq); ?>');">
                    						<span>답글 달기</span>
                    					</button>
    								</div>
    								<div class="subreplyitem" style="display:block">
    									<ul class="subreplybox">
    										<li class="subreplysample divsubreply" style="display:none">
    											<div class="replytop">
                									<div class="userinfo">
                										<img class="subreplywriterpic" src="#" />
                										<span class="normal subreplywriter subreplywriterlink">
                										</span>
                									</div>
                									<div class="replydate subreplyregidate">
                										<span>
                										</span>
                									</div>
                									<div class="replyctrl">
                										<a class="deletesubreply" href="#"><span>삭제</span></a>
                									</div>
                								</div>
                								<div class="subreplybottom">
                									<span class="subreplycontext">
                									</span>
                								</div>
            								</li>
            							</ul>
        							</div>
    							</div>
							</div>
						</li>
<?php 
    }
?>
					</ul>
				</div>
				</form>
			</div>
			<!-- 페이징 시작 -->
			<div class="paging">
				<!-- <div class="pagingbutton pageleftend pagenavinoselect"></div> -->
				<a id="boardprev" href="/?mode=voteview&vote_seq=<?php echo($vote_form_seq); ?>&page=<?php echo($paging["boardprev"])?>">
    				<div class="pagingbutton pageleft pagenavinoselect">
    				</div>
    			</a>
<?php
    for ($i = (integer) $paging["start"]; $i <= (integer) $paging["end"]; $i ++) 
    {
        if ($page == "")
            $page   = "1";
?>
				<div class="pagingbutton <?php if($page == $i) echo("pageselect"); ?>">
					<a id="page" href="/?mode=voteview&vote_seq=<?php echo($vote_form_seq); ?>&page=<?php echo($i)?>">
						<span><?php echo($i)?></span>
					</a>
				</div>
				<a id="boardprev" href="/?mode=voteview&vote_seq=<?php echo($vote_form_seq); ?>&page=<?php echo($paging["boardnext"])?>">
					<div class="pagingbutton pageright pagenaviselect">
					</div>
				</a>
				<!-- <div class="pagingbutton pagerightend pagenavinoselect"></div> -->
			</div>
			<!-- 페이징 끝 -->
		</div>
		<!-- 댓글 끝 -->
<?php 
}
?>
	</div>
</div>
<!-- 컨텐츠 끝-->
<form id="frmSubReply" action="/controller.php?mode=register_subreply_proc" method="post" >
    <input type="hidden" id="parent_replyseq" name="parent_replyseq" />
    <input type="hidden" id="parent_vote_seq" name="parent_vote_seq" value="<?php echo($vote_form_seq); ?>" />
    <input type="hidden" id="sub_reply_page" name="sub_reply_page" value="voteform" />
	<input type="hidden" id="subreply_context" name="subreply_context" />
</form>