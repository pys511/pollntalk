<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20201111
 *  투표 정보 처리
 */
try
{
    //print_r($_POST);
    //exit;
    $cateCtrl   = new CApp_Handler_Vote_Ctrl();
    $is_event   = $_POST["is_event"];
    $result     = $cateCtrl->updateVoteInfo($_POST);
    if (! $result)
    {
        ?>
<script>
		alert("등록하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=voteinfo&vote_seq=<?php echo($_POST["vote_seq"]); ?>";
</script>
<?php
    }
    else
    {
        if ($is_event == "1")
        {
            //print_r($_POST);
            //exit;
            $eventInfo  = new CApp_Handler_Vote_Eventctrl();
            $result     = $eventInfo->registerVoteEventContext($_POST);
            if (!$result)
            {
?>
<script>
        		alert("등록하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
        		location.href	= "/admin_manager.php?mode=voteinfo&vote_seq=<?php echo($_POST["vote_seq"]); ?>";
</script>
<?php              
            }
?>
<script>
		alert("등록되었습니다.");
		location.href	= "/admin_manager.php?mode=voteinfo&vote_seq=<?php echo($_POST["vote_seq"]); ?>";
</script>
<?php
        }
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>