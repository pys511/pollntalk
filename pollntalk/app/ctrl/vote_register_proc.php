<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20201009
 *  투표 결제 등록 처리
 */
try
{
    $vote_seq       = $_POST["vote_seq"];
    $is_event       = $_POST["is_event"];
    $productCtrl    = new CApp_Handler_Product_Ctrl();
    $result         = $productCtrl->payProduct($_POST);
    if (!$result)
    {
?>
<script>
		alert("등록하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/index.php?mode=vote_register&vote_seq=<?php echo($vote_seq); ?>";
</script>
<?php
    }
    else
    {
        if ($is_event == "1")
        {
            $eventInfo  = new CApp_Handler_Vote_Eventctrl();
            $result     = $eventInfo->registerVoteEventContext($_POST);
            if (!$result)
            {
?>                
<script>
        		alert("등록하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
        		location.href	= "/index.php?mode=vote_register&vote_seq=<?php echo($vote_seq); ?>";
</script>
<?php              
            }
        }
?>
<script>
		alert("등록되었습니다.");
		location.href	= "/index.php?mode=mypage&sub=vote&votesub=info&vote_seq=<?php echo($vote_seq); ?>";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>