<?php

/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  ir ajax post 처리 
 */
class CApp_Handler_Ir_Proc extends CCore_Lib_Routines_Handler
{

    public function __construct()
    {
    }

    /*
     * 문의사항 저장
     */
    public function updateAsk($array)
    {
        $compName = $array["compName"];
        $compPhone = $array["compPhone"];
        $compEmail = $array["compEmail"];
        $compContext = $array["compContext"];

        $query = "INSERT INTO PTP_IR
					(
					  IR_COMP_NAME,
					  IR_COMP_PHONE,
					  IR_COMP_EMAIL,
					  IR_COMP_CONTEXT,
                      IR_COMP_DATE
					)
					VALUES
					(
					  :IR_COMP_NAME,
					  :IR_COMP_PHONE,
					  :IR_COMP_EMAIL,
					  :IR_COMP_CONTEXT,
                      NOW()
					);";

        $this->query($query);
        $this->bind("IR_COMP_NAME", $compName);
        $this->bind("IR_COMP_PHONE", $compPhone);
        $this->bind("IR_COMP_EMAIL", $compEmail);
        $this->bind("IR_COMP_CONTEXT", $compContext);

        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        if (! $result)
            return false;

        return true;
    }
}

?>