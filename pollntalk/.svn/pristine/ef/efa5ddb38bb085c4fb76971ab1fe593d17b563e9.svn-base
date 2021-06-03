<?php
/**
 * @auth   	: JEON JY
 * @date	: 20200903
 * 서비스 처리
 */
try
{
    //print_r($_POST);
    //exit;
    $vote   = new CApp_Handler_Product_Ctrl();
    $result = $vote->registerBankAccount($_POST);
    if (! $result)
    {
        ?>
<script>
		alert("등록하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=bankaccount";
</script>
<?php
    }
    else
    {
?>
<script>
		alert("등록되었습니다.");
		location.href	= "/admin_manager.php?mode=bankaccount";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>