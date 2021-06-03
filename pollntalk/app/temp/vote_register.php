<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20200809
 *  투표 정보 등록 처리
 */
try
{
    //print_r($_POST);
    //exit;
    $vote       = new CApp_Handler_Vote_Ctrl();
    $array      = $_POST;
    
    $vote_seq   = $_GET["vote_seq"];
    //$vote_seq   = $vote->registerVote($array);
    $pointID    = "pollntalk".$vote_seq;
    $pubKey		= "pollntalk";
    $privKey	= $vote_seq;
    
    $securityCode   = CCore_Lib_Util_Crypto::instance()->encrypt($pointID, $pubKey, $privKey);
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
    					<span class="votetitle">투표 전달 방법 안내</span>
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
    								<button>
    									<span>복사</span>
    								</button>
    							</div>
    						</div>
    						<div class="voteguideinputer">
    							<div class="voteguidefield">
    								<span>투표 보안코드</span>
    							</div>
    							<div class="voteguideinputbox">
    								<input type="text" id="vote_security_code" name="vote_security_code" value="<?php echo($securityCode); ?>" />
    								<button>
    									<span>보안코드 복사</span>
    								</button>
    							</div>
    						</div>
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
    				<!-- 프리미엄 서비스 안내 시작 -->
    				<div class="votewritetitle">
    					<img src="/app/images/mark_06.jpg" /> 
    					<span class="votetitle">프리미엄 서비스 안내</span>
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
    											<dl>
    												<dt>[Basic]</dt>
    												<dd>각 페이지에 투표 상단 배치 (프리미엄 투표)</dd>
    												<dt>[Extra]</dt>
    												<dd>Basic + 검색 결과 페이지에 투표 상단 배치(프리미엄 투표)</dd>
    												<dt>[Extra Plus]</dt>
    												<dd>Extra Plus + 투표 테두리 강조</dd>
    												<dt>[VIP]</dt>
    												<dd>Extra Plus + 회원 전원에게 투표 공지 쪽지 / 이메일 발송</dd>
    											</dl>
    										</div>
    										<div class="vtewtshort">
    											<select id="vote_service_type" name="vote_service_type">
    												<option value="-">서비스 선택</option>
    												<option value="1">Basic</option>
    												<option value="2">Extra</option>
    												<option value="3">Extra Plus</option>
    												<option value="4">VIP</option>
    											</select>
    										</div>
    									</li>
    								</ul>
    							</div>
    						</div>
    					</div>
    				</div>
    				<div class="votewritecont vtbline">
    					<div class="paybox">
    						<div class="paytable vtbspace">
    							<ul>
    								<li>
    									<div class="payfield">
    										<span class="stress">총 결제금액</span>
    									</div>
    									<div class="payinputer">
    										<input type="text" class="payinputshort" id="vote_service_price" name="vote_service_price" /> 
    										<span class="won">원</span>
    									</div>
    								</li>
    								<li>
    									<div class="payfield">
    										<span>결제방법</span>
    									</div>
    									<div class="payinputer">
    										<input type="checkbox" class="agree" id="vote_payment_type" name="vote_payment_type" value="1" /> 
    										<label for="payment_type"><span>무통장입금</span></label>
    									</div>
    								</li>
    								<li>
    									<div class="payfield">
    										<span>입금계좌</span>
    									</div>
    									<div class="payinputer">
    										<select>
    											<option>계좌를 선택하세요.</option>
    										</select> 
    										<input type="text" class="payinputlong" id="vote_service_account" name="vote_service_account" placeholder="계좌번호" />
    									</div>
    								</li>
    								<li>
    									<div class="payfield">
    										<span>입금자명</span>
    									</div>
    									<div class="payinputer">
    										<input  type="text" class="payinputshort" id="vote_service_payer" name="vote_service_payer" />
    									</div>
    								</li>
    							</ul>
    						</div>
    					</div>
    				</div>
    				<!-- 프리미엄 서비스 안내 끝 -->
    				<!-- 결제내역 시작 -->
    				<div id="payment_guide" class="votewritetitle">
    					<img src="/app/images/mark_07.jpg" /> 
    					<span class="votetitle">결제 방법 안내</span>
    				</div>
    				<div id="payment_context" class="votewritecont vtbspace">
    					<div class="paybox">
    						<div class="payconttable vtbspace">
    							<ul>
    								<li>
    									<div class="paycontfield pcrline pcbline">
    										<span>신청 서비스</span>
    									</div>
    									<div class="paycontdatabox">
    										<div
    											class="paycontdefault pcrline pcmrline pcbline paycontm71">
    											<span>프리미엄 서비스(Extra) 15일</span>
    										</div>
    										<div class="payconteshort pcbline paycontm71">
    											<span>5,400원</span>
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
    											<span class="stress">5,400</span><span>원</span>
    										</div>
    									</div>
    								</li>
    								<li>
    									<div class="paycontfield pcrline pcbline pccontw90">
    										<span>결제방법</span>
    									</div>
    									<div class="paycontdatabox">
    										<div class="paycontdatali pcbline">
    											<span>무통장 입금</span>
    										</div>
    										<div class="paycontdatali pcbline">
    											<span>신한은행 212-222-4545 예금주 : 아무개</span>
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
    											<span>고형석</span>
    										</div>
    									</div>
    								</li>
    							</ul>
    						</div>
    					</div>
    				</div>
    				<div class="votewritebtncont vttspace">
    					<div class="votewritebuttonbox">
    						<div class="votewritebutton defaultbutton">
    							<span>홈으로</span>
    						</div>
    						<div class="votewritebutton defaultbutton">
    							<span>마이페이지</span>
    						</div>
    						<div class="votewritebutton stressbutton">
    							<span>결제하기</span>
    						</div>
    					</div>
    				</div>
    				<!-- 결제내역 끝 -->
    			</div>
    			<!-- 안내 끝 -->
    		</div>
    	</div>
    </form>
</div>