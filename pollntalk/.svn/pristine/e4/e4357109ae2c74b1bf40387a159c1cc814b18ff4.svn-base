<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20201123
 *  구독 신청 하기
 */
class CApp_Handler_Subscribe_Ctrl extends CCore_Lib_Routines_Handler
{
    private static  $m_instance = null;
    public function __construct()
    {
    }
    
    /*
     * instance 반환
     */
    public static function instance()
    {
        if (is_null(self::$m_instance))
            self::$m_instance = new CApp_Handler_Subscribe_Ctrl();
            
        return self::$m_instance;
    }
    
    public function setSubscribe($array)
    {
        $targetMemberSeq    = $array["subscribe_member_seq"];
        $query              = "SELECT COUNT(*) AS CNT FROM SUBSCRIBE_VOTE_LIST WHERE MEMBER_SEQ = :MEMBER_SEQ AND USER_SEQ = :USER_SEQ";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $targetMemberSeq);
        $this->bind("USER_SEQ",  $_SESSION["member_seq"]);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        if (intval($result[0]["CNT"]) > 0)
            return -1;
        
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
        $this->bind("MEMBER_SEQ", $targetMemberSeq);
        $this->bind("USER_SEQ",  $_SESSION["member_seq"]);
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        
        if (! $result)
            return false;
            
        return true;
    }
    
    /*
     *  구독 신청 개수
     */
    public function getSubscribeListToYouCount($keyword)
    {
        $query  = "SELECT 
                        COUNT(*) AS CNT 
                    FROM 
                        SUBSCRIBE_VOTE_LIST 
                    WHERE 
                        USER_SEQ = :USER_SEQ";
        
        $this->query($query);
        $this->bind("USER_SEQ", $_SESSION["member_seq"]);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  구독 목록 조회
     */
    public function getSubscribeListToYou($keyword, $paging)
    {
        $query  = "SELECT 
                    	SUBSCRIBE_SEQ,
                    	A.MEMBER_SEQ,
                    	CASE WHEN A.MEMBER_SEQ IS NOT NULL THEN B.nname
                    		 WHEN A.MEMBER_SEQ IS NULL           THEN '관리자'
                    		 ELSE ''
                    	END AS NNAME,
                    	CASE WHEN A.MEMBER_SEQ IS NOT NULL THEN B.pic
                    		 WHEN A.MEMBER_SEQ IS NULL	       THEN 'app/images/admin/admin.png'
                    		 ELSE ''
                    	END AS PIC,
                    	CC.VOTE_RESP_CNT,
                    	DD.SUBSCRIBE_CNT,
                        EE.VOTE_CNT,
                    	A.USER_SEQ,
                        FF.VOTE_CNT AS NEW_VOTE_CNT,
                    	REGI_DATE
                    FROM 
                    	SUBSCRIBE_VOTE_LIST A
                    	LEFT JOIN
                    	MEMBER B
                    	ON A.MEMBER_SEQ = B.member_seq
                    	LEFT OUTER JOIN
                    	(
                    		SELECT
                    			COUNT(*) AS VOTE_RESP_CNT,
                    			VOTE_MEMBER_SEQ
                    		FROM
                    			VOTE_RESP_LOG C
                    		WHERE 
                    			C.VOTE_MEMBER_SEQ = :USER_SEQ
                    	) CC
                    	ON B.MEMBER_SEQ = CC.VOTE_MEMBER_SEQ
                    	LEFT OUTER JOIN
                    	(
                    		SELECT
                    			COUNT(*) AS SUBSCRIBE_CNT, 
                    			D.USER_SEQ
                    		FROM
                    			SUBSCRIBE_VOTE_LIST D
                    		ORDER BY D.USER_SEQ
                    	) DD
                    	ON A.USER_SEQ = DD.USER_SEQ
                    	INNER JOIN
                    	(
                    		SELECT
                    			COUNT(*) AS VOTE_CNT,
                    			VOTE_WRITER_SEQ
                    		FROM
                    			VOTE E
                    		GROUP BY E.VOTE_WRITER_SEQ
                    	) EE
                    	ON B.MEMBER_SEQ = EE.VOTE_WRITER_SEQ
                        LEFT OUTER JOIN
                        (
                    		SELECT
                    			COUNT(*) AS VOTE_CNT,
                                VOTE_WRITER_SEQ
                    		FROM
                    			VOTE F
                    		WHERE
                    			VOTE_SEQ NOT IN (SELECT VOTE_SEQ FROM VOTE_RESP_LOG F1 WHERE F1.VOTE_MEMBER_SEQ = :USER_SEQ GROUP BY VOTE_SEQ)
                        ) FF
                        ON B.MEMBER_SEQ = FF.VOTE_WRITER_SEQ
                    WHERE
                    	A.USER_SEQ = :USER_SEQ
                    ORDER BY SUBSCRIBE_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("USER_SEQ", $_SESSION["member_seq"]);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  구독 신청 개수
     */
    public function getSubscribeListToMeCount($keyword)
    {
        $query  = "SELECT
                        COUNT(*) AS CNT
                    FROM
                        SUBSCRIBE_VOTE_LIST
                    WHERE
                        MEMBER_SEQ = :MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $_SESSION["member_seq"]);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  구독 목록 조회
     */
    public function getSubscribeListToMe($keyword, $paging)
    {
        $query  = "SELECT
                    	SUBSCRIBE_SEQ,
                    	A.MEMBER_SEQ,
                    	CASE WHEN A.MEMBER_SEQ IS NOT NULL THEN B.nname
                    		 WHEN A.MEMBER_SEQ IS NULL           THEN '관리자'
                    		 ELSE ''
                    	END AS NNAME,
                    	CASE WHEN A.MEMBER_SEQ IS NOT NULL THEN B.pic
                    		 WHEN A.MEMBER_SEQ IS NULL	       THEN 'app/images/admin/admin.png'
                    		 ELSE ''
                    	END AS PIC,
                    	CC.VOTE_RESP_CNT,
                    	DD.SUBSCRIBE_CNT,
                        EE.VOTE_CNT,
                    	A.USER_SEQ,
                        FF.VOTE_CNT AS NEW_VOTE_CNT,
                    	REGI_DATE
                    FROM
                    	SUBSCRIBE_VOTE_LIST A
                    	LEFT JOIN
                    	MEMBER B
                    	ON A.MEMBER_SEQ = B.member_seq
                    	LEFT OUTER JOIN
                    	(
                    		SELECT
                    			COUNT(*) AS VOTE_RESP_CNT,
                    			VOTE_MEMBER_SEQ
                    		FROM
                    			VOTE_RESP_LOG C
                    		WHERE
                    			C.VOTE_MEMBER_SEQ = :MEMBER_SEQ
                    	) CC
                    	ON B.MEMBER_SEQ = CC.VOTE_MEMBER_SEQ
                    	LEFT OUTER JOIN
                    	(
                    		SELECT
                    			COUNT(*) AS SUBSCRIBE_CNT,
                    			D.MEMBER_SEQ
                    		FROM
                    			SUBSCRIBE_VOTE_LIST D
                    		ORDER BY D.MEMBER_SEQ
                    	) DD
                    	ON A.MEMBER_SEQ = DD.MEMBER_SEQ
                    	INNER JOIN
                    	(
                    		SELECT
                    			COUNT(*) AS VOTE_CNT,
                    			VOTE_WRITER_SEQ
                    		FROM
                    			VOTE E
                    		GROUP BY E.VOTE_WRITER_SEQ
                    	) EE
                    	ON B.MEMBER_SEQ = EE.VOTE_WRITER_SEQ
                        LEFT OUTER JOIN
                        (
                    		SELECT
                    			COUNT(*) AS VOTE_CNT,
                                VOTE_WRITER_SEQ
                    		FROM
                    			VOTE F
                    		WHERE
                    			VOTE_SEQ NOT IN (SELECT VOTE_SEQ FROM VOTE_RESP_LOG F1 WHERE F1.VOTE_MEMBER_SEQ = :MEMBER_SEQ GROUP BY VOTE_SEQ)
                        ) FF
                        ON B.MEMBER_SEQ = FF.VOTE_WRITER_SEQ
                    WHERE
                    	A.MEMBER_SEQ = :MEMBER_SEQ
                    ORDER BY SUBSCRIBE_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("MEMBER_SEQ", $_SESSION["member_seq"]);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  내가 구독한 회원 
     */
    public function getSubscribeUser()
    {
        $query      = "SELECT
                            USER_SEQ,
                            B.nname
                        FROM
                            SUBSCRIBE_VOTE_LIST A INNER JOIN
                            MEMBER B
                        WHERE
                            B.MEMBER_SEQ = :MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $_SESSION["member_seq"]);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
}
?>