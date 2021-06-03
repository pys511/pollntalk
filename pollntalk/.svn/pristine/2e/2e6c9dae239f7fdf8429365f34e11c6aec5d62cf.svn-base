<?php
/**
 * @auth   	: PARK YS
 * @date	: 20210404
 * 서비스 처리
 */
try
{
    $vote   = new CApp_Handler_Search_Ctrl();
    $result = $vote->registerkeyword($_POST);
    if (! $result)
    {
?>
<script>
		alert("등록하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=searchkeyword";
</script>
<?php
    }
    else if ($result < 0)
    {
?>
        <script>
        alert("이미 등록된 키워드 입니다.");
        location.href	= "/admin_manager.php?mode=searchkeyword";
        </script>
<?php 
    }
    else
    {
?>
<script>
		alert("등록되었습니다.");
		location.href	= "/admin_manager.php?mode=searchkeyword";
</script>
<?php
    }
}
catch (CException $ex)
{
    $ex->printException();
    ?>
    <script>
		alert("등록하는 중에 오류가 발생하였습니다. 다시 한번 시도해보시기 바랍니다.");
		location.href	= "/admin_manager.php?mode=searchkeyword";
	</script>
    <?php 
    
}
?>