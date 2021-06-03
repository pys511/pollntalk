<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200905
 *  투표 응답 처리
 */
class CApp_Handler_Vote_Respctrl extends CCore_Lib_Routines_Handler
{
    public function __construct()
    {
    }
    
    /*
     *  투표 응답 정보 저장
     */
    public function registerVoteRespInfo($array)
    {
        $vote_seq               = $array["vote_seq"];
        $vote_kind              = $array["vote_kind"];
        $question_seqs          = $array["question_seq"];
        $question_indexs        = $array["question_index"];
        $question_resp_types    = $array["question_resp_type"];
        $logquery      = "INSERT INTO VOTE_RESP_LOG
                            (
                              VOTE_SEQ,
                              VOTE_QUESTION_SEQ,
                              VOTE_QUESTION_RESP_TYPE,
                              VOTE_QUESTION_INDEX,
                              VOTE_ANSWER_SELECT_SEQ,
                              VOTE_MEMBER_SEQ
                            )
                            VALUES
                            (
                              :VOTE_SEQ,
                              :VOTE_QUESTION_SEQ,
                              :VOTE_QUESTION_RESP_TYPE,
                              :VOTE_QUESTION_INDEX,
                              :VOTE_ANSWER_SELECT_SEQ,
                              :VOTE_MEMBER_SEQ
                            );";
        
        $freeQuery      = "INSERT INTO VOTE_FREE_ANSWERS
                            (
                              VOTE_SEQ,
                              VOTE_QUESTION_SEQ,
                              VOTE_QUESTION_INDEX,
                              VOTE_ANSWER_TEXT,
                              VOTE_MEMBER_SEQ
                            )
                            VALUES
                            (
                              :VOTE_SEQ,
                              :VOTE_QUESTION_SEQ,
                              :VOTE_QUESTION_INDEX,
                              :VOTE_ANSWER_TEXT,
                              :VOTE_MEMBER_SEQ
                            )";
        
        for($i = 0; $i < count($question_seqs); $i++)
        {
            $questionSeq            = $question_seqs[$i];
            $questionIndex          = $question_indexs[$i];
            $question_resp_type     = $question_resp_types[$i];
            $answerText             = $array["answer_textarea_".$questionIndex];
            $answerSeq              = $array["answer_".$questionIndex];
            if ($question_resp_type == "3" || $question_resp_type == "4" || $question_resp_type == "5")
            {
                if ($answerText != "")
                {
                    $this->query($freeQuery);
                    $this->bind("VOTE_SEQ", $vote_seq);
                    $this->bind("VOTE_QUESTION_SEQ", $questionSeq);
                    $this->bind("VOTE_QUESTION_INDEX", $questionIndex);
                    $this->bind("VOTE_ANSWER_TEXT", $answerText);
                    $this->bind("VOTE_MEMBER_SEQ", $_SESSION["member_seq"]);
                    
                    $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
                    if (! $result)
                        return false;
                    
                    $selectQuery    = "SELECT
                                            VOTE_FREE_ANSWERS_SEQ
                                        FROM
                                            VOTE_FREE_ANSWERS
                                        ORDER BY VOTE_FREE_ANSWERS_SEQ DESC
                                        LIMIT 1";
                    
                    $this->query($selectQuery);
                    $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
                    if (! $result)
                        return false;
                    
                    if (is_array($answerSeq))
                        $answerSeq[count($answerSeq)]  = $result[0]["VOTE_FREE_ANSWERS_SEQ"];
                    else
                        $answerSeq  = $result["VOTE_FREE_ANSWERS_SEQ"];
                }
                else
                {
                    if (is_array($answerSeq))
                        $answerSeq[count($answerSeq)]  = $array["answer_free_".$questionIndex];
                    else
                        $answerSeq  = $array["answer_free_".$questionIndex];
                }
            }
            
            $answerCount    = count($answerSeq);
            if (is_array($answerSeq))
            {
                for ($j = 0; $j < $answerCount; $j++)
                {
                    $this->query($logquery);
                    $this->bind("VOTE_SEQ", $vote_seq);
                    $this->bind("VOTE_QUESTION_SEQ", $questionSeq);
                    $this->bind("VOTE_QUESTION_RESP_TYPE", $question_resp_type);
                    $this->bind("VOTE_QUESTION_INDEX", $questionIndex);
                    $this->bind("VOTE_ANSWER_SELECT_SEQ", $answerSeq[$j]);
                    $this->bind("VOTE_MEMBER_SEQ", $_SESSION["member_seq"]);
                    
                    $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
                    if (! $result)
                        return false;
                }
            }
            else
            {
                $this->query($logquery);
                $this->bind("VOTE_SEQ", $vote_seq);
                $this->bind("VOTE_QUESTION_SEQ", $questionSeq);
                $this->bind("VOTE_QUESTION_RESP_TYPE", $question_resp_type);
                $this->bind("VOTE_QUESTION_INDEX", $questionIndex);
                $this->bind("VOTE_ANSWER_SELECT_SEQ", $answerSeq);
                $this->bind("VOTE_MEMBER_SEQ", $_SESSION["member_seq"]);
                
                $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
                if (! $result)
                    return false;
            }
        }
        
        $query  = "UPDATE VOTE
                    SET
                      VOTE_PARTICIPATE_COUNT = VOTE_PARTICIPATE_COUNT + 1
                    WHERE 
                      VOTE_SEQ = :VOTE_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        if (! $result)
            return false;
        
        $pointPosition  = "";
        if ($vote_kind == "1")
            $pointPosition  = "102";
        else
            $pointPosition  = "112";
                
        //$pointInfo  = new CApp_Handler_Point_Ctrl();
        CApp_Handler_Point_Ctrl::instance()->setPointByPosition($_SESSION["member_seq"], $pointPosition, "1", "1");
        
        //이벤트 투표시 쿠폰 발급
        if ($vote_kind == "2")
        {
            $query  = "SELECT 
                            COUPON_SEQ
                        FROM
                            VOTE
                        WHERE
                            VOTE_SEQ = :VOTE_SEQ";
            
            $this->query($query);
            $this->bind("VOTE_SEQ", $vote_seq);
            $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
            
            $coupon_seq = $result[0]["COUPON_SEQ"];
            
            $couponlog  = new CApp_Handler_Coupon_Ctrl();
            $result     = $couponlog->registerCouponLogInEventVote($coupon_seq, "2", "2", "1", $vote_seq);
        }

        return true;
    }
    
    public function getVoteResult($vote_seq)
    {
        $query  = "SELECT 
                        VOTE_RESP_SEQ,
                        VOTE_SEQ,
                        VOTE_QUESTION_SEQ,
                        VOTE_QUESTION_RESP_TYPE,
                        VOTE_QUESTION_INDEX,
                        VOTE_ANSWER_SELECT_SEQ,
                        VOTE_MEMBER_SEQ,
                        VOTE_RESP_REGI_DATE
                    FROM 
                        VOTE_RESP_LOG
                    WHERE 
                        VOTE_SEQ = :VOTE_SEQ;";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (! $result)
            return false;
        
        return $result;
    }
    
    public function getVoteRespList($questionSeq)
    {
        $query  = "SELECT
                        VOTE_RESP_SEQ,
                        VOTE_SEQ,
                        VOTE_QUESTION_SEQ,
                        VOTE_QUESTION_RESP_TYPE,
                        VOTE_QUESTION_INDEX,
                        VOTE_ANSWER_SELECT_SEQ,
                        VOTE_MEMBER_SEQ,
                        VOTE_RESP_REGI_DATE
                    FROM
                        VOTE_RESP_LOG
                    WHERE
                        VOTE_QUESTION_SEQ = :VOTE_QUESTION_SEQ;";
        
        $this->query($query);
        $this->bind("VOTE_QUESTION_SEQ", $questionSeq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (! $result)
            return false;
            
        return $result;
    }
    
    public function getVoteRespChart($vote_seq, $question_seq)
    {
        $query  = "SELECT 
                		A.ANSWERS_SEQ,
                		A.ANSWER_TEXT,
                        COUNT(A.ANSWERS_SEQ) AS ANSWERS_COUNT
                	FROM 
                		VOTE_ANSWERS A INNER JOIN
                		VOTE_RESP_LOG B
                		ON A.ANSWERS_SEQ = B.VOTE_ANSWER_SELECT_SEQ
                	WHERE
                	   A.VOTE_SEQ = :VOTE_SEQ AND A.QUESTION_SEQ = :QUESTION_SEQ
                	GROUP BY A.ANSWERS_SEQ, A.ANSWER_TEXT";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        $this->bind("QUESTION_SEQ", $question_seq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        //trigger_error(print_r($result, true), E_USER_ERROR);
        if (! $result)
            return false;
            
        return $result;
    }
    
    public function getVoteRespChartByKind($vote_seq, $question_seq, $type)
    {
        $groupName      = "";
        if ($type != "")
        {
            if ($type == "abode" || $type == "gender")
                $groupName  = "CC.".$type."_name AS VAL_KEY,";
            else 
                $groupName  = "CC.".$type." AS VAL_KEY,";
        }
        
        //A.VOTE_SEQ = :VOTE_SEQ AND A.QUESTION_SEQ = :QUESTION_SEQ
        /*
            CC.gender,
            age,
            abode_name,
         */
        $query          = "SELECT
                                B.VOTE_QUESTION_SEQ, 
                            	A.ANSWERS_SEQ,
                            	A.ANSWER_TEXT,".$groupName."
                            	COUNT(A.ANSWERS_SEQ) AS ANSWERS_COUNT
                            FROM 
                            	VOTE_ANSWERS A LEFT OUTER JOIN
                            	VOTE_RESP_LOG B
                            	ON A.ANSWERS_SEQ = B.VOTE_ANSWER_SELECT_SEQ INNER JOIN
                                (
                            		SELECT
                            			member_seq,
                                        CASE WHEN gender = 'm' THEN '남성'
                                             ELSE '여성'
                                        END gender_name,
                            			gender,
                                        CONCAT(TRUNCATE((YEAR(NOW()) - YEAR(birthday)), -1), '대') AS age,
                            			CASE WHEN abode = '01' THEN '서울특별시'
                            					 WHEN abode = '02' THEN '부산광역시'
                            					 WHEN abode = '03' THEN '대구광역시'
                            					 WHEN abode = '04' THEN '인천광역시'
                            					 WHEN abode = '05' THEN '광주광역시'
                            					 WHEN abode = '06' THEN '대전광역시'
                            					 WHEN abode = '07' THEN '울산광역시'
                            					 WHEN abode = '08' THEN '세종특별자치시'
                            					 WHEN abode = '11' THEN '경기도'
                            					 WHEN abode = '12' THEN '강원도'
                            					 WHEN abode = '13' THEN '충청북도'
                            					 WHEN abode = '14' THEN '충청남도'
                            					 WHEN abode = '15' THEN '전라북도'
                            					 WHEN abode = '16' THEN '전라남도'
                            					 WHEN abode = '17' THEN '경상북도'
                            					 WHEN abode = '18' THEN '경상남도'
                            					 WHEN abode = '20' THEN '제주특별자치도'
                            			END abode_name,
                                        abode	
                            		FROM
                            			MEMBER C
                            	) CC
                                ON B.VOTE_MEMBER_SEQ = CC.member_seq
                            WHERE
                                A.VOTE_SEQ = :VOTE_SEQ AND A.QUESTION_SEQ = :QUESTION_SEQ
                            GROUP BY A.ANSWERS_SEQ, A.ANSWER_TEXT".",CC.".$type."
                            ORDER BY CC.age ASC, A.ANSWERS_SEQ DESC";
        
        trigger_error($query, E_USER_ERROR);
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        $this->bind("QUESTION_SEQ", $question_seq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        trigger_error(print_r($result, true), E_USER_ERROR);
        
        if (! $result)
            return false;
            
        return $result;
    }
}