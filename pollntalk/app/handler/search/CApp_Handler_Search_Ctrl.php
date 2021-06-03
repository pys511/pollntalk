<?php
/**
  * @auth   	: PARK YS
  * @date	: 20210404
  * 검색 처리
  */
class CApp_Handler_Search_Ctrl extends CCore_Lib_Routines_Handler
{
    public function __construct()
    {
    }
    
    /*
     * 검색어 등록
     */
    public function registerkeyword($array)
    {
        $keywordName    = $array['keyword_name'];
        
        $query  = "SELECT COUNT(*) AS CNT FROM PTP_KEYWORD WHERE KEYWORD_NAME = :KEYWORD_NAME";
        
        $this->query($query);
        $this->bind("KEYWORD_NAME", $keywordName);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        if (intval($result[0]["CNT"]) > 0)
            return -1;
            
        $query  = "INSERT INTO PTP_KEYWORD
                    (
                      KEYWORD_NAME
                    )
                    VALUES
                    (
                      :KEYWORD_NAME
                    )";
        
        $this->query($query);
        $this->bind("KEYWORD_NAME", $keywordName);
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        if (! $result)
            return false;
            
        return true;
    }
    
    /*
     * 검색어 삭제
     */
    public function deletekeyword($array)
    {
        $keywordSeq    = $array['keyword_seq'];
        
        $query = "DELETE FROM PTP_KEYWORD WHERE KEYWORD_SEQ = :KEYWORD_SEQ";
        
        $this->query($query);
        $this->bind("KEYWORD_SEQ", $keywordSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);
        
        if (! $result)
            return false;
            
        return true;
    }
    
    
    /*
     * 검색어 목록 조회
     */
    public function getkeywordList()
    {
        $query      = "SELECT KEYWORD_SEQ, KEYWORD_NAME
                       FROM PTP_KEYWORD";
        
        $this->query($query);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (! $result)
            return false;
            
        return $result;
    }
    
    /*
     * 검색어 목록 조회
     */
    public function getkeywordListMain()
    {
        $query      = "SELECT KEYWORD_SEQ, KEYWORD_NAME
                       FROM PTP_KEYWORD
                       ORDER BY KEYWORD_SEQ DESC
                       LIMIT 10";
        
        $this->query($query);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (! $result)
            return false;
            
        return $result;
    }
}
?>
