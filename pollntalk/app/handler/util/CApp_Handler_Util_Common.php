<?php
/**
 *  @auth   : Jeon JY
 *  @date   : 202100208
 *  공통 기능 처리
 */
class CApp_Handler_Util_Common extends CCore_Lib_Routines_Handler
{
    public function __construct()
    {
    }
    
    public function getAlertMessage()
    {
        $query  = "SELECT
                    	SEQ,
                    	ALERT_KIND,
                        MESSAGE,
                        SENDER,
                        ALERT_DATE
                    FROM
                    (
                    	(
                    		SELECT 
                    			NUM AS SEQ,
                    			'1' AS ALERT_KIND,
                    			NAME AS SENDER,
                    			CONCAT('[공지사항] ', SUBJECT, ' [폴앤톡]') AS MESSAGE,
                    			CREATE_DATE AS ALERT_DATE
                    		FROM 
                    			  BOARD
                    		WHERE
                    			  KIND = '1'
                    		ORDER BY NUM
                    		LIMIT 1
                        )
                        UNION ALL
                        (
                    		SELECT 
                    			MESSAGE_SEQ  AS SEQ,
                    			'2' AS ALERT_KIND,
                    			CASE WHEN B.member_seq IS NOT NULL THEN B.nname
                    				 WHEN SENDER IS NULL           THEN '관리자'
                    				 ELSE ''
                    			END AS SENDER,
                    			CONCAT('[메시지] ', MESSAGE_CONTEXT) AS MESSAGE,
                    			MESSAGE_REGI_DATE AS ALERT_DATE
                    		FROM 
                    			MESSAGE A
                    			LEFT JOIN
                    			MEMBER B
                    			ON A.SENDER = B.member_seq
                    		WHERE
                    			 A.RECVER = :RECVER AND
                                 A.VIEW_CHECK = '0'
                    		ORDER BY MESSAGE_SEQ DESC
                    		LIMIT 1
                        )
                    ) A
                    ORDER BY ALERT_DATE DESC
                    LIMIT 1";
        
        
        $this->query($query);
        $this->bind("RECVER", $_SESSION["member_seq"]);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
}
?>