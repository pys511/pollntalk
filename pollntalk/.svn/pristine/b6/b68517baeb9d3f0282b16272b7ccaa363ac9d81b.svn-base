<?php
/** 
 *   @auth   : PARK Y.S.
 *   @date   : 20210423
 *   광고 통계 저장
 * */
class CApp_Handler_Util_AdLink extends CCore_Lib_Routines_Handler{
    
    function insertDB($ip, $subject) {
        
        $query = "SELECT count(*) FROM ad_stats where ad_subject = :SUBJECT and ip_address = :IP";
        
        $this->query($query);
        $this->bind("SUBJECT", $subject);
        $this->bind("IP", $ip);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $count = $result[0]["count(*)"];
        
        if($count <= 0){
            $query = "INSERT INTO ad_stats (ad_subject, ip_address, count) values (:SUBJECT, :IP, 1)";
        } else {
            $query = "UPDATE ad_stats set count = count+1, ad_regidate = current_timestamp() where ad_subject = :SUBJECT and ip_address = :IP";
        }
        
        $this->query($query);
        $this->bind("SUBJECT", $subject);
        $this->bind("IP", $ip);
        
        if($count <= 0){
            $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        } else {
            $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        }
        
        if (! $result)
            return false;
            
            return true;
    }
}