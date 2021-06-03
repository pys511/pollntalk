<?php
try
{
    $vote_seq               = $_GET["vote_seq"];
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
    $coupon_seq             = $result["COUPON_SEQ"];
    $vote_participant_count = $result["VOTE_PARTICIPATE_COUNT"];
    $vote_open_point        = $result["VOTE_OPEN_POINT"];
    $vote_resp_point        = $result["VOTE_RESP_POINT"];
    $vote_is_open           = $result["VOTE_IS_OPEN"];
    $vote_is_premium        = $result["VOTE_IS_PREMIUM"];
    $vote_end_date          = $result["VOTE_END_DATE"];
    $vote_url               = $result["VOTE_URL"];
    $vote_is_event          = $result["VOTE_IS_EVENT"];
    $vote_security_code     = $result["VOTE_SECURITY_CODE"];
    
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
<!-- 투표 정보 보기 시작 -->
<div class="votewritetitle">
	<img src="/app/images/mark_05.jpg" />
	<span>투표 정보</span>
</div>
<div class="voteinfobox">
	<input type="hidden" id="vote_seq" name="vote_seq" value="<?php echo($vote_seq); ?>" />
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
			<span class="divtxt vvwrspace">/</span>
			<span class="strong vvwrspace">지급 포인트 : </span>
			<span class="stress vvwrspace"><?php echo($vote_open_point)?></span>
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
			<span class="strong vvwrspace">설문 상태 : </span>
<?php 
if ($vote_is_open == "1")
{
?>
			<span class="stress">게시중</span>
<?php 
}
else
{
?>
			<span class="stress">미게시</span>
<?php 
}
?>
		</div>
		<div class="votebuttonbox">
			<button id="goVote" class="stressvotebutton rpos">
				<span>투표 보기</span>
			</button>
		</div>
	</div>
</div>
<!-- 투표 정보 보기 끝 -->
<?php 
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
<!-- 이벤트 투표 정보 보기 시작 -->
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
<!-- 쿠폰 정보 보기 끝 -->
<?php 
    }
}
?>
<!-- 투표 전달 방법 안내 시작 -->
<div class="votewritetitle">
	<img src="/app/images/mark_05.jpg" />
	<span>투표 전달 방법 안내</span>
</div>
<div class="votewritecont">
	<div class="voteguideitem">
		<div class="voteguidedoc">
			<div class="voteguidebox">
				<span class="guidetext">※ 투표를 전달하여 신규회원 가입 시 회원님에게 </span><span class="stress">포인트</span><span class="guidetext">가 자동 적립됩니다.</span>
			</div>
		</div>
		<div class="voteguideinputer">
			<div class="voteguidefield">
				<span>설문 주소</span>
			</div>
			<div class="voteguideinputbox">
				<input type="text" value="http://www.pollntalk.com/govote.php?vote_seq=<?php echo($vote_seq); ?>" />
				<button><span>복사</span></button>
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
				<input type="text" value="<?php echo($vote_security_code); ?>" />
				<button><span>보안코드 복사</span></button>
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
						<button class="kakao">카코오톡</button>
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
if ($vote_is_premium == "1" || $vote_kind == "2")
{
    try 
    {
        $votePremium        = new CApp_Handler_Product_Ctrl();
        $result             = $votePremium->getProductPaymentInfo($vote_seq);
        
        $paymentlog_seq     = $result["SERVICE_PAYMENT_SEQ"];
        $product_seq        = $result["PRODUCT_SEQ"];
        $product_name       = $result["SERVICE_NAME"];
        $service_type       = $result["SERVICE_TYPE"];
        $account_type_name  = $result["ACCOUNT_TYPE_NAME"];
        $end_date           = $result["SERVICE_END_DATE"];
        $account_name       = $result["ACCOUNT_NAME"];
        $account            = $result["SERVICE_ACCOUNT"];
        $price              = $result["SERVICE_PRICE"];
        $payer              = $result["SERVICE_PAYER"];
    }
    catch (CException $ex) 
    {
        $ex->executeException();
    }
?>
<!-- 결제내역 시작 -->
<input type="hidden" id="paymentlog_seq" name="paymentlog_seq" value="<?php echo($paymentlog_seq); ?>" />
<input type="hidden" id="product_seq" name="product_seq" value="<?php echo($product_seq); ?>" />
<div class="votewritetitle">
	<img src="/app/images/mark_07.jpg" />
	<span>결제내역 안내</span>
</div>
<div class="votewritecont vtbspace">
	<div class="paybox">
		<div class="payconttable vtbspace">
			<ul>
				<li>
					<div class="paycontfield pcrline pcbline">
						<span>신청 서비스</span>
					</div>
					<div class="paycontdatabox">
						<div class="paycontdefault pcrline pcmrline pcbline paycontm71">
							<span><?php echo($product_name); ?></span>
						</div>
						<div class="payconteshort pcbline paycontm71">
							<span><?php echo(number_format($price)); ?>원</span>
						</div>
					</div>
				</li>
				<li>
					<div class="paycontfield pcrline pcbline">
						<span>총 결제내역</span>
					</div>
					<div class="paycontdatabox">
						<div class="paycontdefault pcrline pcbline">
							<span>&nbsp;</span>
						</div>
						<div class="payconteshort pcbline">
							<span class="stress"><?php echo(number_format($price)); ?></span><span>원</span>
						</div>
					</div>
				</li>
				<li>
					<div class="paycontfield pcrline pcbline pccontw90">
						<span>결제방법</span>
					</div>
					<div class="paycontdatabox">
						<div class="paycontdatali pcbline">
							<span><?php echo($account_type_name); ?></span>
						</div>
						<div class="paycontdatali pcbline">
							<span><?php echo($account_name); ?> <?php echo($account); ?></span>
						</div>
					</div>
				</li>
				<li>
					<div class="paycontfield pcrline pcbwline">
						<span>입금자 명</span>
					</div>
					<div class="paycontdatabox">
						<div class="paycontdefault pcrline">
							<span>&nbsp;</span>
						</div>
						<div class="payconteshort">
							<span><?php echo($payer); ?></span>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="votebuttonlonglongbox">
			<button class="stressvotebutton rpos">
				<span>세금계산서 신청</span>
			</button>
		</div>
	</div>
</div>
<!-- 결제내역 안내 끝 -->
<?php 
}
?>