<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20200809
 *
 */
try
{
    $cateCtrl = new CApp_Handler_Vote_Ctrl();
    $result = $cateCtrl->deleteVoteForm($_POST);
    if (! $result)
    {
        ?>
<script>
		alert("삭제하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=voteform";
</script>
<?php
    }
    else
    {
        ?>
<script>
		alert("샥제되었습니다.");
		location.href	= "/admin_manager.php?mode=voteformlist";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>