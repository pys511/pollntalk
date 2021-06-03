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
$vote_kind      = $_GET["vote_kind"];
$keyword        = $_POST["keyword"];
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
$adverInfo      = $adsetCtrl->getAdverByPosition("3");
?>
    	<a href="javascript:window.open('http://<?php echo($adverInfo["ad_url"]); ?>');"><img class="wad" src="/<?php echo($adverInfo["ad_tempimg"]); ?>" /></a> 
    	<a href="javascript:window.open('http://<?php echo($adverInfo["ad_url"]); ?>');"><img class="mad" src="/<?php echo($adverInfo["ad_mtempimg"]); ?>" /></a>
<?php 

?>
		</div>
	</div>
	<!-- 광고 베너 영역 끝 -->
	<!-- 투표 양식 안내 시작 -->
	<div class="votedisparea  boundray">
		<div class="votedispbox">
			<div class="votecontbox">
        		<div class="voteguide">
        			<div class="votetopic">
        				<span>투표양식</span>
        			</div>
        			<div class="votedoc">
        				<span>투표 양식을 선택하여 내용을 수정해서 손쉽게 등록할 수 있습니다.</span>
        			</div>
        		</div>
    		</div>
		</div>
	</div>
	<!-- 투표 양식 안내 끝 -->
	<!-- 투표 전시 목록 영역 시작 -->
	<div class="votedisparea">
		<div class="votedispcont boundray vbbottomspace">
			<div class="votedispbox">
				<div class="votewritemenu">
					<a href="/?mode=voteformlist&vote_kind=1">
        				<div class="votewritemenuitem <?php if ($vote_kind == "1") echo("selected"); else echo("noselected"); ?>">
        					<span>일반 투표 양식</span>
        				</div>
    				</a>
    				<a href="/?mode=voteformlist&vote_kind=2">
        				<div class="votewritemenuitem <?php if ($vote_kind == "1") echo("noselected"); else echo("selected"); ?>">
        					<span>이벤트 투표 양식</span>
        				</div>
    				</a>
				</div>
			</div>
		</div>
<?php
$cateCtrl   = new CApp_Handler_Category_Ctrl();
$cateResult = $cateCtrl->getCategoryList();
foreach($cateResult as $cateRow)
{
    $cateName   = $cateRow["CATE_NAME"];
    $cateSeq    = $cateRow["CATE_SEQ"];
    
    $vote       = new CApp_Handler_Vote_Ctrl();
    $voteResult = $vote->getVoteFormListByCategory($cateSeq, $keyword);
?>
		<div class="votedispcont boundray">
			<div class="votedispbox">
				<div class="votesubtitle">
					<img class="mtitlesign" src="/app/images/vote_mtitle.png" />
					<span><?php echo($cateName); ?></span>
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
    foreach($voteResult as $voteRow)
    {
        $voteformSeq    = $voteRow["VOTE_FORM_SEQ"];
        $voteSubject    = $voteRow["VOTE_SUBJECT"];
        $cate1depthName = $voteRow["VOTE_CATE_NAME"];
        $cate2depthName = $voteRow["VOTE_CATE_SUB_NAME"];
        $cate2depthName = $voteRow["VOTE_CATE_SUB_NAME"];
        $voteContext    = $voteRow["VOTE_FORM_CONTEXT"];
        $resourcePath   = $voteRow["VOTE_RESOURCE_PATH"];
        $resourceType   = $voteRow["VOTE_RESOURCE_TYPE"];
        if ($resourceType == "1")
            $resourcePath  = "/".$resourcePath;
        else if ($resourceType == "3")
            $resourcePath  = $voteRow["CATE_REAL_IMAGE_PATH"];
?>
							<div class="votedispitem votespace" style="background-image: url('<?php echo($resourcePath); ?>')">
								<div class="votedispinfobox">
									<div class="votedispitemtitle title">
<?php 
    if ($_SESSION["member_seq"] != "")
    {
?>
    									<a href="/?mode=voteform&vote_form_seq=<?php echo($voteformSeq); ?>">
<?php
    }
    else
    {
?> 
										<a href="#" onclick="callLogin()">
<?php    
    }
?>
    										<span><?php echo($voteSubject); ?></span>
    									</a>
									</div>
								</div>
								<div class="votedispInfocont">
									<div class="votedispInfoItem">
    									<div class="votedispinfo">
    										<span class="normal">카테고리 : <?php echo($cate1depthName); if ($cate2depthName != "") { echo("&nbsp;>&nbsp;"); echo($cate2depthName); } ?></span>
    									</div>
    									<div class="votedispinfo">
    										<span><?php echo($voteContext); ?></span>
    									</div>
									</div>
								</div>
							</div>
<?php 
    }
?>					
						</div>
					</div>
					<img class="naviright wright" src="/app/images/vote_right.png" />
				</div>
			</div>
		</div>
<?php 
}
?>
	</div>
	<!-- 투표 전시 목록 영역 끝 -->
</div>