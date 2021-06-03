<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20201016
 *  투표 상세 보기 페이지
 */
try
{
    $vote_seq               = $_GET["vote_seq"];
    $page                   = $_GET["page"];
    
    $vote                   = new CApp_Handler_Vote_Ctrl();
    $result                 = $vote->getVoteInfo($vote_seq);
    $vote_kind              = $result["VOTE_KIND"];
    $vote_type              = $result["VOTE_TYPE"];
    $vote_type_name         = $result["VOTE_TYPE_NAME"];
    $vote_subject           = $result["VOTE_SUBJECT"];
    $vote_context           = $result["VOTE_CONTEXT"];
    $vote_cate1_seq         = $result["VOTE_CATE_SEQ"];
    $vote_cate1_name        = $result["VOTE_CATE_NAME"];
    $vote_writer_seq        = $result["VOTE_WRITER_SEQ"];
    $vote_writer_name       = $result["VOTE_WRITER_NAME"];
    $vote_writer_image      = $result["VOTE_WRITER_IMAGE"];
    $cate_2dept_seq         = $result["VOTE_CATE_SUB_SEQ"];
    $cate_2dept_name        = $result["VOTE_CATE_SUB_NAME"];
    $vote_real_name         = $result["VOTE_RESOURCE_PATH"];
    $vote_real_type         = $result["VOTE_RESOURCE_TYPE"];
    $coupon_seq             = $result["COUPON_SEQ"];
    $vote_open_point        = $result["VOTE_OPEN_POINT"];
    $vote_resp_point        = $result["VOTE_RESP_POINT"];
    $vote_participant_count = $result["VOTE_PARTICIPATE_COUNT"];
    $vote_recomm_count      = $result["VOTE_RECOMM_COUNT"];
    $vote_is_premium        = $result["VOTE_IS_PREMIUM"];
    $vote_end_date          = $result["VOTE_END_DATE"];
    $vote_url               = $result["VOTE_URL"];
    $vote_is_event          = $result["VOTE_IS_EVENT"];
    $vote_security_code     = $result["VOTE_SECURITY_CODE"];
    
    if ($vote_real_name == "")
    {
        if ($vote_real_type != "3")
            $vote_real_name = "/app/images/no_image.png";
        else
            $vote_real_name = "/app/view/common/no_video.php";
    }
    else
    {
        if ($vote_real_type == "3")
        {
            $videoUrls          = explode("/", $vote_real_name);
            $videoLast          = $videoUrls[count($videoUrls) - 1];
            $vote_real_name     = "https://www.youtube.com/embed/".$videoLast;
        }
        else
        {
            if ($vote_real_type == "1")
                $vote_real_name = "/".$vote_real_name;
            else
                $vote_real_name = $vote_real_name;
        }
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<!-- 컨텐츠 시작-->
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
$adverInfo      = $adsetCtrl->getAdverByPosition("5");
?>
    	<a href="javascript:window.open('http://<?php echo($adverInfo["ad_url"]); ?>'); ?>"><img class="wad" src="/<?php echo($adverInfo["ad_tempimg"]); ?>" /></a> 
    	<a href="javascript:window.open('http://<?php echo($adverInfo["ad_url"]); ?>'); ?>"><img class="mad" src="/<?php echo($adverInfo["ad_mtempimg"]); ?>" /></a>
<?php 

?>
		</div>
	</div>
	<!-- 광고 베너 영역 끝 -->
	<!-- 투표 보기 영역 시작 -->
	<div class="voteview">
		<!-- 투표 정보 보기 시작 -->
		<form id="frmVote" method="post" action="/controller.php?mode=vote_resp_proc">
		<input type="hidden" id="vote_writer_seq" name="vote_writer_seq" value="<?php echo($vote_writer_seq); ?>" />
    	<input type="hidden" id="vote_seq" name="vote_seq" value="<?php echo($vote_seq); ?>" />
    	<input type="hidden" id="vote_kind" name="vote_kind" value="<?php echo($vote_kind); ?>" />
    	<input type="hidden" id="vote_resp_point" name="vote_resp_point" value="<?php echo($vote_resp_point); ?>" />
    	<input type="hidden" id="vote_url" name="vote_url" value="http://www.pollntalk.com<?php echo($_SERVER['REQUEST_URI']); ?>" />
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
					<iframe class="voteinfovideo" id="voteVideoFile" src="<?php echo($vote_real_name); ?>" width="350" height="350" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
                    </iframe>
<?php 
}
?>
					<div class="voteinfo">
						<div class="votetitle">
							<span class="strong vvwrspace">제목 : </span>
							<span class="title"><?php echo($vote_subject); ?></span>
						</div>
						<div class="voteexplain">
							<span class="strong vvwrspace">유형 : </span>
							<span class="default"><?php echo($vote_type_name); ?></span>
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
							<span class="strong vvwrspace">작성자 : </span>
							<div class="userinfo">
								<img src="<?php echo($vote_writer_image)?>" width="20px" />
								<span class="normal"><?php echo($vote_writer_name)?></span>
							</div>
						</div>
						<div class="voteext">
							<span class="strong vvwrspace">참여 : </span>
							<span class="stress vvwrspace"><?php echo($vote_participant_count); ?></span>
							<span class="divtxt vvwrspace">/</span>
							<span class="strong vvwrspace">댓글 : </span>
							<span class="stress vvwrspace">589</span>
							<span class="divtxt vvwrspace">/</span>
							<span class="strong vvwrspace">좋아요 : </span>
							<span id="recomm_count" class="stress vvwrspace"><?php echo($vote_recomm_count); ?></span>
						</div>
<?php 
if ($vote_end_date != "nolimit")
{
?>
                		<div class="voteext vvwbspace vvwbline">
                			<span class="strong vvwrspace">마감기간 : </span>
                			<span class="stress"><?php echo($vote_end_date); ?></span>
                		</div>
<?php 
}
?>
						<div class="voteext vvwbspace vvwbline">
							<span class="strong vvwrspace">투표 적립 포인트 : </span>
							<span class="stress"><?php echo($vote_resp_point); ?></span>
						</div>
						<div class="votebuttonbox">
							<button type="button" id="dispuser" class="votebutton">
								<span>구독</span>
							</button>
							<button type="button" id="recomm" class="votebutton">
								<span>좋아요</span>
							</button>
							<button type="button" class="votebutton">
								<span>신고</span>
							</button>
							<button type="button" class="votebutton" onclick="javascript:copyClipboard('vote_url');">
								<span>공유하기</span>
							</button>
							<button type="button" id="goVoteResultView" class="stressvotebutton rpos goVoteResult">
								<span>결과보기</span>
							</button>
						</div>
					</div>
				</div>
				<!-- 투표 정보 보기 끝 -->
			</div>
		</div>
		<!-- 투표 정보 보기 끝 -->
<?php 
//이벤트일 경우 쿠폰 설정
if ($vote_kind == "2")
{
    if ($vote_is_event != "")
    {
        $voteEvent      = new CApp_Handler_Vote_Eventctrl();
        $result         = $voteEvent->getVoteEventInfo($vote_seq);
        $eventSubject   = $result["VOTE_EVENT_SUBJECT"];
        $eventText      = $result["VOTE_EVENT_TEXT"];
        $eventURL       = $result["VOTE_EVENT_URL"];
        if (strpos($eventURL, "embed") === false)
        {
            $eventURLs  = explode("/", $eventURL);
            $last       = $eventURLs[count($eventURLs) - 1];
            $eventURL   = "https://www.youtube.com/embed/".$last;
        }
        
        $presentPath    = $result["VOTE_PRESENT_PATH"];
        $bannerPath     = $result["VOTE_BANNER_PATH"];
?>
		<!-- 투표 이벤트 정보 보기 시작 -->
		<div class="voteviewarea vvwbsline">
			<div class="voteviewcontext">
    			<div class="voteviewbox">
    				<div class="votewritetitle">
                    	<img src="/app/images/mark_05.jpg" />
                    	<span>이벤트 정보</span>
                    </div>
    				<div class="voteinfobox">
    					<div class="votemediabox">
        					<img class="voteinfoimg bspace" src="<?php echo($presentPath);?>" width="350" />
        					<iframe class="voteinfoVideo" src="<?php echo($eventURL); ?>" width="350" height="340" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="visibility:visible;display:block;">
                        	</iframe>
                    	</div>
    					<div class="voteinfo">
    						<div class="voteext">
    							<span class="strong vvwrspace">이벤트 이름: </span> 
    							<span class="normal"><?php echo($eventSubject); ?></span>
    						</div>
    						<div class="voteext">
    							<span class="strong vvwrspace">이벤트 URL: </span> 
    							<span class="normal"><?php echo($eventURL); ?></span>
    						</div>
    					</div>
    					<div class="voteinfo voteboxline">
    						<span class="title strong">이벤트 내용</span> 
    						<p><?php echo($eventText)?></p>
    					</div>
    				</div>
    			</div>
			</div>
		</div>
		<!-- 투표 이벤트 정보 보기 끝 -->
<?php        
    }
    
    if ($coupon_seq != "")
    {
        $coupon     = new CApp_Handler_Coupon_Ctrl();
        $result     = $coupon->getCouponInfo($coupon_seq);
        
        $coupon_seq         = $result["COUPON_SEQ"];
        $coupon_index       = $result["COUPON_INDEX"];
        $coupon_name        = $result["COUPON_NAME"];
        $coupon_image       = $result["COUPON_IMAGE_PATH"];
        $coupon_count       = $result["COUPON_COUNT"];
        $coupon_context     = $result["COUPON_CONTEXT"];
        $coupon_ext_count   = $result["COUPON_EXT_COUNT"];
        $coupon_expire_date = $result["COUPON_NO_EXPIRE_NAME"];
?> 
		<!-- 쿠폰 정보 보기 시작 -->
		<div class="voteviewarea vvwbsline">
			<div class="voteviewcontext">
				<div class="voteviewbox">
					<div class="votewritetitle">
                    	<img src="/app/images/mark_05.jpg" />
                    	<span>쿠폰 정보</span>
                    </div>
					<div class="voteinfobox">
    					<img class="voteinfoimg" src="/<?php echo($coupon_image);?>" />
    					<div class="voteinfo">
    						<div class="voteext">
    							<span class="strong vvwrspace">쿠폰 이름: </span> 
    							<span class="normal"><?php echo($coupon_name); ?></span>
    						</div>
    						<div class="voteext">
    							<span class="strong vvwrspace">쿠폰 혜택: </span> 
    							<span class="normal"><?php echo($coupon_context); ?></span>
    						</div>
    						<div class="voteext">
    							<span class="strong vvwrspace">쿠폰 유효 기간: </span> 
    							<span class="normal"><?php echo($coupon_expire_date); ?></span>
    						</div>
    						<div class="voteext">
    							<span class="strong vvwrspace">쿠폰 지급 인원: </span> 
    							<span class="normal"><?php echo($coupon_count); ?>명</span>
    						</div>
    					</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 쿠폰 정보 보기 끝 -->
<?php 
    }
}
?>
		<!-- 투표 내용 시작 -->
		<div class="voteviewarea">
			<div class="voteviewbox">
				<div class="voteviewcontext">
					<ul>
<?php
try
{
    $question_vote_seq  = $vote_seq;
    $questions = $vote->getVoteQuestions($question_vote_seq);
    $i = 0;
    foreach ($questions as $questionItem) 
    {
        $i++;
        $question_resource_path     = $questionItem["QUESTION_RESOURCE_PATH"];
        $question_resource_type     = $questionItem["QUESTION_RESOURCE_TYPE"];
        $question_resp_type         = $questionItem["QUESTION_RESP_TYPE"];
        $question_seq               = $questionItem["QUESTION_SEQ"];
        $question_index             = $questionItem["QUESTION_INDEX"];
        $question_order             = $questionItem["QUESTION_ORDER"];
        $question_subject           = $questionItem["QUESTION_SUBJECT"];
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
                $videoUrls          = explode("/", $question_resource_path);
                $videoLast          = $videoUrls[count($videoUrls) - 1];
                $question_real_path = "https://www.youtube.com/embed/".$videoLast;
            }
            else
            {
                if ($question_resource_type == "1")
                    $question_real_path = "/".$question_resource_path;
                else
                    $question_real_path = $question_resource_path;
            }
        }
?>
						<li class="awibspace">
							<input class="question_seq" type="hidden" id="question_seq_<?php echo($question_index); ?>" name="question_seq[]" value="<?php echo($question_seq); ?>" /> 
                    		<input class="question_index" type="hidden" id="question_index_<?php echo($question_index); ?>" name="question_index[]" value="<?php echo($question_index); ?>" />
                    		<input class="question_resp_type" type="hidden" id="question_resp_type_<?php echo($question_index); ?>" name="question_resp_type[]" value="<?php echo($question_resp_type); ?>" />
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
                					<iframe class="voteinfoVideo" src="<?php echo($question_real_path); ?>" width="250" height="250" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="<?php if ($question_resource_type == "3") echo("visibility:visible;display:block;"); else echo("visibility:hidden;display:none;"); ?>">
                    				</iframe>
<?php 
        }
?>	
									<div class="questionfieldcont">
										<div class="questionfield">
											<span>질문 <?php echo($i);?></span>
										</div>
										<div class="questiontext">
											<span><?php echo($question_subject); ?></span>
										</div>
									</div>
								</div>
								<div class="questionarrow">
									<img src="/app/images/title_arrow.png" />
								</div>
								<div class="answerbox">
									<ul class="longanswer">
<?php
        $answers        = $vote->getVoteAnswers($question_vote_seq, $question_seq);
        $answerCount    = count($answers);
        $j  = 0;
        foreach ($answers as $answerItem)
        {
            $j++;
            $answer_resource_path     = $answerItem["ANSWER_RESOURCE_PATH"];
            $answer_resource_type     = $answerItem["ANSWER_RESOURCE_TYPE"];
            $answer_index             = $answerItem["ANSWER_INDEX"];
            $answer_seq               = $answerItem["ANSWERS_SEQ"];
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
            
            if ($question_resp_type == "1" || $question_resp_type == "3")
                $resp_type  = "radio";
            else
                $resp_type  = "checkbox";
?>	
													<div class="answeritemtext">
														<input type="<?php echo($resp_type); ?>" class="agree answer_free" id="answer_<?php echo($question_index); ?>_<?php echo($answer_index); ?>" name="answer_<?php echo($question_index); ?>[]" value="<?php echo($answer_seq); ?>" />
														<label for="answer_<?php echo($question_index); ?>_<?php echo($answer_index); ?>">
															<span><?php echo($answer_text); ?></span>
														</label>
													</div>
												</div>
											</div>
										</li>
										
<?php
        }
        
        if ($question_resp_type == "3" || $question_resp_type == "4" || $question_resp_type == "5")
        {
            $freeAnswwers   = $vote->getVoteFreeAnswers($question_vote_seq, $question_seq);
?>
										<li>
											<div class="answeritem longitem <?php if (count($freeAnswwers) > 0) { echo("awibline"); } ?>">
												<div class="answeritembox">
													<textarea id="answer_textarea_<?php echo($question_index); ?>" name="answer_textarea_<?php echo($question_index); ?>" rows="3" cols="96" placeholder="자유 응답 쓰기"></textarea>
												</div>
											</div>
										</li>
										<li>
											<div class="answeritem longitem">
    											<div class="answerreplybox">
                                    				<div class="replyfield">
                                    					<img src="/app/images/answer.png" />
                                    					<span>기타 자유 응답</span>
                                    				</div>
                                    				<div class="replylist">
                                    					<ul>
<?php 
            if (count($freeAnswwers) <= 0)
            {
?>
                                    						<li>
                                    							<div class="replyitem">
                                    								<span>작성한 응답이 없습니다.</span>
                                    							</div>
                                   							</li>
<?php
            }
            else 
            {
                $k = 0;
                foreach ($freeAnswwers as $answerItem)
                {
                    $k++;
                    $vote_free_answer_seq   = $answerItem["VOTE_FREE_ANSWERS_SEQ"];
                    $vote_member_seq        = $answerItem["VOTE_MEMBER_SEQ"];
                    $vote_member_name       = $answerItem["nname"];
                    $vote_member_pic        = $answerItem["pic"];
                    $vote_answer_text       = $answerItem["VOTE_ANSWER_TEXT"];
            
?>
                                    						<li>
                                    							<div class="replyitem">
                                    								<div class="replytop">
                                    									<div class="answerfreeselected">
<?php 
                    if ($question_resp_type == "5")
                    {
?>
                                        									<input type="radio" class="agree answer_free" id="answer_free_<?php echo($question_index); ?>_<?php echo($k); ?>" name="answer_free_<?php echo($question_index); ?>[]" value="<?php echo($vote_free_answer_seq); ?>" <?php if($vote_is_selected == "1") { echo("checked"); }?> />
                    														<label for="answer_free_<?php echo($question_index); ?>_<?php echo($k); ?>">
                    															<span>선택</span>
                    														</label>
<?php 
                    }
?>
                														</div>
                                    								</div>
                                    								<div class="answerTextBottom">
                                    									<span><?php echo($vote_answer_text); ?></span>
                                    								</div>
                                    								<div class="answeruserinfo">
                                										<img src="/<?php echo($vote_member_pic); ?>" style="width: 20px;" />
                                										<span class="normal"><?php echo($vote_member_name); ?></span>
                                									</div>
                                    							</div>
                                    						</li>
<?php 
                }
            }
?>
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
					<div class="voteviewbuttonbox">
						<button type="button" id="registerVoteResp" class="votebutton">
							<span>응답완료</span>
						</button>
						<button type="button" id="goVoteResult" class="stressvotebutton goVoteResult">
							<span>결과보기</span>
						</button>
					</div>
				</div>
			</div>
		</div>
		</form>
		<!-- 투표 내용 끝 -->
<?php 
if ($vote_kind == "1")
{
    $replyCtrl      = new CApp_Handler_Reply_Ctrl();
    $count          = $replyCtrl->getReplyListByVoteCount($vote_seq);
    $paging         = $replyCtrl->makePaging($count, $page);
    $replyList      = $replyCtrl->getReplyListByVote($vote_seq, $paging);
?>		
		<!-- 댓글 시작 -->
		<div class="voteviewarea">
			<div class="replybox">
				<form id="frmReply" name="frmReply" action="/controller.php?mode=reply_proc" method="post">
				<input type="hidden" id="reply_vote_seq" name="reply_vote_seq" value="<?php echo($vote_seq); ?>" />
				<input type="hidden" id="reply_page" name="reply_page" value="voteview" />
				<input type="hidden" id="host_kind" name="host_kind" value="1" />
				<input type="hidden" id="reply_seq" name="reply_seq" />
				<input type="hidden" id="reply_proc" name="reply_proc" />
				<div class="replyfield">
					<span>댓글 </span><span class="title"><?php echo($count); ?></span>
				</div>
				<div class="replyinputer">
					<textarea id="replycontext" name="replycontext" placeholder="여러분의 소중한 댓글을 입력해주세요." readonly></textarea>
					<button type="button" class="votebutton rpos" id="registerReply">
						<span>댓글 달기</span>
					</button>
				</div>
				<div class="replylist">
					<ul class="subreplylist" id="replylist">
<?php 
    foreach ($replyList as $replyItem)
    {
        //print_r($replyItem);
        $replySeq       = $replyItem["REPLY_SEQ"];
        $nickName       = $replyItem["NNAME"];
        $picPath        = $replyItem["PIC"];
        $replyWriter    = $replyItem["REPLY_WRITER_SEQ"];
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
<?php 
if ($replyWriter == $_SESSION["member_seq"])
{
?> 
									<div class="replyctrl">
										<a href="javascript:removeReply('<?php echo($replySeq); ?>');"><span>삭제</span></a>
									</div>
<?php 
}
?>									
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
<?php 
if ($replyWriter == $_SESSION["member_seq"])
{
?>                									
                									<div class="replyctrl">
                										<a class="deletesubreply" href="#"><span>삭제</span></a>
                									</div>
<?php 
}
?>
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
				<a id="boardprev" href="/?mode=voteview&vote_seq=<?php echo($vote_seq); ?>&page=<?php echo($paging["boardprev"])?>">
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
					<a id="page" href="/?mode=voteview&vote_seq=<?php echo($vote_seq); ?>&page=<?php echo($i)?>">
						<span><?php echo($i)?></span>
					</a>
				</div>
<?php
    }
?>
				<a id="boardprev" href="/?mode=voteview&vote_seq=<?php echo($vote_seq); ?>&page=<?php echo($paging["boardnext"])?>">
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
<form id="frmSubReply" action="/controller.php?mode=register_subreply_proc" method="post" >
    <input type="hidden" id="parent_replyseq" name="parent_replyseq" />
    <input type="hidden" id="parent_vote_seq" name="parent_vote_seq" value="<?php echo($vote_seq); ?>" />
    <input type="hidden" id="sub_reply_page" name="sub_reply_page" value="voteview" />
	<input type="hidden" id="subreply_context" name="subreply_context" />
</form>