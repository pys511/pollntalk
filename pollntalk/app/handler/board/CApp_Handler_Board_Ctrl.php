<?php
/**
 *  @auth   : YS PARK
 *  @date   : 20201019
 *  게시판 처리
 */
class CApp_Handler_Board_Ctrl extends CCore_Lib_Routines_Handler
{
    public function __construct()
    {
        
    }
    
    /*
     * 게시글수 불러오기
     */
    public function getboardcount($kind)
    {
        $kindCode   = "";
        switch($kind)
        {
            case "notice":
                $kindCode   = "1";
                break;
                
            case "support":
                $kindCode   = "2";
                break;
        }
        
        $query      = "";
        $query      = "SELECT count(*) FROM BOARD WHERE KIND = :KIND";
        
        $this->query($query);
        $this->bind("KIND", $kindCode);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $count = $result[0]["count(*)"];
        
        return $count;
    }
    
    /*
     * 게시판 리스트 불러오기
     */
    public function getBoardList($kind, $paging)
    {
        $kindCode   = "";
        switch($kind)
        {
            case "notice":
                $kindCode   = "1";
                break;
                
            case "faq":
                $kindCode   = "2";
                break;
                
            case "support":
                $kindCode   = "3";
                break;
        }
        
        $query = "SELECT
                        *
                    FROM
                        BOARD
                    WHERE
                        KIND = :KIND
                    ORDER BY NUM DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("KIND", $kindCode);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  이전 게시글 
     */
    public function getPreView($kind, $num)
    {
        $kindCode   = "";
        switch($kind)
        {
            case "notice":
                $kindCode   = "1";
                break;
                
            case "support":
                $kindCode   = "2";
                break;
        }
        
        $query = "SELECT
                        NUM
                    FROM
                        BOARD
                    WHERE
                        NUM IN (SELECT MAX(NUM) FROM BOARD WHERE KIND = :KIND AND NUM < :NUM)  
                    ORDER BY NUM DESC";
        
        $this->query($query);
        $this->bind("KIND", $kindCode);
        $this->bind("NUM", $num);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (count($result) <= 0)
            return false;
            
        return $result;
    }
    
    /*
     *  이전 게시글
     */
    public function getNextView($kind, $num)
    {
        $kindCode   = "";
        switch($kind)
        {
            case "notice":
                $kindCode   = "1";
                break;
                
            case "support":
                $kindCode   = "2";
                break;
        }
        
        $query = "SELECT
                        NUM
                    FROM
                        BOARD
                    WHERE
                        NUM IN (SELECT MIN(NUM) FROM BOARD WHERE KIND = :KIND AND NUM > :NUM)
                    ORDER BY NUM DESC";
        
        $this->query($query);
        $this->bind("KIND", $kindCode);
        $this->bind("NUM", $num);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (count($result) <= 0)
            return false;
            
        return $result;
    }
    
    /*
     * 게시글 불러오기
     */
    public function getBoardContext($num)
    {
        $query = "SELECT 
                        NUM,
                        KIND,
                        CASE WHEN KIND = '1' THEN 'notice'
                             WHEN KIND = '2' THEN 'faq'
                             ELSE                 'support'
                        END TYPE_NAME,
                        TYPE,
                        PARENT_NUM,
                        MEMBER_SEQ,
                        NAME,
                        SUBJECT,
                        CONTEXT,
                        COUNT,
                        CREATE_DATE
                    FROM BOARD 
                    WHERE NUM = :NUM";
        $this->query($query);
        $this->bind("NUM", $num);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    /*
     *  파일 목록
     */
    public function getBoardFileList($num)
    {
        $query = "SELECT * FROM BOARD_ATTACH_FILE WHERE BOARD_SEQ = :NUM";
        $this->query($query);
        $this->bind("NUM", $num);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  파일을 지정하여 정보 받기
     */
    public function getBoardFile($num)
    {
        $query = "SELECT * FROM BOARD_ATTACH_FILE WHERE ATTACH_FILE_SEQ = :NUM";
        $this->query($query);
        $this->bind("NUM", $num);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    /*
     * 게시글 저장
     */
    public function setBoardContext($array)
    {
        $boardSeq       = $array["NUM"];
        $kind           = $array["KIND"];
        $type           = $array["TYPE"];
        $parent_num     = $array["PARENT_NUM"];
        $subject        = $array["SUBJECT"];
        $context        = $array["board_context"];
        
        if ($boardSeq == "")
        {
            
            $member_seq = $_SESSION["member_seq"];
            $query      = "INSERT INTO BOARD (KIND,TYPE,PARENT_NUM,MEMBER_SEQ,NAME,SUBJECT,CONTEXT)
                            SELECT
                              :KIND,
                              :TYPE,
                              :PARENT_NUM,
                              :MEMBER_SEQ,
                              nname,
                              :SUBJECT,
                              :CONTEXT
                            FROM
                              MEMBER
                            WHERE
                              member_seq = :MEMBER_SEQ";
        }
        else
        {
            $query  = "UPDATE BOARD
                        SET
                          SUBJECT = :SUBJECT,
                          CONTEXT = :CONTEXT
                        WHERE NUM = :NUM";
        }
        
        $this->query($query);
        if ($boardSeq != "")
            $this->bind("NUM", $boardSeq);
        else
        {
            $this->bind("KIND", $kind);
            $this->bind("TYPE", $type);
            $this->bind("PARENT_NUM", $parent_num);
            $this->bind("MEMBER_SEQ", $member_seq);
        }
        
        $this->bind("SUBJECT", $subject);
        $this->bind("CONTEXT", $context);
        $result     = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        
        if ($boardSeq == "")
        {
            $query      = "SELECT NUM FROM BOARD ORDER BY NUM DESC LIMIT 1";
            $this->query($query);
            $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
            $boardSeq   = $result[0]["NUM"];
        }
        
        $filelist   = json_decode($array["file_list"], true);
        $query      = "INSERT INTO BOARD_ATTACH_FILE
                    (
                      BOARD_SEQ,
                      FILE_PATH,
                      FILE_NAME
                    )
                    VALUES
                    (
                      :BOARD_SEQ,
                      :FILE_PATH,
                      :FILE_NAME
                    )";
        
        
        foreach($filelist as $item)
        {
            $this->query($query);
            $this->bind("BOARD_SEQ", $boardSeq);
            $this->bind("FILE_PATH", $item["temp_name"]);
            $this->bind("FILE_NAME", $item["real_name"]);
            $result     = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        }
        
        return $boardSeq;
    }
    
    /*
     * 게시글 수정
     */
    public function updateBoardContext($array)
    {
        $num        = $array["NUM"];
        $subject    = $array["SUBJECT"];
        $context    = $array["board_context"];
        $query      = "UPDATE BOARD
                        SET
                          SUBJECT = :SUBJECT,
                          CONTEXT = :CONTEXT
                        WHERE
                          NUM = :NUM";
        $this->query($query);
        $this->bind("NUM", $num);
        $this->bind("SUBJECT", $subject);
        $this->bind("CONTEXT", $context);
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        return $result;
    }
    
    /*
     * 게시글 삭제
     */
    public function deleteBoardContext($array)
    {
        $num        = $array["NUM"];
        $query      = "DELETE FROM BOaRD WHERE NUM = :NUM";
        
        $this->query($query);
        $this->bind("NUM", $num);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        return $result;
    }
    
    /*
     * 게시글 조회수 올리기
     */
    public function updateBoardCount($num)
    {
        $query = "";
        $query = "UPDATE BOARD SET COUNT = COUNT + 1 WHERE NUM = :NUM";
        
        $this->query($query);
        $this->bind("NUM", $num);
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        return $result;
    }
    
    /*
     * 게시 답글 조회수 올리기
     */
    public function updateChildBoardCount($num)
    {
        $query = "";
        $query = "UPDATE BOARD SET COUNT = COUNT + 1 WHERE PARENT_NUM = :NUM";
        
        $this->query($query);
        $this->bind("NUM", $num);
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        return $result;
    }
    
    /*
     * 게시글 불러오기
     */
    public function getChildBoardContext($num)
    {
        $query = "SELECT * FROM BOARD WHERE PARENT_NUM = :NUM";
        $this->query($query);
        $this->bind("NUM", $num);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
}