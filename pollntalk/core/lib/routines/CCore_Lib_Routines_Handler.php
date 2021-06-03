<?php

/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  DB 핸들러 처리
 */
abstract class CCore_Lib_Routines_Handler implements ICore_Lib_Routines_Component
{

    const SELECT = "0";
    const INSERT = "1";
    const UPDATE = "2";
    const DELETE = "3";

    private     $m_result       = null;
    protected   $m_connection   = null;
    protected   $m_statement    = null;

    public function __construct ()
    {
        
    }

    /*
     * paging 기능 처리
     */
    public function makePaging($count, $page)
    {
        if ($page == "")
            $page = 1;
        else
            $page = (integer) $page;
        
        $record = 15;
        $limit = 10;
        $pageCount = (integer) ($count / $record);
        $startPage = (((integer) ($page / $limit)) * $limit);
        $pageLimit = $startPage + ($limit - 1);
        if ($pageCount < $pageLimit) 
        {
            $extCount = (integer) ($count % $record);
            if ($extCount <= 0 && $count > 0)
                $endPage = $pageLimit;
            else
                $endPage = $pageCount + 1;
        } 
        else
            $endPage = $pageLimit;

        // $startPage = $pageLimit - $limit;
        if ($startPage <= 0) 
        {
            $startPage = 1;
            $prevPage = 1;
        } 
        else
            $prevPage = $startPage - 1;

        $nextPage = $endPage + 1;
        if ($pageCount < $endPage)
            $nextPage = $endPage;
        
        $result = array(
                "current" => $page,
                "boardprev" => $prevPage,
                "boardnext" => $nextPage,
                "start" => $startPage,
                "end" => $endPage
        );

        return $result;
    }

    /*
     * sql query를 받는다.
     */
    protected function query ($query)
    {
        try 
        {
            if ($this->m_connection == null)
                $this->m_connection = CCore_Util_Factory_Database::instance()->create();

            $this->m_statement = $this->m_connection->prepare($query);
        } 
        catch (PDOException $ex) 
        {
            throw new CException($ex, ExceptionType::ERROR, "query를 받는 중에 오류가 발생하였습니다.");
        }

        return;
    }

    /*
     * sql query에 삽입한 값을 넣는다.
     */
    protected function bind ($key, $value)
    {
        try 
        {
            if ($this->m_statement == null)
                return false;

            if ($key == "" || is_null($key))
                return false;

            $type = gettype($value);
            $paramType = PDO::PARAM_NULL;

            switch ($type) 
            {
                case "boolean":
                    $paramType = PDO::PARAM_BOOL;
                    break;

                case "integer":
                    $paramType = PDO::PARAM_INT;
                    break;

                case "string":
                    $paramType = PDO::PARAM_STR;
                    break;

                default:
                    $paramType = PDO::PARAM_NULL;
                    break;
            }

            $pos = strpos($key, ":");
            if ($pos === false)
                $key = ":" . $key;

            $this->m_statement->bindParam($key, $value, $paramType);
        } 
        catch (PDOException $ex) 
        {
            throw new CException($ex, ExceptionType::ERROR, "query를 실행하기 위해 값을 bind하는 중에 오류가 발생하였습니다.");
        }

        return true;
    }

    /*
     * sql query를 실행하고 결과를 반환한다.
     */
    protected function execute ($type, $param = null, $noError = false)
    {
        $result = null;
        try 
        {
            $isResult = false;
            if ($param == null)
                $isResult = $this->m_statement->execute();
            else
                $isResult = $this->m_statement->execute($param);

            if (! $isResult && ! $noError)
                throw new CException(null, ExceptionType::ERROR, "[9]query 실행하는데 실패하였습니다. error[" .print_r($this->m_statement->errorInfo(), true) . "]");

            if ($type == CCore_Lib_Routines_Handler::SELECT)
                $result = $this->m_statement->fetchAll(PDO::FETCH_ASSOC);
            else
                $result = $isResult;
        } 
        catch (PDOException $ex) 
        {
            if (! $noError)
                throw new CException($ex, ExceptionType::ERROR, "[10]query를 실행하는 중에 오류가 발생하였습니다.");
        }

        return $result;
    }
}
?>