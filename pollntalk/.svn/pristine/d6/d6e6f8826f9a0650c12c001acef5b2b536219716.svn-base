<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200806
 *
 */
try
{
    $memberCtrl = new CApp_Handler_Member_Ctrl();
    $result = $memberCtrl->certMember($_POST);
    if (! $result){
        ?>
<script>
		alert("인증중 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		opener.location.reload();
		window.close();
</script>
<?php
    }
    else{
        $_SESSION['cert'] = "1";
        $_SESSION['adult'] = $memberCtrl->check_age(substr($_POST["birth_day"], 0, 4), 20);
        ?>
        <script>
        alert("휴대전화인증에 성공하셨습니다.");
        opener.location.reload();
		window.close();
        </script>
        <?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>
