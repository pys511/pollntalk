<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20201029
 *  포인트 이력 목록
 */
try
{
    $page               = $_GET["page"];
    $member_seq         = $_SESSION["member_seq"];
    
    // 문의 사항 처리
    $pointInfo          = new CApp_Handler_Point_Ctrl();
    $pointSum           = $pointInfo->getPointSum($member_seq);
    $pointTodaySum      = $pointInfo->getPointSumToday($member_seq);
    $pointTodayCount    = $pointInfo->getPointCountToday($member_seq);
    $count              = $pointInfo->getPointLogListCountByMember($member_seq);
    $paging             = $pointInfo->makePaging($count, $page);
    $pointlog           = $pointInfo->getPointLogListByMember($member_seq, $paging);
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<div class="messagecontent">
	<!-- 포인트 상황 시작 -->
	<div class="messagestatus">
		<div class="messagestatustitle title">
			<span>포인트</span>
		</div>
	</div>
	<div class="pointstatus">
		<div class="statustop">
			<div class="statustopsubject">
				<span>보유 포인트</span>
			</div>
			<div class="statustopdata">
				<span class="stress"><?php echo($pointSum); ?></span> 
				<span>P</span>
			</div>
		</div>
		<!-- 포인트 요약 현황 시작 -->
		<div class="statusmiddle">
			<div class="statusmiddlebox">
				<div class="statusmiddleitem strspace">
					<span>금일 적립 포인트</span> 
					<span class="title"><?php echo($pointTodaySum); ?></span> 
					<span>p</span>
				</div>
				<div class="statusmiddleitem strspace">
					<span>|</span>
				</div>
				<div class="statusmiddleitem strspace">
					<span>금일 적립 횟수</span> 
					<span class="title"><?php echo($pointTodayCount); ?></span> 
					<span>회</span>
				</div>
				<!-- <div class="statusmiddleitem strspace">
					<span>|</span>
				</div>
				<div class="statusmiddleitem">
					<span>금일 회원 가입</span> <span class="title">50</span> <span>명</span>
				</div> -->
			</div>
		</div>
		<!-- 포인트 요약 현황 끝 -->
		<!-- 포인트 목록 영역 시작 -->
		<div class="table">
			<div class="tablebox">
				<div class="tableborder">
					<div class="tablefield">
						<div class="defaulttableitem wrline">
							<span>항목</span>
						</div>
						<div class="defaulttableitem wrline">
							<span>포인트</span>
						</div>
						<div class="defaulttableitem wrline">
							<span>비고</span>
						</div>
						<div class="defaulttableitem">
							<span>날짜</span>
						</div>
					</div>
					<div class="tablelist">
						<!-- 포인트 요약 목록 시작 -->
						<ul>
<?php 
// $length = count($result);
foreach ($pointlog as $items)
{
    $logSeq             = $items["POINT_LOG_SEQ"];
    $memberSeq          = $items["MEMBER_SEQ"];
    $memberName         = $items["MEMBER_NAME"];
    $pointPosition      = $items["POINT_POSITION"];
    $pointPositionName  = $items["POINT_POSITION_NAME"];
    $pointKind          = $items["POINT_KIND"];
    $pointKindName      = $items["POINT_KIND_NAME"];
    $pointType          = $items["POINT_TYPE"];
    $pointTypeName      = $items["POINT_TYPE_NAME"];
    $point              = $items["POINT"];
    $pointRegidate      = $items["POINT_REGI_DATE"];
?>
							<li>
								<div class="defaulttableli">
									<div class="defaulttableitem wrline">
										<div class="defaulttablefield mline">
											<span>항목</span>
										</div>
										<div class="defaulttabledata mrline">
											<span><?php echo($pointPositionName); ?>(<?php echo($pointKindName); ?>)</span>
										</div>
									</div>
									<div class="pointnumber wrline">
										<div class="defaulttablefield mline">
											<span>포인트</span>
										</div>
										<div class="defaulttabledata mrline">
											<span><?php echo($point);?>p</span>
										</div>
									</div>
									<div class="defaulttableitem wrline">
										<div class="defaulttablefield mline">
											<span>비고</span>
										</div>
										<div class="defaulttabledata mrline">
											<span><?php echo($pointTypeName); ?></span>
										</div>
									</div>
									<div class="defaulttableitem">
										<div class="defaulttablefield mline mbline">
											<span>날짜</span>
										</div>
										<div class="defaulttabledata mrline mbline">
											<span><?php echo($pointRegidate); ?></span>
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
				<!-- 포인트 요약 목록 끝 -->
				<!-- 페이징 시작 -->
				<div class="paging">
					<a id="boardprev" href="/?mode=mypage_point&page=<?php echo($paging["boardprev"])?>">
    					<div class="pagingbutton pageleft pagenavinoselect">
    					</div>
    				</a>
<?php
// print_r($paging);
for ($i = (integer) $paging["start"]; $i <= (integer) $paging["end"]; $i ++) 
{
    if ($page == "")
        $page   = "1";
?>
					<div class="pagingbutton <?php if($page == $i) echo("pageselect"); ?>">
						<a id="page" href="/?mode=mypage_point&page=<?php echo($i)?>">
							<span><?php echo($i)?></span>
						</a>
					</div>
<?php
}
?>
					<a id="boardprev" href="/?mode=mypage_point&page=<?php echo($paging["boardnext"])?>">
    					<div class="pagingbutton pageright pagenaviselect">
    					</div>
    				</a>
				</div>
				<!-- 페이징 끝 -->
			</div>
		</div>
		<!-- 포인트 목록 영역 끝 -->
	</div>
	<!-- 포인트 상황 끝 -->
</div>