<?php

class CApp_Handler_Admin_ask extends CCore_Lib_Routines_Handler
{

    public function __construct()
    {
    }

    /*
     * 문의사항 목록
     */
    public function getAskList()
    {
        $query = "SELECT 
                          IR_SEQ AS ir_seq,
                          IR_COMP_NAME AS ir_comp_name,
                          IR_COMP_PHONE AS ir_comp_phone,
                          IR_COMP_EMAIL AS ir_comp_email
                        FROM 
                          PTP_IR
                        ORDER BY IR_SEQ DESC";

        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result;
    }
    
    public function getBoardList($boardName)
    {
        $query = "SELECT * FROM :BOARDNAME ORDER BY num DESC";
        $this->query($query);
        $this->bind("startNum", $startNum);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
}

