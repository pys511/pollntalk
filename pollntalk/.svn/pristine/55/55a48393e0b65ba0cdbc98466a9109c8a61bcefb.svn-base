<?php
/**
 * @auth   	: PARK YS
 * @date	: 20210414
 * mailSend 처리
 */

    $result = CApp_Handler_Util_Email::instance()->sendEmail($_POST);
    
    if($result === false){
        ?>
        <script>
        alert("이메일 발송에 실패하였습니다. 다시 한번 시도해보시기 바랍니다.");
        location.href	= "/admin_manager.php?mode=emaillist";
        </script>
        <?php 
    } else {    
        ?>
        <script>
        alert("이메일 발송에 성공하였습니다.");
        location.href	= "/admin_manager.php?mode=emaillist";
        </script>
        <?php
    }
?>