<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20201215
 *
 */
try
{
    $exec       = $_POST["exec"];
    $pageName   = $_POST["pagename"];
    $num        = $_POST["NUM"];
    $procName   = "등록";
    $board      = new CApp_Handler_Board_Ctrl();
    if ($exec == "register")
    {
        $result     = $board->setBoardContext($_POST);
        $procName   = "등록";
        $num        = $result;
    }
    else if ($exec == "update")
    {
        $result     = $board->updateBoardContext($_POST);
        $procName   = "수정";
    }
    else
    {
        $result     = $board->deleteBoardContext($_POST);
        $procName   = "삭제";
    }
    
    if (!$result)
    {
        ?>
<script>
		alert("<?php echo($procName); ?>하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/index.php?mode=boardwrite&sub=<?php echo($pageName); ?>";
</script>
<?php
    }
    else
    {
        ?>
<script>
		alert("<?php echo($procName); ?>되었습니다.");
		location.href	= "/index.php?mode=boardView&sub=<?php echo($pageName); ?>&num=<?php echo($num); ?>";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>