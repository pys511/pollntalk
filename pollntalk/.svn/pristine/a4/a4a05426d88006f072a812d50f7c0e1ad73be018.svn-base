<?php
/**
 *  @auth   : YS PARK
 *  @date   : 20210418
 *  메일 관리
 */
class CApp_Handler_Admin_mail extends CCore_Lib_Routines_Handler
{
    /*
     * Email 리스트 불러오기
     */
    public function getMailList($paging)
    {
        $query = "SELECT
                        *
                    FROM
                        ADMIN_MAIL
                    ORDER BY MAIL_NUM DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     * Email Count 불러오기
     */
    public function getEmailCount()
    {
        $query = "";
        $query = "SELECT count(*) FROM ADMIN_MAIL";
        
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $count = $result[0]["count(*)"];
        
        return $count;
    }
    
    
    /*
     * Email 불러오기
     */
    public function getBoardContext($num)
    {
        $query = "SELECT * FROM ADMIN_MAIL where MAIL_NUM = :NUM";
        $this->query($query);
        $this->bind("NUM", $num);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    /*
     * 첨부파일 불러오기
     */
    public function getMailAttachList($num)
    {
        $query = "SELECT * FROM MAIL_ATTACH_FILE WHERE MAIL_SEQ = :NUM";
        $this->query($query);
        $this->bind("NUM", $num);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    
    /*
     * 게시글 삭제
     */
    public function deleteEmail($array)
    {
        $num        = $array["num"];
        $query      = "DELETE FROM ADMIN_MAIL WHERE MAIL_NUM = :NUM";
        
        $this->query($query);
        $this->bind("NUM", $num);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        return $result;
    }
    
}