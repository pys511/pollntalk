<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20201119
 *  구독 처리 
 */
class CApp_Handler_Vote_Subscribe extends CCore_Lib_Routines_Handler
{
    public function __construct()
    {
    }
    
    /*
     *  구독 신청
     */
    public function subscribeVote($member_seq)
    {
        $query  = "INSERT INTO SUBSCRIBE_VOTE_LIST
                    (
                      MEMBER_SEQ,
                      USER_SEQ
                    )
                    VALUES
                    (
                      :MEMBER_SEQ,
                      :USER_SEQ
                    )";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $member_seq);
        $this->bind("USER_SEQ", $_SESSION["member_seq"]);
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        
        if (! $result)
            return false;
        
        return true;
    }
    
    /*
     *  나에게 구독 신청한 갯수
     */
    public function subscribeCountToMe($keyword)
    {
        $query = "SELECT
        				COUNT(*) AS CNT
        			FROM
        			    SUBSCRIBE_VOTE_LIST
                    WHERE
                        MEMBER_SEQ = :MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $_SESSION["member_seq"]);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  내가 구독 신청한 갯수
     */
    public function subscribeCountToYou($keyword)
    {
        $query = "SELECT
        				COUNT(*) AS CNT
        			FROM
        			    SUBSCRIBE_VOTE_LIST
                    WHERE
                        USER_SEQ = :MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("USER_SEQ", $_SESSION["member_seq"]);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
}
?>