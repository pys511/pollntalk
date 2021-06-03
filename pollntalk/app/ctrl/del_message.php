<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20201021
 *  메시지 삭제
 */
try
{
    $message        = new CApp_Handler_Message_Ctrl();
    $result         = $message->deleteMessage($_POST);
    $resultData     = "";
    if (!$result)
        $resultData = "MSG_DEL_FALSE";
    else
        $resultData = "MSG_DEL_TRUE";
    
    $pageName       = $_POST["mypageName"];
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<script>
		location.href	= "/?mode=mypage&sub=message&messagesub=<?php echo($pageName); ?>&delmsgresult=<?php echo($resultData); ?>";
</script>