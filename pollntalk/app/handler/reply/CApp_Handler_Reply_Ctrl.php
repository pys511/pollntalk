<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200806
 *  댓글 처리
 */
class CApp_Handler_Reply_Ctrl extends CCore_Lib_Routines_Handler
{
    public function __construct()
    {
    }
    
    /*
     * 댓글 등록
     */
    public function registerReply($array)
    {
        $voteSeq        = $array['reply_vote_seq'];
        if ($voteSeq == "")
            $voteSeq    = $array['reply_vote_form_seq'];
        $replyContext   = $array['replycontext'];
        $replyKind      = $array['host_kind'];
        $replyType      = "";
        $parentSeq      = "";
        if ($replyContext != "")
        {
            $replyType  = "1";
            $parentSeq  = "0";
        }
        
        $query  = "INSERT INTO REPLY
                    (
                      REPLY_TYPE,
                      HOST_KIND,
                      REPLY_WRITER_SEQ,
                      HOST_SEQ,
                      PARENT_SEQ,
                      REPLY_CONTEXT
                    )
                    VALUES
                    (
                      :REPLY_TYPE,
                      :HOST_KIND,
                      :REPLY_WRITER_SEQ,
                      :HOST_SEQ,
                      :PARENT_SEQ,
                      :REPLY_CONTEXT
                    )";
        
        $memberSeq  = $_SESSION["member_seq"];
        if ($_SESSION["member_seq"] == "")
        {
            if ($_SESSION["admin_seq"] != "")
                $memberSeq  = "0";
            else
                return false;
        }
        
        $this->query($query);
        $this->bind("REPLY_TYPE", $replyType);
        $this->bind("HOST_KIND", $replyKind);
        $this->bind("REPLY_WRITER_SEQ", $memberSeq);
        $this->bind("HOST_SEQ", $voteSeq);
        $this->bind("PARENT_SEQ", $parentSeq);
        $this->bind("REPLY_CONTEXT", $replyContext);
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        
        if (! $result)
            return false;
            
        return true;
    }
    
    /*
     * 댓글 등록
     */
    public function registerSubReply($array)
    {
        $voteSeq        = $array['parent_vote_seq'];
        if ($voteSeq == "")
            $voteSeq    = $array['parent_vote_form_seq'];
        $replyContext   = $array['subreply_context'];
        $replySeq       = $array['parent_replyseq'];
        
        $query  = "SELECT
                        REPLY_TYPE, HOST_KIND, HOST_SEQ
                    FROM
                        REPLY
                    WHERE
                        REPLY_SEQ = :REPLY_SEQ";
        
        $this->query($query);
        
        $this->bind("REPLY_SEQ", $replySeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        $query  = "INSERT INTO REPLY
                    (
                      REPLY_TYPE,
                      HOST_KIND,
                      REPLY_WRITER_SEQ,
                      HOST_SEQ,
                      PARENT_SEQ,
                      REPLY_CONTEXT
                    )
                    VALUES
                    (
                      :REPLY_TYPE,
                      :HOST_KIND,
                      :REPLY_WRITER_SEQ,
                      :HOST_SEQ,
                      :PARENT_SEQ,
                      :REPLY_CONTEXT
                    )";
        
        $memberSeq  = $_SESSION["member_seq"];
        if ($_SESSION["member_seq"] == "")
        {
            if ($_SESSION["admin_seq"] != "")
                $memberSeq  = "0";
            else
                return false;
        }
        
        $this->query($query);
        $this->bind("REPLY_TYPE", $result[0]["REPLY_TYPE"]);
        $this->bind("HOST_KIND", $result[0]["HOST_KIND"]);
        $this->bind("REPLY_WRITER_SEQ", $memberSeq);
        $this->bind("HOST_SEQ", $result[0]["HOST_SEQ"]);
        $this->bind("PARENT_SEQ", $replySeq);
        $this->bind("REPLY_CONTEXT", $replyContext);
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        
        if (! $result)
            return false;
            
        return true;
    }
    
    public function getReplyListCount($voteSeq)
    {
        $query  = "SELECT
                        COUNT(*) AS CNT
                    FROM
                        REPLY
                    WHERE
                        HOST_SEQ = :HOST_SEQ";
        
        $this->query($query);
        $this->bind("HOST_SEQ", $voteSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
            
        if (! $result)
            return false;
            
        return $result[0]["CNT"];
    }
    
    public function getReplyList($voteSeq, $paging)
    {
        $query  = "SELECT 
                    	REPLY_SEQ,
                    	REPLY_TYPE,
                    	HOST_KIND,
                    	REPLY_WRITER_SEQ,
                        CASE WHEN B.member_seq IS NOT NULL THEN B.nname
                    		 WHEN REPLY_WRITER_SEQ = 0 		  THEN '관리자'
                    		 ELSE ''
                        END AS NNAME,
                    	CASE WHEN B.member_seq IS NOT NULL THEN B.pic
                    		 WHEN REPLY_WRITER_SEQ = 0 		  THEN 'app/images/admin/admin.png'
                    		 ELSE ''
                        END AS PIC,
                    	HOST_SEQ,
                        (SELECT COUNT(*) FROM REPLY DD WHERE DD.PARENT_SEQ = A.REPLY_SEQ) AS SUBREPLY_COUNT,
                    	PARENT_SEQ,
                    	REPLY_CONTEXT,
                    	REPLY_REGI_DATE
                    FROM 
                    	REPLY A
                    	LEFT JOIN
                        MEMBER B
                    	ON A.REPLY_WRITER_SEQ = B.MEMBER_SEQ
                    WHERE
                        HOST_SEQ = :HOST_SEQ
                    ORDER BY REPLY_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("HOST_SEQ", $voteSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        if (! $result)
            return false;
            
        return $result;
    }
    
    public function getReplyListByKindCount($voteSeq, $host_kind, $keyword)
    {
        $query  = "SELECT
                        COUNT(*) AS CNT
                    FROM
                        REPLY 
                    WHERE
                        ((:HOST_KIND IS NOT NULL AND HOST_KIND = :HOST_KIND) OR
                        (:HOST_KIND IS NULL AND 0=0)) AND
                        PARENT_SEQ = '0'";
        
        if ($voteSeq != "")
            $query   .= " AND HOST_SEQ = :HOST_SEQ";
        
        $this->query($query);
        $this->bind("HOST_KIND", $host_kind);
        if ($voteSeq != "")
            $this->bind("HOST_SEQ", $voteSeq);
       
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (! $result)
            return false;
                
        return $result[0]["CNT"];
    }
    
    public function getReplyListByKind($voteSeq, $host_kind, $keyword, $pageing)
    {
        $query  = "SELECT
                        REPLY_SEQ,
                    	REPLY_TYPE,
                    	HOST_KIND,
                    	REPLY_WRITER_SEQ,
                        CASE WHEN B.member_seq IS NOT NULL THEN B.nname
                    		 WHEN REPLY_WRITER_SEQ = 0 		  THEN '관리자'
                    		 ELSE ''
                        END AS NNAME,
                    	CASE WHEN B.member_seq IS NOT NULL THEN B.pic
                    		 WHEN REPLY_WRITER_SEQ = 0 		  THEN 'app/images/admin/admin.png'
                    		 ELSE ''
                        END AS PIC,
                    	HOST_SEQ,
                        (SELECT COUNT(*) FROM REPLY DD WHERE DD.PARENT_SEQ = A.REPLY_SEQ) AS SUBREPLY_COUNT,
                    	PARENT_SEQ,
                    	REPLY_CONTEXT,
                    	REPLY_REGI_DATE
                    FROM
                        REPLY A
                        LEFT JOIN
                        MEMBER B
                        ON A.REPLY_WRITER_SEQ = B.MEMBER_SEQ
                        INNER JOIN
                        VOTE C
                        ON A.HOST_SEQ = C.VOTE_SEQ
                    WHERE
                        ((:HOST_KIND IS NOT NULL AND HOST_KIND = :HOST_KIND) OR
                        (:HOST_KIND IS NULL AND 0=0)) AND
                        PARENT_SEQ = '0'";
        
        if ($voteSeq != "")
            $query   .= " AND HOST_SEQ = :HOST_SEQ ";
        
        $query      .= "ORDER BY REPLY_SEQ DESC
                        LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $pageing["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("HOST_KIND", $host_kind);
        if ($voteSeq != "")
            $this->bind("HOST_SEQ", $voteSeq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (! $result)
            return false;
            
        return $result;
    }
    
    public function getReplyListByVoteFormCount($voteSeq)
    {
        $query  = "SELECT
                        COUNT(*) AS CNT
                    FROM
                        REPLY
                    WHERE
                        HOST_SEQ = :HOST_SEQ AND
                        HOST_KIND = '2' AND
                        PARENT_SEQ = '0'";
        
        $this->query($query);
        $this->bind("HOST_SEQ", $voteSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        if (! $result)
            return false;
            
        return $result[0]["CNT"];
    }
    
    public function getReplyListByVoteForm($voteSeq, $paging)
    {
        $query  = "SELECT 
                    	REPLY_SEQ,
                    	REPLY_TYPE,
                    	HOST_KIND,
                    	REPLY_WRITER_SEQ,
                        CASE WHEN B.member_seq IS NOT NULL THEN B.nname
                    		 WHEN REPLY_WRITER_SEQ = 0 		  THEN '관리자'
                    		 ELSE ''
                        END AS NNAME,
                    	CASE WHEN B.member_seq IS NOT NULL THEN B.pic
                    		 WHEN REPLY_WRITER_SEQ = 0 		  THEN 'app/images/admin/admin.png'
                    		 ELSE ''
                        END AS PIC,
                    	HOST_SEQ,
                        (SELECT COUNT(*) FROM REPLY DD WHERE DD.PARENT_SEQ = A.REPLY_SEQ) AS SUBREPLY_COUNT,
                    	PARENT_SEQ,
                    	REPLY_CONTEXT,
                    	REPLY_REGI_DATE
                    FROM 
                    	REPLY A
                    	LEFT JOIN
                        MEMBER B
                    	ON A.REPLY_WRITER_SEQ = B.MEMBER_SEQ
                    WHERE
                        HOST_SEQ = :HOST_SEQ AND
                        HOST_KIND = '2' AND
                        PARENT_SEQ = '0'
                    ORDER BY REPLY_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("HOST_SEQ", $voteSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        if (! $result)
            return false;
            
        return $result;
    }
    
    public function getReplyListByVoteCount($voteSeq)
    {
        $query  = "SELECT
                        COUNT(*) AS CNT
                    FROM
                        REPLY
                    WHERE
                        HOST_SEQ = :HOST_SEQ AND
                        HOST_KIND = '1' AND
                        PARENT_SEQ = '0'";
        
        $this->query($query);
        $this->bind("HOST_SEQ", $voteSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        if (! $result)
            return false;
            
        return $result[0]["CNT"];
    }
    
    public function getReplyListByVote($voteSeq, $paging)
    {
        $query  = "SELECT 
                    	REPLY_SEQ,
                    	REPLY_TYPE,
                    	HOST_KIND,
                    	REPLY_WRITER_SEQ,
                        CASE WHEN B.member_seq IS NOT NULL THEN B.nname
                    		 WHEN REPLY_WRITER_SEQ = 0 		  THEN '관리자'
                    		 ELSE ''
                        END AS NNAME,
                    	CASE WHEN B.member_seq IS NOT NULL THEN B.pic
                    		 WHEN REPLY_WRITER_SEQ = 0 		  THEN 'app/images/admin/admin.png'
                    		 ELSE ''
                        END AS PIC,
                    	HOST_SEQ,
                        (SELECT COUNT(*) FROM REPLY DD WHERE DD.PARENT_SEQ = A.REPLY_SEQ) AS SUBREPLY_COUNT,
                    	PARENT_SEQ,
                    	REPLY_CONTEXT,
                    	REPLY_REGI_DATE
                    FROM 
                    	REPLY A
                    	LEFT JOIN
                        MEMBER B
                    	ON A.REPLY_WRITER_SEQ = B.MEMBER_SEQ
                    WHERE
                        HOST_SEQ = :HOST_SEQ AND
                        HOST_KIND = '1' AND
                        PARENT_SEQ = '0'
                    ORDER BY REPLY_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("HOST_SEQ", $voteSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        if (! $result)
            return false;
            
        return $result;
    }
    
    public function getSubReplyList($parentSeq)
    {
        $query  = "SELECT
                    	REPLY_SEQ,
                    	REPLY_TYPE,
                    	HOST_KIND,
                    	REPLY_WRITER_SEQ,
                        CASE WHEN B.member_seq IS NOT NULL THEN B.nname
                    		 WHEN REPLY_WRITER_SEQ = 0 		  THEN '관리자'
                    		 ELSE ''
                        END AS NNAME,
                    	CASE WHEN B.member_seq IS NOT NULL THEN B.pic
                    		 WHEN REPLY_WRITER_SEQ = 0 		  THEN 'app/images/admin/admin.png'
                    		 ELSE ''
                        END AS PIC,
                    	HOST_SEQ,
                        (SELECT COUNT(*) FROM REPLY DD WHERE DD.PARENT_SEQ = A.REPLY_SEQ) AS SUBREPLY_COUNT,
                    	PARENT_SEQ,
                    	REPLY_CONTEXT,
                    	REPLY_REGI_DATE
                    FROM
                    	REPLY A
                    	LEFT JOIN
                        MEMBER B
                    	ON A.REPLY_WRITER_SEQ = B.MEMBER_SEQ
                    WHERE
                        PARENT_SEQ = :PARENT_SEQ
                    ORDER BY REPLY_SEQ DESC";
        
        $this->query($query);
        $this->bind("PARENT_SEQ", $parentSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        if (! $result)
            return false;
            
        return $result;
    }
    
    public function removeReply($array)
    {
        $replySeq   = $array['reply_seq'];
        $query      = "DELETE FROM REPLY WHERE REPLY_SEQ = :REPLY_SEQ"; 
        
        $this->query($query);
        $this->bind("REPLY_SEQ", $replySeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);
        
        if (! $result)
            return false;
            
        return true;
    }
    
    public function getReplyCount()
    {
        $query      = "SELECT COUNT(*) AS CNT FROM REPLY";
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
}