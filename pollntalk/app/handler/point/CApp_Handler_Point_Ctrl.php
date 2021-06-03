<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 202001008
 *  포인트 관리
 */
class CApp_Handler_Point_Ctrl extends CCore_Lib_Routines_Handler
{
    private static  $m_instance = null;
    public function __construct()
    {
    }
    
    /*
     * instance 반환
     */
    public static function instance()
    {
        if (is_null(CApp_Handler_Point_Ctrl::$m_instance))
            self::$m_instance = new CApp_Handler_Point_Ctrl();
            
        return CApp_Handler_Point_Ctrl::$m_instance;
    }
    
    /*
     *  포인트 지급 위치에 따른 포인트 정보 조회
     */
    public function getPointByPosition($position)
    {
        $query  = "SELECT 
                        POINT_SEQ,
                        POINT_POSITION,
                        POINT,
                        POINT_REGI_DATE
                    FROM 
                        POINT_INFO
                    WHERE
                        POINT_POSITION = :POINT_POSITION";
        
        $this->query($query);
        $this->bind("POINT_POSITION", $position);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (!$result)
            return false;
        
        return $result[0];
    }
    
    /*
     *  포인트 정보 목록
     */
    public function getPointListCount($keyword)
    {
        $query  = "SELECT
                        COUNT(*)
                    FROM
                        POINT_INFO";
        
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (!$result)
            return false;
            
        return $result;
    }
    
    /*
     *  포인트 정보 목록
     */
    public function getPointList()
    {
        $query  = "SELECT 
                        POINT_SEQ,
                        POINT_POSITION,
                        CASE WHEN POINT_POSITION = '101' THEN '일반 투표 개설'
                             WHEN POINT_POSITION = '102' THEN '일반 투표 응답'
                             WHEN POINT_POSITION = '111' THEN '이벤트 투표 개설'
                             WHEN POINT_POSITION = '112' THEN '이벤트 투표 응답'
                             ELSE                             '기타'
                        END AS POINT_POSITION_NAME,
                        POINT,
                        POINT_REGI_DATE
                    FROM 
                        POINT_INFO
                    ORDER BY POINT_SEQ DESC";
        
        $this->query($query);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (!$result)
            return false;
            
        return $result;
    }
    
    /*
     *  포인트 정보 조회
     */
    public function getPointInfo($pointSeq)
    {
        $query  = "SELECT 
                        POINT_SEQ,
                        POINT_POSITION,
                        POINT,
                        POINT_REGI_DATE
                    FROM 
                        POINT_INFO
                    WHERE
                        POINT_SEQ = :POINT_SEQ";
        
        $this->query($query);
        $this->bind("POINT_SEQ", $pointSeq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (!$result)
            return false;
            
        return $result;
    }
    
    /*
     *  위치에 따른 포인트 지급
     */
    public function setPointByPosition($member_seq, $point_position, $pointKind, $pointType)
    {
        $query  = "INSERT INTO POINT_LOG
                    (
                      MEMBER_SEQ,
                      POINT_POSITION,
                      POINT_KIND,
                      POINT_TYPE,
                      POINT
                    )
                    SELECT
                        :MEMBER_SEQ,
                        POINT_POSITION,
                        :POINT_KIND,
                        :POINT_TYPE,
                        A.POINT
                    FROM
                        POINT_INFO A
                    WHERE
                        A.POINT_POSITION = :POINT_POSITION";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $member_seq);
        $this->bind("POINT_POSITION", $point_position);
        $this->bind("POINT_KIND", $pointKind);
        $this->bind("POINT_TYPE", $pointType);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        if (! $result)
            return false;
            
        return true;
    }
    
    /*
     *  회원에게 포인트 지급
     */
    public function setPoint2Member($member_seq, $point_position, $pointKind, $pointType, $point)
    {
        $query = "INSERT INTO POINT_LOG
                    (
                      MEMBER_SEQ,
                      POINT_POSITION,
                      POINT_KIND,
                      POINT_TYPE,
                      POINT
                    )
                    VALUES
                    (
                      :MEMBER_SEQ,
                      :POINT_POSITION,
                      :POINT_KIND,
                      :POINT_TYPE,
                      :POINT
                    )";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $member_seq);
        $this->bind("POINT", $point);
        $this->bind("POINT_POSITION", $point_position);
        $this->bind("POINT_KIND", $pointKind);
        $this->bind("POINT_TYPE", $pointType);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        if (! $result)
            return false;
        
        return true;
    }
    
    /*
     *  포인트 정보 목록
     */
    public function getPointLogListCount($keyword)
    {
        $query  = "SELECT
                        COUNT(*) AS CNT
                    FROM
                        POINT_LOG";
        
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (!$result)
            return false;
            
        return $result[0]["CNT"];
    }
    
    /*
     *  포인트 정보 목록
     */
    public function getPointLogList($keyword, $paging)
    {
        $query  = "SELECT 
                        POINT_LOG_SEQ,
                        A.MEMBER_SEQ,
                        B.uname AS MEMBER_NAME,
                        POINT_POSITION,
                        CASE WHEN POINT_POSITION = '101' THEN '일반 투표 개설'
                             WHEN POINT_POSITION = '102' THEN '일반 투표 응답'
                             WHEN POINT_POSITION = '111' THEN '이벤트 투표 개설'
                             WHEN POINT_POSITION = '112' THEN '이벤트 투표 응답'
                             ELSE                             '기타'
                        END AS POINT_POSITION_NAME,
                        POINT_KIND,
                        CASE WHEN POINT_KIND = '1' THEN '보너스 발급'
                             ELSE                       '자동발급'
                        END AS POINT_KIND_NAME,
                        POINT_TYPE,
                        CASE WHEN POINT_TYPE = '1' THEN '적립'
                             ELSE                       '사용'
                        END AS POINT_TYPE_NAME,
                        POINT,
                        POINT_REGI_DATE
                    FROM 
                        POINT_LOG A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.MEMBER_SEQ
                    ORDER BY POINT_LOG_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (!$result)
            return false;
            
        return $result;
    }
    
    /*
     *  포인트 정보 목록
     */
    public function getPointLogListCountByMember($member_seq)
    {
        $query  = "SELECT
                        COUNT(*) AS CNT
                    FROM
                        POINT_LOG
                    WHERE
                        MEMBER_SEQ = :MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $member_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (!$result)
            return false;
            
        return $result[0]["CNT"];
    }
    
    /*
     *  포인트 정보 목록
     */
    public function getPointLogListByMember($member_seq, $paging)
    {
        $query  = "SELECT
                        POINT_LOG_SEQ,
                        A.MEMBER_SEQ,
                        B.uname AS MEMBER_NAME,
                        POINT_POSITION,
                        CASE WHEN POINT_POSITION = '101' THEN '일반 투표 개설'
                             WHEN POINT_POSITION = '102' THEN '일반 투표 응답'
                             WHEN POINT_POSITION = '111' THEN '이벤트 투표 개설'
                             WHEN POINT_POSITION = '112' THEN '이벤트 투표 응답'
                             ELSE                             '기타'
                        END AS POINT_POSITION_NAME,
                        POINT_KIND,
                        CASE WHEN POINT_KIND = '1' THEN '보너스 발급'
                             ELSE                       '자동발급'
                        END AS POINT_KIND_NAME,
                        POINT_TYPE,
                        CASE WHEN POINT_TYPE = '1' THEN '적립'
                             ELSE                       '사용'
                        END AS POINT_TYPE_NAME,
                        POINT,
                        POINT_REGI_DATE
                    FROM
                        POINT_LOG A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.MEMBER_SEQ
                    WHERE
                        A.MEMBER_SEQ = :MEMBER_SEQ
                    ORDER BY POINT_LOG_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $member_seq);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (!$result)
            return false;
            
        return $result;
    }
    
    /*
     *  회원 포인트 총합
     */
    public function getPointSum($member_seq)
    {
        $query  = "SELECT
                        FORMAT(SUM(POINT), 0) AS SUM
                    FROM
                        POINT_LOG
                    WHERE
                        MEMBER_SEQ = :MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $member_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (!$result)
            return false;
        
        $returnVal  = $result[0]["SUM"];
        if ($returnVal == "")
            $returnVal  = "0";
            
        return $returnVal;
    }
    
    /*
     *  금일 누적 회원 포인트 총합
     */
    public function getPointSumToday($member_seq)
    {
        $query  = "SELECT
                        FORMAT(SUM(POINT), 0) AS SUM
                    FROM
                        POINT_LOG
                    WHERE
                        DATE(POINT_REGI_DATE) = DATE(NOW()) AND
                        MEMBER_SEQ = :MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $member_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (!$result)
            return false;
        
        $returnVal  = $result[0]["SUM"];
        if ($returnVal == "")
            $returnVal  = "0";
            
        return $returnVal;
    }
    
    /*
     *  금일 누적 회원 포인트 총합
     */
    public function getPointCountToday($member_seq)
    {
        $query  = "SELECT
                        COUNT(POINT) AS CNT
                    FROM
                        POINT_LOG
                    WHERE
                        DATE(POINT_REGI_DATE) = DATE(NOW()) AND
                        MEMBER_SEQ = :MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $member_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (!$result)
            return false;
            
        return $result[0]["CNT"];
    }
    
    /*
     *  포인트 정보 저장 처리
     */
    public function registerPointInfo($array)
    {
        $pointSeq       = $array["point_seq"];
        $pointPosition  = $array["point_position_list"];
        $point          = $array["point"];
        
        $insertquery    = "INSERT INTO POINT_INFO
                            (
                              POINT_POSITION,
                              POINT
                            )
                            VALUES
                            (
                              :POINT_POSITION,
                              :POINT
                            )";
        
        $updatequery    = "UPDATE POINT_INFO
                            SET
                              POINT_POSITION = :POINT_POSITION,
                              POINT = :POINT
                            WHERE POINT_SEQ = :POINT_SEQ";       
        
        if ($pointSeq != "")
        {
            $this->query($updatequery);
            $this->bind("POINT_SEQ", $pointSeq);
        }
        else 
            $this->query($insertquery);
        
        $this->bind("POINT_POSITION", $pointPosition);
        $this->bind("POINT", $point);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        if (! $result)
            return false;
        
        return true;
    }
    
   /*
    *   포인트 정보 삭제 처리
    */
   public function deletePointInfo($array)
   {
       $pointSeq    = $array["point_seq"];
       $query       = "DELETE FROM POINT_INFO
                        WHERE POINT_SEQ = :POINT_SEQ";
       
       $this->query($query);
       $this->bind("POINT_SEQ", $pointSeq);
       
       $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);
       if (! $result)
           return false;
           
       return true;
   }
}