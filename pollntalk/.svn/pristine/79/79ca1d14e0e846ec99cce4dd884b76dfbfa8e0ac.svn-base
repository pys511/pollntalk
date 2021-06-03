<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20201011
 *  회원정보 저장
 */
try
{
    $exec           = $_POST["proc"];
    $member         = new CApp_Handler_Admin_member();
    $result         = false;
    $procName       = "";
    if ($exec != "delete")
    {
        $result     = $member->updateMemberByAdmin($_POST);
        $procName   = "등록";
    }
    else
    {
        $result     = $member->outMemberByAdmin($_POST);
        $procName   = "탈퇴 처리";
    }
    if (! $result)
    {
?>
<script>
		alert("<?php echo($procName); ?>하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=memberlist";
</script>
<?php
    }
    else
    {
?>
<script>
		alert("<?php echo($procName); ?>되었습니다.");
		location.href	= "/admin_manager.php?mode=outmemberlist";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>