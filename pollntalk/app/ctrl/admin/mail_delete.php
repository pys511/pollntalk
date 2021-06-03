<?php
 

try{
    
    $mail          = new CApp_Handler_Admin_mail();
    $result        = $mail->deleteEmail($_POST);
    
    if (!$result)
    {
        ?>
<script>
		alert("삭제하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=emaillist";
</script>
<?php
    }
    else
    {
        ?>
<script>
		alert("삭제 되었습니다.");
		location.href	= "/admin_manager.php?mode=emaillist";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}


?>