<?php
/**
 * @auth   	: JEON JY
 * @date	: 20201103
 * 포인트 처리
 */
try
{
    //print_r($_POST);
    //exit;
    $exec       = $_GET["exec"];
    $procName   = "등록";
    $vote       = new CApp_Handler_Point_Ctrl();
    if ($exec != "del")
    {
        $result     = $vote->registerPointInfo($_POST);
        $procName   = "등록";
    }
    else
    {
        $result     = $vote->deletePointInfo($_POST);
        $procName   = "삭제";
    }
    
    if (! $result)
    {
        ?>
<script>
		alert("<?php echo($procName); ?>하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=pointregister";
</script>
<?php
    }
    else
    {
?>
<script>
		alert("<?php echo($procName); ?>되었습니다.");
		location.href	= "/admin_manager.php?mode=pointregister";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>