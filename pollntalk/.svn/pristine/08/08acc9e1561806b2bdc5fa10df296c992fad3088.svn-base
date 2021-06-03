<?php
/**
 * @auth   	: PARK YS
 * @date	: 20210411
 * 서비스 처리
 */
try
{
    $proc           = $_POST["proc"];
    $mainCtrl       = new CApp_Handler_Main_Ctrl();
    
    if ($proc == "register")
        $result     = $mainCtrl->setText($_POST);
    else
    {
        $seq        = $_POST["seq"];
        $result     = $mainCtrl->deleteText($seq);
    }
    
    if (! $result)
    {
?>
<script>
		alert("처리하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=mainsetting";
</script>
<?php 
    }
    else
    {
?>
<script>
		alert("처리되었습니다.");
		location.href	= "/admin_manager.php?mode=mainsetting";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
?>
    <script>
		alert("처리하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=mainsetting";
	</script>
<?php 
    
}
?>