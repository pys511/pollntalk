<!-- 컨텐츠 시작-->
<div class="content">
<!-- 카테고리 영역 시작 -->
	<div class="defaultarea grayback">
<?php
require_once ('./app/view/common/category.php');
?>
	</div>
<?php
$page           = $_GET["page"];
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
	<!-- 광고 베너 영역 시작 -->
	<div class="adverbannerarea boundray">
		<div class="adverbannerbox">
<?php 
$adsetCtrl      = new CApp_Handler_Util_AdSetting();
$adverInfo      = $adsetCtrl->getAdverByPosition("10");
?>
    	<a href="javascript:window.open('http://<?php echo($adverInfo["ad_url"]); ?>');"><img class="wad" src="/<?php echo($adverInfo["ad_tempimg"]); ?>" /></a> 
    	<a href="javascript:window.open('http://<?php echo($adverInfo["ad_url"]); ?>');"><img class="mad" src="/<?php echo($adverInfo["ad_mtempimg"]); ?>" /></a>
<?php 

?>
		</div>
	</div>
	<!-- 광고 베너 영역 끝 -->			
	<!-- 투표 목록 영역 시작 -->
	<div class="searchlistarea">
		<!-- 투표 게시판 목록 시작 -->
		<div class="searchlist">
			<div class="searchkeyword">
				<span class="stress">'<?php echo($keyword); ?>'</span>
				<span>로 검색한 검색 결과</span>
			</div>
			<div class="searchlistbox">
<?php
try 
{
    $vote       = new CApp_Handler_Vote_Ctrl();
    $count      = $vote->getVoteSearchListByHotissueCount($cate_seq, $cate_sub_seq, $keyword);
    $result     = $vote->getVoteSearchListByHotissue($cate_seq, $cate_sub_seq, $keyword);
?>	
				<div class="searchlistview">
					<div class="searchtypetitle">
						<img src="/app/images/vote_mtitle.png" />
						<span>핫이슈 투표(<?php echo($count); ?>)</span>
					</div>
					<ul>
<?php 
    // 목록이 없을 경우
    if (count($result) > 0)
    {
        // $length = count($result);
        foreach ($result as $items)
        {
            $vote_seq               = $items["VOTE_SEQ"];
            $vote_cate1_name        = $items["VOTE_CATE_NAME"];
            $cate_2dept_name        = $items["VOTE_CATE_SUB_NAME"];
            $subject                = $items["VOTE_SUBJECT"];
            $vote_context           = $items["VOTE_CONTEXT"];
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
            $reply_count            = "0";
            
            if ($vote_real_name =="" || $vote_real_type == "3")
            {
                if ($cateSubImagePath == "")
                    $vote_real_name = $cateSubImagePath;
                else
                    $vote_real_name = $cateImagePath;
            }
?>
						<li>
							<img class="itemimage" src="<?php echo($vote_real_name); ?>" />
							<div class="searchitembox">
								<div class="searchitemtitle title">
<?php 
            if ($_SESSION["member_seq"] != "")
            {
?>
    								<a href="/?mode=voteview&vote_seq=<?php echo($vote_seq); ?>" >
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
								<div class="searchitemdoc">
									<span><?php echo($vote_context); ?></span>
								</div>
								<div class="searchitemcate">
									<span>
										카테고리 : 
<?php 
                                            echo($vote_cate1_name);
                                            if ($cate_2dept_name != "")
                                                echo("&nbsp;>&nbsp;".$cate_2dept_name);
?>
									</span>
								</div>
								<div class="searchitemetc">
									<div class="searchiteminfo">
										<span>참여 : </span>
										<span class="stress"><?php echo($participant_count); ?></span>
										<span>/</span>
										<span>댓글 : </span> 
										<span class="stress"><?php echo($reply_count); ?></span> 
										<span>/</span>
										<span>좋아요 : </span> <span class="stress">50</span>
									</div>
									<div class="searchitemwriter">
										<img src="/<?php echo($writerImage); ?>" /> 
										<span class="writerName"><?php echo($writer); ?></span>
									</div>
								</div>
							</div>
						</li>
<?php 
        }
    }
    else 
    {
?>
						<li>
							<div class="searchitembox">
								<div class="searchitemtitle title">
									<span>검색된 결과가 없습니다.</span>
								</div>
							</div>
						</li>
<?php 
    }
?>
					</ul>
					<div class="goallsearchbutton">
						<span>투표 더보기 ▶</span>
					</div>
				</div>
<?php
    $count      = $vote->getVoteSearchListByPremiumCount($cate_seq, $cate_sub_seq, $keyword);
    $result     = $vote->getVoteSearchListByPremium($cate_seq, $cate_sub_seq, $keyword);
?>	
				<div class="searchlistview">
					<div class="searchtypetitle">
						<img src="/app/images/vote_mtitle.png" />
						<span>프리미엄 투표(<?php echo($count); ?>)</span>
					</div>
					<ul>
<?php 
    // 목록이 없을 경우
    if (count($result) > 0)
    {
        // $length = count($result);
        foreach ($result as $items)
        {
            $vote_seq               = $items["VOTE_SEQ"];
            $vote_cate1_name        = $items["VOTE_CATE_NAME"];
            $cate_2dept_name        = $items["VOTE_CATE_SUB_NAME"];
            $subject                = $items["VOTE_SUBJECT"];
            $vote_context           = $items["VOTE_CONTEXT"];
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
            $reply_count            = "0";
            
            if ($vote_real_name =="" || $vote_real_type == "3")
            {
                if ($cateSubImagePath == "")
                    $vote_real_name = $cateSubImagePath;
                else
                    $vote_real_name = $cateImagePath;
            }
?>
						<li>
							<img class="itemimage" src="<?php echo($vote_real_name); ?>" />
							<div class="searchitembox">
								<div class="searchitemtitle title">
<?php 
            if ($_SESSION["member_seq"] != "")
            {
?>
    								<a href="/?mode=voteview&vote_seq=<?php echo($vote_seq); ?>" >
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
								<div class="searchitemdoc">
									<span><?php echo($vote_context); ?></span>
								</div>
								<div class="searchitemcate">
									<span>
										카테고리 : 
<?php 
                                            echo($vote_cate1_name);
                                            if ($cate_2dept_name != "")
                                                echo("&nbsp;>&nbsp;".$cate_2dept_name);
?>
									</span>
								</div>
								<div class="searchitemetc">
									<div class="searchiteminfo">
										<span>참여 : </span>
										<span class="stress"><?php echo($participant_count); ?></span>
										<span>/</span>
										<span>댓글 : </span> 
										<span class="stress"><?php echo($reply_count); ?></span> 
										<span>/</span>
										<span>좋아요 : </span> <span class="stress">50</span>
									</div>
									<div class="searchitemwriter">
										<img src="/<?php echo($writerImage); ?>" /> 
										<span class="writerName"><?php echo($writer); ?></span>
									</div>
								</div>
							</div>
						</li>
<?php 
        }
    }
    else 
    {
?>
						<li>
							<div class="searchitembox">
								<div class="searchitemtitle title">
									<span>검색된 결과가 없습니다.</span>
								</div>
							</div>
						</li>
<?php 
    }
?>
					</ul>
					<div class="goallsearchbutton">
						<span>투표 더보기 ▶</span>
					</div>
				</div>
<?php
    $count      = $vote->getVoteSearchListByEventCount($cate_seq, $cate_sub_seq, $keyword);
    $result     = $vote->getVoteSearchListByEvent($cate_seq, $cate_sub_seq, $keyword);
?>	
				<div class="searchlistview">
					<div class="searchtypetitle">
						<img src="/app/images/vote_mtitle.png" />
						<span>이벤트 투표(<?php echo($count); ?>)</span>
					</div>
					<ul>
<?php 
    // 목록이 없을 경우
    if (count($result) > 0)
    {
        // $length = count($result);
        foreach ($result as $items)
        {
            $vote_seq               = $items["VOTE_SEQ"];
            $vote_cate1_name        = $items["VOTE_CATE_NAME"];
            $cate_2dept_name        = $items["VOTE_CATE_SUB_NAME"];
            $subject                = $items["VOTE_SUBJECT"];
            $vote_context           = $items["VOTE_CONTEXT"];
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
            $reply_count            = "0";
            
            if ($vote_real_name =="" || $vote_real_type == "3")
            {
                if ($cateSubImagePath == "")
                    $vote_real_name = $cateSubImagePath;
                else
                    $vote_real_name = $cateImagePath;
            }
?>
						<li>
							<img class="itemimage" src="<?php echo($vote_real_name); ?>" />
							<div class="searchitembox">
								<div class="searchitemtitle title">
<?php 
            if ($_SESSION["member_seq"] != "")
            {
?>
    								<a href="/?mode=voteview&vote_seq=<?php echo($vote_seq); ?>" >
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
								<div class="searchitemdoc">
									<span><?php echo($vote_context); ?></span>
								</div>
								<div class="searchitemcate">
									<span>
										카테고리 : 
<?php 
                                            echo($vote_cate1_name);
                                            if ($cate_2dept_name != "")
                                                echo("&nbsp;>&nbsp;".$cate_2dept_name);
?>
									</span>
								</div>
								<div class="searchitemetc">
									<div class="searchiteminfo">
										<span>참여 : </span>
										<span class="stress"><?php echo($participant_count); ?></span>
										<span>/</span>
										<span>댓글 : </span> 
										<span class="stress"><?php echo($reply_count); ?></span> 
										<span>/</span>
										<span>좋아요 : </span> <span class="stress">50</span>
									</div>
									<div class="searchitemwriter">
										<img src="/<?php echo($writerImage); ?>" /> 
										<span class="writerName"><?php echo($writer); ?></span>
									</div>
								</div>
							</div>
						</li>
<?php 
        }
    }
    else 
    {
?>
						<li>
							<div class="searchitembox">
								<div class="searchitemtitle title">
									<span>검색된 결과가 없습니다.</span>
								</div>
							</div>
						</li>
<?php 
    }
?>
					</ul>
					<div class="goallsearchbutton">
						<span>투표 더보기 ▶</span>
					</div>
				</div>
			</div>
		</div>
		<!-- 투표 게시판 목록 끝 -->
		<!-- 투표 게시판 목록 시작 -->
		<div class="board">
			<div class="boardbox">
<?php
    $page       = $_GET["page"];
    $count      = $vote->getVoteSearchListCount($cate_seq, $cate_sub_seq, $keyword);
    $paging     = $vote->makePaging($count, $page);
    $result     = $vote->getVoteSearchList($cate_seq, $cate_sub_seq, $keyword, $paging);
?>	
				<div class="searchtypetitle">
					<img src="/app/images/vote_mtitle.png" />
					<span>일반 투표(<?php echo($count); ?>)</span>
				</div>
				<div class="searchsortlink">
					<div class="searchsortitem">
						<span>추천순</span>
					</div>
					<div class="searchline"></div>
					<div class="searchsortitem">
						<span>최신순</span>
					</div>
					<div class="searchline"></div>
					<div class="searchsortitem">
						<span>좋아요</span>
					</div>
					<div class="searchline"></div>
					<div class="searchsortitem">
						<span>참여순</span>
					</div>
				</div>
				<ul>
<?php 
    // 목록이 없을 경우
    if (count($result) > 0)
    {
        // $length = count($result);
        foreach ($result as $items)
        {
            $vote_seq               = $items["VOTE_SEQ"];
            $vote_cate1_name        = $items["VOTE_CATE_NAME"];
            $cate_2dept_name        = $items["VOTE_CATE_SUB_NAME"];
            $subject                = $items["VOTE_SUBJECT"];
            $vote_context           = $items["VOTE_CONTEXT"];
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
            $reply_count            = "0";
            
            if ($vote_real_name =="" || $vote_real_type == "3")
            {
                if ($cateSubImagePath == "")
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
								<a href="/?mode=voteview&vote_seq=<?php echo($vote_seq); ?>" >
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
    else 
    {
?>
					<li>
						<div class="larea">
						</div>
						<div class="rarea">
							<div class="boardtitle title">
								<span>검색된 결과가 없습니다.</span>
							</div>
						</div>
					</li>
<?php 
    }
?>
				</ul>
				<!-- 페이징 시작 -->
    			<div class="paging">
    				<!-- <div class="pagingbutton pageleftend pagenavinoselect"></div> -->
    				<a id="boardprev" href="/?mode=search&page=<?php echo($paging["boardprev"])?>&cate_seq=<?php echo($cate_seq); ?>&cate_sub_seq=<?php echo($cate_sub_seq); ?>&search=<?php echo($keyword); ?>">
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
    					<a id="page" href="/?mode=search&page=<?php echo($i)?>&cate_seq=<?php echo($cate_seq); ?>&cate_sub_seq=<?php echo($cate_sub_seq); ?>&search=<?php echo($keyword); ?>">
    						<span><?php echo($i)?></span>
    					</a>
    				</div>
<?php
    }
?>
    				<a id="boardprev" href="/?mode=search&page=<?php echo($paging["boardnext"])?>&cate_seq=<?php echo($cate_seq); ?>&cate_sub_seq=<?php echo($cate_sub_seq); ?>&search=<?php echo($keyword); ?>">
    					<div class="pagingbutton pageright pagenaviselect">
    					</div>
    				</a>
    				<!-- <div class="pagingbutton pagerightend pagenavinoselect"></div> -->
    			</div>
    			<!-- 페이징 끝 -->
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
<!-- 컨텐츠 끝-->