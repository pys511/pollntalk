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
    $result                 = $vote->getVoteInfoByAdmin($vote_seq);
    //print_r($result);
    $vote_kind              = $result["VOTE_KIND"];
    $vote_type              = $result["VOTE_TYPE"];
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
    $vote_url               = $result["VOTE_URL"];
    $vote_is_open           = $result["VOTE_IS_OPEN"];   
    $vote_is_premium        = $result["VOTE_IS_PREMIUM"];
    $vote_is_event          = $result["VOTE_IS_EVENT"];
    $vote_is_hot            = $result["VOTE_IS_HOT"];
    $coupon_seq             = $result["COUPON_SEQ"];
    $vote_is_start          = $result["VOTE_IS_START"];
    $vote_view_count        = $result["VOTE_VIEW_COUNT"];
    $vote_recomm_count      = $result["VOTE_RECOMM_COUNT"];
    $vote_participant_count = $result["VOTE_PARTICIPATE_COUNT"];
    $vote_security_code     = $result["VOTE_SECURITY_CODE"];
    $vote_open_point        = $result["VOTE_OPEN_POINT"];
    $vote_resp_point        = $result["VOTE_RESP_POINT"];
    $vote_regi_date         = $result["VOTE_REGI_DATE"];
    $vote_end_date          = $result["VOTE_END_DATE"];
    $vote_security_code     = $result["VOTE_SECURITY_CODE"];
    $service_type           = $result["SERVICE_TYPE"];
    $service_type_name      = $result["SERVICE_PRODUCT_NAME"];
    $product_seq            = $result["PRODUCT_SEQ"];
    $service_price          = $result["SERVICE_PRICE"];
    $service_payment_type   = $result["SERVICE_PAYMENT_TYPE"];
    $service_account_type   = $result["SERVICE_ACCOUNT_TYPE"];
    $service_account        = $result["SERVICE_ACCOUNT"];
    $service_payer          = $result["SERVICE_PAYER"];
    $service_payment_date   = $result["SERVICE_PAYMENT_DATE"];
    $service_regi_date      = $result["SERVICE_REGI_DATE"];
    $service_prem_seq       = $result["SERVICE_PREM_SEQ"];
    
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
            	<form id="frmVote" method="post" action="/admin_controller.php?mode=vote_info_proc">
					<input type="hidden" id="vote_seq" name="vote_seq" value="<?php echo($vote_seq); ?>" />
					<div class="contentBox">
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> 
							<span>투표 상세 정보</span>
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
									<span>작성자</span>
								</div>
								<div class="boardInputBox">
									<input type="hidden" id="vote_writer_seq" name="vote_writer_seq" value="<?php echo($vote_writer_seq); ?>" />
									<span><?php echo($vote_writer_name); ?></span>
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
									<span>관련 링크</span>
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
									<span>설문 주소</span>
								</div>
								<div class="boardInputBox">
									<input type="text" id="vote_link_url" name="vote_link_url" class="longInput" value="http://www.pollntalk.com/govote.php?vote_seq=<?php echo($vote_seq); ?>" />
    							</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>투표 보안코드</span>
								</div>
								<div class="boardInputBox">
									<input type="text" id="vote_security_code" name="vote_security_code" class="middleInput" value="<?php echo($vote_security_code); ?>" />
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
							<div class="boardWriteItem">
								<div class="boardName">
									<span>마감일</span>
								</div>
								<div class="boardInputBox">
									<input type="text" class="defaultInput calendarbox" id="calendarbox" name="vote_end_date" value="<?php echo($vote_end_date); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>등록일</span>
								</div>
								<div class="boardInputBox">
									<span><?php echo($vote_regi_date); ?></span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>비공개 여부</span>
								</div>
								<div class="boardInputBox">
									<input type="radio" name="is_open" id="is_open1" value="1" <?php if ($vote_is_open == "1") echo("checked"); ?> /> 
									<label for="votekind1"> 
										<span>비공개 투표</span>
									</label> 
									<input type="radio" name="is_open" id="is_open2" value="0" <?php if ($vote_is_open == "0") echo("checked"); ?> />
									<label for="votekind2"> 
										<span>공개 투표</span>
									</label>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>개시 여부</span>
								</div>
								<div class="boardInputBox">
									<input type="hidden" id="is_start" name="is_start" value="<?php echo($vote_is_start); ?>" />
									<input type="radio" name="is_start_val[]" id="is_start1" value="1" <?php if ($vote_is_start == "1") echo("checked"); ?> /> 
									<label for="votekind1"> 
										<span>개시</span>
									</label> 
									<input type="radio" name="is_start_val[]" id="is_start2" value="0" <?php if ($vote_is_start == "0") echo("checked"); ?> />
									<label for="votekind2"> 
										<span>미개시</span>
									</label>
								</div>
							</div>
<?php 							
//이벤트일 경우 쿠폰 설정
if ($vote_kind != "2")
{
?>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>프리미엄 서비스 여부</span>
								</div>
								<div class="boardInputBox">
									<input type="checkbox" name="is_premium" id="s_premium1" value="1" <?php if ($vote_is_premium == "1") echo("checked"); ?> /> 
									<label for="votekind1"> 
										<span>프리미엄 서비스</span>
									</label> 
								</div>
							</div>
<?php
}

//포인트 설정
//설문 개설 포인트
$voteOpenPoint  = "";
$pointCtrl      = new CApp_Handler_Point_Ctrl();
$pointOpenInfo  = $pointCtrl->getPointByPosition("101");
$voteOpenPoint  = $pointOpenInfo["POINT"];
if ($vote_open_point != "")
    $voteOpenPoint  = $vote_open_point;
?>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>설문 개설 포인트</span>
								</div>
								<div class="boardInputBox">
									<input type="hidden" id="vote_origin_open_point" name="vote_origin_open_point" value="<?php echo($pointOpenInfo["POINT"]);?>" />
									<input type="text" id="vote_open_point" name="vote_open_point" class="defaultInput" value="<?php echo($voteOpenPoint); ?>" />
								</div>
							</div>
<?php 
//설문 응답 포인트 
$voteRespPoint  = "";
$pointRespInfo  = $pointCtrl->getPointByPosition("102");
$voteRespPoint  = $pointRespInfo["POINT"];
if ($vote_resp_point != "")
    $voteRespPoint  = $vote_resp_point;
?>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>응답 포인트</span>
								</div>
								<div class="boardInputBox">
									<input type="hidden" id="vote_origin_resp_point" name="vote_origin_resp_point" value="<?php echo($pointRespInfo["POINT"]);?>" />
									<input type="text" id="vote_resp_point" name="vote_resp_point" class="defaultInput" value="<?php echo($voteRespPoint); ?>" />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>핫이슈 투표 여부</span>
								</div>
								<div class="boardInputBox">
									<input type="checkbox" name="is_hot" id="is_hot" value="1" <?php if ($vote_is_hot == "1") echo("checked"); ?> /> 
									<label for="is_hot"> 
										<span>핫이슈 투표 설정</span>
									</label> 
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>이벤트 내용 여부</span>
								</div>
								<div class="boardInputBox">
									<input type="checkbox" name="is_event" id="is_event" value="1" <?php if ($vote_is_event == "1") echo("checked"); ?> /> 
									<label for="is_event"> 
										<span>이벤트 내용 있음</span>
									</label> 
								</div>
							</div>
						</div>
						<div class="boardListButtonBox">
							<div class="buttonBox">
								<a href="/admin_manager.php?mode=voteview&vote_seq=<?php echo($vote_seq); ?>">
									<span class="buttonText">투표 내용 보기</span>
								</a>
							</div>
							<div class="buttonBox">
								<a href="/admin_manager.php?mode=replylist&vote_seq=<?php echo($vote_seq); ?>">
									<span class="buttonText">댓글 보기</span>
								</a>
							</div>
						</div>
						<input type="hidden" id="vote_is_premium" name="vote_is_premium" value="<?php echo($vote_is_premium); ?>" />
<?php 
//프리미엄 서비스 중일 경우
if ($vote_is_premium == "1" || $vote_kind == "2")
{
?>
						<input type="hidden" id="service_prem_seq" name="service_prem_seq" value="<?php echo($service_prem_seq); ?>" />
						<input type="hidden" id="productSeq" name="productSeq" />						
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> 
							<span>결제 내용</span>
						</div>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>선택한 서비스</span>
								</div>
								<div class="boardInputBox">
<?php
    $product    = new CApp_Handler_Product_Ctrl();
    $service    = $product->getProductList("1");
?>
    								<select id="vote_service_seq" name="vote_service_seq">
    									<option value="-">서비스 선택</option>
<?php 
    for ($i = 0; $i < count($service); $i++)
    {
        $item           = $service[$i];
        $service_seq    = $item["SERVICE_SEQ"];
?>
										<option value="<?php echo($service_seq); ?>" <?php if ($service_type == $service_seq) echo("selected"); ?>><?php echo($item["SERVICE_NAME"]); ?></option>
<?php 
    }
?>
									</select>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>총 결제금액</span>
								</div>
								<div class="boardInputBox">
									<input type="text" class="defaultInput" id="vote_service_price" name="vote_service_price" value="<?php echo(number_format($service_price)); ?>" /> 
									<span class="won">원</span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>결제 방법</span>
								</div>
								<div class="boardInputBox">
									<input type="checkbox" class="agree" id="vote_payment_type" name="vote_payment_type" value="1" <?php if ($service_payment_type == "1") echo("checked"); ?> /> 
									<label for="vote_payment_type"><span>무통장입금</span></label>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>입금계좌</span>
								</div>
<?php
    $productCtrl        = new CApp_Handler_Product_Ctrl();
    $accountlist        = $productCtrl->getBankAccountList();
?>
								<div class="boardInputBox">
									<input type="hidden" id="bank_account_seq" name="bank_account_seq" value="<?php echo($service_account_type); ?>" />
									<select id="service_account_type" name="service_account_type">
    									<option value="-">계좌를 선택하세요.</option>
<?php 									
    for ($i = 0; $i < count($accountlist); $i++)
    {
        $accountSeq     = $accountlist[0]["ACCOUNT_SEQ"];
        $accountName    = $accountlist[0]["ACCOUNT_NAME"];
        //$accountNumber  = $accountlist[0]["ACCOUNT_NUMBER"];
?>
    									<option value="<?php echo($accountSeq); ?>" <?php if ($service_account_type == $accountSeq) echo("selected"); ?> ><?php echo($accountName);?></option>
<?php 
    }
?>	
    								</select>
    								<input type="text" class="defaultInput" id="vote_service_account" name="vote_service_account" placeholder="계좌번호" value="<?php echo($service_account); ?>" readonly />
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>입금자명</span>
								</div>
								<div class="boardInputBox">
									<input type="text" class="defaultInputs" id="vote_service_payer" name="vote_service_payer" value="<?php echo($service_payer); ?>" />
								</div>
							</div>
						</div>
<?php 
}

//이벤트일 경우 쿠폰 설정
$voteEvent          = new CApp_Handler_Vote_Eventctrl();
$result             = $voteEvent->getVoteEventInfo($vote_seq);
$voteEventSeq       = $result["VOTE_EVENT_CONTEXT_SEQ"];
$voteEventSubject   = $result["VOTE_EVENT_SUBJECT"];
$voteEventContext   = $result["VOTE_EVENT_TEXT"];
$voteEventContext   = str_replace("<br/>", "\r\n", $voteEventContext);
$votePresentPath    = $result["VOTE_PRESENT_PATH"];
if ($votePresentPath == "")
    $votePresentPath    = "/app/images/no_image.png";
$voteBannerPath     = $result["VOTE_BANNER_PATH"];
if ($voteBannerPath == "")
    $voteBannerPath     = "/app/images/no_image.png";
$voteUrl            = $result["VOTE_EVENT_URL"];
?>
						<div id="view_event" style="width:100%;float:left;<?php if($vote_is_event == "1") { echo("display:block;"); } else { echo("display:none;"); } ?>">
    						<input type="hidden" id="vote_event_context_seq" name="vote_event_context_seq" value="<?php echo($voteEventSeq); ?>" />						
    						<div class="boardTitle">
    							<img src="/app/images/admin/title_mark.gif" /> 
    							<span>이벤트 내용 정보</span>
    						</div>
    						<div class="boardBox">
    							<div class="boardWriteItem">
    								<div class="boardName">
    									<span>제목</span>
    								</div>
    								<div class="boardInputBox">
    									<input type="text" id="vote_event_subject" name="vote_event_subject" class="longInput" value="<?php echo($voteEventSubject); ?>" />
    								</div>
    							</div>
    							<div class="boardWriteItem">
    								<div class="boardName">
    									<span>내용</span>
    								</div>
    								<div class="boardImageInputBox">
    									<textarea id="vote_event_context" name="vote_event_context" cols="100" rows="21" ><?php echo($voteEventContext); ?></textarea>
    								</div>
    							</div>
    							<div class="boardWriteItem">
    								<div class="boardName">
    									<span>선물 이미지</span>
    								</div>
    								<div class="boardImageInputBox">
    									<input type="hidden" id="event_real_path" name="event_real_path" value="<?php echo($votePresentPath); ?>" />
    									<img id="event_imageFile" src="<?php echo($vote_real_name); ?>" width="160" height="160"  />
    									<div id="find_event_image" class="buttonBox">
        									<a href="javascript:void(0);">
        										<span class="buttonText">파일 업로드</span>
        									</a>
    									</div>
    								</div>
    							</div>
    							<div class="boardWriteItem">
    								<div class="boardName">
    									<span>광고 베너</span>
    								</div>
    								<div class="boardImageInputBox">
    									<input type="hidden" id="ad_real_path" name="ad_real_path" value="<?php echo($voteBannerPath); ?>" />
    									<img id="ad_imageFile" src="<?php echo($voteBannerPath); ?>" width="160" height="160"  />
    									<div id="find_ad_image" class="buttonBox">
        									<a href="javascript:void(0);">
        										<span class="buttonText">파일 업로드</span>
        									</a>
    									</div>
    								</div>
    							</div>
    							<div class="boardWriteItem">
    								<div class="boardName">
    									<span>홍보 동영상</span>
    								</div>
    								<div class="boardInputBox">
    									<input type="text" id="event_movie_url" name="event_movie_url" class="longInput" value="<?php echo($voteUrl); ?>" />
    								</div>
    							</div>
    						</div>
						</div>
<?php 
//이벤트일 경우 쿠폰 설정
if ($vote_kind == "2")
{
    $coupon     = new CApp_Handler_Coupon_Ctrl();
    $result     = $coupon->getCouponInfo($coupon_seq);
    
    $coupon_seq         = $result["COUPON_SEQ"];
    $coupon_index       = $result["COUPON_INDEX"];
    $coupon_name        = $result["COUPON_NAME"];
    $coupon_count       = $result["COUPON_COUNT"];
    $coupon_ext_count   = $result["COUPON_EXT_COUNT"];
    $coupon_expire_date = $result["COUPON_EXPIRE_DATE"];
?>
						<input type="hidden" id="coupon_Seq" name="coupon_Seq" />						
						<div class="boardTitle">
							<img src="/app/images/admin/title_mark.gif" /> 
							<span>이벤트 쿠폰 정보</span>
						</div>
						<div class="boardBox">
							<div class="boardWriteItem">
								<div class="boardName">
									<span>쿠폰 번호</span>
								</div>
								<div class="boardInputBox">
									<input type="text" class="defaultInputs" id="coupon_index" name="coupon_index" value="<?php echo($coupon_index); ?>" />
									<div id="searchCoupon" class="buttonBox" style="display:block;">
										<a href="javascript:void(0);">
											<span class="buttonText">쿠폰 조회</span>
										</a>
									</div>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>쿠폰 이름</span>
								</div>
								<div class="boardInputBox">
									<a href="/admin_manager.php?mode=couponregister&coupon_seq=<?php echo($coupon_seq); ?>">
										<span id="coupon_name"><?php echo($coupon_name); ?></span>
									</a>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>쿠폰 가능 인원</span>
								</div>
								<div class="boardInputBox">
									<span id="coupon_count"><?php echo($coupon_count); ?></span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>쿠폰 잔량</span>
								</div>
								<div class="boardInputBox">
									<span id="coupon_ext_count"><?php echo($coupon_ext_count); ?></span>
								</div>
							</div>
							<div class="boardWriteItem">
								<div class="boardName">
									<span>유효 기간</span>
								</div>
								<div class="boardInputBox">
									<span id="coupon_expire_date"><?php echo($coupon_expire_date); ?></span>
								</div>
							</div>
						</div>
<?php 
}
?>
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
<?php
require_once ('./app/view/admin/footer.php');
?>
	<!-- 파일을 업로드할 폼 -->
	<form id="frmImageUpload" method="post" action="/admin_controller.php?mode=image_vote_upload" target="uploadFrame" enctype="multipart/form-data">
		<input type="hidden" id="question_upload_index" name="question_upload_index" /> 
		<input type="hidden" id="answer_upload_index" name="answer_upload_index" /> 
		<input type="file" id="uploadName" name="uploadName" style="display: none" accept="image/*" />
	</form>
	<form id="frmEventImage" method="post" action="/controller.php?mode=event_image_upload" target="uploadFrame" enctype="multipart/form-data">
		<input type="file" id="eventImageFile" name="eventImageFile" style="display: none" />
    </form>
    <form id="frmBannerImage" method="post" action="/controller.php?mode=banner_image_upload" target="uploadFrame" enctype="multipart/form-data">
    	<input type="file" id="bannerImageFile" name="bannerImageFile" style="display: none" />
    </form>
	<!-- admin 정보 등록 js -->
	<script type="text/javascript" src="/app/js/calendar.js?v=1.4" charset="utf-8">
	</script>
	<script type="text/javascript" src="/app/js/admin_vote_info.js?v=1.8" charset="utf-8">
	</script>
	<!-- admin 정보 등록 js -->
	<iframe src="/" id="uploadFrame" name="uploadFrame" width="0" height="0" frameborder="0" style="width: 0px; height: 0px;"> 
	</iframe>
	<div id="popupBox" style="display: none;">
	</div>
</body>
</html>