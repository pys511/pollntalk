<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20201009
 *  투표 응답 처리
 */
try
{
    $vote_seq       = $_POST["vote_seq"];
    //print_r($_POST);
    //exit;
    $voteRespCtrl   = new CApp_Handler_Vote_Respctrl();
    $result         = $voteRespCtrl->registerVoteRespInfo($_POST);
    if (!$result)
    {
?>
<script>
		alert("등록하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/index.php?mode=vote_view&vote_seq=<?php echo($vote_seq); ?>";
</script>
<?php
    }
    else
    {
?>
<script>
		alert("등록되었습니다.");
		location.href	= "/index.php?mode=vote_result&vote_seq=<?php echo($vote_seq); ?>";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}