<?php
/**
 * @auth   	: PARK Y.S.
 * @date	: 20210423
 * 서비스 처리
 */
try
{
    
    $adsetCtrl      = new CApp_Handler_Util_AdSetting();
    $proc           = $_POST["proc_name"];
    if ($proc == "register")
        $result         = $adsetCtrl->setAdver($_POST);
    else 
        $result         = $adsetCtrl->deleteAdver($_POST);
    if (! $result)
    {
        ?>
<script>
		alert("등록하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=adversetting";
</script>
<?php 
    }
    else
    {
?>
<script>
		alert("등록되었습니다.");
		location.href	= "/admin_manager.php?mode=adversetting";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
?>
    <script>
		alert("등록하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=adversetting";
	</script>
<?php 
    
}
?>
