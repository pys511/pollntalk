<?php
?>
<div class="content">
	<!-- 카테고리 영역 시작 -->
	<div class="defaultarea grayback">
<?php
require_once ('./app/view/common/category.php');
?>
	</div>
<?php
$cate_seq       = $_GET["cate_seq"];
$cate_sub_seq   = $_GET["cate_sub_seq"];
$cate_name      = "";
$cate_sub_name  = "";
if ($cate_seq != "" || $cate_sub_seq != "") 
{
    $cateInfo       = $cateCtrl->getCategory4View($cate_seq, $cate_sub_seq);
    $cate_name      = $cateInfo[0]["CATE_NAME"];
    $cate_sub_name  = $cateInfo[0]["CATE_SUB_NAME"];
?>
	<div class="defaultarea">
		<div class="catetitle">
<?php
    if ($cate_name != "") 
    {
?>			
			<span class="largetitle"><?php echo($cate_name); ?></span>
<?php
    }

    if ($cate_sub_name != "") 
    {
?>
			<span class="largetitle">></span> <span class="largetitle"><?php echo($cate_sub_name); ?></span>
<?php
    }
    ?>
		</div>
	</div>
<?php
}
?>
	<!-- 카테고리 영역 끝 -->
	<!-- 광고 베너 영역 시작 -->
	<div class="adverbannerarea boundray">
		<div class="adverbannerbox">
<?php 
$adsetCtrl      = new CApp_Handler_Util_AdSetting();
$adverInfo      = $adsetCtrl->getAdverByPosition("2");
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
					<img class="wtitle" src="/app/images/vote_title_02.png" /> 
					<img class="mtitle" src="/app/images/vote_title_m_02.png" />
				</div>
				<div class="allviewbutton">
					<a href="/?mode=premium_votelist&cate_seq=<?php echo($cate_seq); ?>&cate_sub_seq=<?php echo($cate_sub_seq); ?>">
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
    $result     = $vote->getVoteListByPremiumSlide($cate_seq, $cate_sub_seq);
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
					<a href="/?mode=event_votelist&cate_seq=<?php echo($cate_seq); ?>&cate_sub_seq=<?php echo($cate_sub_seq); ?>">
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
    $page       = $_GET["page"];
    $vote       = new CApp_Handler_Vote_Ctrl();
    $result     = $vote->getVoteListByEventSlide($cate_seq, $cate_sub_seq);
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
        							<div class="votedispuser" data-member="<?php echo($writerSeq); ?>">
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
?>
						</div>
					</div>
					<img class="naviright wright" src="/app/images/vote_right.png" />
				</div>
			</div>
		</div>
	</div>
	<!-- 투표 전시 목록 영역 끝 -->
	<!-- 투표 목록 영역 시작 -->
	<div class="votelistarea">
		<!-- 투표 게시판 목록 시작 -->
		<div class="votelist">
			<div class="sortlink">
				<div class="sortitem">
					<span>추천순</span>
				</div>
				<div class="txtline"></div>
				<div class="sortitem">
					<span>최신순</span>
				</div>
				<div class="txtline"></div>
				<div class="sortitem">
					<span>참여순</span>
				</div>
			</div>
<?php
    $keyword    = "";
    $page       = $_GET["page"];
    $vote       = new CApp_Handler_Vote_Ctrl();
    $count      = $vote->getVoteListCount($cate_seq, $cate_sub_seq, $keyword);
    $paging     = $vote->makePaging($count, $page);
    $result     = $vote->getVoteList($cate_seq, $cate_sub_seq, $keyword, $paging);
?>
			<div class="votelistbox">
				<div class="votelistview">
<?php 
    // 목록이 있을 경우
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
    							<div class="votedispuser" data-member="<?php echo($writerSeq); ?>" data-name="<?php echo($writer); ?>">
    								<img src="/<?php echo($writerImage); ?>" />
    								<span class="writerName"><?php echo($writer); ?></span>
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
?>
				</div>
			</div>
			<!-- 페이징 시작 -->
			<div class="paging">
				<!-- <div class="pagingbutton pageleftend pagenavinoselect"></div> -->
				<a id="boardprev" href="/?mode=votelist&page=<?php echo($paging["boardprev"])?>&cate_seq=<?php echo($cate_seq); ?>&cate_sub_seq=<?php echo($cate_sub_seq); ?>">
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
					<a id="page" href="/?mode=votelist&page=<?php echo($i)?>&cate_seq=<?php echo($cate_seq); ?>&cate_sub_seq=<?php echo($cate_sub_seq); ?>">
						<span><?php echo($i)?></span>
					</a>
				</div>
<?php
    }
?>
				<a id="boardprev" href="/?mode=votelist&page=<?php echo($paging["boardnext"])?>&cate_seq=<?php echo($cate_seq); ?>&cate_sub_seq=<?php echo($cate_sub_seq); ?>">
					<div class="pagingbutton pageright pagenaviselect">
					</div>
				</a>
				<!-- <div class="pagingbutton pagerightend pagenavinoselect"></div> -->
			</div>
			<!-- 페이징 끝 -->
<?php 
    }
    catch (CException $ex)
    {
        $ex->executeException();
    }
?>
		</div>
		<!-- 투표 게시판 목록 끝 -->
	</div>
	<!-- 투표 게시판 목록 영역 끝 -->
</div>