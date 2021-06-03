<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20201021
 *  메시지 전송
 */
try
{
    $exec           = $_POST["exec"];
    $message        = new CApp_Handler_Message_Ctrl();
    $result         = false;
    $procName       = "";
    if ($exec != "del")
    {
        $result     = $message->sendMessageAll($_POST);
        $procName   = "등록";
    }
    else
    {
        $result     = $message->deleteMessage($_POST);
        $procName   = "삭제";
    }
    if (! $result)
    {
        ?>d
<script>
		alert("<?php echo($procName); ?>하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=messagelist";
</script>
<?php
    }
    else
    {
?>
<script>
		alert("<?php echo($procName); ?>되었습니다.");
		location.href	= "/admin_manager.php?mode=messagelist";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>