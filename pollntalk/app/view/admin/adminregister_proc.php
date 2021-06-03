<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  ajax로 받은 문의사항 정보를 처리
 */
try {
    $update = new CApp_Handler_Admin_Ctrl();
    $result = $update->registerAdmin($_POST);
    
        if (!$result)
        {
            ?>
<script>
		alert("등록중 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=adminlist";
</script>
<?php
    }
    else
    {
        ?>
<script>
		alert("등록 되었습니다.");
		location.href	= "/admin_manager.php?mode=adminlist";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>