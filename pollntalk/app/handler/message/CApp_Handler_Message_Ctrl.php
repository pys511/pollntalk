<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200919
 *  메시지 처리
 */
class CApp_Handler_Message_Ctrl extends CCore_Lib_Routines_Handler
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
            self::$m_instance = new CApp_Handler_Message_Ctrl();
            
        return self::$m_instance;
    }
    
    /*
     *  메시지 전송
     */
    public function sendMessage($array)
    {
        $recvMemberSeq  = $array["recv_member_seq"];
        
        $query          = "SELECT 
                                COUNT(BLOCK_MEMBER_SEQ) AS CNT
                            FROM 
                                BLOCK_MESSAGE_MEMBER
                            WHERE
                                MEMBER_SEQ = :MEMBER_SEQ AND
                                TARGET_SEQ = :TARGET_SEQ";
                
        $this->query($query);
        $this->bind("MEMBER_SEQ", $recvMemberSeq);
        $this->bind("TARGET_SEQ", $_SESSION["member_seq"]);
        
        $result         = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $count          = $result[0]["CNT"];
        if ($count != "" && $count != "0")
            return false;
        
        $curPos         = $array["cur_pos"];
        $messageType    = $array["message_type"];
        $messageContext = $array["messagecontext"];
        $refUrl         = $array["ref_url"];
        $query  = "INSERT INTO MESSAGE
                    (
                      MESSAGE_TYPE,
                      SENDER,
                      RECVER,
                      VIEW_CHECK,
                      MESSAGE_POS,
                      MESSAGE_CONTEXT,
                      MESSAGE_REF_URL
                    )
                    VALUES
                    (
                      :MESSAGE_TYPE,
                      :SENDER,
                      :RECVER,
                      '0',
                      :MESSAGE_POS,
                      :MESSAGE_CONTEXT,
                      :MESSAGE_REF_URL
                    )";
        
        $this->query($query);
        $this->bind("MESSAGE_TYPE", $messageType);
        $this->bind("SENDER", $_SESSION["member_seq"]);
        $this->bind("RECVER", $recvMemberSeq);
        $this->bind("MESSAGE_POS", $curPos);
        $this->bind("MESSAGE_CONTEXT", $messageContext);
        $this->bind("MESSAGE_REF_URL", $refUrl);
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        
        if (! $result)
            return false;
            
        return true;
    }
    
    /*
     *  메시지 그룹 삭제
     */
    public function sendMessageAll($array)
    {
        $memberlist     = $array["member_seq"];
        $messageContext = $array["messagecontext"];
        $query  = "INSERT INTO MESSAGE
                    (
                      MESSAGE_TYPE,
                      SENDER,
                      RECVER,
                      VIEW_CHECK,
                      MESSAGE_POS,
                      MESSAGE_CONTEXT
                    )
                    VALUES
                    (
                      :MESSAGE_TYPE,
                      :SENDER,
                      :RECVER,
                      '0',
                      :MESSAGE_POS,
                      :MESSAGE_CONTEXT
                    )";
        
        $this->query($query);
        foreach ($memberlist as $item)
        {
            $this->bind("MESSAGE_TYPE", "1");
            $this->bind("SENDER", $_SESSION["admin_seq"]);
            $this->bind("RECVER", $item);
            $this->bind("MESSAGE_POS", "admin");
            $this->bind("MESSAGE_CONTEXT", $messageContext);
            $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        }
        
        return true;
    }
    
    /*
     *  메시지 삭제
     */
    public function deleteMessage($array)
    {
        $inParam	= new ArrayObject();
        $i			= 0;
         foreach ($array["message_seq"] as $item)
        {
            $inParam->offsetSet($i, $item);
            $i++;
        }
            
        if ($inParam->count() > 0)
        {
            $placeHolders	= implode(",", array_fill(0, $inParam->count(), '?'));
            $query          = "DELETE FROM MESSAGE WHERE MESSAGE_SEQ IN ($placeHolders)";
            
            $this->query($query);
            $result = $this->execute(CCore_Lib_Routines_Handler::DELETE, $inParam->getArrayCopy());
        }
        
        if (! $result)
            return false;
            
        return true;
    }
    
    /*
     *  받은 메시지 개수
     */
    public function getRecvMessageListCount($keyword)
    {
        $query  = "SELECT
                        COUNT(MESSAGE_SEQ) AS CNT
                    FROM
                        MESSAGE
                    WHERE
                        RECVER = :RECVER";
        
        $this->query($query);
        $this->bind("RECVER", $_SESSION["member_seq"]);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  받은 메시지 조회
     */
    public function getRecvMessageList($keyword, $paging)
    {
        $query  = "SELECT 
                        MESSAGE_SEQ,
                        MESSAGE_TYPE,
                        SENDER,
                        CASE WHEN B.member_seq IS NOT NULL THEN B.nname
                    		 WHEN SENDER IS NULL           THEN '관리자'
                    		 ELSE ''
                        END AS NNAME,
                    	CASE WHEN B.member_seq IS NOT NULL THEN B.pic
                    		 WHEN SENDER IS NULL	       THEN 'app/images/admin/admin.png'
                    		 ELSE ''
                        END AS PIC,
                        RECVER,
                        VIEW_CHECK,
                        MESSAGE_POS,
                        MESSAGE_CONTEXT,
                        MESSAGE_REF_URL,
                        MESSAGE_REGI_DATE
                    FROM 
                        MESSAGE A
                        LEFT JOIN
                        MEMBER B
                        ON A.SENDER = B.member_seq
                    WHERE
                        A.RECVER = :RECVER
                    ORDER BY MESSAGE_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("RECVER", $_SESSION["member_seq"]);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  보낸 메시지 개수
     */
    public function getSendMessageListCount($keyword)
    {
        $query  = "SELECT
                        COUNT(MESSAGE_SEQ) AS CNT
                    FROM
                        MESSAGE
                    WHERE
                        SENDER = :SENDER";
        
        $this->query($query);
        $this->bind("SENDER", $_SESSION["member_seq"]);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  보낸 메시지 조회
     */
    public function getSendMessageList($keyword, $paging)
    {
        $query  = "SELECT
                        MESSAGE_SEQ,
                        MESSAGE_TYPE,
                        SENDER,
                        CASE WHEN B.member_seq IS NOT NULL THEN B.nname
                    		 WHEN RECVER IS NULL	       THEN '관리자'
                    		 ELSE ''
                        END AS NNAME,
                    	CASE WHEN B.member_seq IS NOT NULL THEN B.pic
                    		 WHEN RECVER IS NULL           THEN 'app/images/admin/admin.png'
                    		 ELSE ''
                        END AS PIC,
                        RECVER,
                        VIEW_CHECK,
                        MESSAGE_POS,
                        MESSAGE_CONTEXT,
                        MESSAGE_REF_URL,
                        MESSAGE_REGI_DATE
                    FROM
                        MESSAGE A
                        LEFT JOIN
                        MEMBER B
                        ON A.RECVER = B.member_seq
                    WHERE
                        A.SENDER = :SENDER
                    ORDER BY MESSAGE_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("SENDER", $_SESSION["member_seq"]);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  메시지 개수
     */
    public function getMessageListCount($array)
    {
        $inParam	   = new ArrayObject();
        $i			   = 0;
        
        if (count($array["member_seq"]) > 0)
        {
            foreach ($array["member_seq"] as $item)
            {
                $inParam->offsetSet($i, $item);
                $i++;
            }
        }
        else
        {
            if ($_GET["member_seq"] != "")
                $inParam->offsetSet(0, $_GET["member_seq"]);
        }
        
        $query          = ""; 
        $placeHolders   = null;
        if ($inParam->count() > 0)
        {
            $placeHolders	= implode(",", array_fill(0, $inParam->count(), '?'));
            $query          = "SELECT
                                    COUNT(MESSAGE_SEQ) AS CNT
                                FROM
                                    MESSAGE
                                WHERE
                                    SENDER IN ($placeHolders)";
        }
        else
        {
            $query          = "SELECT
                                    COUNT(MESSAGE_SEQ) AS CNT
                                FROM
                                    MESSAGE";
        }
        
        $this->query($query);
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT, $inParam->getArrayCopy());
        
        return $result[0]["CNT"];
    }
    
    /*
     *  보낸 메시지 조회
     */
    public function getMessageList($array, $paging)
    {
        $inParam	   = new ArrayObject();
        $i			   = 0;
        
        if (count($array["member_seq"]) > 0)
        {
            foreach ($array["member_seq"] as $item)
            {
                $inParam->offsetSet($i, $item);
                $i++;
            }
        }
        else
        {
            if ($_GET["member_seq"] != "")
                $inParam->offsetSet(0, $_GET["member_seq"]);
        }
        
        $query         = "";
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        if ($inParam->count() > 0)
        {
            $placeHolders	= implode(",", array_fill(0, $inParam->count(), '?'));
            $query          = "SELECT
                                    MESSAGE_SEQ,
                                    MESSAGE_TYPE,
                                    CASE WHEN RECVER_SEQ IS NOT NULL THEN RECVER_NAME
                                		 WHEN RECVER IS NULL	     THEN '관리자'
                                		 ELSE ''
                                    END AS RECVER_NAME,
                                	RECVER,
                                    CASE WHEN SENDER_SEQ IS NOT NULL THEN SENDER_NAME
                                		 WHEN SENDER IS NULL	     THEN '관리자'
                                		 ELSE ''
                                    END AS SENDER_NAME,
                                	SENDER,
                                    VIEW_CHECK,
                                    MESSAGE_POS,
                                    MESSAGE_CONTEXT,
                                    MESSAGE_REF_URL,
                                    MESSAGE_REGI_DATE
                                FROM
                                    MESSAGE A
                                    LEFT JOIN
                                    (
                                        SELECT 
                                            nname AS SENDER_NAME,
                                            member_seq AS SENDER_SEQ
                                        FROM
                                            MEMBER B
                                    ) BB
                                    ON A.SENDER = BB.SENDER_SEQ
                                    LEFT JOIN
                                    (
                                        SELECT 
                                            nname AS RECVER_NAME,
                                            member_seq AS RECVER_SEQ
                                        FROM
                                            MEMBER C
                                    ) CC
                                    ON A.RECVER = CC.RECVER_SEQ
                                WHERE
                                    A.RECVER IN ($placeHolders)
                                ORDER BY MESSAGE_SEQ DESC
                                LIMIT ".$start.", 15";
        }
        else 
        {
            $query          = "SELECT
                                    MESSAGE_SEQ,
                                    MESSAGE_TYPE,
                                    CASE WHEN RECVER_SEQ IS NOT NULL THEN RECVER_NAME
                                		 WHEN RECVER IS NULL	     THEN '관리자'
                                		 ELSE ''
                                    END AS RECVER_NAME,
                                	RECVER,
                                    CASE WHEN SENDER_SEQ IS NOT NULL THEN SENDER_NAME
                                		 WHEN SENDER IS NULL	     THEN '관리자'
                                		 ELSE ''
                                    END AS SENDER_NAME,
                                	SENDER,
                                    VIEW_CHECK,
                                    MESSAGE_POS,
                                    MESSAGE_CONTEXT,
                                    MESSAGE_REF_URL,
                                    MESSAGE_REGI_DATE
                                FROM
                                    MESSAGE A
                                    LEFT JOIN
                                    (
                                        SELECT 
                                            nname AS SENDER_NAME,
                                            member_seq AS SENDER_SEQ
                                        FROM
                                            MEMBER B
                                    ) BB
                                    ON A.SENDER = BB.SENDER_SEQ
                                    LEFT JOIN
                                    (
                                        SELECT 
                                            nname AS RECVER_NAME,
                                            member_seq AS RECVER_SEQ
                                        FROM
                                            MEMBER C
                                    ) CC
                                    ON A.RECVER = CC.RECVER_SEQ
                                ORDER BY MESSAGE_SEQ DESC
                                LIMIT :start, :length";
        }
        
        $this->query($query);
        $this->bind("start", $start);
        $this->bind("length", 15);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT, $inParam->getArrayCopy());
        
        return $result;
    }
}