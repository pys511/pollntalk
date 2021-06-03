<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20210602
 *  인증번호 보내기
 */
try
{
    $email = $_POST["email"];
    $authNum = $_GET["authNum"];
    
    $templateArray = [
        "title" => "pollntalk 인증메일.",
        "context" => "인증번호는 [".$authNum."]입니다.",
        "buttonname" => "폴엔톡",
        "buttonlink" => "http://pollntalk2021.cafe24.com/",
        "template" => "./app/view/template/mail_template.html"
    ];
    
    
    $templateBody = CApp_Handler_Util_Email::instance()->setTemplate($templateArray);
    
    $mailArray = [
        'mailTo' => $email,
        'subject' => 'pollntalk 가입을 위한 인증메일입니다.',
        'mailFrom' => 'pollntalk@naver.com',
        'mail_context' => $templateBody,
        'file_list' => ''
    ];
    
    $result = CApp_Handler_Util_Email::instance()->sendEmail($mailArray);
    
    
    if (! $result)
        echo (FALSE);
    else
        echo (TRUE);
}
catch (CException $ex)
{
    $ex->printException();
}
?>