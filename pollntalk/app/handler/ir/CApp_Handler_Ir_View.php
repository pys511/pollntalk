<?php

/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  ir 보기 페이지 처리
 */
class CApp_Handler_Ir_View extends CCore_Lib_Routines_Handler
{

    public function __construct()
    {
    }

    /*
     * 업데이트 page view count
     */
    public function updateCount()
    {
        try
        {
            $query = "";
            $query = "SELECT 
                          COUNT(*) AS CNT
                        FROM 
                          PTP_IR_VIEW
                        WHERE 
                          IR_VIEW_DATE = DATE(NOW())";

            $this->query($query);
            $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
            if (! $result)
                return false;

            $count = (integer) $result[0]["CNT"];
            if ($count <= 0)
            {
                $query = "INSERT INTO PTP_IR_VIEW
                            (
                              IR_VIEW_COUNT,
                              IR_VIEW_DATE
                            )
                            VALUES
                            (
                              1,
                              DATE(NOW())
                            )";

                $this->query($query);
                $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
                if (! $result)
                    return false;
            }
            else
            {
                $query = "UPDATE PTP_IR_VIEW
                            SET
                              IR_VIEW_COUNT = IR_VIEW_COUNT + 1,
                            WHERE 
                              IR_VIEW_DATE = DATE(NOW())";

                $this->query($query);
                $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
                if (! $result)
                    return false;
            }
        }
        catch (Exception $ex)
        {
            throw new CException($ex, ExceptionType::ERROR, "IR View 처리 중 오류가 발생했습니다.");
        }

        return true;
    }
}
?>
