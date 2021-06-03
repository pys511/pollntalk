<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200829
 *  투표 목록
 */
try 
{
    $cate_seq               = $_GET["cate_seq"];
    $cate_sub_seq           = $_GET["cate_sub_seq"];
    $vote_kind              = $_GET["vote_kind"];
    $vote_cate_seq          = $_POST["vote_cate_seq"];
    $vote_cate_sub_seq      = $_POST["vote_cate_sub_seq"];
    if ($vote_cate_seq != "")
        $cate_seq       = $cate_sub_seq;
    
    if ($vote_cate_sub_seq != "")
        $cate_sub_seq   = $vote_cate_sub_seq;
    
    $catectrl       = new CApp_Handler_Category_Ctrl();
    $cateInfo       = $catectrl->getCategory4View($cate_seq, $cate_sub_seq);
    $cate_name      = $cateInfo[0]["CATE_NAME"];
    $cate_sub_name  = $cateInfo[0]["CATE_SUB_NAME"];

    $keyword = $_GET["keyword"];
} 
catch (CException $ex) 
{
    $ex->printException();
}
?>
<!doctype html>
<html id="start" xmlns="http://www.w3.org/1999/xhtml">
<?php
require_once ('./app/view/admin/header.php');
?>
<body id="body">
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
            	<div class="contentBox">
					<div class="boardTitle">
						<img src="/app/images/admin/title_mark.gif" />
<?php
if ($cate_name == "")
    $cate_name = "전체";
?>
            			<span><?php echo($cate_name); ?><?php echo(">".$cate_sub_name); ?> 목록</span>
					</div>
					<form id="frmVote" method="post" action="/admin_manager.php?mode=votelist&vote_kind=<? echo($vote_kind);?>">
						<input type="hidden" id="vote_cate_seq" name="vote_cate_seq" value="<?php echo($vote_cate_seq);?>" />
    					<select id="cate_seq" name="cate_seq">
    						<option value="-">1차 카테고리</option>
<?php
try
{
    $catelist   = $catectrl->getCategoryList();
    for ($i = 0; $i < count($catelist); $i++)
    {
        $val_cate_seq   = $catelist[$i]["CATE_SEQ"];
        $val_cate_name  = $catelist[$i]["CATE_NAME"];
?>
							<option value="<?php echo($val_cate_seq); ?>" <?php if ($val_cate_seq == $vote_cate_seq) echo("selected"); ?>><?php echo($val_cate_name); ?></option>
<?php
    }
}
catch (CException $ex)
{
    $ex->executeException();
}
?>
    					</select>
    					<input type="hidden" id="vote_cate_sub_seq" name="vote_cate_sub_seq" value="<?php echo($vote_cate_sub_seq);?>" />
    					<select id="cate_sub_seq" name="cate_sub_seq">
    						<option value="-">2차 카테고리</option>
<?php 
try
{
    //echo($cate_seq);
    if ($vote_cate_seq != "" && $vote_cate_seq != "0")
    {
        $cate_sub_seqs      = $catectrl->getCategorySubList($vote_cate_seq);
        foreach ($cate_sub_seqs as $items)
        {
            $val_cate_sub_seq   = $items["CATE_SEQ"];
            $val_cate_sub_name  = $items["CATE_NAME"];
?>
    						<option value="<?php echo($val_cate_sub_seq); ?>" <?php if ($val_cate_sub_seq == $vote_cate_sub_seq) echo("selected"); ?>><?php echo($val_cate_sub_name); ?></option>
<?php
        }
    }
}
catch (CException $ex)
{
    $ex->executeException();
}
?>
    					</select>
						<div class="boardBox">
    						<div class="boardField">
    							<span class="fieldShortShort">선택</span> 
    							<span class="fieldDefault">카테고리</span> 
    							<span class="fieldCommon">제목</span>
    							<span class="fieldShort">작성자</span>
    							<span class="fieldNumber">조회수</span> 
    							<span class="fieldNumber">참여수</span>
    							<span class="fieldNumber">댓글수</span> 
    							<span class="fieldNumber">추천수</span>
    							<span class="fieldNumber">마감일</span> 
    							<!-- <span class="fieldNumber">작성일</span> -->
    						</div>
    						<div class="boardList">
    							<ul>
<?php
try
{
    $keyword    = "";
    $page       = $_GET["page"];
    $vote       = new CApp_Handler_Vote_Ctrl();
    $count      = $vote->getVoteListCount4Admin($vote_cate_seq, $vote_cate_sub_seq, $vote_kind, $keyword);
    $paging     = $vote->makePaging($count, $page);
    $result     = $vote->getVoteList4Admin($vote_cate_seq, $vote_cate_sub_seq, $vote_kind, $keyword, $paging);
    // 목록이 없을 경우
    if (count($result) <= 0 || $result == false) 
    {
?>
            						<li id="noData">
    									<div class="boardListItem">
    										<div class="borderListItemGuide">
    											<span>등록된 컨텐츠가 없습니다.</span>
    										</div>
    									</div>
    								</li>
<?php
    } // 목록이 있을 경우
    else 
    {
        // $length = count($result);
        foreach ($result as $items) 
        {
            $vote_seq           = $items["VOTE_SEQ"];
            $vote_cate1_name    = $items["VOTE_CATE_NAME"];
            $cate_2dept_name    = $items["VOTE_CATE_SUB_NAME"];
            $subject            = $items["VOTE_SUBJECT"];
            $writer             = $items["VOTE_WRITER_NAME"];
            $participant_count  = $items["VOTE_PARTICIPATE_COUNT"];
            $view_count         = $items["VOTE_VIEW_COUNT"];
            $recomm_count       = $items["VOTE_RECOMM_COUNT"];
            $end_date           = $items["VOTE_END_DATE"];
            $regi_date          = $items["VOTE_REGI_DATE"];
            $reply_count        = "0";
?>
            						<li id="sample_advertiselist">
            							<div class="boardListItem">
    										<div class="fieldShortShort">
    											<input id="ir_seq" name="ir_seq[]" type="checkbox" value="<?php echo($vote_seq); ?>" />
    										</div>
    										<a id="adverName" href="/admin_manager.php?mode=voteinfo&vote_seq=<?php echo($vote_seq)?>"> 
    											<span class="fieldDefault">
<?php 
                                                    echo($vote_cate1_name);
                                                    if ($cate_2dept_name != "")
                                                        echo("&nbsp;>&nbsp;".$cate_2dept_name);
?>
    											</span> 
    											<span class="fieldCommon"><?php echo($subject); ?></span> 
    											<span class="fieldShort"><?php echo($writer); ?></span>
    										</a>
    										<span class="fieldNumber"><?php echo($view_count); ?></span> 
    										<span class="fieldNumber"><?php echo($participant_count); ?></span>
    										<span class="fieldNumber"><?php echo($reply_count); ?></span> 
    										<span class="fieldNumber"><?php echo($recomm_count); ?></span> 
    										<span class="fieldNumber"><?php echo($end_date); ?></span> 
    										<!-- <span class="fieldNumber"><?php echo($regi_date); ?></span> -->
										</div>
    								</li>
<?php
        }
    }
}
catch (CException $ex)
{
    $ex->executeException();   
}
?>
            					</ul>
    						</div>
    					</div>
    					<!-- 페이징 시작 -->
    					<div class="boardListButtonBox">
    						<div class="buttonLeftBox">
    							<a id="boardprev" href="/admin_manager.php?mode=votelist&vote_kind=<?php echo($vote_kind); ?>&page=<?php echo($paging["boardprev"])?>">
    								<span class="buttonText">◀</span>
    							</a>
    						</div>
<?php
// print_r($paging);
for ($i = (integer) $paging["start"]; $i <= (integer) $paging["end"]; $i ++) 
{
?>
    						<div id="adverpaging" class="boardPaging">
    							<div id="pageSample" class="buttonLeftBox">
    								<a id="page" href="/admin_manager.php?mode=votelist&vote_kind=<?php echo($vote_kind); ?>&page=<?php echo($i)?>">
    									<span id="pageText" class="buttonText">
    										<?php echo($i)?>
    									</span>
    								</a>
    							</div>
    						</div>
<?php
}
?>
    						<div class="buttonLeftBox">
    							<a id="boardnext" href="/admin_manager.php?mode=votelist&vote_kind=<?php echo($vote_kind); ?>&page=<?php echo($paging["boardnext"])?>">
    								<span class="buttonText">▶</span>
    							</a>
    						</div>
    					</div>
    					<!-- 페이징 끝 -->
					</form>
            	</div>
			</div>
		</div>
	</div>
<?php
require_once ('./app/view/admin/footer.php');
?>
	<script type="text/javascript" src="/app/js/admin_vote_list.js?v=1.0" charset="utf-8">
	</script>
</body>
</html>