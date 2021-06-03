<?php
$cateCtrl   = new CApp_Handler_Category_Ctrl();
$depth1Cate = $cateCtrl->getCategoryList();
$curCateSeq = "";

?>
<!-- 카테고리 영역 시작 -->
<div class="categoryarea">
	<div class="categorybox">
		<div class="category">
			<img class="leftbutton" src="/app/images/cate_left.png" />
			<div class="categorybar">
				<div class="categorylist" id="catelist">
<?php
for ($i = 0; $i < count($depth1Cate); $i ++) 
{
    $disp_cate_seq      = $depth1Cate[$i]["CATE_SEQ"];
    $cate_name          = $depth1Cate[$i]["CATE_NAME"];
    $cate_is_cert       = $depth1Cate[$i]["CATE_IS_CERT"];
    if ($_GET["cate_seq"] == $disp_cate_seq)
        $curCateSeq     = $disp_cate_seq;
    
        
        if($cate_is_cert == 0){
        ?>
            <div class="categoryitem">
            	<a href="/index.php?mode=votelist&cate_seq=<?php echo($disp_cate_seq);?>" onmouseover="highlightCategory(this, '<?php echo($disp_cate_seq); ?>')">
            		<span <?php if ($disp_cate_seq == $_GET["cate_seq"]) echo("class='title'"); ?>><?php echo($cate_name); ?></span>
				</a>
			</div>
		<?php
     } else{
         if($_SESSION['cert'] == 1 && $_SESSION['adult'] == 1){
         ?>
         	<div class="categoryitem">
            	<a href="/index.php?mode=votelist&cate_seq=<?php echo($disp_cate_seq);?>" onmouseover="highlightCategory(this, '<?php echo($disp_cate_seq); ?>')">
            		<span <?php if ($disp_cate_seq == $_GET["cate_seq"]) echo("class='title'"); ?>><?php echo($cate_name); ?></span>
				</a>
			</div>
         <?php                
         } else {
             if($_SESSION['member_seq'] == ""){
                 ?>
                <div class="categoryitem">
                 	<a href='javascript:void(0);' onclick="uselogin();">
                 		<span <?php if ($disp_cate_seq == $_GET["cate_seq"]) echo("class='title'"); ?>><?php echo($cate_name); ?></span>
    				</a>
    			</div>
    			<?php
             } else {
         	?>
             	<div class="categoryitem">
    				<a href='javascript:void(0);' onclick="goCert();">
    					<span <?php if ($disp_cate_seq == $_GET["cate_seq"]) echo("class='title'"); ?>><?php echo($cate_name); ?></span>
    				</a>
    			</div>
         <?php
             }
         }
     }
}
?>					
				</div>
			</div>
			<img class="rightbutton" src="/app/images/cate_right.png" />
		</div>
	</div>
</div>
<?php
if ($mode == "votelist") 
{
?>
<div class="categorysubarea">
	<div class="categorysubbox">
<?php
    $depth2Cate         = $cateCtrl->getSubCategory4View();
    $cate_parent_seq    = "";
    $isFirst            = true;
    for ($i = 0; $i < count($depth2Cate); $i ++) 
    {
        $cate_temp_seq  = $depth2Cate[$i]["CATE_PARENT_SEQ"];
        if ($cate_parent_seq != $cate_temp_seq) 
        {
            if (! $isFirst) 
            {
?>
		</ul>
<?php
            }
?>
		<ul class="categorysublist" id="catesublist_<?php echo($cate_temp_seq); ?>" style="<?php if ($cate_temp_seq == $_GET["cate_seq"]) { echo("display: block;");} else {echo("display: none;");} ?>">
<?php
            $cate_parent_seq = $cate_temp_seq;
        }

        $disp_cate_seq  = $depth2Cate[$i]["CATE_SEQ"];
        $cate_name      = $depth2Cate[$i]["CATE_NAME"];
?>
			<li class="categorySubitem" id="cate_sub_<?php echo($cate_parent_seq); ?>_<?php echo($disp_cate_seq); ?>">
				<a href="/index.php?mode=votelist&cate_seq=<?php echo($cate_parent_seq);?>&cate_sub_seq=<?php echo($disp_cate_seq); ?>" onmouseover="highlightSubCategory(this)"> 
					<span><?php echo($cate_name); ?></span>
				</a>
			</li>
<?php
        $isFirst = false;
    }
?>
		</ul>
	</div>
</div>
<?php
}
?>
<!-- 카테고리 영역 끝 -->