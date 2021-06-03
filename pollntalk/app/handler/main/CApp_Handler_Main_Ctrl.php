<?php
/**
 *  @auth   : PARK Y.S.
 *  @date   : 20210412
 *  메인화면 처리
 */
class CApp_Handler_Main_Ctrl extends CCore_Lib_Routines_Handler 
{
    
    public function __construct()
    {
    }
    
    public function setText($array)
    {
        $seq                = $array["seq"];
        $mainText1          = $array['main_text1'];
        $mainText1Color     = $array['main_color1'];
        $mainText2          = $array['main_text2'];
        $mainText2Color     = $array['main_color2'];
        $tempPath           = $array['temp_path'];
        $realName           = $array['real_name'];
        $backColor          = $array['main_backcolor'];
        $isOpen             = $array['is_open'];
        
        if ($seq == "")
        {
            $query  = "INSERT INTO PTP_MAIN
                        (
                          M_TEXT1,
                          M_TEXT1_COLOR,
                          M_TEXT2,
                          M_TEXT2_COLOR,
                          M_REAL_IMAGE,
                          M_IS_OPEN,
                          M_ORIGIN_IMAGE,
                          M_BACKCOLOR
                        )
                        VALUES
                        (
                          :M_TEXT1,
                          :M_TEXT1_COLOR,
                          :M_TEXT2,
                          :M_TEXT2_COLOR,
                          :M_REAL_IMAGE,
                          :M_IS_OPEN,
                          :M_ORIGIN_IMAGE,
                          :M_BACKCOLOR
                        )";
        }
        else
        {
            $query  = "UPDATE PTP_MAIN
                        SET
                          M_TEXT1 = :M_TEXT1,
                          M_TEXT1_COLOR = :M_TEXT1_COLOR,
                          M_TEXT2 = :M_TEXT2,
                          M_TEXT2_COLOR = :M_TEXT2_COLOR,
                          M_REAL_IMAGE = :M_REAL_IMAGE,
                          M_ORIGIN_IMAGE = :M_ORIGIN_IMAGE,
                          M_IS_OPEN = :M_IS_OPEN,
                          M_BACKCOLOR = :M_BACKCOLOR
                        WHERE 
                          MAIN_SEQ = :MAIN_SEQ";     
        }
        
        $this->query($query);
        if ($seq != "")
            $this->bind("MAIN_SEQ", $seq);
        
        $this->bind("M_TEXT1", $mainText1);
        $this->bind("M_TEXT1_COLOR", $mainText1Color);
        $this->bind("M_TEXT2", $mainText2);
        $this->bind("M_TEXT2_COLOR", $mainText2Color);
        $this->bind("M_REAL_IMAGE", $realName);
        $this->bind("M_ORIGIN_IMAGE", $tempPath);
        $this->bind("M_BACKCOLOR", $backColor);
        $this->bind("M_IS_OPEN", $isOpen);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        if (! $result)
            return false;
        
        return true;
    }
    
    public function getText($num)
    {
        $query  = "SELECT
                        MAIN_SEQ,
                        M_TEXT1,
                        M_TEXT1_COLOR,
                        M_TEXT2,
                        M_TEXT2_COLOR,
                        M_REAL_IMAGE,
                        M_ORIGIN_IMAGE,
                        M_IS_OPEN,
                        M_BACKCOLOR,
                        N_REGI_DATE
                    FROM
                        PTP_MAIN A
                    WHERE
                        MAIN_SEQ = :MAIN_SEQ";
        $this->query($query);
        $this->bind("MAIN_SEQ", $num);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    public function getTextList()
    {
        $query  = "SELECT
                        MAIN_SEQ,
                        M_TEXT1,
                        M_TEXT1_COLOR,
                        M_TEXT2,
                        M_TEXT2_COLOR,
                        M_REAL_IMAGE,
                        M_ORIGIN_IMAGE,
                        M_IS_OPEN,
                        M_BACKCOLOR,
                        N_REGI_DATE
                    FROM
                        PTP_MAIN A
                    ORDER BY MAIN_SEQ ASC";
        
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    public function getTextListByUsed()
    {
        $query  = "SELECT
                        MAIN_SEQ,
                        M_TEXT1,
                        M_TEXT1_COLOR,
                        M_TEXT2,
                        M_TEXT2_COLOR,
                        M_REAL_IMAGE,
                        M_ORIGIN_IMAGE,
                        M_IS_OPEN,
                        M_BACKCOLOR,
                        N_REGI_DATE
                    FROM
                        PTP_MAIN A
                    WHERE M_IS_OPEN = '1'
                    ORDER BY MAIN_SEQ ASC";
        
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    public function deleteText($seq)
    {
        $query  = "DELETE FROM PTP_MAIN WHERE MAIN_SEQ = :MAIN_SEQ";
        
        $this->query($query);
        $this->bind("MAIN_SEQ", $seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);
        
        return $result;
    }
}
?>