<?php
/**
 * @auth   	: PARK YS
 * @date	: 20210411
 * 서비스 처리
 */
try
{    
    $upload   = new CApp_Handler_Util_Fileupload();
    $result = $upload->setMainPic();
    
    if (! $result)
    {
        ?>
<script>
		alert("업로드하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=mainsetting";
</script>
<?php 
    }
    else
    {
?>
<script>
		alert("업로드되었습니다.");
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
		alert("업로드하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=mainsetting";
	</script>
    <?php 
    
}
?>
