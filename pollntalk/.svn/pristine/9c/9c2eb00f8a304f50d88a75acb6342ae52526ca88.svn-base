<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20200809
 *  투표 양식 처리
 */
try
{
    //print_r($_POST);
    //exit;
    $cateCtrl = new CApp_Handler_Vote_Ctrl();
    $result = $cateCtrl->registerVote($_POST);
    if (! $result)
    {
?>
<script>
		alert("등록하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=voteview&vote_seq=<?php echo($_POST["vote_seq"]); ?>";
</script>
<?php
    }
    else
    {
?>
<script>
		alert("등록되었습니다.");
		location.href	= "/admin_manager.php?mode=voteview&vote_seq=<?php echo($_POST["vote_seq"]); ?>";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>