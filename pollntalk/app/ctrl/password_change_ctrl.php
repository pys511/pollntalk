<?php
/**
 *  @auth   : PARK Y.S.
 *  @date   : 20210423
 *  패스워드 변경 처리
 */
try
{    
    $passCh = new CApp_Handler_Member_Ctrl();
    $result = $passCh -> changePassword($_POST);
    
    if($result == 1){
        ?>
        	<script>
        		alert("비밀번호가 변경되었습니다. 로그인 후 이용부탁드립니다.");
        		location.href="http://pollntalk2021.cafe24.com/"
        	</script>
        	<?php
    }elseif($result == -2){
       ?>
        	<script>
        		alert("인증번호가 잘못되었습니다. 확인 후 다시 한번 시도해보시기 바랍니다.");
        		history.back();
        	</script>
       <?php
    }else{
       ?>
        	<script>
        		alert("잠시문제가 발생하여 처리하지 못하였습니다. 잠시 후 다시 한번 시도해보시기 바랍니다.");
        		location.href="http://pollntalk2021.cafe24.com/"
        	</script>
       <?php
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>