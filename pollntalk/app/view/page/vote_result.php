<?php 
/**
 *  @auth   : JEON JY
 *  @date   : 20201016
 *  투표 응답 결과 페이지
 */
try
{
    //투표 정보
    $vote_seq               = $_GET["vote_seq"];
    $page                   = $_GET["page"];
    $view_type              = $_GET["view_type"];
    
    $vote                   = new CApp_Handler_Vote_Ctrl();
    $result                 = $vote->getVoteInfo($vote_seq);
    $vote_kind              = $result["VOTE_KIND"];
    $vote_type              = $result["VOTE_TYPE"];
    $vote_subject           = $result["VOTE_SUBJECT"];
    $vote_context           = $result["VOTE_CONTEXT"];
    $vote_cate1_seq         = $result["VOTE_CATE_SEQ"];
    $vote_cate1_name        = $result["VOTE_CATE_NAME"];
    $vote_writer_name       = $result["VOTE_WRITER_NAME"];
    $vote_writer_image      = $result["VOTE_WRITER_IMAGE"];
    $cate_2dept_seq         = $result["VOTE_CATE_SUB_SEQ"];
    $cate_2dept_name        = $result["VOTE_CATE_SUB_NAME"];
    $vote_real_name         = $result["VOTE_RESOURCE_PATH"];
    $vote_real_type         = $result["VOTE_RESOURCE_TYPE"];
    $vote_participant_count = $result["VOTE_PARTICIPATE_COUNT"];
    $vote_is_premium        = $result["VOTE_IS_PREMIUM"];
    $vote_end_date          = $result["VOTE_END_DATE"];
    $vote_url               = $result["VOTE_URL"];
    $vote_security_code     = $result["VOTE_SECURITY_CODE"];
    $vote_regi_date         = $result["VOTE_REGI_DATE"];
    $vote_period            = $result["PERIOD"];
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<!-- 카테고리 영역 시작 -->
<div class="content">
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
$adverInfo      = $adsetCtrl->getAdverByPosition("6");
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
		<form id="frmVote" method="post">
    	<input type="hidden" id="vote_seq" name="vote_seq" value="<?php echo($vote_seq); ?>" />
    	<input type="hidden" id="vote_kind" name="vote_kind" value="<?php echo($vote_kind); ?>" />
    	<input type="hidden" id="vote_type" name="vote_type" value="<?php echo($vote_type); ?>" />
    	<input type="hidden" id="view_type" name="view_type" value="<?php echo($view_type); ?>" />
		<!-- 투표 정보 보기 시작 -->
		<div class="voteviewarea vvwbsline">
			<div class="voteviewbox">
				<div class="voteinfobox">
<?php 
if ($vote_real_type != "3" && $vote_real_type != "0")
{
?>
					<img class="voteinfoimg" src="<?php echo($vote_real_name); ?>"  width="350" />
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
							<span class="stress vvwrspace">50</span>
						</div>
						<div class="voteext vvwbspace vvwbline">
							<span class="strong vvwrspace">투표 적립 포인트 : </span> 
							<span class="stress">50</span>
						</div>
						<div class="votebuttonbox">
							<button class="votebutton rpos">
								<span>구독</span>
							</button>
							<button class="votebutton rpos">
								<span>좋아요</span>
							</button>
							<button class="votebutton rpos">
								<span>신고</span>
							</button>
						</div>
					</div>
				</div>
				<!-- 투표 정보 보기 끝 -->
			</div>
		</div>
		<!-- 투표 이벤트 정보 보기 시작 -->
		<div class="voteviewarea vvwbsline">
			<div class="voteviewbox awibspace">
				<!-- 투표 결과 현황 시작 -->
				<div class="voteviewtable">
					<div class="votevtfield">
						<div class="votevtdefault">
							<span>구분</span>
						</div>
						<div class="votevtlong">
							<span>내용</span>
						</div>
					</div>
					<div class="votevtcontext">
						<ul>
							<li>
								<div class="votevtitem">
									<div class="votevtdefault">
										<span>작성일</span>
									</div>
									<div class="votevtlong">
										<span><?php echo($vote_regi_date); ?></span>
									</div>
								</div>
							</li>
							<li>
								<div class="votevtitem">
									<div class="votevtdefault">
										<span>응답 기간</span>
									</div>
									<div class="votevtlong">
										<span><?php echo($vote_period); ?></span>
									</div>
								</div>
							</li>
<?php 
if ($vote_end_date != "nolimit")
{
?>
							<li>
								<div class="votevtitem">
									<div class="votevtdefault">
										<span>마감일</span>
									</div>
									<div class="votevtlong">
										<span><?php echo($vote_end_date); ?></span>
									</div>
								</div>
							</li>
<?php 
}
?>
						</ul>
					</div>
				</div>
				<!-- 투표 결과 현황 끝 -->
			</div>
		</div>
		<!-- 투표 이벤트 정보 보기 끝 -->
		<!-- 투표 결과 시작 -->
<?php 
//퀴즈일 때
if ($vote_type == "4")
{
?>
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
            $answers        = $vote->getVoteQuizAnswers($question_vote_seq, $question_seq);
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
                $checked            = $answerItem["CHECKED"];
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
														<input type="<?php echo($resp_type); ?>" class="agree answer_free" id="answer_<?php echo($question_index); ?>_<?php echo($answer_index); ?>" name="answer_<?php echo($question_index); ?>[]" value="<?php echo($answer_seq); ?>" <?php echo($checked); ?> />
														<label for="answer_<?php echo($question_index); ?>_<?php echo($answer_index); ?>">
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
    											<div class="replybox">
                                    				<div class="replyfield">
                                    					<span>기타 자유 응답</span>
                                    				</div>
                                    				<div class="replylist">
                                    					<ul>
<?php
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
}
//일반 투표
else 
{
?>
		<div class="voteviewarea">
			<div class="voteviewbox">
				<div class="voteviewcontext awibspace">
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
							<input type="hidden" id="question_seq_<?php echo($i); ?>" name="question_seq[]" value="<?php echo($question_seq); ?>" />
							<input type="hidden" id="question_index_<?php echo($i); ?>" name="question_index[]" value="<?php echo($question_index); ?>" />
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
    										<span>질문 <?php echo($i);?></span>
    									</div>
    									<div class="questiontext">
    										<span><?php echo($question_subject); ?></span>
    									</div>
    								</div>
								</div>
							</div>
        					<div class="voteviewcontextbox ">
        						<div class="voteresultbuttonbox">
        							<div class="votertbtn">
        								<div class="voteresultbutton <?php if ($view_type == "") { ?> buttonselected <?php } else { ?> buttonnoselected <?php } ?>" >
        									<a href="/?mode=vote_result&vote_seq=<?php echo($vote_seq); ?>">
        										<span>전체</span>
        									</a>
        								</div>
        								<div class="voteresultbutton <?php if ($view_type == "age") { ?> buttonselected <?php } else { ?> buttonnoselected <?php } ?>">
        									<a href="/?mode=vote_result&vote_seq=<?php echo($vote_seq); ?>&view_type=age">
        										<span>연령별</span>
        									</a>
        								</div>
        								<div class="voteresultbutton <?php if ($view_type == "gender") { ?> buttonselected <?php } else { ?> buttonnoselected <?php } ?>">
        									<a href="/?mode=vote_result&vote_seq=<?php echo($vote_seq); ?>&view_type=gender">
        										<span>남녀별</span>
        									</a>
        								</div>
        								<div class="voteresultbutton <?php if ($view_type == "abode") { ?> buttonselected <?php } else { ?> buttonnoselected <?php } ?>">
        									<a href="/?mode=vote_result&vote_seq=<?php echo($vote_seq); ?>&view_type=abode">
        										<span>지역별</span>
        									</a>
        								</div>
        							</div>
        						</div>
<?php 
            //자유 응답 추가
            if ($question_resp_type != "5")
            {
                if ($view_type == "")
                {
?>        						
        						<div id="chart_bar_<?php echo($question_index); ?>" class="chartbox">
        							<!-- <img class="chart360" src="/app/images/sample_18.png" /><img class="chart800" src="/app/images/sample_19.jpg" /><img class="chart1024" src="/app/images/sample_20.jpg" /> -->
        						</div>
        						<div id="chart_pie_<?php echo($question_index); ?>" class="chartbox">
        							<!-- <img class="chart360" src="/app/images/sample_18.png" /><img class="chart800" src="/app/images/sample_19.jpg" /><img class="chart1024" src="/app/images/sample_20.jpg" /> -->
        						</div>
<?php
                }
                else
                {
?>
								<div id="chart_<?php echo($question_index); ?>" class="chartbox">
        							<!-- <img class="chart360" src="/app/images/sample_18.png" /><img class="chart800" src="/app/images/sample_19.jpg" /><img class="chart1024" src="/app/images/sample_20.jpg" /> -->
        						</div>
<?php 
                }
            }
            else 
            {
?>
								<div class="replylist">
									<ul>
<?php 
                if ($question_resp_type == "3" || $question_resp_type == "4" || $question_resp_type == "5")
                {
                    $freeAnswwers   = $vote->getVoteFreeAnswers($question_vote_seq, $question_seq);
                    $k = 0;
                    foreach ($freeAnswwers as $answerItem)
                    {
                        $vote_free_answer_seq   = $answerItem["VOTE_FREE_ANSWERS_SEQ"];
                        $vote_member_seq        = $answerItem["VOTE_MEMBER_SEQ"];
                        $vote_member_name       = $answerItem["nname"];
                        $vote_member_pic        = $answerItem["pic"];
                        $vote_answer_text       = $answerItem["VOTE_ANSWER_TEXT"];
                        $percentage             = $answerItem["PERCENTAGE"];
?>
                						<li>
                							<div class="replyitem">
                								<div class="replytop">
                									<div class="userinfo">
                										<img src="/<?php echo($vote_member_pic); ?>" style="width: 20px;" />
                                    					<span class="normal"><?php echo($vote_member_name); ?></span>
                									</div>
                									<div class="replyctrl">
                										<span><?php echo($percentage); ?>%</span>
                									</div>
                								</div>
                								<div class="replybottom">
                									<span><?php echo($vote_answer_text); ?></span>
                								</div>
                							</div>
                						</li>
<?php 
                    }
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
}
?>
    				</ul>
				</div>
				<div class="voteviewbtncont vvwbspace">
					<div class="voteviewbuttonbox">
						<button class="votebutton">
							<span>이전</span>
						</button>
						<button class="votebutton">
							<span>홈으로</span>
						</button>
					</div>
				</div>
			</div>
		</div>
		</form>
		<!-- 투표 결과 끝 -->
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
				<input type="hidden" id="reply_page" name="reply_page" value="vote_result" />
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
					<ul id="replylist">
<?php 
    foreach ($replyList as $replyItem)
    {
        $replySeq       = $replyItem["REPLY_SEQ"];
        $nickName       = $replyItem["NNAME"];
        $picPath        = $replyItem["PIC"];
        $replyDate      = $replyItem["REPLY_REGI_DATE"];
        $replyContext   = $replyItem["REPLY_CONTEXT"];
?>
						<li>
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
								</div>
								<div class="replybottom">
									<span><?php echo($replyContext); ?></span>
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