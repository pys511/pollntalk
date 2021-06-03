<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200728
 *  content page main
 */

$mainCtrl   = new CApp_Handler_Main_Ctrl();
$mainResult = $mainCtrl->getTextListByUsed();

?>
<div class="content">
	<!-- 메인 특화 화면 영역 시작 -->
	<div class="mainscreen">
		<!-- 메인 베너 영역 시작 -->
<?php
$i  = 0;
foreach ($mainResult as $items)
{
    if ($i > 0)
        $display    = "display:none";
?>
		<div class="mainbannerarea" id="back_<?php echo($items["MAIN_SEQ"]); ?>" style="<? echo($display); ?>;background-color: #<?php echo($items["M_BACKCOLOR"]); ?>;">
			<div class="mainbanneritem" style="background-image: url('<?php echo($items["M_REAL_IMAGE"]); ?>')">
				<!-- 중앙 메시지 시작 -->
				<input type="hidden" id="backcolor" name="backcolor" />
				<div class="mainmessage">
					<div class="messageaccessory"></div>
					<div class="mainmessagebox">
						<span class="message strong" style="color:#<?php echo($items["M_TEXT1_COLOR"]); ?>"><?php echo($items["M_TEXT1"]); ?></span> 
						<span class="message effect" style="color:#<?php echo($items["M_TEXT2_COLOR"]); ?>"><?php echo($items["M_TEXT2"]); ?></span>
					</div>
				</div>
				<!-- 중앙 메시지 끝 -->
				<!-- 베너 navi 시작 -->
				<div class="bannerbutton">
					<img src="/app/images/banner_on.png" /> 
					<img src="/app/images/banner_off.png" /> 
					<img src="/app/images/banner_off.png" />
				</div>
				<!-- 베너 navi 끝 -->
			</div>
		</div>
<?php
    $i++;
}
?>
		<!-- 메인 베너 영역 끝 -->
		<!-- 현황 정보 영역 시작 -->
		<div class="votestatusarea">
			<div class="votestatus">
				<div class="votestatusbox">
					<div class="votestatusitem rightline">
						<img class="wstatusicon" src="/app/images/status_01.png" /> 
						<img class="mstatusicon" src="/app/images/status_m_01.png" />
						<div class="status">
							<span class="statusTitle">회원</span>
<?php 
try 
{
    $memberCtrl     = new CApp_Handler_Member_Ctrl();
    $memberCount    = $memberCtrl->getMemberCount();
}
catch (CException $ex)
{
    $ex->printException();
}
?>		

							<span class="statusData"><?php echo(number_format($memberCount)); ?></span>
						</div>
					</div>
					<div class="votestatusitem rightline">
						<img class="wstatusicon" src="/app/images/status_02.png" /> 
						<img class="mstatusicon" src="/app/images/status_m_02.png" />
						<div class="status">
							<span class="statusTitle">투표</span> 
<?php 
try 
{
    $voteCtrl       = new CApp_Handler_Vote_Ctrl();
    $voteCount      = $voteCtrl->getVoteCount();
}
catch (CException $ex)
{
    $ex->printException();
}
?>
							<span class="statusData"><?php echo(number_format($voteCount)); ?></span>
						</div>
					</div>
					<div class="votestatusitem rightline">
						<img class="wstatusicon" src="/app/images/status_03.png" /> 
						<img class="mstatusicon" src="/app/images/status_m_03.png" />
						<div class="status">
							<span class="statusTitle">참여</span> 
<?php 
try 
{
    $votePartiCount = $voteCtrl->getParticipantVoteCount();
}
catch (CException $ex)
{
    $ex->printException();
}
?>
							<span class="statusData"><?php echo(number_format($votePartiCount)); ?></span>
						</div>
					</div>
					<div class="votestatusitem">
						<img class="wstatusicon" src="/app/images/status_04.png" /> 
						<img class="mstatusicon" src="/app/images/status_m_04.png" />
						<div class="status">
							<span class="statusTitle">댓글</span> 
<?php 
try 
{
    $replyCtrl      = new CApp_Handler_Reply_Ctrl();
    $replyCount     = $replyCtrl->getReplyCount();
}
catch (CException $ex)
{
    $ex->printException();
}
?>
							<span class="statusData"><?php echo(number_format($replyCount)); ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- 현황 정보 영역 끝 -->
<?php
require_once ('./app/view/common/category.php');
?>		
	</div>
	<!-- 메인 특화 화면 영역 끝 -->
	<!-- 광고 베너 영역 시작 -->
	<div class="adverbannerarea boundray">
		<div class="adverbannerbox">
<?php 
$adsetCtrl      = new CApp_Handler_Util_AdSetting();
$adverInfo      = $adsetCtrl->getAdverByPosition("1");
?>
					<a href="javascript:window.open('http://<?php echo($adverInfo["ad_url"]); ?>');"><img class="wad" src="/<?php echo($adverInfo["ad_tempimg"]); ?>" /></a> 
					<a href="javascript:window.open('http://<?php echo($adverInfo["ad_url"]); ?>');"><img class="mad" src="/<?php echo($adverInfo["ad_mtempimg"]); ?>" /></a>
<?php 

?>					
		</div>
	</div>
	<!-- 광고 베너 영역 끝 -->
	<!-- 투표 전시 목록 영역 시작 -->
	<div class="votedisparea">
		<div class="votedispcont boundray">
			<div class="votedispbox">
				<div class="votedisptitle">
					<img class="wtitle" src="/app/images/vote_title_01.png" /> 
					<img class="mtitle" src="/app/images/vote_title_m_01.png" />
				</div>
				<div class="allviewbutton">
					<a href="/?mode=hotissue_votelist">
						<span>전체보기 + </span>
					</a>
				</div>
				<div class="votedisplist">
					<div class="mnavi">
						<img class="navileft mleft" src="/app/images/vote_m_left.png" /> 
						<img class="naviright mright" src="/app/images/vote_m_right.png" />
					</div>
					<img class="navileft wleft" src="/app/images/vote_left.png" />
					<div class="votedisp">
						<div class="votedispview">
<?php
try 
{
    $keyword    = "";
    $page       = $_GET["page"];
    $vote       = new CApp_Handler_Vote_Ctrl();
    $count      = $vote->getVoteListByHotissueCount($cate_seq, $cate_sub_seq, $keyword);
    $paging     = $vote->makePaging($count, $page);
    $result     = $vote->getVoteListByHotissue($cate_seq, $cate_sub_seq, $keyword, $paging);
    {
        // 목록이 없을 경우
        if (count($result) > 0)
        {
            // $length = count($result);
            foreach ($result as $items)
            {
                $vote_seq               = $items["VOTE_SEQ"];
                $vote_cate1_name        = $items["VOTE_CATE_NAME"];
                $cate_2dept_name        = $items["VOTE_CATE_SUB_NAME"];
                $vote_type_name         = $items["VOTE_TYPE_NAME"];
                $subject                = $items["VOTE_SUBJECT"];
                $writerSeq              = $items["VOTE_WRITER_SEQ"];
                $writer                 = $items["VOTE_WRITER_NAME"];
                $writerImage            = $items["VOTE_WRITER_IMAGE"];
                $participant_count      = $items["VOTE_PARTICIPATE_COUNT"];
                $cateImagePath          = $items["CATE_REAL_IMAGE_PATH"];
                $cateSubImagePath       = $items["CATE_SUB_REAL_IMAGE_PATH"];
                $vote_real_name         = $items["VOTE_RESOURCE_PATH"];
                $vote_real_type         = $items["VOTE_RESOURCE_TYPE"];
                $view_count             = $items["VOTE_VIEW_COUNT"];
                $recomm_count           = $items["VOTE_RECOMM_COUNT"];
                $end_date               = $items["VOTE_END_DATE"];
                $regi_date              = $items["VOTE_REGI_DATE"];
                $isOpenName             = $items["VOTE_IS_OPEN_NAME"];
                $isOpen                 = $items["VOTE_IS_OPEN"];
                $reply_count            = "0";
                
                if ($vote_real_name =="" || $vote_real_type == "3")
                {
                    if ($cateSubImagePath == "")
                        $vote_real_name = $cateSubImagePath;
                    else
                        $vote_real_name = $cateImagePath;
                }
                
?>						
							<div class="votedispitem votespace" style="background-image: url('<?php echo($vote_real_name); ?>')">
							<div class="votedispinfobox">
    							<div class="votedispitemtitle title">
<?php 
if ($_SESSION["member_seq"] != "")
{
?>
    								<!-- <a href="/?mode=voteview&vote_seq=<?php echo($vote_seq); ?>" > -->
									<a id="vote_h_<?php echo($vote_seq); ?>" href="javascript:goVote('vote_h_<?php echo($vote_seq); ?>', '<?php echo($vote_seq); ?>', '<?php echo($isOpen); ?>')" >
<?php
}
else
{
?> 
									<a href="#" onclick="callLogin()">
<?php    
}
?>
    									<span><?php echo($subject); ?></span>
    								</a>
    							</div>
    						</div>
    						<div class="votedispInfocont">
    							<div class="votedispInfoItem">
        							<div class="votedispuser" data-member="<?php echo($writerSeq); ?>" data-name="<?php echo($writer);?>">
        								<img src="/<?php echo($writerImage); ?>" />
        								<span><?php echo($writer); ?></span>
        							</div>
        							<div class="votedispinfo width100">
        								<span>유형 : </span>
        								<span><?php echo($vote_type_name); ?>(<?php echo($isOpenName); ?>)</span>
        							</div>
        							<div class="votedispinfo width100">
        								<span class="normal">
        									카테고리 : 
<?php 
                                                echo($vote_cate1_name);
                                                if ($cate_2dept_name != "")
                                                    echo("&nbsp;>&nbsp;".$cate_2dept_name);
?>
        								</span>
        							</div>
        							<div class="votedispinfo">
        								<span>참여 : </span>
        								<span class="stress"><?php echo($participant_count); ?></span>
        								<span>/</span>
        								<span>댓글 : </span>
        								<span class="stress"><?php echo($reply_count); ?></span>
        								<span>/</span>
        								<span>좋아요 : </span>
        								<span class="stress"><?php echo($recomm_count); ?></span>
        							</div>
        						</div>
        					</div>
    					</div>
<?php 
            }
        }
    }
?>
						</div>
					</div>
					<img class="naviright wright" src="/app/images/vote_right.png" />
				</div>
			</div>
		</div>
		<div class="votedispcont boundray">
			<div class="votedispbox">
				<div class="votedisptitle">
					<img class="wtitle" src="/app/images/vote_title_02.png" /> 
					<img class="mtitle" src="/app/images/vote_title_m_02.png" />
				</div>
				<div class="allviewbutton">
					<a href="/?mode=premium_votelist">
						<span>전체보기 + </span>
					</a>
				</div>
				<div class="votedisplist">
					<div class="mnavi">
						<img class="navileft mleft" src="/app/images/vote_m_left.png" /> 
						<img class="naviright mright" src="/app/images/vote_m_right.png" />
					</div>
					<img class="navileft wleft" src="/app/images/vote_left.png" />
					<div class="votedisp">
						<div class="votedispview">
<?php
    $keyword    = "";
    $count      = $vote->getVoteListByPremiumCount($cate_seq, $cate_sub_seq, $keyword);
    $paging     = $vote->makePaging($count, $page);
    $result     = $vote->getVoteListByPremium($cate_seq, $cate_sub_seq, $keyword, $paging);
    {
        // 목록이 없을 경우
        if (count($result) > 0)
        {
            // $length = count($result);
            foreach ($result as $items)
            {
                $vote_seq               = $items["VOTE_SEQ"];
                $vote_cate1_name        = $items["VOTE_CATE_NAME"];
                $cate_2dept_name        = $items["VOTE_CATE_SUB_NAME"];
                $vote_type_name         = $items["VOTE_TYPE_NAME"];
                $subject                = $items["VOTE_SUBJECT"];
                $writerSeq              = $items["VOTE_WRITER_SEQ"];
                $writer                 = $items["VOTE_WRITER_NAME"];
                $writerImage            = $items["VOTE_WRITER_IMAGE"];
                $participant_count      = $items["VOTE_PARTICIPATE_COUNT"];
                $cateImagePath          = $items["CATE_REAL_IMAGE_PATH"];
                $cateSubImagePath       = $items["CATE_SUB_REAL_IMAGE_PATH"];
                $vote_real_name         = $items["VOTE_RESOURCE_PATH"];
                $vote_real_type         = $items["VOTE_RESOURCE_TYPE"];
                $view_count             = $items["VOTE_VIEW_COUNT"];
                $recomm_count           = $items["VOTE_RECOMM_COUNT"];
                $end_date               = $items["VOTE_END_DATE"];
                $regi_date              = $items["VOTE_REGI_DATE"];
                $isOpen                 = $items["VOTE_IS_OPEN"];
                $isOpenName             = $items["VOTE_IS_OPEN_NAME"];
                $reply_count            = "0";
                
                if ($vote_real_name =="" || $vote_real_type == "3")
                {
                    if ($cateSubImagePath != "")
                        $vote_real_name = $cateSubImagePath;
                    else
                        $vote_real_name = $cateImagePath;
                }
                
?>
							<div class="votedispitem votespace" style="background-image: url('<?php echo($vote_real_name); ?>')">
							<div class="votedispinfobox">
								<div class="votedispitemtitle title">
<?php 
if ($_SESSION["member_seq"] != "")
{
?>
									<!-- <a href="/?mode=voteview&vote_seq=<?php echo($vote_seq); ?>" > -->
									<a id="vote_p_<?php echo($vote_seq); ?>" href="javascript:goVote('vote_p_<?php echo($vote_seq); ?>', '<?php echo($vote_seq); ?>', '<?php echo($isOpen); ?>')" >
<?php
}
else
{
?> 
									<a href="#" onclick="callLogin()">
<?php    
}
?>
    									<span><?php echo($subject); ?></span>
    								</a>
    							</div>
    						</div>
    						<div class="votedispInfocont">
    							<div class="votedispInfoItem">
        							<div class="votedispuser" data-member="<?php echo($writerSeq); ?>" data-name="<?php echo($writer);?>">
        								<img src="/<?php echo($writerImage); ?>" />
        								<span><?php echo($writer); ?></span>
        							</div>
        							<div class="votedispinfo width100">
        								<span>유형 : </span>
        								<span><?php echo($vote_type_name); ?>(<?php echo($isOpenName); ?>)</span>
        							</div>
        							<div class="votedispinfo width100">
        								<span class="normal">
        									카테고리 : 
<?php 
                                            echo($vote_cate1_name);
                                            if ($cate_2dept_name != "")
                                                echo("&nbsp;>&nbsp;".$cate_2dept_name);
?>
        								</span>
        							</div>
        							<div class="votedispinfo">
        								<span>참여 : </span>
        								<span class="stress"><?php echo($participant_count); ?></span>
        								<span>/</span>
        								<span>댓글 : </span>
        								<span class="stress"><?php echo($reply_count); ?></span>
        								<span>/</span>
        								<span>좋아요 : </span>
        								<span class="stress"><?php echo($recomm_count); ?></span>
        							</div>
        						</div>
        					</div>
    					</div>
<?php 
            }
        }
    }
?>
						</div>
					</div>
					<img class="naviright wright" src="/app/images/vote_right.png" />
				</div>
			</div>
		</div>
		<div class="votedispcont boundray">
			<div class="votedispbox">
				<div class="votedisptitle">
					<img class="wtitle" src="/app/images/vote_title_03.png" /> 
					<img class="mtitle" src="/app/images/vote_title_m_03.png" />
				</div>
				<div class="allviewbutton">
					<a href="/?mode=event_votelist">
						<span>전체보기 + </span>
					</a>
				</div>
				<div class="votedisplist">
					<div class="mnavi">
						<img class="navileft mleft" src="/app/images/vote_m_left.png" /> 
						<img class="naviright mright" src="/app/images/vote_m_right.png" />
					</div>
					<img class="navileft wleft" src="/app/images/vote_left.png" />
					<div class="votedisp">
						<div class="votedispview">
<?php
    $keyword    = "";
    $count      = $vote->getVoteListByEventCount($cate_seq, $cate_sub_seq, $keyword);
    $paging     = $vote->makePaging($count, $page);
    $result     = $vote->getVoteListByEvent($cate_seq, $cate_sub_seq, $keyword, $paging);
    {
        // 목록이 없을 경우
        if (count($result) > 0)
        {
            // $length = count($result);
            foreach ($result as $items)
            {
                $vote_seq               = $items["VOTE_SEQ"];
                $vote_cate1_name        = $items["VOTE_CATE_NAME"];
                $cate_2dept_name        = $items["VOTE_CATE_SUB_NAME"];
                $vote_type_name         = $items["VOTE_TYPE_NAME"];
                $subject                = $items["VOTE_SUBJECT"];
                $writerSeq              = $items["VOTE_WRITER_SEQ"];
                $writer                 = $items["VOTE_WRITER_NAME"];
                $writerImage            = $items["VOTE_WRITER_IMAGE"];
                $participant_count      = $items["VOTE_PARTICIPATE_COUNT"];
                $cateImagePath          = $items["CATE_REAL_IMAGE_PATH"];
                $cateSubImagePath       = $items["CATE_SUB_REAL_IMAGE_PATH"];
                $vote_real_name         = $items["VOTE_RESOURCE_PATH"];
                $vote_real_type         = $items["VOTE_RESOURCE_TYPE"];
                $view_count             = $items["VOTE_VIEW_COUNT"];
                $recomm_count           = $items["VOTE_RECOMM_COUNT"];
                $end_date               = $items["VOTE_END_DATE"];
                $regi_date              = $items["VOTE_REGI_DATE"];
                $isOpen                 = $items["VOTE_IS_OPEN"];
                $isOpenName             = $items["VOTE_IS_OPEN_NAME"];
                $reply_count            = "0";
                
                if ($vote_real_name =="" || $vote_real_type == "3")
                {
                    if ($cateSubImagePath != "")
                        $vote_real_name = $cateSubImagePath;
                    else
                        $vote_real_name = $cateImagePath;
                }
                
?>
						<div class="votedispitem votespace" style="background-image: url('<?php echo($vote_real_name); ?>')">
							<div class="votedispinfobox">
								<div class="votedispitemtitle title">
<?php 
if ($_SESSION["member_seq"] != "")
{
?>
									<!-- <a href="/?mode=voteview&vote_seq=<?php echo($vote_seq); ?>" > -->
									<a id="vote_e_<?php echo($vote_seq); ?>" href="javascript:goVote('vote_e_<?php echo($vote_seq); ?>', '<?php echo($vote_seq); ?>', '<?php echo($isOpen); ?>')" >
<?php
}
else
{
?> 
									<a href="#" onclick="callLogin()">
<?php    
}
?>
    									<span><?php echo($subject); ?></span>
    								</a>
    							</div>
    						</div>
    						<div class="votedispInfocont">
    							<div class="votedispInfoItem">
        							<div class="votedispuser" data-member="<?php echo($writerSeq); ?>" data-name="<?php echo($writer);?>">
        								<img src="/<?php echo($writerImage); ?>" />
        								<span><?php echo($writer); ?></span>
        							</div>
        							<div class="votedispinfo width100">
        								<span>유형 : </span>
        								<span><?php echo($vote_type_name); ?>(<?php echo($isOpenName); ?>)</span>
        							</div>
        							<div class="votedispinfo width100">
        								<span class="normal">
        									카테고리 : 
<?php 
                                            echo($vote_cate1_name);
                                            if ($cate_2dept_name != "")
                                                echo("&nbsp;>&nbsp;".$cate_2dept_name);
?>
        								</span>
        							</div>
        							<div class="votedispinfo">
        								<span>참여 : </span>
        								<span class="stress"><?php echo($participant_count); ?></span>
        								<span>/</span>
        								<span>댓글 : </span>
        								<span class="stress"><?php echo($reply_count); ?></span>
        								<span>/</span>
        								<span>좋아요 : </span>
        								<span class="stress"><?php echo($recomm_count); ?></span>
        							</div>
        						</div>
        					</div>
    					</div>
<?php 
            }
        }
    }
?>						
						</div>
					</div>
					<img class="naviright wright" src="/app/images/vote_right.png" />
				</div>
			</div>
		</div>
	</div>
	<!-- 투표 전시 목록 영역 끝 -->
	<!-- 투표 게시판 목록 영역 시작 -->
	<div class="boardarea">
		<!-- 투표 게시판 슬라이드 시작 -->
		<div class="votedispcont">
			<div class="votedispbox">
				<div class="votedisptitle lbspace">
					<img class="wtitle" src="/app/images/vote_title_04.png" /> 
					<img class="mtitle" src="/app/images/vote_title_m_04.png" />
				</div>
				<div class="votedisplist">
					<div class="mnavi">
						<img class="navileft mleft" src="/app/images/vote_m_left.png" /> 
						<img class="naviright mright" src="/app/images/vote_m_right.png" />
					</div>
					<img class="navileft wleft" src="/app/images/vote_left.png" />
					<div class="votedisp">
						<div class="votedispview">
<?php
    $keyword    = "";
    $page       = $_GET["page"];
    $result     = $vote->getVoteNewList($cate_seq, $cate_sub_seq, $keyword, 0, 10);
    {
        // 목록이 없을 경우
        if (count($result) > 0)
        {
            // $length = count($result);
            foreach ($result as $items)
            {
                $vote_seq               = $items["VOTE_SEQ"];
                $vote_cate1_name        = $items["VOTE_CATE_NAME"];
                $cate_2dept_name        = $items["VOTE_CATE_SUB_NAME"];
                $vote_type_name         = $items["VOTE_TYPE_NAME"];
                $subject                = $items["VOTE_SUBJECT"];
                $writerSeq              = $items["VOTE_WRITER_SEQ"];
                $writer                 = $items["VOTE_WRITER_NAME"];
                $writerImage            = $items["VOTE_WRITER_IMAGE"];
                $participant_count      = $items["VOTE_PARTICIPATE_COUNT"];
                $cateImagePath          = $items["CATE_REAL_IMAGE_PATH"];
                $cateSubImagePath       = $items["CATE_SUB_REAL_IMAGE_PATH"];
                $vote_real_name         = $items["VOTE_RESOURCE_PATH"];
                $vote_real_type         = $items["VOTE_RESOURCE_TYPE"];
                $view_count             = $items["VOTE_VIEW_COUNT"];
                $recomm_count           = $items["VOTE_RECOMM_COUNT"];
                $end_date               = $items["VOTE_END_DATE"];
                $regi_date              = $items["VOTE_REGI_DATE"];
                $isOpen                 = $items["VOTE_IS_OPEN"];
                $isOpenName             = $items["VOTE_IS_OPEN_NAME"];
                $reply_count            = "0";
                
                if ($vote_real_name =="" || $vote_real_type == "3")
                {
                    if ($cateSubImagePath != "")
                        $vote_real_name = $cateSubImagePath;
                    else
                        $vote_real_name = $cateImagePath;
                }
                
?>
						<div class="votedispitem votespace" style="background-image: url('<?php echo($vote_real_name); ?>')">
							<div class="votedispinfobox">
								<div class="votedispitemtitle title">
<?php 
if ($_SESSION["member_seq"] != "")
{
?>
									<!-- <a href="/?mode=voteview&vote_seq=<?php echo($vote_seq); ?>" > -->
									<a id="vote_n_<?php echo($vote_seq); ?>" href="javascript:goVote('vote_n_<?php echo($vote_seq); ?>', '<?php echo($vote_seq); ?>', '<?php echo($isOpen); ?>')" >
<?php
}
else
{
?> 
									<a href="#" onclick="callLogin()">
<?php    
}
?>
    									<span><?php echo($subject); ?></span>
    								</a>
    							</div>
    						</div>
    						<div class="votedispInfocont">
    							<div class="votedispInfoItem">
        							<div class="votedispuser" data-member="<?php echo($writerSeq); ?>" data-name="<?php echo($writer);?>">
        								<img src="/<?php echo($writerImage); ?>" />
        								<span><?php echo($writer); ?></span>
        							</div>
        							<div class="votedispinfo width100">
        								<span>유형 : </span>
        								<span><?php echo($vote_type_name); ?>(<?php echo($isOpenName); ?>)</span>
        							</div>
        							<div class="votedispinfo width100">
        								<span class="normal">
        									카테고리 : 
<?php 
                                            echo($vote_cate1_name);
                                            if ($cate_2dept_name != "")
                                                echo("&nbsp;>&nbsp;".$cate_2dept_name);
?>
        								</span>
        							</div>
        							<div class="votedispinfo">
        								<span>참여 : </span>
        								<span class="stress"><?php echo($participant_count); ?></span>
        								<span>/</span>
        								<span>댓글 : </span>
        								<span class="stress"><?php echo($reply_count); ?></span>
        								<span>/</span>
        								<span>좋아요 : </span>
        								<span class="stress"><?php echo($recomm_count); ?></span>
        							</div>
        						</div>
        					</div>
    					</div>
<?php 
            }
        }
    }
?>						
						</div>
					</div>
					<img class="naviright wright" src="/app/images/vote_right.png" />
				</div>
			</div>
		</div>
		<!-- 투표 게시판 슬라이드 끝 -->
		<!-- 투표 게시판 목록 시작 -->
		<div class="board">
			<div class="boardbox">
				<ul>
<?php
    $keyword    = "";
    $page       = $_GET["page"];
    $result     = $vote->getVoteNewList($cate_seq, $cate_sub_seq, $keyword, 10, 10);
    {
        // 목록이 없을 경우
        if (count($result) > 0)
        {
            // $length = count($result);
            foreach ($result as $items)
            {
                $vote_seq               = $items["VOTE_SEQ"];
                $vote_cate1_name        = $items["VOTE_CATE_NAME"];
                $cate_2dept_name        = $items["VOTE_CATE_SUB_NAME"];
                $vote_type_name         = $items["VOTE_TYPE_NAME"];
                $subject                = $items["VOTE_SUBJECT"];
                $writerSeq              = $items["VOTE_WRITER_SEQ"];
                $writer                 = $items["VOTE_WRITER_NAME"];
                $writerImage            = $items["VOTE_WRITER_IMAGE"];
                $participant_count      = $items["VOTE_PARTICIPATE_COUNT"];
                $cateImagePath          = $items["CATE_REAL_IMAGE_PATH"];
                $cateSubImagePath       = $items["CATE_SUB_REAL_IMAGE_PATH"];
                $vote_real_name         = $items["VOTE_RESOURCE_PATH"];
                $vote_real_type         = $items["VOTE_RESOURCE_TYPE"];
                $view_count             = $items["VOTE_VIEW_COUNT"];
                $recomm_count           = $items["VOTE_RECOMM_COUNT"];
                $end_date               = $items["VOTE_END_DATE"];
                $regi_date              = $items["VOTE_REGI_DATE"];
                $isOpen                 = $items["VOTE_IS_OPEN"];
                $isOpenName             = $items["VOTE_IS_OPEN_NAME"];
                $reply_count            = "0";
                
                if ($vote_real_name =="" || $vote_real_type == "3")
                {
                    if ($cateSubImagePath != "")
                        $vote_real_name = $cateSubImagePath;
                    else
                        $vote_real_name = $cateImagePath;
                }
                
?>
					<li>
						<div class="larea">
							<div class="boardcate">
								<span>
<?php 
                                    echo($vote_cate1_name);
                                    if ($cate_2dept_name != "")
                                        echo("&nbsp;>&nbsp;".$cate_2dept_name);
?>								
								</span>
							</div>
							<div class="boardmember mview">
								<img src="/<?php echo($writerImage); ?>" />
								<span><?php echo($writer); ?></span> 
								<span class="normal">/</span> 
								<span class="normal short">참여:</span> 
								<span class="stress short"><?php echo($participant_count); ?></span>
							</div>
						</div>
						<div class="rarea">
							<div class="boardtitle title">
<?php 
if ($_SESSION["member_seq"] != "")
{
?>
								<!-- <a href="/?mode=voteview&vote_seq=<?php echo($vote_seq); ?>" > -->
								<a id="vote_n_<?php echo($vote_seq); ?>" href="javascript:goVote('vote_n_<?php echo($vote_seq); ?>', '<?php echo($vote_seq); ?>', '<?php echo($isOpen); ?>')" >
<?php
}
else
{
?> 
								<a href="#" onclick="callLogin()">
<?php    
}
?>
									<span><?php echo($subject); ?></span>
								</a>
							</div>
							<div class="boardmember wview">
								<img src="/<?php echo($writerImage); ?>" />
								<span><?php echo($writer); ?></span>
							</div>
							<div class="boarddefault wview">
								<span class="normal short">참여:</span> 
								<span class="stress short"><?php echo($participant_count); ?></span>
							</div>
						</div>
					</li>
<?php 
            }
        }
    }
?>		
				</ul>
			</div>
		</div>
		<!-- 투표 게시판 목록 끝 -->
	</div>
	<!-- 투표 게시판 목록 영역 끝 -->
<?php 
}
catch (CException $ex)
{
    $ex->executeException();
}
?>	
</div>
<?php
unset($_POST);
?>