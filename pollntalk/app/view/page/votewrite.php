<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  투표 작성 페이지
 */
try
{
    $voteData       = null;
    $vote           = new CApp_Handler_Vote_Ctrl();
    $voteSeq        = $_POST["vote_seq"];
    $vote_kind      = $_GET["vote_kind"];
    if ($vote_kind == "")
        $vote_kind  = "1";
    
    $voteformSeq    = "";
    if ($voteSeq == "")
    {
        $voteformSeq    = $_POST["vote_form_seq"];
        $voteData       = $vote->getVoteFormInfo($voteformSeq);
        if (count($voteData) > 0)
        {
            $vote_kind          = $voteData["VOTE_FORM_KIND"];
            $vote_type          = $voteData["VOTE_TYPE"];
            $vote_subject       = $voteData["VOTE_SUBJECT"];
            $vote_cate1_seq     = $voteData["VOTE_CATE_SEQ"];
            $vote_cate1_name    = $voteData["VOTE_CATE_NAME"];
            $cate_2dept_seq     = $voteData["VOTE_CATE_SUB_SEQ"];
            $cate_2dept_name    = $voteData["VOTE_CATE_SUB_NAME"];
            $vote_real_name     = $voteData["VOTE_RESOURCE_PATH"];
            $vote_real_type     = $voteData["VOTE_RESOURCE_TYPE"];
            $vote_context       = $voteData["VOTE_FORM_CONTEXT"];
            $vote_url           = $voteData["VOTE_URL"];
            $vote_end_date      = "";
        }
    }
    
    if ($vote_real_name =="")
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
            $videoUrls      = explode("/", $vote_real_name);
            $videoLast      = $videoUrls[count($videoUrls) - 1];
            $vote_real_name = "https://www.youtube.com/embed/".$videoLast;
        }
    }
    
    //포인트 설정
    //설문 개설 포인트
    $voteOpenPoint  = "";
    $pointCtrl      = new CApp_Handler_Point_Ctrl();
    $pointOpenInfo  = $pointCtrl->getPointByPosition("101");
    $voteOpenPoint  = $pointOpenInfo["POINT"];
    
    //설문 응답 포인트
    $voteRespPoint  = "";
    $pointRespInfo  = $pointCtrl->getPointByPosition("102");
    $voteRespPoint  = $pointRespInfo["POINT"];
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
	<form id="frmVote" method="post" action="/controller.php?mode=vote_proc">
		<input type="hidden" id="vote_seq" name="vote_seq" value="<?php echo($voteSeq); ?>" />
		<input type="hidden" id="vote_form_seq" name="vote_form_seq" value="<?php echo($voteformSeq); ?>" />
		<input type="hidden" id="vote_kind" name="vote_kind" value="<?php echo($vote_kind)?>" />
		<input type="hidden" id="temp_path" name="vote_temp_path" value="<?php echo($vote_real_name); ?>" /> 
		<input type="hidden" id="real_name" name="vote_real_name" value="<?php echo($vote_real_name); ?>" />
		<input type="hidden" id="vote_open_point" name="vote_open_point" value="<?php echo($voteOpenPoint); ?>" />
		<input type="hidden" id="vote_resp_point" name="vote_resp_point" value="<?php echo($voteRespPoint); ?>" />
    	<div class="votewritearea">
			<div class="votewritebox">
				<div class="votewritemenu">
					<a href="/?mode=votewrite&vote_kind=1">
        				<div class="votewritemenuitem <?php if ($vote_kind == "1") echo("selected"); else echo("noselected"); ?>">
        					<span>투표 만들기</span>
        				</div>
    				</a>
    				<a href="/?mode=votewrite&vote_kind=2">
        				<div class="votewritemenuitem <?php if ($vote_kind == "1") echo("noselected"); else echo("selected"); ?>">
        					<span>이벤트 투표 만들기</span>
        				</div>
    				</a>
				</div>
				<!-- 투표 입력란 시작 -->
				<div class="votewrite">
					<!-- 투표 기본 정보 시작 -->
					<div class="votewritetitle">
						<img src="/app/images/mark_01.png" />
						<span class="votedeftitle">기본 정보</span>
						<span class="altright semistress">빨간색 : 필수항목</span>
					</div>
					<div class="votewritecont vtallline">
						<div class="votewritecontitem">
							<div class="votewriteinputer vtbline">
    							<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span class="stress">유형</span>
    							</div>
    							<div class="votewriteinputbox">
    								<div class="inputcont">
    									<select id="vote_type" name="vote_type" class="vrspace" <?php if ($vote_type != "" && $vote_type != "0") echo("style='color:#999999'"); ?>>
    										<option value="0" <?php if ($vote_type == "" || $vote_type == "0") echo("selected"); ?>>-유형 선택-</option>
    										<option value="1" <?php if ($vote_type == "1") echo("selected"); ?>>투표</option>
    										<option value="2" <?php if ($vote_type == "2") echo("selected"); ?>>설문</option>
    										<option value="3" <?php if ($vote_type == "3") echo("selected"); ?>>자유 응답 설문</option>
    										<option value="4" <?php if ($vote_type == "4") echo("selected"); ?>>퀴즈</option>
    									</select>
    								</div>
    							</div>
    						</div>
							<div class="votewriteinputer vtbline">
								<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span class="stress">제목</span>
    							</div>
    							<div class="votewriteinputbox">
									<div class="inputcont">
										<input type="text" class="voteinputlong" id="vote_subject" name="vote_subject" value="<?php echo($vote_subject); ?>" placeholder="제목을 입력하세요." />
									</div>
								</div>
							</div>
							<div class="votewriteinputer vtbline">
								<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span class="stress">카테고리</span>
    							</div>
								<div class="votewriteinputbox">
									<div class="inputcont">
										<input type="hidden" id="cate_seq" name="cate_seq" value="<?php echo($vote_cate1_seq); ?>" />
<?php 
$cateCtrl   = new CApp_Handler_Category_Ctrl();
$depth1Cate = $cateCtrl->getCategoryList();
$cate1Count = count($depth1Cate);
?>										
    									<select id="vote_cate_seq" name="vote_cate1_seq" class="vrspace" <?php if ($cate1Count > 0) echo("style='color:#999999'"); ?>>
    										<option value="-">-1차 카테고리 선택-</option>
<?php
for ($i = 0; $i < count($depth1Cate); $i ++) 
{
    $cate_seq   = $depth1Cate[$i]["CATE_SEQ"];
    $cate_name  = $depth1Cate[$i]["CATE_NAME"];

    $selected   = "selected";
?>
    										<option value="<?php echo($cate_seq);?>" <?php if ($vote_cate1_seq == $cate_seq) echo($selected);?>><?php echo($cate_name); ?></option>
<?php
}
?>
    									</select> 
<?php
$cate_sub_seqs  = null;
$cate2Count     = 0;
if ($cate_2dept_seq != "" && $cate_2dept_seq != "0") 
{
    $cate_sub_seqs  = $cateCtrl->getCategorySubList($vote_cate1_seq);
    $cate2Count     = count($cate_sub_seqs);
}
?>
    									<select id="cate_2dept_seq" name="vote_cate2_seq" <?php if ($cate2Count > 0) echo("style='color:#999999'"); ?>>
    										<option value="-">-2차 카테고리 선택-</option>
<?php 
if ($cate_sub_seqs != null)
{
    foreach ($cate_sub_seqs as $items) 
    {
        $cate_sub_seq   = $items["CATE_SEQ"];
        $cate_sub_name  = $items["CATE_NAME"];
?>
											<option value="<?php echo($cate_sub_seq); ?>" <?php if ($cate_2dept_seq == $cate_sub_seq) echo($selected);?>><?php echo($cate_sub_name); ?></option>						
<?php
    }
}
?>	
    									</select>
									</div>
								</div>
							</div>
							<div class="votewriteinputer vtbline">
								<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span>부연 설명</span>
    							</div>
								<div class="votewriteinputbox">
									<div class="inputcont">
										<textarea id="vote_context" name="vote_context" rows="3" placeholder="투표/퀴즈/설문에 대해 부연 설명할 내용이 있으시면 입력하세요."><?php echo($vote_context); ?></textarea>
									</div>
								</div>
							</div>
							<div class="votewriteinputer vtbline">
								<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span>사진/동영상</span>
    							</div>
								<div class="votewriteinputbox">
									<div class="inputconstdefault">
										<img class="inputcontImage imageFile" id="imageFile" src="<?php echo($vote_real_name); ?>" width="315" style="<?php if ($vote_real_type != "3") echo("display:block"); else echo("display:none"); ?>" />
                                        <iframe class="inputcontVideo" id="videoFile" src="<?php echo($vote_real_name); ?>" width="315" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="<?php if ($vote_real_type == "3") echo("visibility:visible;display:block;"); else echo("visibility:hidden;display:none;"); ?>">
                                        </iframe>
                                        <div class="inputcontcheckbox">
                                        	<input type="radio" class="agree" id="resource_type_00" name="resource_type[]" value="0" <?php if ($vote_real_type == "1") { ?> checked <?php } else if ($vote_real_type == "") {?> checked <?php } ?> />
											<label for="resource_type_00">
												<span>사진/동영상 없음</span>
											</label>
											<input type="radio" class="agree" id="resource_type_01" name="resource_type[]" value="1" <?php if ($vote_real_type == "1") { ?> checked <?php } ?> />
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
                                        <input type="hidden" id="vote_resource_type" name="vote_resource_type" value="<?php echo($vote_real_type); ?>" />
    									<input type="text" class="voteinputshort vrspace" id="vote_resource_url" name="vote_resource_url" value="<?php echo($vote_real_name); ?>" style="<?php if ($vote_real_type == "2" || $vote_real_type == "3") echo("display:block"); else echo("display:none"); ?>" >
    									<button type="button" class="votebutton resource_view" id="resource_view" style="<?php if ($vote_real_type == "2" || $vote_real_type == "3") echo("display:block"); else echo("display:none"); ?>" >
    										<span>등록</span>
    									</button>
										<button type="button" class="votebutton fileupload" id="upImageFile" style="<?php if ($vote_real_type != "3" && $vote_real_type != "") echo("display:block"); else echo("display:none"); ?>" >
											<img src="/app/images/up.png"/>
											<span>사진파일선택</span>
										</button>
									</div>
								</div>
							</div>
							<div class="votewriteinputer vtbline">
								<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span>관련 내용 링크</span>
    							</div>
								<div class="votewriteinputbox">
									<div class="inputcont">
										<input type="text" class="voteinputlong" id="vote_url" name="vote_url" value="<?php echo($vote_url); ?>" placeholder="www.***" />
									</div>
								</div>
							</div>
							<div class="votewriteinputer vtbline">
    							<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span>마감일</span>
    							</div>
    							<div class="votewriteinputbox">
    								<div class="inputcontbox">
										<input class="inputcalendar calendarbox" type="text" style="padding-left: 50px" id="calendarbox" name="vote_end_date" value="<?php echo($vote_end_date); ?>" placeholder="         마감일을 선택하세요." />
									</div>
    							</div>
    						</div>
<?php 
if ($vote_kind == "2")
{
?>
    						<div class="votewriteinputer vtbline">
    							<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span class="stress">담당자 연락처</span>
    							</div>
    							<div class="votewriteinputbox">
    								<div class="inputcont">
    									<input type="text" id="event_phone" name="event_phone" placeholder="-없이 번호만 기재"  />
    								</div>
    							</div>
    						</div>
							<div class="votewriteinputer vtbline">
    							<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span>투표 내용 파일</span>
    							</div>
    							<div class="votewriteinputbox">
    								<div class="inputconstdefault">
    									<input type="hidden" id="real_path" name="real_path" />
    									<input type="text" class="vrspace" id="event_file" name="event_file" />
    									<button type="button" id="find_event_file" class="votebutton">
    										<img src="/app/images/up.png" /> 
    										<span>파일 선택</span>
    									</button>
    								</div>
    							</div>
    						</div>
    						<div class="votewriteinputer">
    							<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span>이벤트 유무</span>
    							</div>
    							<div class="votewriteinputbox">
    								<div class="inputconstdefault">
    									<input type="checkbox" class="agree is_event" id="is_event" name="is_event" value="1" /> 
                    					<label class="is_event" for="is_event"> 
                    						<span>이벤트 있음</span>
                    					</label>
    								</div>
    							</div>
    						</div>
<?php 
}
?>
						</div>
					</div>
					<!-- 투표 기본 정보 끝 -->

					<!-- 질문 목록 시작 -->
					<div class="question_lst" id="question_lst">
						<!-- 질문 영역 샘플 시작 -->
    					<div id="question_lst_item" class="votewritecont vtallline" style="display: none">
    						<input class="question_seq" type="hidden" name="question_seq" /> 
                    		<input class="question_index" type="hidden" name="question_index" />
                    		<input class="question_order" type="hidden" name="question_order" />
                    		<input class="question_temp_path" type="hidden" name="question_temp_path" /> 
        					<input class="question_real_name" type="hidden" name="question_real_name" />
        					<input class="vote_question_resource_type" type="hidden" name="vote_question_resource_type" />
    						<div class="votewritecontitem">
    							<div class="votewriteinputer vtbline">
    								<div class="votewritefield questionsmallfield">
        								<img src="/app/images/question.png" /> 
        								<span class="question_field">질문/응답</span> 
        							</div>
        							<div class="votewriteinputbox">
        								<a class="deleteQuestion" href="javascript:void(0)">
        									<img class="rightbutton" src="/app/images/close.png" />
        								</a>
    								</div>
    							</div>
    							<div class="votewriteinputer vtbline">
    								<div class="votewritefield">
    									<img class="votemark" src="/app/images/mark_03.png" /> 
        								<span class="stress question_field">질문</span> 
        								<a class="upPosMobile" href="javascript:void(0)">
        									<img class="bcontrol rightbutton" src="/app/images/upPos.png" />
        								</a>
        								<a class="downPosMobile" href="javascript:void(0)">
        									<img class="bcontrol rightbutton" src="/app/images/downPos.png" />
        								</a>		
        							</div>
    								<div class="votewriteinputbox">
    									<div class="inputcontli vbspace">
    										<input type="text" class="question_subject" name="question_subject" placeholder="질문을 입력하세요." />
    										<a class="upPosWindow" href="javascript:void(0)">
    											<img class="rightbutton" src="/app/images/upPos.png" />
    										</a>
    										<a class="downPosWindow" href="javascript:void(0)">
    	    									<img class="rightbutton" src="/app/images/downPos.png" />
    	    								</a>		
    									</div>
    									<div class="inputconstdefault">
    										<img class="inputcontImage imageFile" src="/app/images/no_image.png" width="315" />
    										<iframe class="inputcontVideo question_VideoFile" id="question_VideoFile" src="/app/view/common/no_video.php" style="visibility:hidden;display:none;" width="315" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen >
    										</iframe>
    										<div class="inputcontcheckbox">
    											<input type="radio" class="agree question_resource_type_00" name="question_resource_type[]" value="0" />
    											<label class="question_resource_label_00" for="question_resource_type_00">
    												<span>사진/동영상 없음</span>
    											</label>
    											<input type="radio" class="agree question_resource_type_01" name="question_resource_type[]" value="1" />
    											<label class="question_resource_label_01" for="question_resource_type_01">
    												<span>사진 업로드</span>
    											</label>
    											<input type="radio" class="agree question_resource_type_02" name="question_resource_type[]" value="2" />
    											<label class="question_resource_label_02" for="question_resource_type_02">
    												<span>사진 URL</span>
    											</label>
    											<input type="radio" class="agree question_resource_type_03" name="question_resource_type[]" value="3" />
    											<label class="question_resource_label_03" for="question_resource_type_03">
    												<span>동영상 URL</span>
    											</label>
    										</div>
    										<input type="text" class="voteinputshort vrspace vbspace vote_question_resource_url" name="vote_question_resource_url" style="display:none;" />									
    										<button type="button" id="fileupload" class="votebutton fileupload">
    											<img src="/app/images/up.png"/>
    											<span>사진파일선택</span>
    										</button>
    										<button type="button" class="votebutton question_resource_view" style="display:none;">
        										<span>등록</span>
        									</button>
    										<select class="question_answer_kind rightbutton vrspace" name="question_answer_kind">
        										<option value="-">-응답종류 선택-</option>
        										<option value="1">단일 응답</option>
												<option value="2">복수 응답</option>
												<option value="3">단일 응답 / 참여자 신규 응답 추가</option>
												<option value="4">복수 응답 / 참여자 신규 응답 추가</option>
												<option value="5">참여자 의견 작성</option>
        									</select>
    									</div>
    								</div>
    							</div>
    							<!-- 질문 샘플 영역의 응답 영역 시작 -->
    							<div class="votewriteinputer">
    								<ul id="answer_lst" class="answer_lst">
    									<li class="answer_lst_item" style="display: none">
    										<input class="answer_seq" type="hidden" name="answer_seq" /> 
											<input class="answer_index" type="hidden" name="answer_index" />
											<input class="answer_temp_path" type="hidden" name="answer_temp_path" value="" />
											<input class="answer_real_name" type="hidden" name="answer_real_name" value="" />
											<input type="hidden" class="vote_answer_resource_type" name="vote_answer_resource_type" />
    										<div class="votewritefield">
    											<img class="votemark" src="/app/images/mark_03.png" /> 
        										<span class="stress">응답</span> 
        										<a class="appendAnswer mobilePlus" href="javascript:void(0)">
        											<img class="bcontrol" src="/app/images/bplus.jpg" />
        										</a> 
        										<a class="removeAnswer mobileMinus" href="javascript:void(0)"> 
        											<img class="bcontrol" src="/app/images/bminus.jpg" />
        										</a>										
            								</div>
    										<div class="votewriteinputbox">
    											<div class="inputcontli vbspace">
    												<input type="text" class="answer_subject" name="answer_subject" placeholder="응답을 입력하세요." />
    												<a class="removeAnswer windowMinus" href="javascript:void(0)"> 
    													<img src="/app/images/bminus.jpg" />
    												</a>
    												<a class="appendAnswer windowPlus" href="javascript:void(0)"> 
    													<img src="/app/images/bplus.jpg" />
    												</a>
    											</div>
    											<div class="inputconstdefault">
            										<img class="inputcontImage imageFile" src="/app/images/no_image.png" width="315" />
    												<iframe class="inputcontVideo answer_VideoFile" id="answer_VideoFile" src="/app/view/common/no_video.php" style="visibility:hidden;display:none;" width="315" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
    												</iframe>
    												<div class="inputcontcheckbox">
    													<input type="radio" class="agree answer_resource_type_00" id="answer_resource_type_00" name="answer_resource_type[]" value="0" />
            											<label class="answer_resource_label_00" for="answer_resource_type_00">
            												<span>사진/동영상 없음</span>
            											</label>
            											<input type="radio" class="agree answer_resource_type_01" id="answer_resource_type_01" name="answer_resource_type[]" value="1" />
            											<label class="answer_resource_label_01" for="answer_resource_type_01">
            												<span>사진 업로드</span>
            											</label>
            											<input type="radio" class="agree answer_resource_type_02" id="answer_resource_type_02" name="answer_resource_type[]" value="2" />
            											<label class="answer_resource_label_02" for="answer_resource_type_02">
            												<span>사진 URL</span>
            											</label>
            											<input type="radio" class="agree answer_resource_type_03" id="answer_resource_type_03" name="answer_resource_type[]" value="3" />
            											<label class="answer_resource_label_03" for="answer_resource_type_03">
            												<span>동영상 URL</span>
            											</label>
            										</div>
            										<input type="text" class="voteinputshort vrspace vbspace vote_answer_resource_url" name="vote_answer_resource_url" style="display:none;" />			
    												<button type="button" class="votebutton fileupload">
    													<img src="/app/images/up.png"/>
    													<span>사진파일선택</span>
    												</button>
    												<button type="button" class="votebutton answer_resource_view" style="display:none;">
                                                		<span>보기</span>
                                                    </button>
    												<div class="checkinput answerCorrect" style="display:none">
    													<input type="checkbox" class="agree answer_correct" id="answer_correct_01" /> 
                                    					<label class="answer_correct_label" for="answer_correct_01"> 
                                    						<span>정답 여부</span>
                                    					</label>
        											</div>
    											</div>
    										</div>
    									</li>
    								</ul>
    							</div>
    							<!-- 질문 샘플 영역의 응답 영역 끝 -->
    						</div>
    					</div>
    					<!-- 질문 영역 샘플 끝 -->
<?php
$question_vote_seq  = $voteSeq;
if ($question_vote_seq == "")
    $question_vote_seq  = $voteformSeq;

$questions = $vote->getVoteFormQuestions($question_vote_seq);
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
            $question_real_path = "/app/images/no_image.png";
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
						<!-- 질문 데이터 영역 시작 -->
						<div id="question_lst_item" class="votewritecont vtallline newWriteItem">
    						<input class="question_seq" type="hidden" name="question_seq" value="<?php echo($question_seq); ?>" /> 
                    		<input class="question_index" type="hidden" name="question_index" value="<?php echo($question_index); ?>" />
                    		<input class="question_order" type="hidden" name="question_order" value="<?php echo($question_order); ?>" />
                    		<input class="question_temp_path" type="hidden" name="question_temp_path" value="<?php echo($question_resource_path); ?>" /> 
        					<input class="question_real_name" type="hidden" name="question_real_name" value="<?php echo($question_resource_path); ?>" />
        					<input class="vote_question_resource_type" type="hidden" name="vote_question_resource_type[]" value="<?php echo($question_resource_type); ?>" />
        					<div class="votewritecontitem">
    							<div class="votewriteinputer vtbline ">
    								<div class="votewritefield questionsmallfield">
        								<img src="/app/images/question.png" /> 
        								<span class="question_field">질문/응답</span> 
        							</div>
        							<div class="votewriteinputbox">
        								<a class="deleteQuestion" href="javascript:void(0)">
        									<img class="rightbutton" src="/app/images/close.png" />
        								</a>
    								</div>
    							</div>
    							<div class="votewriteinputer vtbline">
    								<div class="votewritefield">
    									<img class="votemark" src="/app/images/mark_03.png" /> 
        								<span class="stress question_field">질문</span> 
        								<a class="upPosMobile" href="javascript:void(0)">
        									<img class="bcontrol rightbutton" src="/app/images/upPos.png" />
        								</a>
        								<a class="downPosMobile" href="javascript:void(0)">
        									<img class="bcontrol rightbutton" src="/app/images/downPos.png" />
        								</a>		
        							</div>
    								<div class="votewriteinputbox">
    									<div class="inputcontli vbspace">
    										<input type="text" class="question_subject" name="question_subject" value="<?php echo($question_subject); ?>" placeholder="질문을 입력하세요." />
    										<a class="upPosWindow" href="javascript:void(0)">
    											<img class="rightbutton" src="/app/images/upPos.png" />
    										</a>
    										<a class="downPosWindow" href="javascript:void(0)">
    	    									<img class="rightbutton" src="/app/images/downPos.png" />
    	    								</a>		
    									</div>
    									<div class="inputconstdefault">
    										<img class="inputcontImage imageFile" src="<?php echo($question_real_path); ?>" width="315" style="<?php if ($question_resource_type != "3") echo("display:block"); else echo("display:none"); ?>" />
    										<iframe class="inputcontVideo question_VideoFile" id="question_VideoFile" src="<?php echo($question_real_path); ?>" width="315" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="<?php if ($question_resource_type == "3") echo("visibility:visible;display:block;"); else echo("visibility:hidden;display:none;"); ?>">
    										</iframe>
    										<div class="inputcontcheckbox">
    											<input type="radio" class="agree question_resource_type_00" name="question_resource_type[]" value="0" <?php if ($question_resource_type == "0") { ?> checked <?php } else if ($vote_real_type == "") {?> checked <?php } ?> />
    											<label class="question_resource_label_00" for="question_resource_type_04">
    												<span>사진/동영상 없음</span>
    											</label>
    											<input type="radio" class="agree question_resource_type_01" name="question_resource_type[]" value="1" <?php if ($question_resource_type == "1") { ?> checked <?php } ?> />
    											<label class="question_resource_label_01" for="question_resource_type_05">
    												<span>사진 업로드</span>
    											</label>
    											<input type="radio" class="agree question_resource_type_02" name="question_resource_type[]" value="2" <?php if ($question_resource_type == "2") { ?> checked <?php } ?> />
    											<label class="question_resource_label_02" for="question_resource_type_06">
    												<span>사진 URL</span>
    											</label>
    											<input type="radio" class="agree question_resource_type_03" name="question_resource_type[]" value="3" <?php if ($question_resource_type == "3") { ?> checked <?php } ?> />
    											<label class="question_resource_label_03" for="question_resource_type_07">
    												<span>동영상 URL</span>
    											</label>
    										</div>
    										<input type="text" class="voteinputshort vrspace vbspace vote_question_resource_url" name="vote_question_resource_url[]" value="<?php echo($question_resource_path); ?>" style="<?php if ($question_resource_type == "2" || $question_resource_type == "3") echo("display:block"); else echo("display:none"); ?>" />	
    										<button type="button" class="votebutton fileupload" style="<?php if ($question_resource_type == "1") echo("display:block"); else echo("display:none"); ?>" >
    											<img src="/app/images/up.png"/>
    											<span>사진파일선택</span>
    										</button>
    										<button type="button" class="votebutton question_resource_view" style="<?php if ($question_resource_type == "2" || $question_resource_type == "3") echo("display:block"); else echo("display:none"); ?>" >
                                        		<span>등록</span>
                                            </button>
    										<select class="question_answer_kind rightbutton vrspace" name="question_answer_kind">
        										<option value="0">-응답종류 선택-</option>
        										<option value="1" <?php if ($question_resp_type == "1") echo("selected"); ?>>단일 응답</option>
        										<option value="2" <?php if ($question_resp_type == "2") echo("selected"); ?>>복수 응답</option>
        										<option value="3" <?php if ($question_resp_type == "3") echo("selected"); ?>>단일 응답 / 참여자 신규 응답 추가</option>
        										<option value="4" <?php if ($question_resp_type == "4") echo("selected"); ?>>복수 응답 / 참여자 신규 응답 추가</option>
        										<option value="5" <?php if ($question_resp_type == "5") echo("selected"); ?>>참여자 응답 추가</option>
        									</select>
    									</div>
    								</div>
    							</div>
    							<!-- 질문 데이터 영역의 응답 영역 시작 -->
    							<div class="votewriteinputer">
    								<ul id="answer_lst" class="answer_lst">
    									<!-- 질문 데이터 영역의 응답 영역 샘플 시작 -->
    									<li class="answer_lst_item" style="display: none">
    										<input class="answer_seq" type="hidden" name="answer_seq" />
    										<input class="answer_index" type="hidden" name="answer_index" />
    										<input class="answer_temp_path" type="hidden" name="answer_temp_path" value="" />
											<input class="answer_real_name" type="hidden" name="answer_real_name" value="" />
											<input type="hidden" class="vote_answer_resource_type" name="vote_answer_resource_type" />
    										<div class="votewritefield">
    											<img class="votemark" src="/app/images/mark_03.png" /> 
        										<span class="stress">응답</span> 
        										<a class="appendAnswer mobilePlus" href="javascript:void(0)"> 
        											<img class="bcontrol" src="/app/images/bplus.jpg" />
        										</a> 
        										<a class="removeAnswer mobileMinus" href="javascript:void(0)"> 
        											<img class="bcontrol" src="/app/images/bminus.jpg" />
        										</a>										
            								</div>
    										<div class="votewriteinputbox">
    											<div class="inputcontli vbspace">
    												<input type="text" class="answer_subject" name="answer_subject" placeholder="응답을 입력하세요." />
    												<a class="removeAnswer windowMinus" href="javascript:void(0)"> 
    													<img src="/app/images/bminus.jpg" />
    												</a>
    												<a class="appendAnswer windowPlus" href="javascript:void(0)"> 
    													<img src="/app/images/bplus.jpg" />
    												</a>
    											</div>
    											<div class="inputconstdefault">
            										<img class="inputcontImage imageFile" src="/app/images/no_image.png" width="315" />
    												<iframe class="inputcontVideo answer_VideoFile" id="answer_VideoFile" src="/app/view/common/no_video.php" style="visibility:hidden;display:none;" width="315" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
    												</iframe>
    												<div class="inputcontcheckbox">
            											<label class="answer_resource_label_00" for="answer_resource_type_04">
            												<span>사진/동영상 없음</span>
            											</label>
            											<input type="radio" class="agree answer_resource_type_01" id="answer_resource_type_01" name="answer_resource_type[]" value="1" />
            											<label class="answer_resource_label_01" for="answer_resource_type_05">
            												<span>사진 업로드</span>
            											</label>
            											<input type="radio" class="agree answer_resource_type_02" id="answer_resource_type_02" name="answer_resource_type[]" value="2" />
            											<label class="answer_resource_label_02" for="answer_resource_type_06">
            												<span>사진 URL</span>
            											</label>
            											<input type="radio" class="agree answer_resource_type_03" id="answer_resource_type_03" name="answer_resource_type[]" value="3" />
            											<label class="answer_resource_label_03" for="answer_resource_type_07">
            												<span>동영상 URL</span>
            											</label>
            										</div>
    												<input type="text" class="voteinputshort vrspace vote_answer_resource_url" name="vote_answer_resource_url" style="display:none;" />
    												<button type="button" class="votebutton fileupload">
    													<img src="/app/images/up.png"/>
    													<span>사진파일선택</span>
    												</button>
    												<button type="button" class="votebutton answer_resource_view" style="display:none;">
                                                		<span>보기</span>
                                                    </button>
    												<div class="checkinput answerCorrect" style="display:none">
        												<input type="checkbox" class="agree answer_correct" id="answer_correct_02"/> 
                                    					<label class="answer_correct_label" for="answer_correct_02"> 
                                    						<span>정답 여부</span>
                                    					</label>
        											</div>
    											</div>
    										</div>
    									</li>
    									<!-- 질문 데이터 영역의 응답 영역 샘플 끝 -->
<?php
    $answers = $vote->getVoteFormAnswers($question_vote_seq, $question_seq);
    $j = 0;
    foreach ($answers as $answerItem) 
    {
        $j++;
        $answer_resource_path       = $answerItem["ANSWER_RESOURCE_PATH"];
        $answer_resource_type       = $answerItem["ANSWER_RESOURCE_TYPE"];
        $answer_seq                 = $answerItem["ANSWERS_SEQ"];
        $answer_index               = $answerItem["ANSWER_INDEX"];
        $answer_real_path           = "";
        if ($answer_resource_path == "")
        {
            if ($answer_resource_type != "3")
                $answer_real_path = "/app/images/no_image.png";
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
										<!-- 질문 데이터 영역의 응답 데이터 영역 시작 -->
    									<li class="answer_lst_item newAnswerItem">
    										<input class="answer_seq" type="hidden" name="answer_seq" value="<?php echo($answer_seq); ?>" /> 
                    						<input class="answer_index" type="hidden" name="answer_index" value="<?php echo($answer_index); ?>" />
                    						<input class="answer_temp_path" type="hidden" name="answer_temp_path" value="<?php echo($answer_resource_path); ?>" /> 
											<input class="answer_real_name" type="hidden" name="answer_real_name" value="<?php echo($answer_resource_path); ?>" />
											<input class="vote_answer_resource_type" type="hidden" name="vote_answer_resource_type[]" value="<?php echo($answer_resource_type); ?>" />
    										<div class="votewritefield">
    											<img class="votemark" src="/app/images/mark_03.png" /> 
        										<span class="stress">응답</span> 
        										<a class="appendAnswer mobilePlus" href="javascript:void(0)"> 
        											<img class="bcontrol" src="/app/images/bplus.jpg" />
        										</a> 
        										<a class="removeAnswer mobileMinus" href="javascript:void(0)"> 
        											<img class="bcontrol" src="/app/images/bminus.jpg" />
        										</a>
    										</div>
    										<div class="votewriteinputbox">
    											<div class="inputcontli vbspace">
    												<input type="text" class="answer_subject" name="answer_subject" type="text" value="<?php echo($answer_text); ?>" placeholder="응답을 입력하세요." />
    												<a class="removeAnswer windowMinus" href="javascript:void(0)">
    													<img src="/app/images/bminus.jpg" />
    												</a>
    												<a class="appendAnswer windowPlus" href="javascript:void(0)"> 
    													<img src="/app/images/bplus.jpg" />
    												</a>
    											</div>
    											<div class="inputconstdefault">
            										<img class="inputcontImage imageFile" src="<?php echo($answer_real_path); ?>"  width="315" style="<?php if ($answer_resource_type != "3") echo("display:block"); else echo("display:none"); ?>" />
    												<iframe class="inputcontVideo answer_VideoFile" id="answer_VideoFile" src="<?php echo($answer_real_path); ?>" width="315" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="<?php if ($answer_resource_type == "3") echo("visibility:visible;display:block;"); else echo("visibility:hidden;display:none;"); ?>">
    												</iframe>
    												<div class="inputcontcheckbox">
    													<input type="radio" class="agree answer_resource_type_00" id="answer_resource_type_07" name="answer_resource_type[]" value="0" <?php if ($answer_resource_type == "0") { echo("checked"); } ?> />
            											<label class="answer_resource_label_00" for="answer_resource_type_08">
            												<span>사진/동영상 없음</span>
            											</label>
            											<input type="radio" class="agree answer_resource_type_01" id="answer_resource_type_07" name="answer_resource_type[]" value="1" <?php if ($answer_resource_type == "1") { echo("checked"); } ?> />
            											<label class="answer_resource_label_01" for="answer_resource_type_09">
            												<span>사진 업로드</span>
            											</label>
            											<input type="radio" class="agree answer_resource_type_02" id="answer_resource_type_08" name="answer_resource_type[]" value="2" <?php if ($answer_resource_type == "2") { echo("checked"); } ?> />
            											<label class="answer_resource_label_02" for="answer_resource_type_10">
            												<span>사진 URL</span>
            											</label>
            											<input type="radio" class="agree answer_resource_type_03" id="answer_resource_type_09" name="answer_resource_type[]" value="3" <?php if ($answer_resource_type == "3") { echo("checked"); } ?> />
            											<label class="answer_resource_label_03" for="answer_resource_type_11">
            												<span>동영상 URL</span>
            											</label>
            										</div>
    												<input type="text" class="voteinputshort vrspace vote_answer_resource_url" name="vote_answer_resource_url[]" value="<?php echo($answer_resource_path); ?>" style="<?php if ($answer_resource_type == "2" || $answer_resource_type == "3") echo("display:block"); else echo("display:none"); ?>" />
    												<button type="button" class="votebutton fileupload" style="<?php if ($answer_resource_type == "1") echo("display:block"); else echo("display:none"); ?>" >
    													<img src="/app/images/up.png"/>
    													<span>사진파일선택</span>
    												</button>
    												<button type="button" class="votebutton answer_resource_view" style="<?php if ($answer_resource_type == "2" || $answer_resource_type == "3") echo("display:block"); else echo("display:none"); ?>" >
                                                		<span>등록</span>
                                                    </button>
    												<div class="checkinput answerCorrect" style="display:none">
        												<input type="checkbox" class="agree answer_correct" id="answer_correct_03" value="<?php echo($j); ?>" <?php if ($is_correct != "" && $is_correct == "1") { echo("checked"); } ?> />
                                    					<label class="answer_correct_label" for="answer_correct_03"> 
                                    						<span>정답 여부</span>
                                    					</label>
        											</div>
    											</div>
    										</div>
    									</li>
    									<!-- 질문 데이터 영역의 응답 데이터 영역 끝 -->
<?php
    }
?>
    								</ul>
    							</div>
    							<!-- 질문 데이터 영역의 응답 영역 끝 -->
    						</div>
    					</div>
    					<!-- 질문 데이터 영역 끝 -->
<?php
}
?>
					</div>
					<div class="votewritecont">
    					<div class="appendquestion">
    						<a id="appendQuestion" href="javascript:void(0);">
    							<img src="/app/images/vote_append.jpg" />
    						</a>
    					</div>
    				</div>
<?php 
if ($vote_kind != "2")
{
?>
					<!-- 비공개 여부 시작 -->
					<div class="votewritetitle">
						<img src="/app/images/mark_02.png" />
						<span class="votedeftitle">투표 비공개 서비스(선택)</span>
					</div>
					<div class="votewritecont vtbline vtbspace">
						<div class="votewritetablebox">
							<div class="votewritetable  vtbspace">
								<div class="votewtfield">
									<div class="vtewtdefault wterline">
										<span>서비스명</span>
									</div>
									<div class="votewtlong">
										<span>서비스 내용</span>
									</div>
								</div>
								<div class="votewtcontext votewt80">
									<ul>
										<li>
											<div class="vtewtdefault wterline">
												<input class="agree" id="is_open" name="is_open" type="checkbox" value="1" />
												<label for="is_open">
													<span>투표 비공개 서비스</span>
												</label>
											</div>
											<div class="votewtlong">
												<span>투표 제작 후 제공되는 보안코드를 입력한 회원만 투표 가능(사내, 모임 등 지인끼리 투표 참여 가능)</span>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- 비공개 여부 끝 -->
<?php 
}
?>
					<div class="votewritebtncont vttspace">
    					<div class="votewritebuttonbox">
    						<div class="votewritebutton defaultbutton">
    							<span>임시저장</span>
    						</div>
    						<div class="votewritebutton defaultbutton">
    							<span>미리보기</span>
    						</div>
    						<div id="registerVote" class="votewritebutton stressbutton">
    							<span>투표등록</span>
    						</div>
    					</div>
    				</div>
				</div>
				<!-- 투표 입력란 끝 -->
			</div>
		</div>
	</form>
</div>
<!-- 파일을 업로드할 폼 -->
<form id="frmImageUpload" method="post" action="/controller.php?mode=image_vote_upload" target="uploadFrame" enctype="multipart/form-data">
	<input type="hidden" id="question_upload_index" name="question_upload_index" /> 
	<input type="hidden" id="answer_upload_index" name="answer_upload_index" /> 
	<input type="file" id="uploadName" name="uploadName" style="display: none" accept="image/*" />
</form>
<form id="frmFileUpload" method="post" action="/controller.php?mode=file_upload" target="uploadFrame" enctype="multipart/form-data">
	<input type="file" id="docFile" name="docFile" style="display: none" />
</form>
<!-- 파일을 업로드할 폼 -->
<iframe src="/" id="uploadFrame" name="uploadFrame" width="0" height="0" frameborder="0" style="width: 0px; height: 0px;"> 
</iframe>