<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20200809
 *  투표 정보 등록 처리
 */
try
{
    //exit;
    $vote       = new CApp_Handler_Vote_Ctrl();
    $array      = $_POST;
    
    $vote_seq   = $_GET["vote_seq"];
    //$vote_seq   = $vote->registerVote($array);
    $dateValue  = date("d");
    $pointID    = $vote_seq;
    $pubKey		= "pollntalk";
    $privKey	= $vote_seq;
    
    $securityCode   = CCore_Lib_Util_Crypto::instance()->encrypt($pointID, $pubKey, $privKey);
    $securityCode   = str_replace("=", "", $securityCode);
    $result         = $vote->updateSecurityCode($vote_seq, $securityCode);
    
    $vote_kind  = $array["vote_kind"];
    //echo($vote_kind);
    if (!$vote_seq)
    {
        $voteformseq        = $_POST["voteformseq"];
        $backUrl            = "/index.php?mode=votewrite";
        if ($voteformseq != "")
            $backUrl        .= "&vote_form_seq=".$voteformseq;
?>
<script>
		alert("등록하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "<?php echo($backUrl); ?>";
</script>
<?php
    }
    
    $result         = $vote->getVoteInfo($vote_seq);
    $vote_kind      = $result["VOTE_KIND"];
    $voteEndDate    = $result["VOTE_END_DATE"];
    $vote_type      = $result["VOTE_TYPE"];
    $vote_is_event  = $result["VOTE_IS_EVENT"];
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
	<form id="frmVote" method="post" action="/controller.php?mode=vote_register_proc">
		<input type="hidden" id="vote_seq" name="vote_seq" value="<?php echo($vote_seq); ?>" />
		<input type="hidden" id="member_seq" name="member_seq" value="<?php echo($_SESSION["member_seq"]); ?>" />
		<input type="hidden" id="productSeq" name="productSeq" />
		<input type="hidden" id="vote_end_date" name="vote_end_date" value="<?php echo($voteEndDate); ?>" />
		<input type="hidden" id="service_type" name="service_type" value="<?php echo($vote_type); ?>" />
		<input type="hidden" id="is_event" name="is_event" value="<?php echo($vote_is_event); ?>" /> 
    	<div class="votewritearea">
    		<div class="votewritebox">
    			<!-- 투표 완료 설명 시작 -->
    			<div class="voteguidedoc">
    				<div class="voteguidebox">
    					<p>
    						<span class="title">투표 제작이 완료 되었습니다.</span>
    					</p>
    					<p>
    						<span class="guidetext">투표는 </span>
    						<span class="stress">마이페이지</span>
    						<span class="guidetext">에서 조회할 수 있으며 게시된 투표함은 수정할 수 없습니다.</span>
    					</p>
    				</div>
    			</div>
    			<!-- 투표 완료 설명 끝 -->
    			<!-- 안내 시작 -->
    			<div class="votewrite">
    				<!-- 투표 전달 방법 안내 시작 -->
    				<div class="votewritetitle">
    					<img src="/app/images/mark_05.jpg" /> 
    					<span class="votedeftitle">투표 전달 방법 안내</span>
    				</div>
    				<div class="votewritecont">
    					<div class="voteguideitem">
    						<div class="voteguidedoc">
    							<div class="voteguidebox">
    								<span class="guidetext">※ 투표를 전달하여 신규회원 가입 시 회원님에게 </span>
    								<span class="stress">포인트</span>
    								<span class="guidetext">가 자동 적립됩니다.</span>
    							</div>
    						</div>
    						<div class="voteguideinputer">
    							<div class="voteguidefield">
    								<span>설문 주소</span>
    							</div>
    							<div class="voteguideinputbox">
    								<input type="text" id="vote_link_url" name="vote_link_url" value="http://www.pollntalk.com/govote.php?vote_seq=<?php echo($vote_seq); ?>" />
    								<button type="button" onclick="copyClipboard('vote_link_url');">
    									<span>복사</span>
    								</button>
    							</div>
    						</div>
<?php 
if ($vote_kind == "1")
{
?>
    						<div class="voteguideinputer">
    							<div class="voteguidefield">
    								<span>투표 보안코드</span>
    							</div>
    							<div class="voteguideinputbox">
    								<input type="text" id="vote_security_code" name="vote_security_code" value="<?php echo($securityCode); ?>" />
    								<button type="button" onclick="copyClipboard('vote_security_code');">
    									<span>보안코드 복사</span>
    								</button>
    							</div>
    						</div>
<?php 
}
?>
    						<div class="voteguidebuttoncont">
    							<div class="voteguidebuttonbox">
    								<div class="voteguidebtn">
    									<div class="voteguidebtnfield">
    										<span>전달/공유</span>
    									</div>
    									<div class="voteguidebutton">
    										<button class="kakao">카카오톡</button>
    										<button class="facebook">페이스북</button>
    										<button class="linkedin">링크드인</button>
    										<button class="mail">메일</button>
    									</div>
    								</div>
    								<div class="voteguidebtndoc">
    									<span>※ 투표가 게시된 후에 투표 코드 및 보안 코드를 사용하실 수 있습니다.</span>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>
    				<!-- 투표 전달 방법 안내 끝 -->
<?php 
$product    = new CApp_Handler_Product_Ctrl();
if ($vote_kind == "1")
{
?>
    				<!-- 프리미엄 서비스 안내 시작 -->
    				<div class="votewritetitle">
    					<img src="/app/images/mark_06.jpg" /> 
    					<span class="votedeftitle">프리미엄 서비스 안내</span>
    				</div>
    				<div class="votewritecont">
    					<div class="votewritetablebox">
    						<div class="votewritetable">
    							<div class="votewtfield">
    								<div class="vtewtshort wterline">
    									<span>서비스명</span>
    								</div>
    								<div class="votewtcont wterline">
    									<span>서비스 내용</span>
    								</div>
    								<div class="vtewtshort">
    									<span>가격</span>
    								</div>
    							</div>
    							<div class="votewtcontext votewt240">
    								<ul>
    									<li>
    										<div class="vtewtshort wterline">
    											<input class="agree" id="vote_is_preminum" name="vote_is_preminum" type="checkbox" /> 
    											<label for="vote_is_preminum"><span>프리미엄 서비스</span></label>
    										</div>
    										<div class="votewtcont wterline">
    											<ul style="padding:3px 3px 3px 3px">
    												<li>메인 페이지 투표 상단 배치 (프리미엄 투표)</li>
    												<li>서브 페이지 투표 상단 배치 (프리미엄 투표)</li>
    												<li>투표 테두리 강조 효과</li>
    												<li>회원 전원에게 투표 메일 / 쪽지 발송 홍보</li>
    												<li>투표 통계 현황 조회</li>
    											</ul>
    										</div>
    										<div class="vtewtshort">
<?php
    $service    = $product->getProductList("1");
?>
    											<select id="vote_service_seq" name="vote_service_seq">
    												<option value="-">서비스 선택</option>
<?php 
    for ($i = 0; $i < count($service); $i++)
    {
        $item   = $service[$i];
?>
    												<option value="<?php echo($item["SERVICE_SEQ"]); ?>"><?php echo($item["SERVICE_NAME"]); ?></option>
<?php 
    }
?>
    											</select>
    										</div>
    									</li>
    								</ul>
    							</div>
    						</div>
    					</div>
    				</div>
<?php 
}
else 
{
    if ($vote_is_event == "1")
    {
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
					<!-- 이벤트 정보 시작 -->
					<input type="hidden" id="vote_event_context_seq" name="vote_event_context_seq" value="<?php echo($voteEventSeq);?>" />
					<div class="votewritetitle">
						<img src="/app/images/mark_01.png" />
						<span class="votedeftitle">이벤트 내용 작성</span>
						<span class="altright semistress">빨간색 : 필수항목</span>
					</div>
					<div class="votewritecont vtallline">
						<div class="votewritecontitem">
							<div class="votewriteinputer vtbline">
								<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span class="stress">제목</span>
    							</div>
    							<div class="votewriteinputbox">
									<div class="inputcont">
										<input type="text" class="voteinputlong" id="vote_event_subject" name="vote_event_subject" value="" placeholder="이벤트 제목을 입력하세요." value="<?php echo($voteEventSubject); ?>" />
									</div>
								</div>
							</div>
							<div class="votewriteinputer vtbline">
								<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span class="stress">내용</span>
    							</div>
								<div class="votewriteinputbox">
									<div class="inputcont">
										<textarea id="vote_event_context" name="vote_event_context" rows="13" placeholder="■내용&#13;&#10;- 이벤트 내용을 기재하세요.&#13;&#10;■선물&#13;&#10;- 이벤트 선물을 기재하세요.&#13;&#10;■선물 제공 인원&#13;&#10;- 이벤트 선물을 기재하세요.&#13;&#10;■응모 기간&#13;&#10;- 시작일 / 종료일을 기재하세요.&#13;&#10;■응모 자격&#13;&#10;- 응모 자격 내용을 기재하세요.&#13;&#10;■당첨 기준&#13;&#10;- 당첨 기준 내용을 기재하세요.&#13;&#10;■당첨 기준&#13;&#10;- 당첨 기준 내용을 기재하세요.&#13;&#10;■당첨 발표일&#13;&#10;- 당첨 발표일을 기재하세요.&#13;&#10;■당첨 발표 장소&#13;&#10;- 당첨 발표 장소를 기재하세요.&#13;&#10;■선물 제공 방법&#13;&#10;- 선물 제공 방법을 기재하세요.&#13;&#10;"><?php echo($voteEventContext); ?></textarea>
									</div>
								</div>
							</div>
							<div class="votewriteinputer vtbline">
    							<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span class="stress">선물 이미지</span>
    							</div>
    							<div class="votewriteinputbox">
    								<div class="inputconstdefault">
    									<img class="inputcontImage event_imageFile" id="event_imageFile" src="<?php echo($votePresentPath); ?>" width="225" />
    									<input type="hidden" id="event_real_path" name="event_real_path" value="<?php echo($votePresentPath); ?>" />
    									<button type="button" id="find_event_image" class="votebutton">
    										<img src="/app/images/up.png" /> 
    										<span>이미지 파일 선택</span>
    									</button>
    								</div>
    							</div>
    						</div>
    						<div class="votewriteinputer vtbline">
    							<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span>광고 배너</span>
    							</div>
    							<div class="votewriteinputbox">
    								<div class="inputconstdefault">
    									<img class="inputcontImage ad_imageFile" id="ad_imageFile" src="<?php echo($voteBannerPath); ?>" width="225" />
    									<input type="hidden" id="ad_real_path" name="ad_real_path" value="<?php echo($voteBannerPath); ?>" />
    									<button type="button" id="find_ad_image" class="votebutton">
    										<img src="/app/images/up.png" /> 
    										<span>이미지 파일 선택</span>
    									</button>
    								</div>
    							</div>
    						</div>
    						<div class="votewriteinputer">
    							<div class="votewritefield">
    								<img class="votemark" src="/app/images/mark_03.png" /> 
    								<span>홍보 동영상</span>
    							</div>
    							<div class="votewriteinputbox">
    								<div class="inputcont">
    									<input type="text" id="event_movie_url" name="event_movie_url" placeholder="홍보 동영상 유튜브 주소" value="<?php echo($voteUrl); ?>" />
    								</div>
    							</div>
    						</div>
    					</div>
					</div>
					<!-- 이벤트 정보 끝 -->
<?php 
    }
?>					
					<!-- 이벤트 결제 안내 시작 -->
    				<div class="votewritetitle">
    					<img src="/app/images/mark_06.jpg" /> 
    					<span class="votetitle">이벤트 서비스 안내</span>
    				</div>
    				<div class="votewritecont">
    					<div class="votewritetablebox">
    						<div class="votewritetable">
    							<div class="votewtfield">
    								<div class="vtewtshort wterline">
    									<span>서비스명</span>
    								</div>
    								<div class="votewtcont wterline">
    									<span>서비스 내용</span>
    								</div>
    								<div class="vtewtshort">
    									<span>가격</span>
    								</div>
    							</div>
    							<div class="votewtcontext votewt240">
    								<ul>
    									<li>
    										<div class="vtewtshort wterline">
    											<input class="agree" id="vote_is_preminum" name="vote_is_preminum" type="checkbox" /> 
    											<label for="vote_is_preminum"><span>이벤트 서비스</span></label>
    										</div>
    										<div class="votewtcont wterline">
    											<ul style="padding:3px 3px 3px 3px">
    												<li>메인 페이지 투표 상단 배치 (이벤트 투표)</li>
    												<li>투표 테두리 강조 효과</li>
    												<li>회원 전원에게 투표 메일 / 쪽지 발송 홍보</li>
    												<li>투표 페이지에 홍보/광고 베너 및 홍보 동영상 게시</li>
    												<li>투표 통계 현황 조회</li>
    											</ul>
    										</div>
    										<div class="vtewtshort">
<?php
    $service    = $product->getProductList("2");
?>
    											<select id="vote_service_seq" name="vote_service_seq">
    												<option value="-">서비스 선택</option>
<?php 
    for ($i = 0; $i < count($service); $i++)
    {
        $item   = $service[$i];
?>
    												<option value="<?php echo($item["SERVICE_SEQ"]); ?>"><?php echo($item["SERVICE_NAME"]); ?></option>
<?php 
    }
?>
    											</select>
    										</div>
    									</li>
    								</ul>
    							</div>
    						</div>
    					</div>
    				</div>
    				<!-- 이벤트 결제 안내 끝 -->
<?php 
}
?>
    				<div id="paymentbox" class="votewritecont vtbline" style="display:none">
    					<div class="paybox">
    						<div class="paytable vtbspace">
    							<ul>
    								<li>
    									<div class="payfield">
    										<span class="stress">총 결제금액</span>
    									</div>
    									<div class="payinputer">
    										<input type="text" class="payinputshort" id="vote_service_price" name="vote_service_price" readonly /> 
    										<span class="won">원</span>
    									</div>
    								</li>
    								<li>
    									<div class="payfield">
    										<span>결제 방법</span>
    									</div>
    									<div class="payinputer">
    										<input type="checkbox" class="agree" id="vote_payment_type" name="vote_payment_type" value="1" /> 
    										<label for="vote_payment_type"><span>무통장입금</span></label>
    									</div>
    								</li>
    								<li>
    									<div class="payfield">
    										<span>입금계좌</span>
    									</div>
    									<div class="payinputer">
<?php
$accountlist    = $product->getBankAccountList();
?>
    										<input type="hidden" id="bank_account_seq" name="bank_account_seq" />
    										<select id="service_account_type" name="service_account_type">
    											<option value="-">계좌를 선택하세요.</option>
<?php 									
for ($i = 0; $i < count($accountlist); $i++)
{
    $accountSeq     = $accountlist[0]["ACCOUNT_SEQ"];
    $accountName    = $accountlist[0]["ACCOUNT_NAME"];
    //$accountNumber  = $accountlist[0]["ACCOUNT_NUMBER"];
?>
												<option value="<?php echo($accountSeq); ?>" ><?php echo($accountName);?></option>
<?php 
}
?>												
    										</select> 
    										<input type="text" class="payinputlong" id="vote_service_account" name="vote_service_account" placeholder="계좌번호" readonly />
    									</div>
    								</li>
    								<li>
    									<div class="payfield">
    										<span>입금자명</span>
    									</div>
    									<div class="payinputer">
    										<input type="text" class="payinputshort" id="vote_service_payer" name="vote_service_payer" />
    									</div>
    								</li>
    							</ul>
    						</div>
    					</div>
    				</div>
    				<!-- 프리미엄 서비스 안내 끝 -->
    				<div class="votewritebtncont vttspace">
    					<div class="votewritebuttonbox">
    						<div class="votewritebutton defaultbutton">
    							<span>홈으로</span>
    						</div>
    						<div class="votewritebutton defaultbutton">
    							<a href="/?mode=mypage&sub=vote&votesub=info&vote_seq=<?php echo($vote_seq); ?>">
    								<span>마이페이지</span>
    							</a>
    						</div>
    						<?php 
    						  if($_SESSION["cert"] == "1"){
    						?>
    							<div class="votewritebutton stressbutton" id="payProduct" name="payProduct">
    								<span>결제하기</span>
    							</div>
    						<?php
    						  }else{
    						?>
    							<div class="votewritebutton stressbutton" id="payProductCert" name="payProductCert">
    								<span>결제하기</span>
    							</div>
    						<?php
    						  }
    						?>
    					</div>
    				</div>
    				<!-- 결제내역 끝 -->
    			</div>
    			<!-- 안내 끝 -->
    		</div>
    	</div>
    </form>
</div>
<!-- 파일을 업로드할 폼 -->
<form id="frmEventImage" method="post" action="/controller.php?mode=event_image_upload" target="uploadFrame" enctype="multipart/form-data">
	<input type="file" id="eventImageFile" name="eventImageFile" style="display: none" />
</form>
<form id="frmBannerImage" method="post" action="/controller.php?mode=banner_image_upload" target="uploadFrame" enctype="multipart/form-data">
	<input type="file" id="bannerImageFile" name="bannerImageFile" style="display: none" />
</form>
<!-- 파일을 업로드할 폼 -->
<iframe src="/" id="uploadFrame" name="uploadFrame" width="0" height="0" frameborder="0" style="width: 0px; height: 0px;"> 
</iframe>