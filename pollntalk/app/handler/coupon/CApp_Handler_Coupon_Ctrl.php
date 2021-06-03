<?php
/**
 *  @auth   : JY JEON
 *  @date   : 202001108
 *  쿠폰 관리
 */
class CApp_Handler_Coupon_Ctrl extends CCore_Lib_Routines_Handler
{
    public function __construct()
    {
    }
    
    public function getCouponListCount($keyword)
    {
        $query = "SELECT
    					COUNT(*) AS CNT
    				FROM
    				    COUPON";
        
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    public function getCouponList($keyword, $paging)
    {
        $query  = "SELECT 
                        A.COUPON_SEQ,
                        COUPON_INDEX,
                        COUPON_TYPE,
                        CASE WHEN COUPON_TYPE = '1' THEN '일반 쿠폰'
                             ELSE                        '이벤트 쿠폰'
                        END AS COUPON_TYPE_NAME,
                        COUPON_STATUS,
                        CASE WHEN COUPON_STATUS = '1' THEN '미게시'
                             ELSE                           '게시'
                        END AS COUPON_STATUS_NAME,
                        COUPON_NAME,
                        COUPON_CONTEXT,
                        COUPON_IMAGE_PATH,
                        COUPON_COUNT,
                        COUPON_USED_POINT,
                        COUPON_EXT_COUNT,
                        (COUPON_EXT_COUNT - EXT_CNT) AS COUPON_CUR_EXT_COUNT,
                        COUPON_LIMITED_DATE,
                        COUPON_IS_LIMIT,
                        CASE WHEN COUPON_IS_LIMIT = '1' THEN '무제한'
                             ELSE                            CONCAT('~', COUPON_LIMITED_DATE)
                        END AS COUPON_IS_LIMIT_NAME,
                        COUPON_EXPIRE_DATE,
                        COUPON_NO_EXPIRE,
                        CASE WHEN COUPON_NO_EXPIRE = '1' THEN '무제한'
                             ELSE                            CONCAT('~', COUPON_EXPIRE_DATE)
                        END AS COUPON_NO_EXPIRE_NAME,
                        COUPON_MODI_DATE,
                        COUPON_REGI_DATE
                    FROM 
                        COUPON A 
                    	LEFT JOIN
                    	(
                    		SELECT
                    			COUNT(B.COUPON_SEQ) AS EXT_CNT,
                                B.COUPON_SEQ
                    		FROM 
                    			COUPON_LOG B
                    	) BB
                    	ON A.COUPON_SEQ = BB.COUPON_SEQ
                    ORDER BY COUPON_SEQ DESC
                    LIMIT :start, :length";
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    public function getCouponListOfMallCount($keyword)
    {
        $query = "SELECT
    					COUNT(*) AS CNT
    				FROM
    				    COUPON
                    WHERE
                        COUPON_TYPE = '1' AND
                        COUPON_STATUS = '2'";
        
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    public function getCouponListOfMall($keyword, $paging)
    {
        $query  = "SELECT
                        A.COUPON_SEQ,
                        COUPON_INDEX,
                        COUPON_TYPE,
                        CASE WHEN COUPON_TYPE = '1' THEN '일반 쿠폰'
                             ELSE                        '이벤트 쿠폰'
                        END AS COUPON_TYPE_NAME,
                        COUPON_STATUS,
                        CASE WHEN COUPON_STATUS = '1' THEN '미게시'
                             ELSE                           '게시'
                        END AS COUPON_STATUS_NAME,
                        COUPON_NAME,
                        COUPON_CONTEXT,
                        COUPON_IMAGE_PATH,
                        COUPON_COUNT,
                        COUPON_USED_POINT,
                        COUPON_EXT_COUNT,
                        (COUPON_EXT_COUNT - EXT_CNT) AS COUPON_CUR_EXT_COUNT,
                        COUPON_LIMITED_DATE,
                        COUPON_IS_LIMIT,
                        CASE WHEN COUPON_IS_LIMIT = '1' THEN '무제한'
                             ELSE                            CONCAT('~', COUPON_LIMITED_DATE)
                        END AS COUPON_IS_LIMIT_NAME,
                        COUPON_EXPIRE_DATE,
                        COUPON_NO_EXPIRE,
                        CASE WHEN COUPON_NO_EXPIRE = '1' THEN '무제한'
                             ELSE                            CONCAT('~', COUPON_EXPIRE_DATE)
                        END AS COUPON_NO_EXPIRE_NAME,
                        COUPON_MODI_DATE,
                        COUPON_REGI_DATE
                    FROM
                        COUPON A
                    	LEFT JOIN
                    	(
                    		SELECT
                    			COUNT(B.COUPON_SEQ) AS EXT_CNT,
                                B.COUPON_SEQ
                    		FROM
                    			COUPON_LOG B
                    	) BB
                    	ON A.COUPON_SEQ = BB.COUPON_SEQ
                    WHERE
                        A.COUPON_TYPE = '1' AND
                        A.COUPON_STATUS = '2'
                    ORDER BY COUPON_SEQ DESC
                    LIMIT :start, :length";
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    public function getCouponInfoByIndex($coupon_index)
    {
        $query  = "SELECT
                        A.COUPON_SEQ,
                        COUPON_INDEX,
                        COUPON_TYPE,
                        CASE WHEN COUPON_TYPE = '1' THEN '일반 쿠폰'
                             ELSE                        '이벤트 쿠폰'
                        END AS COUPON_TYPE_NAME,
                        COUPON_STATUS,
                        CASE WHEN COUPON_STATUS = '1' THEN '미게시'
                             ELSE                           '게시'
                        END AS COUPON_STATUS_NAME,
                        COUPON_NAME,
                        COUPON_CONTEXT,
                        COUPON_IMAGE_PATH,
                        COUPON_COUNT,
                        COUPON_USED_POINT,
                        COUPON_EXT_COUNT,
                        (COUPON_EXT_COUNT - EXT_CNT) AS COUPON_CUR_EXT_COUNT,
                        COUPON_LIMITED_DATE,
                        COUPON_IS_LIMIT,
                        CASE WHEN COUPON_IS_LIMIT = '1' THEN '무제한'
                             ELSE                            CONCAT('~', COUPON_LIMITED_DATE)
                        END AS COUPON_IS_LIMIT_NAME,
                        COUPON_EXPIRE_DATE,
                        COUPON_NO_EXPIRE,
                        CASE WHEN COUPON_NO_EXPIRE = '1' THEN '무제한'
                             ELSE                            CONCAT('~', COUPON_EXPIRE_DATE)
                        END AS COUPON_NO_EXPIRE_NAME,
                        COUPON_MODI_DATE,
                        COUPON_REGI_DATE
                    FROM
                        COUPON A 
                    	LEFT JOIN
                    	(
                    		SELECT
                    			COUNT(B.COUPON_SEQ) AS EXT_CNT,
                                B.COUPON_SEQ
                    		FROM 
                    			COUPON_LOG B
                    	) BB
                    	ON A.COUPON_SEQ = BB.COUPON_SEQ
                    WHERE
                        COUPON_INDEX = :COUPON_INDEX";
        
        $this->query($query);
        $this->bind("COUPON_INDEX", (integer)$coupon_index);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    public function getCouponInfo($coupon_seq)
    {
        $query  = "SELECT 
                    	A.COUPON_SEQ,
                    	COUPON_INDEX,
                    	COUPON_TYPE,
                        CASE WHEN COUPON_TYPE = '1' THEN '일반 쿠폰'
                             ELSE                        '이벤트 쿠폰'
                        END AS COUPON_TYPE_NAME,
                        COUPON_STATUS,
                        CASE WHEN COUPON_STATUS = '1' THEN '미게시'
                             ELSE                           '게시'
                        END AS COUPON_STATUS_NAME,
                    	COUPON_NAME,
                    	COUPON_IMAGE_PATH,
                    	COUPON_CONTEXT,
                    	COUPON_COUNT,
                        COUPON_USED_POINT,
                    	COUPON_EXT_COUNT,
                        (COUPON_EXT_COUNT - EXT_CNT) AS COUPON_CUR_EXT_COUNT,
                        COUPON_LIMITED_DATE,
                        COUPON_IS_LIMIT,
                        CASE WHEN COUPON_IS_LIMIT = '1' THEN '무제한'
                             ELSE                            CONCAT('~', COUPON_LIMITED_DATE)
                        END AS COUPON_IS_LIMIT_NAME,
                        COUPON_EXPIRE_DATE,
                        COUPON_NO_EXPIRE,
                        CASE WHEN COUPON_NO_EXPIRE = '1' THEN '무제한'
                             ELSE                            CONCAT('~', COUPON_EXPIRE_DATE)
                        END AS COUPON_NO_EXPIRE_NAME,
                    	COUPON_MODI_DATE,
                    	COUPON_REGI_DATE
                    FROM 
                    	COUPON A 
                    	LEFT JOIN
                    	(
                    		SELECT
                    			COUNT(B.COUPON_SEQ) AS EXT_CNT,
                                B.COUPON_SEQ
                    		FROM 
                    			COUPON_LOG B
                    	) BB
                    	ON A.COUPON_SEQ = BB.COUPON_SEQ
                    WHERE
                    	A.COUPON_SEQ = :COUPON_SEQ";
        
        $this->query($query);
        $this->bind("COUPON_SEQ", (integer) $coupon_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    public function deleteCouponInfo($array)
    {
        $couponSeq  = $array['coupon_seq'];
        $query      = "DELETE FROM COUPON
                        WHERE COUPON_SEQ = :COUPON_SEQ";
        
        $this->query($query);
        $this->bind("COUPON_SEQ", (integer) $couponSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);
        
        return $result;
    }
    
    public function registerCouponInfo($array)
    {
        $couponSeq          = $array['coupon_seq'];
        $couponName         = $array['coupon_name'];
        $couponType         = $array['coupon_type'];
        $tempPath           = $array['temp_path'];
        $realName           = $array['real_name'];
        $couponContext      = $array['coupon_context'];
        $couponCount        = $array['coupon_count'];
        $couponExtCount     = $array['coupon_ext_count'];
        $couponUsedPoint    = $array['coupon_used_point'];
        $couponStatus       = $array['coupon_status'];
        $isLimited          = $array['is_limited'];
        $couponLimitedDate  = $array['coupon_limited_date'];
        $noExpire           = $array['no_expire'];
        $couponExpireDate   = $array['coupon_expire_date'];
        $indexData          = "";
        
        if ($couponSeq == "")
        {
            $query = "SELECT
                            COUPON_INDEX
                        FROM 
                            COUPON
                        ORDER BY COUPON_INDEX DESC";
            
            $this->query($query);
            $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
            $index  = $result[0]["COUPON_INDEX"];
            if ($index == "")
            {
                $arrTime    = getDate();
                $indexData  = $arrTime['year'].$arrTime['mon'].$arrTime['mday'];
                $indexData  .= "001";
            }
            else 
            {
                $arrTime    = getDate();
                
                $indexData  = substr($index, 9, 11);
                $indexData  = ((integer)$indexData) + 1;
                $indexData  = (string)$indexData;
                
                while(strlen($indexData) < 4)
                    $indexData = "0".$indexData;
                
                $indexData  = $arrTime['year'].$arrTime['mon'].$arrTime['mday'].$indexData;
            }
            
            $query = "INSERT INTO COUPON
                        (
                          COUPON_INDEX,
                          COUPON_NAME,
                          COUPON_TYPE,
                          COUPON_STATUS,
                          COUPON_IMAGE_PATH,
                          COUPON_CONTEXT,
                          COUPON_COUNT,
                          COUPON_USED_POINT,
                          COUPON_EXT_COUNT,
                          COUPON_LIMITED_DATE,
                          COUPON_IS_LIMIT,
                          COUPON_EXPIRE_DATE,
                          COUPON_NO_EXPIRE,
                          COUPON_MODI_DATE
                        )
                        VALUES
                        (
                          :COUPON_INDEX,
                          :COUPON_NAME,
                          :COUPON_TYPE,
                          :COUPON_STATUS,
                          :COUPON_IMAGE_PATH,
                          :COUPON_CONTEXT,
                          :COUPON_COUNT,
                          :COUPON_USED_POINT,
                          :COUPON_EXT_COUNT,
                          :COUPON_LIMITED_DATE,
                          :COUPON_IS_LIMIT,
                          :COUPON_EXPIRE_DATE,
                          :COUPON_NO_EXPIRE,
                          NOW()
                        )";
        }
        else
        {
            $query = "UPDATE COUPON
                        SET
                          COUPON_NAME = :COUPON_NAME,
                          COUPON_TYPE = :COUPON_TYPE,
                          COUPON_STATUS = :COUPON_STATUS,
                          COUPON_IMAGE_PATH = :COUPON_IMAGE_PATH,
                          COUPON_CONTEXT = :COUPON_CONTEXT,
                          COUPON_COUNT = :COUPON_COUNT,
                          COUPON_USED_POINT = :COUPON_USED_POINT,
                          COUPON_LIMITED_DATE = :COUPON_LIMITED_DATE,
                          COUPON_IS_LIMIT = :COUPON_IS_LIMIT,
                          COUPON_EXPIRE_DATE = :COUPON_EXPIRE_DATE,
                          COUPON_NO_EXPIRE = :COUPON_NO_EXPIRE,
                          COUPON_MODI_DATE = NOW()
                        WHERE COUPON_SEQ = :COUPON_SEQ";
        }
        
        $this->query($query);
        if ($couponSeq != "")
            $this->bind("COUPON_SEQ", $couponSeq);
        else
        {
            $this->bind("COUPON_INDEX", $indexData);
            $this->bind("COUPON_EXT_COUNT", $couponExtCount);
        }
        
        if ($couponLimitedDate == "")   
            $couponLimitedDate  = "0000-00-00 00:00:00";
        if ($couponExpireDate == "")
            $couponExpireDate   = "0000-00-00 00:00:00";
            
        $this->bind("COUPON_NAME", $couponName);
        $this->bind("COUPON_TYPE", $couponType);
        $this->bind("COUPON_STATUS", $couponStatus);
        $this->bind("COUPON_IMAGE_PATH", $realName);
        $this->bind("COUPON_CONTEXT", $couponContext);
        $this->bind("COUPON_COUNT", $couponCount);
        $this->bind("COUPON_USED_POINT", $couponUsedPoint);
        $this->bind("COUPON_LIMITED_DATE", $couponLimitedDate);
        $this->bind("COUPON_IS_LIMIT", $isLimited);
        $this->bind("COUPON_EXPIRE_DATE", $couponExpireDate);
        $this->bind("COUPON_NO_EXPIRE", $noExpire);
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        if (! $result)
            return false;
        
        if ($couponSeq == "")
        {
            $query = "SELECT
                            COUPON_SEQ
                        FROM
                            COUPON
                        ORDER BY COUPON_SEQ DESC";
            
            $this->query($query);
            $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
            $couponSeq  = $result[0]["COUPON_SEQ"];
        }
            
        return $couponSeq;
    }
    
    public function registerCouponLogInEventVote($coupon_seq, $issued_type, $issued_position, $status, $vote_seq)
    {
        $query  = "INSERT INTO COUPON_LOG
                    (
                      COUPON_SEQ,
                      COUPON_MEMBER_SEQ,
                      COUPON_ISSUED_TYPE,
                      COUPON_ISSUED_POSITION,
                      COUPON_EVENT_VOTE_SEQ
                    )
                    VALUES
                    (
                      :COUPON_SEQ,
                      :COUPON_MEMBER_SEQ,
                      :COUPON_ISSUED_TYPE,
                      :COUPON_ISSUED_POSITION,
                      :COUPON_EVENT_VOTE_SEQ
                    )";
        
        $this->query($query);
        $this->bind("COUPON_SEQ", $coupon_seq);
        $this->bind("COUPON_MEMBER_SEQ", $_SESSION["member_seq"]);
        $this->bind("COUPON_ISSUED_TYPE", $issued_type);
        $this->bind("COUPON_EVENT_VOTE_SEQ", $vote_seq);
        $this->bind("COUPON_ISSUED_POSITION", $issued_position);
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        
        return $result;
    }
    
    public function getCouponLogCountByMember()
    {
        $query = "SELECT
    					COUNT(*) AS CNT
    				FROM
    				    COUPON_LOG
                    WHERE
                        COUPON_MEMBER_SEQ = :COUPON_MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("COUPON_MEMBER_SEQ", $_SESSION["member_seq"]);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    public function getCouponLogByMember($paging)
    {
        $query  = "SELECT 
                    	COUPON_LOG_SEQ,
                    	A.COUPON_SEQ,
                    	COUPON_MEMBER_SEQ,
                        A.COUPON_USED_POINT,
                        COUPON_ISSUED_TYPE,
                        CASE WHEN COUPON_ISSUED_TYPE = '1' THEN '포인트 사용 발급'
                             WHEN COUPON_ISSUED_TYPE = '2' THEN '이벤트 참여 발급'
                             ELSE 						        '보너스 발급'
                    	END AS COUPON_ISSUED_TYPE_NAME,
                        COUPON_ISSUED_POSITION,
                    	CASE WHEN COUPON_ISSUED_POSITION = '1' THEN '폴앤톡몰'
                    		 ELSE									'이벤트'
                    	END AS COUPON_ISSUED_POSITION_NAME,
                    	COUPON_EVENT_VOTE_SEQ,
                        COUPON_LOG_STATUS,
                        CASE WHEN COUPON_LOG_STATUS = '1' THEN '사용 대기'
                             ELSE                              '사용'
                        END AS COUPON_LOG_STATUS_NAME,
                    	COUPON_ISSUED_REGI_DATE,
                    	COUPON_INDEX,
                    	COUPON_NAME,
                    	CASE WHEN COUPON_TYPE = '1' THEN '일반 쿠폰'
                             ELSE                        '이벤트 쿠폰'
                        END AS COUPON_TYPE_NAME,
                        COUPON_STATUS,
                        CASE WHEN COUPON_STATUS = '1' THEN '미게시'
                             ELSE                           '게시'
                        END AS COUPON_STATUS_NAME,
                        COUPON_EXT_COUNT,
                    	COUPON_IMAGE_PATH,
                    	COUPON_CONTEXT,
                    	COUPON_COUNT,
                    	COUPON_LIMITED_DATE,
                        COUPON_IS_LIMIT,
                        CASE WHEN COUPON_IS_LIMIT = '1' THEN '무제한'
                             ELSE                            CONCAT('~', COUPON_LIMITED_DATE)
                        END AS COUPON_IS_LIMIT_NAME,
                        COUPON_EXPIRE_DATE,
                        COUPON_NO_EXPIRE,
                        CASE WHEN COUPON_NO_EXPIRE = '1' THEN '무제한'
                             ELSE                            CONCAT('~', COUPON_EXPIRE_DATE)
                        END AS COUPON_NO_EXPIRE_NAME,
                    	COUPON_MODI_DATE
                    FROM 
                    	COUPON_LOG A 
                    	INNER JOIN
                    	COUPON B
                        ON A.COUPON_SEQ = B.COUPON_SEQ
                    WHERE 
                    	COUPON_MEMBER_SEQ = :COUPON_MEMBER_SEQ
                    ORDER BY COUPON_SEQ DESC
                    LIMIT :start, :length";
        $this->query($query);
        $this->bind("COUPON_MEMBER_SEQ", $_SESSION["member_seq"]);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    public function buyCoupon($coupon_seq)
    {
        $result     = $this->getCouponInfo($coupon_seq);
        $usedPoint  = $result["COUPON_USED_POINT"];
        $query      = "INSERT INTO COUPON_LOG
                        (
                          COUPON_SEQ,
                          COUPON_MEMBER_SEQ,
                          COUPON_ISSUED_TYPE,
                          COUPON_ISSUED_POSITION,
                          COUPON_USED_POINT
                        )
                        VALUES
                        (
                          :COUPON_SEQ,
                          :COUPON_MEMBER_SEQ,
                          :COUPON_ISSUED_TYPE,
                          :COUPON_ISSUED_POSITION,
                          :COUPON_USED_POINT
                        )";
        
        $this->query($query);
        $this->bind("COUPON_SEQ", $coupon_seq);
        $this->bind("COUPON_MEMBER_SEQ", $_SESSION["member_seq"]);
        $this->bind("COUPON_ISSUED_TYPE", "1");
        $this->bind("COUPON_ISSUED_POSITION", "1");
        $this->bind("COUPON_USED_POINT", $usedPoint);
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        
        return $result;
    }
}
?>