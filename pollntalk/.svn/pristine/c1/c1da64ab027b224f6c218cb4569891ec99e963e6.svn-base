<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200806
 *
 */
try
{
    $exec       = $_GET["exec"];
    $procName   = "등록";
    $cateCtrl   = new CApp_Handler_Category_Ctrl();
    if ($exec != "del")
    {
        $result     = $cateCtrl->registerCategory($_POST);
        $procName   = "등록";
    }
    else
    {
        $result = $cateCtrl->deleteCategory($_POST);
        $procName   = "삭제";
    }
    
    if (!$result)
    {
        ?>
<script>
		alert("<?php echo($procName); ?>하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=category";
</script>
<?php
    }
    else
    {
        ?>
<script>
		alert("<?php echo($procName); ?>되었습니다.");
		location.href	= "/admin_manager.php?mode=category";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>