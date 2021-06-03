<?php
/**
 *  @auth   : YS PARK
 *  @date   : 20201019
 *  관리자 게시판 관리
 */
class CApp_Handler_Admin_board extends CCore_Lib_Routines_Handler
{
    
    public function __construct()
    {
        
    }
    
    /*  
     * 게시판 리스트 불러오기
     */
    public function getBoardList($kind, $paging)
    {
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
        $this->bind("KIND", $kind);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     * 게시글 불러오기 
     */
    public function getBoardContext($num)
    {
        $query = "SELECT * FROM BOARD where NUM = :NUM";
        $this->query($query);
        $this->bind("NUM", $num);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    /*
     *  
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
        
        if ($boardSeq == "" || $parent_num != "")
        {
            if ($_SESSION["admin_seq"] != "")
            {
                $member_seq = $_SESSION["admin_seq"];
                $query      = "INSERT INTO BOARD
                                (
                                  KIND,
                                  TYPE,
                                  PARENT_NUM,
                                  MEMBER_SEQ,
                                  NAME,
                                  SUBJECT,
                                  CONTEXT
                                )
                                VALUES
                                (
                                  :KIND,
                                  :TYPE,
                                  :PARENT_NUM,
                                  :MEMBER_SEQ,
                                  '관리자',
                                  :SUBJECT,
                                  :CONTEXT
                                )";
            }
            else
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
        if ($boardSeq != "" && $parent_num == "")
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
        
        if ($boardSeq == "" || $parent_num != "")
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
        
        if ($parent_num != "")
            return $parent_num;
         
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
     * 게시글수 불러오기
     */
    public function getboardcount($kind)
    {
        $query = "";
        $query = "SELECT count(*) FROM BOARD WHERE KIND = :KIND";
        
        $this->query($query);
        $this->bind("KIND", $kind);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $count = $result[0]["count(*)"];
        
        return $count;
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
?>