<?php

class CApp_Handler_Util_Email extends CCore_Lib_Routines_Handler
{
    private static  $m_instance = null;
    public function __construct()
    {
    }

    /*
    * instance 반환
    */
    public static function instance ()
    {
        if (is_null(self::$m_instance))
            self::$m_instance = new CApp_Handler_Util_Email();
        
        return CApp_Handler_Util_Email::$m_instance;
    }
    
    /*
     * Email 보내기
     */
    
    public function sendEmail($array) {
        
        //$to = "=?$charset?B?".base64_encode($array["mailTo"])."?=";
        $to = $array["mailTo"];
        $charset = "UTF-8";
        
        if(strcmp($to, "ALL") == '0')
        {
            $emailto = $this->gerMemberEmail();
                             
            foreach ($emailto as $i)
            {
                $to = $i["email"];
                
                $subject = $array["subject"];
                $subject = "=?$charset?B?".base64_encode($subject)."?=";
                $uid = md5(uniqid(time()));
                $mail_from = $array["mailFrom"];
                
                $header = "From: $mail_from\r\n";
                $header .="MIME-Version: 1.0\r\n";
                $header .="Content-Type: Multipart/mixed; boundary=\"$uid\"";
                
                $mail_body = "This is a multi-part message in MIME format.\r\n\r\n";
                $mail_body .=     "--$uid\r\n";
                $mail_body .=     "Content-Type: text/html; charset=UTF-8\r\n";
                $mail_body .=     "Content-Transfer-Encoding: 8bit\r\n\r\n".$array["mail_context"]."\r\n";
                $mail_body .=      "--$uid\r\n";
                
                trigger_error ( print_r($array, true), E_USER_ERROR );
                
                $filelsit   = $array["file_list"];
                if ($filelsit != "")
                {
                    $filelist   = json_decode($filelsit, true);
                    $itemCount = 0;
                    $lastCount = count($filelist);
                    
                    foreach ($filelist as $item){
                        
                        $realName = $item["real_name"];
                        $fileName = $item["temp_name"];
                        $size = filesize($fileName);
                        
                        
                        $file2 = fopen($fileName,'r');
                        $content = fread($file2, $size);
                        fclose($file2);
                        
                        $mail_body .= "Content-Type: application/octet-stream;charset=utf-8; name=\"".$realName."\"\r\n";
                        $mail_body .= "Content-Transfer-Encoding: base64 \r\n";
                        $mail_body .= "Content-Disposition: attachment; filename=\"".$realName."\"\r\n\r\n";
                        $mail_body .= base64_encode($content)."\r\n";
                        if(++$itemCount === $lastCount){
                            $mail_body .= "--".$uid."--";
                        } else {
                            $mail_body .= "--".$uid."\r\n";
                        }
                    }
                }
                
                $email = mail($to, $subject, $mail_body, $header);
                
                if(!$email)
                {
                    trigger_error ( $to, E_USER_ERROR );
                    trigger_error ( print_r(error_get_last(), true), E_USER_ERROR );
                    return false;
                } else {
                    $result = $this->insertMailDB($to,$array["subject"],$array["mail_context"],$array["file_list"]);
                }
            }
            
            return $result;
        }
        else 
        {
            $subject = $array["subject"];
            $subject = "=?$charset?B?".base64_encode($subject)."?=";
            $uid = md5(uniqid(time()));
            $mail_from = $array["mailFrom"];
            
            $header = "From: $mail_from\r\n";
            $header .="MIME-Version: 1.0\r\n";
            $header .="Content-Type: Multipart/mixed; boundary=\"$uid\"";
            
            $mail_body = "This is a multi-part message in MIME format.\r\n\r\n";
            $mail_body .=     "--$uid\r\n";
            $mail_body .=     "Content-Type: text/html; charset=UTF-8\r\n";
            $mail_body .=     "Content-Transfer-Encoding: 64bit\r\n\r\n".$array["mail_context"]."\r\n";
            $mail_body .=      "--$uid\r\n";
            
            trigger_error ( print_r($array, true), E_USER_ERROR );
            
            $filelsit   = $array["file_list"];
            if ($filelsit != "")
            {
                $filelist   = json_decode($filelsit, true);
                $itemCount = 0;
                $lastCount = count($filelist);
                
                foreach ($filelist as $item){
                    
                    $realName = $item["real_name"];
                    $fileName = $item["temp_name"];
                    $size = filesize($fileName);
                    
                    
                    $file2 = fopen($fileName,'r');
                    $content = fread($file2, $size);
                    fclose($file2);
                    
                    $mail_body .= "Content-Type: application/octet-stream;charset=utf-8; name=\"".$realName."\"\r\n";
                    $mail_body .= "Content-Transfer-Encoding: base64 \r\n";
                    $mail_body .= "Content-Disposition: attachment; filename=\"".$realName."\"\r\n\r\n";
                    $mail_body .= base64_encode($content)."\r\n";
                    if(++$itemCount === $lastCount){
                        $mail_body .= "--".$uid."--";
                    } else {
                        $mail_body .= "--".$uid."\r\n";
                    }
                }
            }
            
            $email = mail($to, $subject, $mail_body, $header);
            
            if(!$email)
            {
                trigger_error ( $to, E_USER_ERROR );
                trigger_error ( print_r(error_get_last(), true), E_USER_ERROR );
                return false;
            } else {
                $result = $this->insertMailDB($array["mailTo"],$array["subject"],$array["mail_context"],$array["file_list"]);
                return $result;
            }
        }

    }
    
    
    /*
     * 보낸이메일을 DB에 저장 하기
     */
   
    public function insertMailDB($to, $subject, $context, $list) {
        $mail_to             = $to;
        $mail_subject        = $subject;
        $mail_context        = $context;
        
        $query      = "INSERT INTO `ADMIN_MAIL`(`MAIL_TO`, `MAIL_SUBJECT`, `MAIL_CONTEXT`) VALUES (:MAIL_TO, :MAIL_SUBJECT, :MAIL_CONTEXT)";
        
        $this->query($query);
        
        $this->bind("MAIL_TO", $mail_to);
        $this->bind("MAIL_SUBJECT", $mail_subject);
        $this->bind("MAIL_CONTEXT", $mail_context);
        $result     = $this->execute(CCore_Lib_Routines_Handler::INSERT);
            
        $query      = "SELECT MAIL_NUM FROM ADMIN_MAIL ORDER BY MAIL_NUM DESC LIMIT 1";
        $this->query($query);
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $mailSeq   = $result[0]["MAIL_NUM"];
            
        $filelist   = json_decode($list, true);
            $query      = "INSERT INTO MAIL_ATTACH_FILE
                        (
                          MAIL_SEQ,
                          FILE_PATH,
                          FILE_NAME
                        )
                        VALUES
                        (
                          :MAIL_SEQ,
                          :FILE_PATH,
                          :FILE_NAME
                        )";
            
            
            foreach($filelist as $item)
            {
                $this->query($query);
                $this->bind("MAIL_SEQ", $mailSeq);
                $this->bind("FILE_PATH", $item["temp_name"]);
                $this->bind("FILE_NAME", $item["real_name"]);
                $result     = $this->execute(CCore_Lib_Routines_Handler::INSERT);
            }
            
    
        return $result;
    }
    
    
    /*
     * 회원들의 Email를 가져옴
     */
    
    public function gerMemberEmail() {
        $query      = "SELECT email from MEMBER ORDER BY member_seq DESC";
        $this->query($query);
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     * 
     */
    
    public function setTemplate($array) {
        
        $template = file_get_contents($array["template"]);
        
        foreach($array as $key => $value)
        {
            $template = str_replace('{#'.$key.'#}', $value, $template);
        }
        
        return $template;
    }
    
}