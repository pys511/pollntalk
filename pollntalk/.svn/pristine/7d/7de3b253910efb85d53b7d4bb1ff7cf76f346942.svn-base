<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20201215
 *
 */
try
{
    //print_r($_POST);
    //exit;
    $exec       = $_POST["exec"];
    $pageName   = $_POST["pagename"];
    $num        = $_POST["NUM"];
    $procName   = "등록";
    $board      = new CApp_Handler_Admin_board();
    if ($exec == "register")
    {
        $result         = $board->setBoardContext($_POST);
        $procName       = "등록";
        if ($result)
            $pageName   = $pageName."view";
        else
            $pageName   = $pageName."write";
        
        $num        = $result;
        if ($pageName == "boardsupport")
        {
            $memberSeq      = $_POST["member_seq"];
            $array  = new ArrayObject();
            $array->offsetSet("recv_member_seq", $memberSeq);
            $array->offsetSet("cur_pos", $pageName);
            $array->offsetSet("message_type", "1");
            $array->offsetSet("messagecontext", "1대1 고객지원에 대한 답변을 하였습니다.");
            $array->offsetSet("ref_url", "/?mode=boardView&sub=support&num=".$num);
            
            CApp_Handler_Message_Ctrl::instance()->sendMessage($array);
        }
    }
    else if ($exec == "update")
    {
        $result     = $board->updateBoardContext($_POST);
        $procName   = "수정";
        if ($result)
            $pageName   = $pageName."view";
        else
            $pageName   = $pageName."write";
    }
    else
    {
        $result     = $board->deleteBoardContext($_POST);
        $procName   = "삭제";
        $pageName   = $pageName."list";
    }
    
    if (!$result)
    {
        ?>
<script>
		alert("<?php echo($procName); ?>하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=<?php echo($pageName); ?>";
</script>
<?php
    }
    else
    {
        ?>
<script>
		alert("<?php echo($procName); ?>되었습니다.");
		location.href	= "/admin_manager.php?mode=<?php echo($pageName); ?>&num=<?php echo($num); ?>";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>