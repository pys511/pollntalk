<?php
/**
 * @auth   	: PARK YS
 * @date	: 20210530
 * 패스워드 팢기 mailSend 처리
 */

    $memberCtrl = new CApp_Handler_Member_Ctrl();
    $authNum = $memberCtrl ->setAuthNum($_POST);
    
    if($authNum == -1){
        ?>
        <script>
        	alert("이메일 발송에 실패하였습니다. 다시 한번 시도해보시기 바랍니다.");
        	parent.closePopup();
        </script>
        <?php
    } else {
        
        $templateArray = [
            "title" => "pollntalk 비밀번호 인증",
            "context" => "pollntalk 비밀번호변경 인증번호는 ".$authNum."입니다.",
            "buttonname" => "비밀번호변경 페이지이동",
            "buttonlink" => "http://pollntalk2021.cafe24.com/app/view/page/password_change.php?email=".$_POST['email'],
            "template" => "./app/view/template/mail_template.html"
        ];
        
        
        $templateBody = CApp_Handler_Util_Email::instance()->setTemplate($templateArray);
        
        $mailArray = [
            'mailTo' => $_POST['email'],
            'subject' => 'pollntalk 비밀번호변경 메일입니다.',
            'mailFrom' => 'pollntalk@naver.com',
            'mail_context' => $templateBody,
            'file_list' => ''
        ];
        
        
        $result = CApp_Handler_Util_Email::instance()->sendEmail($mailArray);
        
        if($result === false){
            ?>
        	<script>
        		alert("이메일 발송에 실패하였습니다. 다시 한번 시도해보시기 바랍니다.");
       			parent.closePopup();
        	</script>
        	<?php 
        } else {    
            ?>
        	<script>
        		alert("이메일로 인증번호를 발송하였습니다.");
        		parent.closePopup();
        	</script>
        	<?php
        }
    }
?>