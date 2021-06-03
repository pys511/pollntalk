<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200806
 *  댓글 처리
 */
try
{
    $replyProc  = $_POST["reply_proc"];
    
    $replyCtrl  = new CApp_Handler_Reply_Ctrl();
    $result     = "";
    
    if ($replyProc == "register")
        $result     = $replyCtrl->registerReply($_POST);
    else 
        $result     = $replyCtrl->removeReply($_POST);
    
    $resultData = "";
    $voteSeq        = $_POST["reply_vote_seq"];
    $voteFormSeq    = $_POST["reply_vote_form_seq"];
        
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