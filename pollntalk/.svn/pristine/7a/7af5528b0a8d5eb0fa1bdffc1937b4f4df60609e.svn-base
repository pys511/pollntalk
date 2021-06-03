<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20200809
 *  투표 정보 등록 처리
 */
try
{
    $vote   = new CApp_Handler_Vote_Ctrl();
    $result = $vote->registerVote($_POST);
    if (! $result)
    {
?>
<script>
		alert("등록하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		history.back();
</script>
<?php
    }
    else
    {
        $userList   = CApp_Handler_Subscribe_Ctrl::instance()->getSubscribeUser();
        foreach ($userList as $userItem)
        {
            $array  = new ArrayObject();
            $array->offsetSet("recv_member_seq", $userItem["USER_SEQ"]);
            $array->offsetSet("cur_pos", "voteregister");
            $array->offsetSet("message_type", "1");
            $array->offsetSet("messagecontext", "회원님이 구독한 ".$userItem["nname"]."님의 새로운 투표가 개설되었습니다.");
            $array->offsetSet("ref_url", "/?mode=voteview&vote_seq=".$_POST["vote_seq"]);
            
            CApp_Handler_Message_Ctrl::instance()->sendMessage($array);
        }
?>
<script>
		alert("등록되었습니다.");
		location.href	= "/index.php?mode=vote_register&vote_seq=<?php echo($result); ?>";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>