<?php
/*
 * mypage message
 */
$messagesub = "";
$keyword    = "";

if (array_key_exists(CONST_WEB_MESSAGE::MSGSUB, $_GET))
    $messagesub = $_GET[CONST_WEB_MESSAGE::MSGSUB];
else
    $messagesub = "recv";

// 기본은 member
if ($messagesub == "")
    $messagesub = "recv"; // 추후 기본으로 할 페이지로 할 것.

$messagesubcontentpath = "./app/view/page/mypage_message_" . $messagesub . ".php";

try
{
    $message        = new CApp_Handler_Message_Ctrl();
    $recvcount      = $message->getRecvMessageListCount($keyword);
    $sendcount      = $message->getSendMessageListCount($keyword);
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<div class="messagecontent">
	<!-- 쪽지 상황 시작 -->
	<div class="messagestatus">
		<div class="messagestatustitle <?php if ($messagesub == "recv") { ?> title <?php } ?>">
			<a href="/?mode=mypage&sub=message&messagesub=recv"> <span>받은 쪽지(<?php echo($recvcount); ?>)</span>
			</a>
		</div>
		<div class="messagestatustitle <?php if ($messagesub == "send") { ?> title <?php } ?>">
			<a href="/?mode=mypage&sub=message&messagesub=send"> <span>보낸 쪽지(<?php echo($sendcount); ?>)</span>
			</a>
		</div>
	</div>
	<!-- 쪽지 상황 끝 -->
<?php
// mypage content page
require_once ($messagesubcontentpath);
?>
	<!-- 쪽지 게시판 끝 -->
</div>
<?php 
if ($_GET["delmsgresult"] != "")
{
?>
<script type="text/javascript">
var msgresult	= "<?php echo($_GET["delmsgresult"]); ?>";
if (msgresult == "MSG_DEL_FALSE")
   	alert("메시지를 삭제하는데 실패하였습니다. 잠시 후에 다시 시도해보시기 바랍니다.");
else
    alert("삭제되었습니다.");
</script>
<?php 
}
?>