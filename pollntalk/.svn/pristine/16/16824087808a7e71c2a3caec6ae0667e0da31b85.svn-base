<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  투표 내용 관리자 페이지
 */
try 
{
    $vote_seq   = $_GET["vote_seq"];

    $cateCtrl   = new CApp_Handler_Category_Ctrl();
    $depth1Cate = $cateCtrl->getCategoryList();
    
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
    $vote_is_premium        = $result["VOTE_IS_PREMIUM"];   
    $vote_view_count        = $result["VOTE_VIEW_COUNT"];
    $vote_recomm_count      = $result["VOTE_RECOMM_COUNT"];
    $vote_participant_count = $result["VOTE_PARTICIPATE_COUNT"];
    $vote_end_date          = $result["VOTE_END_DATE"];
    $vote_url               = $result["VOTE_URL"];
    $vote_security_code     = $result["VOTE_SECURITY_CODE"];
    
    if ($vote_real_name =="")
    {
        if ($vote_real_type != "3")
            $vote_real_name = "app/images/no_image.png";
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
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once ('./app/view/admin/header.php');
?>
<body>
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
            	<form id="frmVote" method="post" action="/admin_controller.php?mode=vote_view_proc">
					<input type="hidden" id="vote_seq" name="vote_seq" value="<?php echo($vote_seq); ?>" />
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> <span>투표 상세 내용</span>
						</div>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>종류</span>
								</div>
								<div class="boardInputBox">
									<input type="radio" name="vote_kind" id="vote_kind1" value="1" <?php if ($vote_kind == "1") echo("checked"); ?> /> 
									<label for="votekind1"> 
										<span>일반 투표</span>
									</label> 
									<input type="radio" name="vote_kind" id="vote_kind2" value="2" <?php if ($vote_kind == "2") echo("checked"); ?> />
									<label for="votekind2"> 
										<span>이벤트 투표</span>
									</label>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>유형</span>
								</div>
								<div class="boardInputBox">
									<select id="vote_type" name="vote_type" class="inputSelect">
										<option value="0" <?php if ($vote_type == "" || $vote_type == "0") echo("selected"); ?>>-</option>
										<option value="1" <?php if ($vote_type == "1") echo("selected"); ?>>투표</option>
										<option value="2" <?php if ($vote_type == "2") echo("selected"); ?>>일반 설문</option>
										<option value="3" <?php if ($vote_type == "3") echo("selected"); ?>>자유 응답 설문</option>
										<option value="4" <?php if ($vote_type == "4") echo("selected"); ?>>퀴즈</option>
									</select>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>제목</span>
								</div>
								<div class="boardInputBox">
									<input id="vote_subject" name="vote_subject" class="longInput" type="text" value="<?php echo($vote_subject); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>카테고리</span>
								</div>
								<div class="categorybox">
									<span>1차 카테고리 선택</span> 
									<input type="hidden" id="cate_seq" name="cate_seq" value="<?php echo($vote_cate1_seq); ?>" /> 
									<select id="vote_cate_seq" name="vote_cate1_seq">
										<option value="0">-</option>
<?php
for ($i = 0; $i < count($depth1Cate); $i ++) 
{
    $cate_seq = $depth1Cate[$i]["CATE_SEQ"];
    $cate_name = $depth1Cate[$i]["CATE_NAME"];

    $selected = "selected";
?>	
										<option value="<?php echo($cate_seq);?>" <?php if ($vote_cate1_seq == $cate_seq) echo($selected);?>><?php echo($cate_name); ?></option>
<?php
}
?>
                                    </select>
								</div>
								<div class="categorybox">
									<span>2차 카테고리 선택</span> 
									<select id="cate_2dept_seq" name="vote_cate2_seq">
										<option value="0">-</option>
<?php
if ($cate_2dept_seq != "" && $cate_2dept_seq != "0") 
{
    $cate_sub_seqs = $cateCtrl->getCategorySubList($vote_cate1_seq);
    foreach ($cate_sub_seqs as $items) 
    {
        $cate_sub_seq = $items["CATE_SEQ"];
        $cate_sub_name = $items["CATE_NAME"];
?>
										<option value="<?php echo($cate_sub_seq); ?>" <?php if ($cate_2dept_seq == $cate_sub_seq) echo($selected);?>><?php echo($cate_sub_name); ?></option>						
<?php
    }
}
?>									
									</select>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>투표 사진 / 동영상</span>
								</div>
								<div class="boardImageInputBox">
									<div class="boardinputarea">
										<input type="radio" class="agree" id="resource_type_01" name="resource_type[]" value="1" <?php if ($vote_real_type == "1") { ?> checked <?php } else if ($vote_real_type == "") {?> checked <?php } ?>/>
										<label for="resource_type_01">
											<span>사진 업로드</span>
										</label>
										<input type="radio" class="agree" id="resource_type_02" name="resource_type[]" value="2" <?php if ($vote_real_type == "2") { ?> checked <?php } ?> />
										<label for="resource_type_02">
											<span>사진 URL</span>
										</label>
										<input type="radio" class="agree" id="resource_type_03" name="resource_type[]" value="3" <?php if ($vote_real_type == "3") { ?> checked <?php } ?> />
										<label for="resource_type_03">
											<span>동영상 URL</span>
										</label>
									</div>
									<div class="boardinputarea">
										<input type="hidden" id="vote_temp_path" name="vote_temp_path" value="<?php echo($vote_real_name); ?>" /> 
    									<input type="hidden" id="vote_real_name" name="vote_real_name" value="<?php echo($vote_real_name); ?>" />
    									<img id="voteImageFile" src="<?php echo($vote_real_name); ?>" width="160" height="160" style="<?php if ($vote_real_type != "3") echo("display:block"); else echo("display:none"); ?>" />
    									<iframe id="voteVideoFile" src="<?php echo($vote_real_name); ?>" width="160" height="160" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="<?php if ($vote_real_type == "3") echo("visibility:visible;display:block;"); else echo("visibility:hidden;display:none;"); ?>">
    									</iframe>
    									<input type="hidden" id="vote_resource_type" name="vote_resource_type" value="<?php echo($vote_real_type); ?>" />
    									<input type="text" class="halfInput" id="vote_resource_url" name="vote_resource_url" value="<?php echo($vote_real_name); ?>" style="<?php if ($vote_real_type == "2" || $vote_real_type == "3") echo("display:block"); else echo("display:none"); ?>" >
    									<button type="button" id="resource_view" style="<?php if ($vote_real_type == "2" || $vote_real_type == "3") echo("display:block"); else echo("display:none"); ?>" >
    										<span>보기</span>
    									</button>
    									<div id="upImageFile" class="buttonBox" style="display:none;">
    										<a href="javascript:void(0);">
    											<span class="buttonText">파일 업로드</span>
    										</a>
										</div>
    								</div>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>관련링크</span>
								</div>
								<div class="boardInputBox">
									<input id="vote_url" name="vote_url" class="longInput" type="text" value="<?php echo($vote_url); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>설명</span>
								</div>
								<div class="boardInputBox">
									<input id="vote_context" name="vote_context" class="longInput" type="text" value="<?php echo($vote_context); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>조회수</span>
								</div>
								<div class="boardInputBox">
									<span><?php echo($vote_view_count); ?></span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>추천수</span>
								</div>
								<div class="boardInputBox">
									<span><?php echo($vote_recomm_count); ?></span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>참여수</span>
								</div>
								<div class="boardInputBox">
									<span><?php echo($vote_participant_count); ?></span>
								</div>
							</div>
						</div>
						<div class="boardBox">
							<div class="boardList">
								<ul id="question_lst">
									<li id="question_lst_item" style="display: none;" class="votewriteitem">
										<input class="question_seq" type="hidden" id="question_seq" name="question_seq" /> 
										<input class="question_index" type="hidden" id="question_index" name="question_index" /> 
										<input class="question_order" type="hidden" id="question_order" name="question_order" />
										<div class="votewritebox">
											<div class="questionbox">
												<div class="boardWriteItem">
													<div class="boardName">
														<span class="question_field">질문</span>
													</div>
													<div class="boardInputBox">
														<input class="middleInput question_subject" id="question_subject" name="question_subject" type="text" />
														<div class="buttonBox upPos">
															<a id="upPos" href="javascript:void(0)">
																<span class="buttonText">위로</span>
															</a>
														</div>
														<div class="buttonBox downPos">
															<a id="downPos" href="javascript:void(0)">
																<span class="buttonText">아래로</span>
															</a>
														</div>
														<div class="buttonrightBox deleteQuestion">
															<a id="deleteQuestion" href="javascript:void(0)">
																<span class="buttonText">질문삭제</span>
															</a>
														</div>
													</div>
												</div>
												<div class="boardWriteItem">
													<div class="boardName">
														<span>질문 사진/동영상</span>
													</div>
													<div class="boardImageInputBox">
														<div class="boardinputarea">
                    										<input type="radio" class="question_resource_type_01" id="question_resource_type_01" name="question_resource_type[]" value="1" checked />
                                                            <label class="question_resource_label_01" for="question_resource_type_01">
                                                            <span>사진 업로드</span>
                                                            </label>
                                                            <input type="radio" class="question_resource_type_02" id="question_resource_type_02" name="question_resource_type[]" value="2" />
                                                            <label class="question_resource_label_02" for="question_resource_type_02">
                                                            <span>사진 URL</span>
                                                            </label>
                                                            <input type="radio" class="question_resource_type_03" id="question_resource_type_03" name="question_resource_type[]" value="3" />
                                                            <label class="question_resource_label_03" for="question_resource_type_03">
                                                            <span>동영상 URL</span>
                                                            </label>
                    									</div>
                    									<div class="boardinputarea">
                    										<input class="question_temp_path" type="hidden" id="temp_path" name="question_temp_path" /> 
    														<input class="question_real_name" type="hidden" id="real_name" name="question_real_name" />
    														<img class="imageFile" src="/app/images/admin/photo.png" width="160" height="160" />
    														<div id="fileupload" class="buttonBox fileupload">
    															<a href="javascript:void(0);">
    															<span class="buttonText">파일 업로드</span></a>
    														</div>
    														<iframe class="question_VideoFile" id="question_VideoFile" src="/app/view/common/no_video.php" style="visibility:hidden;display:none;" width="160" height="160" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
    														</iframe>
                        									<input type="hidden" class="vote_question_resource_type" id="vote_question_resource_type" name="vote_question_resource_type" />
                        									<input type="text" class="halfInput vote_question_resource_url" id="vote_question_resource_url" name="vote_question_resource_url" style="display:none;" />
                        									<button type="button" class="question_resource_view" id="question_resource_view" style="display:none;">
                        										<span>보기</span>
                        									</button>
    													</div>
													</div>
												</div>
												<div class="boardWriteItem">
													<div class="boardName">
														<span>응답종류</span>
													</div>
													<div class="boardInputBox">
														<select class="inputSelect question_answer_kind" id="question_answer_kind" name="question_answer_kind">
															<option value="0">-</option>
															<option value="1">단일 응답</option>
															<option value="2">복수 응답</option>
															<option value="3">단일 응답 / 참여자 신규 응답 추가</option>
															<option value="4">복수 응답 / 참여자 신규 응답 추가</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="votewritebox">
											<ul id="answer_lst" class="answer_lst">
												<li class="answer_lst_item" style="display: none">
												<input class="answer_seq" type="hidden" id="answer_seq" name="answer_seq" /> 
												<input class="answer_index" type="hidden" id="answer_index" name="answer_index" />
													<div class="boardWriteItem">
														<div class="boardName">
															<span class="answer_field">응답</span>
														</div>
														<div class="boardInputBox">
															<input class="middleInput answer_subject" id="answer_subject" name="answer_subject" type="text" />
															<div class="buttonBox">
																<a class="appendAnswer" href="javascript:void(0)"> 
																	<span class="buttonText">응답추가</span>
																</a>
															</div>
															<div class="buttonBox">
																<a class="removeAnswer" href="javascript:void(0)"> 
																	<span class="buttonText">응답삭제</span>
																</a>
															</div>
														</div>
													</div>
													<div class="boardWriteItem">
														<div class="boardName">
															<span>응답 사진/동영상</span>
														</div>
														<div class="boardImageInputBox">
															<div class="boardinputarea">
                        										<input type="radio" class="answer_resource_type_01" id="answer_resource_type_01" name="answer_resource_type[]" value="1" checked />
                        										<label class="answer_resource_label_01" for="answer_resource_type_01">
                        											<span>사진 업로드</span>
                        										</label>
                        										<input type="radio" class="answer_resource_type_02" id="answer_resource_type_02" name="answer_resource_type[]" value="2" />
                        										<label class="answer_resource_label_02" for="answer_resource_type_02">
                        											<span>사진 URL</span>
                        										</label>
                        										<input type="radio" class="answer_resource_type_03" id="answer_resource_type_03" name="answer_resource_type[]" value="3" />
                        										<label class="answer_resource_label_03" for="answer_resource_type_03">
                        											<span>동영상 URL</span>
                        										</label>
                        									</div>
                        									<div class="boardinputarea">
                        										<input class="answer_temp_path" type="hidden" id="temp_path" name="answer_temp_path" value="" /> 
    															<input class="answer_real_name" type="hidden" id="real_name" name="answer_real_name" value="" />
        														<img class="imageFile" src="/app/images/admin/photo.png" width="160" height="160" />
    															<div id="fileupload" class="buttonBox fileupload">
    																<a href="javascript:void(0);">
    																	<span class="buttonText">파일 업로드</span>
    																</a>
    															</div>
    															<iframe class="answer_VideoFile" id="answer_VideoFile" src="/app/view/common/no_video.php" style="visibility:hidden;display:none;" width="160" height="160" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
    															</iframe>
                            									<input type="hidden" class="vote_answer_resource_type" id="vote_answer_resource_type" name="vote_answer_resource_type" />
                            									<input type="text" class="halfInput vote_answer_resource_url" id="vote_answer_resource_url" name="vote_answer_resource_url" style="display:none;" />
                            									<button type="button" class="answer_resource_view" id="answer_resource_view" style="display:none;"><span>보기</span></button>
    														</div>
														</div>
													</div>
													<div class="boardWriteItem answerCorrect" style="display:none">
														<div class="boardName">
															<span>정답여부</span>
														</div>
														<div class="boardInputBox">
															<input type="checkbox" class="answer_correct" id="answer_correct" name="answer_correct" value="1" />
															<label class="answer_correct_label" for="answer_correct"> 
																<span>정답</span>
															</label> 													
														</div>
													</div>
												</li>
											</ul>
										</div>
									</li>
<?php
$questions = $vote->getVoteQuestions($vote_seq);
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
            $videoUrls              = explode("/", $question_resource_path);
            $videoLast              = $videoUrls[count($videoUrls) - 1];
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
    
    $question_resp_type         = $questionItem["QUESTION_RESP_TYPE"];
    $question_seq               = $questionItem["QUESTION_SEQ"];
    $question_index             = $questionItem["QUESTION_INDEX"];
    $question_subject           = $questionItem["QUESTION_SUBJECT"];
?>            					
            						<li id="question_lst_item" class="votewriteitem newWriteItem">
                						<input class="question_seq" type="hidden" id="question_seq" name="question_seq" value="<?php echo($question_seq); ?>" /> 
                						<input class="question_index" type="hidden" id="question_index" name="question_index" value="<?php echo($question_index); ?>" />
										<input class="question_order" type="hidden" id="question_order" name="question_order" />
										<div class="votewritebox">
											<div class="questionbox">
												<div class="boardWriteItem">
													<div class="boardName">
														<span class="question_field">질문</span>
													</div>
													<div class="boardInputBox">
														<div class="buttonBox upPos">
															<a id="upPos" href="javascript:void(0)">
																<span class="buttonText">위로</span>
															</a>
														</div>
														<div class="buttonBox downPos">
															<a id="downPos" href="javascript:void(0)">
																<span class="buttonText">아래로</span>
															</a>
														</div>
														<div class="buttonrightBox deleteQuestion">
															<a id="deleteQuestion" href="javascript:void(0)">
																<span class="buttonText">질문삭제</span>
															</a>
														</div>
													</div>
												</div>
												<div class="boardWriteItem">
													<div class="boardName">
														<span>질문글</span>
													</div>
													<div class="boardInputBox">
														<input class="middleInput question_subject" id="question_subject" name="question_subject" type="text" value="<?php echo($question_subject); ?>" />
													</div>
												</div>
												<div class="boardWriteItem">
													<div class="boardName">
														<span>질문 사진/동영상</span>
													</div>
													<div class="boardImageInputBox">
														<div class="boardinputarea">
                    										<input type="radio" class="question_resource_type_01" id="question_resource_type_01" name="question_resource_type[]" value="1" <?php if ($question_resource_type == "1") { ?> checked <?php } ?> />
                                                            <label class="question_resource_label_01" for="question_resource_type_01">
                                                            	<span>사진 업로드</span>
                                                            </label>
                                                            <input type="radio" class="question_resource_type_02" id="question_resource_type_02" name="question_resource_type[]" value="2" <?php if ($question_resource_type == "2") { ?> checked <?php } ?> />
                                                            <label class="question_resource_label_02" for="question_resource_type_02">
                                                            	<span>사진 URL</span>
                                                            </label>
                                                            <input type="radio" class="question_resource_type_03" id="question_resource_type_03" name="question_resource_type[]" value="3" <?php if ($question_resource_type == "3") { ?> checked <?php } ?> />
                                                            <label class="question_resource_label_03" for="question_resource_type_03">
                                                            	<span>동영상 URL</span>
                                                            </label>
                    									</div>
                    									<div class="boardinputarea">
                    										<input class="question_temp_path" type="hidden" id="temp_path" name="question_temp_path" value="<?php echo($question_resource_path); ?>" /> 
    														<input class="question_real_name" type="hidden" id="real_name" name="question_real_name" value="<?php echo($question_resource_path); ?>" />
    														<img class="imageFile" src="<?php echo($question_real_path); ?>" width="160" height="160" style="<?php if ($question_resource_type != "3") echo("display:block"); else echo("display:none"); ?>" />
    														<div id="fileupload" class="buttonBox fileupload" style="<?php if ($question_resource_type == "1") echo("display:block"); else echo("display:none"); ?>" >
    															<a href="javascript:void(0);">
    																<span class="buttonText">파일 업로드</span>
    															</a>
    														</div>
    														<iframe class="question_VideoFile" id="question_VideoFile" src="<?php echo($question_real_path); ?>" width="160" height="160" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="<?php if ($question_resource_type == "3") echo("visibility:visible;display:block;"); else echo("visibility:hidden;display:none;"); ?>">
    														</iframe>
                        									<input type="hidden" class="vote_question_resource_type" id="vote_question_resource_type" name="vote_question_resource_type[]" value="<?php echo($question_resource_type); ?>" />
                        									<input type="text" class="halfInput vote_question_resource_url" id="vote_question_resource_url" name="vote_question_resource_url[]" value="<?php echo($question_resource_path); ?>" style="<?php if ($question_resource_type == "2" || $question_resource_type == "3") echo("display:block"); else echo("display:none"); ?>" />
                        									<button type="button" class="question_resource_view" id="question_resource_view" style="<?php if ($question_resource_type == "2" || $question_resource_type == "3") echo("display:block"); else echo("display:none"); ?>" >
                        										<span>보기</span>
                        									</button>
    													</div>
													</div>
												</div>
												<div class="boardWriteItem">
													<div class="boardName">
														<span>응답종류</span>
													</div>
													<div class="boardInputBox">
														<select class="inputSelect question_answer_kind" id="question_answer_kind" name="question_answer_kind">
															<option value="0">-</option>
															<option value="1" <?php if ($question_resp_type == "1") echo("selected"); ?>>단일 응답</option>
															<option value="2" <?php if ($question_resp_type == "2") echo("selected"); ?>>복수 응답</option>
															<option value="3" <?php if ($question_resp_type == "3") echo("selected"); ?>>단일 응답 / 참여자 신규 응답 추가</option>
															<option value="4" <?php if ($question_resp_type == "4") echo("selected"); ?>>복수 응답 / 참여자 신규 응답 추가</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="votewritebox">
											<ul id="answer_lst" class="answer_lst">
												<li class="answer_lst_item" style="display: none">
													<input class="answer_seq" type="hidden" id="answer_seq" name="answer_seq" /> 
													<input class="answer_index" type="hidden" id="answer_index" name="answer_index" />
													<div class="boardWriteItem">
														<div class="boardName">
															<span class="answer_field">응답</span>
														</div>
														<div class="boardInputBox">
															<input class="middleInput answer_subject" id="answer_subject" name="answer_subject" type="text" />
															<div class="buttonBox">
																<a class="appendAnswer" href="javascript:void(0)"> 
																	<span class="buttonText">응답추가</span>
																</a>
															</div>
															<div class="buttonBox">
																<a class="removeAnswer" href="javascript:void(0)"> 
																	<span class="buttonText">응답삭제</span>
																</a>
															</div>
														</div>
													</div>
													<div class="boardWriteItem">
														<div class="boardName">
															<span>응답 사진/동영상</span>
														</div>
														<div class="boardImageInputBox">
															<div class="boardinputarea">
                        										<input type="radio" class="answer_resource_type_01" id="answer_resource_type_01" name="answer_resource_type[]" value="1" checked />
                                                                <label class="answer_resource_label_01" for="answer_resource_type_01">
                                                                <span>사진 업로드</span>
                                                                </label>
                                                                <input type="radio" class="answer_resource_type_02" id="answer_resource_type_02" name="answer_resource_type[]" value="2" />
                                                                <label class="answer_resource_label_02" for="answer_resource_type_02">
                                                                <span>사진 URL</span>
                                                                </label>
                                                                <input type="radio" class="answer_resource_type_03" id="answer_resource_type_03" name="answer_resource_type[]" value="3" />
                                                                <label class="answer_resource_label_03" for="answer_resource_type_03">
                                                                <span>동영상 URL</span>
                                                                </label>
                        									</div>
                        									<div class="boardinputarea">
                        										<input class="answer_temp_path" type="hidden" id="temp_path" name="answer_temp_path" value="" /> 
    															<input class="answer_real_name" type="hidden" id="real_name" name="answer_real_name" value="" />
    															<img class="imageFile" src="/app/images/admin/photo.png" width="160" height="160" />
    															<div id="fileupload" class="buttonBox fileupload">
    																<a href="javascript:void(0);">
    																	<span class="buttonText">파일 업로드</span>
    																</a>
    															</div>
    															<iframe class="answer_VideoFile" id="answer_VideoFile" src="/app/view/common/no_video.php" style="visibility:hidden;display:none;" width="160" height="160" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
    															</iframe>
                            									<input type="hidden" class="vote_answer_resource_type" id="vote_answer_resource_type" name="vote_answer_resource_type[]" />
                            									<input type="text" class="halfInput vote_answer_resource_url" id="vote_answer_resource_url" name="vote_answer_resource_url[]" style="display:none;" />
                            									<button type="button" class="answer_resource_view" id="answer_resource_view" style="display:none;"><span>보기</span></button>
    														</div>
    													</div>
													</div>
													<div class="boardWriteItem answerCorrect" style="display:none">
														<div class="boardName">
															<span>정답여부</span>
														</div>
														<div class="boardInputBox">
															<input type="checkbox" class="answer_correct" id="answer_correct" name="answer_correct" value="1" />
															<label class="answer_correct_label" for="answer_correct"> 
																<span>정답</span>
															</label> 													
														</div>
													</div>
												</li>
<?php
    $answers = $vote->getVoteAnswers($vote_seq, $question_seq);
    $j = 0;
    foreach ($answers as $answerItem) 
    {
        //print_r($answerItem);
        //echo("<br/>\r\n");
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
        //echo($is_correct);
?>
                    							<li class="answer_lst_item newAnswerItem">
                    								<input class="answer_seq" type="hidden" id="answer_seq" name="answer_seq" value="<?php echo($answerItem["ANSWERS_SEQ"]); ?>" /> 
                    								<input class="answer_index" type="hidden" id="answer_index" name="answer_index" />
													<div class="boardWriteItem">
														<div class="boardName">
															<span class="answer_field">응답</span>
														</div>
														<div class="boardInputBox">
															<input class="middleInput answer_subject" id="answer_subject" name="answer_subject" type="text" value="<?php echo($answer_text); ?>" />
															<div class="buttonBox">
																<a class="appendAnswer" href="javascript:void(0)"> 
																	<span class="buttonText">응답추가</span>
																</a>
															</div>
															<div class="buttonBox">
																<a class="removeAnswer" href="javascript:void(0)"> 
																	<span class="buttonText">응답삭제</span>
																</a>
															</div>
														</div>
													</div>
													<div class="boardWriteItem">
														<div class="boardName">
															<span>응답 사진/동영상</span>
														</div>
														<div class="boardImageInputBox">
															<div class="boardinputarea">
                        										<input type="radio" class="answer_resource_type_01" id="answer_resource_type_01" name="answer_resource_type[]" value="1" <?php if ($answer_resource_type == "1") { echo("checked"); } ?> />
                                                                <label class="answer_resource_label_01" for="answer_resource_type_01">
                                                                	<span>사진 업로드</span>
                                                                </label>
                                                                <input type="radio" class="answer_resource_type_02" id="answer_resource_type_02" name="answer_resource_type[]" value="2" <?php if ($answer_resource_type == "2") { echo("checked"); } ?> />
                                                                <label class="answer_resource_label_02" for="answer_resource_type_02">
                                                                	<span>사진 URL</span>
                                                                </label>
                                                                <input type="radio" class="answer_resource_type_03" id="answer_resource_type_03" name="answer_resource_type[]" value="3" <?php if ($answer_resource_type == "3") { echo("checked"); } ?> />
                                                                <label class="answer_resource_label_03" for="answer_resource_type_03">
                                                                	<span>동영상 URL</span>
                                                                </label>
                        									</div>
                        									<div class="boardinputarea">
                        										<input class="answer_temp_path" type="hidden" id="temp_path" name="answer_temp_path" value="<?php echo($answer_resource_path); ?>" /> 
    															<input class="answer_real_name" type="hidden" id="real_name" name="answer_real_name" value="<?php echo($answer_resource_path); ?>" />
    															<img class="imageFile" width="160" height="160" src="<?php echo($answer_real_path); ?>" style="<?php if ($answer_resource_type != "3") echo("display:block"); else echo("display:none"); ?>" />
    															<div id="fileupload" class="buttonBox fileupload" style="<?php if ($answer_resource_type == "1") echo("display:block"); else echo("display:none"); ?>" >
    																<a href="javascript:void(0);">
    																	<span class="buttonText">파일 업로드</span>
    																</a>
    															</div>
    															<iframe class="answer_VideoFile" id="answer_VideoFile" src="<?php echo($answer_real_path); ?>" width="160" height="160" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="<?php if ($answer_resource_type == "3") echo("visibility:visible;display:block;"); else echo("visibility:hidden;display:none;"); ?>">
    															</iframe>
                            									<input type="hidden" class="vote_answer_resource_type" id="vote_answer_resource_type" name="vote_answer_resource_type[]" value="<?php echo($answer_resource_type); ?>" />
                            									<input type="text" class="halfInput vote_answer_resource_url" id="vote_answer_resource_url" name="vote_answer_resource_url[]" value="<?php echo($answer_resource_path); ?>" style="<?php if ($answer_resource_type == "2" || $answer_resource_type == "3") echo("display:block"); else echo("display:none"); ?>" >
                            									<button type="button" class="answer_resource_view" id="answer_resource_view" style="<?php if ($answer_resource_type == "2" || $answer_resource_type == "3") echo("display:block"); else echo("display:none"); ?>" >
                            										<span>보기</span>
                            									</button>
    														</div>
														</div>
													</div>
													<div class="boardWriteItem answerCorrect" style="display:<?php if ($vote_type == "4") echo("block"); else echo("none"); ?>">
														<div class="boardName">
															<span>정답여부</span>
														</div>
														<div class="boardInputBox">
															<input type="checkbox" class="answer_correct" id="answer_correct" name="answer_correct" value="<?php echo($j); ?>" <?php if ($is_correct != "" && $is_correct == "1") { echo("checked"); } ?> />
															<label class="answer_correct_label" for="answer_correct"> 
																<span>정답</span>
															</label> 													
														</div>
													</div>
												</li>
<?php
    }
?>
                    						</ul>
										</div>
</li>
<?php
}
?>                					
                				</ul>
							</div>
							<div class="boardListButtonBox">
								<div class="buttonBox" style="float: right; margin-right: 10px;">
									<a id="appendQuestion" href="javascript:void(0)">
										<span class="buttonText">질문추가</span>
									</a>
								</div>
							</div>
						</div>
						<!-- 버튼 -->
						<div class="boardListButtonBox">
							<div class="buttonBox">
								<a id="deleteVote" href="javascript:void(0)">
									<span class="buttonText">삭제하기</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="registerVote" href="javascript:void(0)">
									<span class="buttonText">수정하기</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="goVoteResult" href="javascript:void(0)">
									<span class="buttonText">설문 결과 바로가기</span>
								</a>
							</div>
							<div class="buttonBox">
								<a id="goVote" href="javascript:void(0)">
									<span class="buttonText">설문 바로가기</span>
								</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- 파일을 업로드할 폼 -->
	<form id="frmImageUpload" method="post" action="/admin_controller.php?mode=image_vote_upload" target="uploadFrame" enctype="multipart/form-data">
		<input type="hidden" id="question_upload_index" name="question_upload_index" /> 
		<input type="hidden" id="answer_upload_index" name="answer_upload_index" /> 
		<input type="file" id="uploadName" name="uploadName" style="display: none" accept="image/*" />
	</form>
<?php
require_once ('./app/view/admin/footer.php');
?>
	<script type="text/javascript" src="/app/js/admin_vote_view.js?v=1.21" charset="utf-8">
	</script>
	<!-- admin 정보 등록 js -->
	<iframe src="/" id="uploadFrame" name="uploadFrame" width="0" height="0" frameborder="0" style="width: 0px; height: 0px;"> 
	</iframe>
	<div id="popupBox" style="display: none;">
	</div>
</body>
</html>