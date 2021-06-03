<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200806
 *  댓글 처리
 */
try
{
    $replyCtrl  = new CApp_Handler_Reply_Ctrl();
    $result     = "";
    
    $result     = $replyCtrl->registerSubReply($_POST);
    
    $resultData = "";
    $voteSeq        = $_POST["parent_vote_seq"];
    $voteFormSeq    = $_POST["parent_vote_form_seq"];
        
    if (! $result)
        $resultData = "REPLY_FALSE";
    else 
        $resultData = "REPLY_TRUE";
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<script>
		location.href	= "/admin_manager.php?mode=replylist&vote_seq=<?php echo($voteSeq); ?>&vote_form_seq=<?php echo($voteFormSeq);?>&replyresult=<?php echo($resultData); ?>";
</script>