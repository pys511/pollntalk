<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200905
 *  투표 설문 정보 처리
 */
class CApp_Handler_Vote_Ctrl extends CCore_Lib_Routines_Handler
{
    private $default_end_date   = "9999-12-31";     //마감 날짜가 없을 시 기본 날짜(무기한)
    
    public function __construct()
    {
    }

    /*
     *  투표 양식을 조회하는 함수
     */
    public function getVoteFormInfo($vote_form_seq)
    {
        $query = "SELECT 
                    VOTE_FORM_SEQ,
                    VOTE_WRITER_SEQ,
                    VOTE_FORM_KIND,
                    CASE WHEN VOTE_TYPE = '1' THEN '투표'
                         WHEN VOTE_TYPE = '2' THEN '일반설문'
                         WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                         WHEN VOTE_TYPE = '4' THEN '퀴즈'
                         ELSE '기타'
                    END AS VOTE_TYPE_NAME,
                    VOTE_TYPE,
                    VOTE_SUBJECT,
                    VOTE_CATE_SEQ,
                    (SELECT CATE_NAME FROM CATEGORY C WHERE C.CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                    VOTE_CATE_SUB_SEQ,
                    (SELECT CATE_NAME FROM CATEGORY D WHERE D.CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                    VOTE_RESOURCE_PATH,
                    VOTE_RESOURCE_TYPE,
                    VOTE_URL,
                    VOTE_FORM_CONTEXT,
                    VOTE_VIEW_COUNT,
                    VOTE_USE_COUNT,
                    VOTE_REGI_DATE
                FROM 
                    VOTE_FORM A
                WHERE
                    VOTE_FORM_SEQ = :VOTE_SEQ";
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_form_seq);

        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result[0];
    }

    /*
     *  투표 양식 목록 갯수
     */
    public function getVoteFormListCount()
    {
        $query = "SELECT
    					COUNT(*) AS CNT
    				FROM
    				    VOTE_FORM";

        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result[0]["CNT"];
    }
    
    /*
     *  카테고리에 의한 투표 양식 목록
     */
    public function getVoteFormListByCategory($cate_seq, $keyword)
    {
        $query = "SELECT 
                    VOTE_FORM_SEQ,
                    VOTE_WRITER_SEQ,
                    VOTE_FORM_KIND,
                    CASE WHEN VOTE_TYPE = '1' THEN '투표'
                         WHEN VOTE_TYPE = '2' THEN '일반설문'
                         WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                         WHEN VOTE_TYPE = '4' THEN '퀴즈'
                         ELSE '기타'
                    END AS VOTE_TYPE_NAME,
                    VOTE_TYPE,
                    VOTE_SUBJECT,
                    A.VOTE_CATE_SEQ,
                    (SELECT CATE_NAME FROM CATEGORY D WHERE D.CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                    A.VOTE_CATE_SUB_SEQ,
                    C.CATE_NAME AS VOTE_CATE_SUB_NAME,
                    C.CATE_REAL_IMAGE_PATH,
                    VOTE_RESOURCE_PATH,
                    VOTE_RESOURCE_TYPE,
                    VOTE_URL,
                    VOTE_FORM_CONTEXT,
                    VOTE_VIEW_COUNT,
                    VOTE_USE_COUNT,
                    VOTE_REGI_DATE,
                    B.ADMINNAME 
                FROM 
                    VOTE_FORM A INNER JOIN
                    ptp_admin B ON A.VOTE_WRITER_SEQ = B.ADMIN_SEQ INNER JOIN
                    CATEGORY C ON A.VOTE_CATE_SUB_SEQ = C.CATE_SEQ
                WHERE
                    (VOTE_CATE_SEQ = :VOTE_CATE_SEQ) OR 
                    ((:VOTE_SUBJECT IS NULL AND 0 = 0) AND (VOTE_SUBJECT IS NOT NULL AND VOTE_SUBJECT LIKE :VOTE_SUBJECT))
                ORDER BY VOTE_FORM_SEQ DESC";

        $this->query($query);
        $this->bind("VOTE_CATE_SEQ", $cate_seq);
        $this->bind("VOTE_SUBJECT", $keyword);

        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result;
    }
    
    /*
     *  카테고리에 의한 투표 양식 목록
     */
    public function getVoteFormListByType($vote_kind, $vote_type, $keyword)
    {
        $query = "SELECT
                    VOTE_FORM_SEQ,
                    VOTE_WRITER_SEQ,
                    VOTE_FORM_KIND,
                    CASE WHEN VOTE_TYPE = '1' THEN '투표'
                         WHEN VOTE_TYPE = '2' THEN '일반설문'
                         WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                         WHEN VOTE_TYPE = '4' THEN '퀴즈'
                         ELSE '기타'
                    END AS VOTE_TYPE_NAME,
                    VOTE_TYPE,
                    VOTE_SUBJECT,
                    A.VOTE_CATE_SEQ,
                    (SELECT CATE_NAME FROM CATEGORY D WHERE D.CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                    A.VOTE_CATE_SUB_SEQ,
                    C.CATE_NAME AS VOTE_CATE_SUB_NAME,
                    C.CATE_REAL_IMAGE_PATH,
                    VOTE_RESOURCE_PATH,
                    VOTE_RESOURCE_TYPE,
                    VOTE_URL,
                    VOTE_FORM_CONTEXT,
                    VOTE_VIEW_COUNT,
                    VOTE_USE_COUNT,
                    VOTE_REGI_DATE,
                    B.ADMINNAME
                FROM
                    VOTE_FORM A INNER JOIN
                    ptp_admin B ON A.VOTE_WRITER_SEQ = B.ADMIN_SEQ INNER JOIN
                    CATEGORY C ON A.VOTE_CATE_SUB_SEQ = C.CATE_SEQ
                WHERE
                    ((VOTE_TYPE = :VOTE_TYPE) AND (VOTE_FORM_KIND = :VOTE_FORM_KIND)) OR
                    ((:VOTE_SUBJECT IS NULL AND 0 = 0) AND (VOTE_SUBJECT IS NOT NULL AND VOTE_SUBJECT LIKE :VOTE_SUBJECT))
                ORDER BY VOTE_FORM_SEQ DESC";
        
        $this->query($query);
        $this->bind("VOTE_FORM_KIND", $vote_kind);
        $this->bind("VOTE_TYPE", $vote_type);
        $this->bind("VOTE_SUBJECT", $keyword);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }

    /*
     *  관리자 투표 양식 목록
     */
    public function getAdminVoteFormList($cate_seq, $cate_sub_seq, $keyword, $paging)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
        
        $query = "SELECT
                        VOTE_FORM_SEQ,
                        VOTE_WRITER_SEQ,
                        VOTE_FORM_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                         WHEN VOTE_TYPE = '2' THEN '일반설문'
                         WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                         WHEN VOTE_TYPE = '4' THEN '퀴즈'
                         ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        A.VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY B WHERE B.CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        A.VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY C WHERE C.CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_USE_COUNT,
                        VOTE_REGI_DATE
                    FROM
                        VOTE_FORM A
                    WHERE
                        ((:VOTE_CATE_SEQ IS NULL AND 0 = 0) OR (VOTE_CATE_SEQ = :VOTE_CATE_SEQ)) OR
                        ((:VOTE_CATE_SUB_SEQ IS NULL AND 0 = 0) OR (VOTE_CATE_SUB_SEQ = :VOTE_CATE_SUB_SEQ)) OR
                        ((:VOTE_SUBJECT IS NULL AND 0 = 0) OR (VOTE_SUBJECT LIKE :VOTE_SUBJECT))
                    ORDER BY VOTE_FORM_SEQ DESC
                    LIMIT :start, :length";

        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("VOTE_CATE_SEQ", $cate_seq);
        $this->bind("VOTE_CATE_SUB_SEQ", $cate_sub_seq);
        $this->bind("VOTE_SUBJECT", $keyword);

        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result;
    }

    /*
     *  투표 양식 질문 목록
     */
    public function getVoteFormQuestions($vote_seq)
    {
        $query = "SELECT 
                        QUESTION_SEQ,
                        VOTE_KIND,
                        VOTE_SEQ,
                        QUESTION_INDEX,
                        QUESTION_SUBJECT,
                        QUESTION_RESOURCE_TYPE,
                        QUESTION_RESOURCE_PATH,
                        QUESTION_RESP_TYPE,
                        QUESTION_REGI_DATE
                    FROM 
                        VOTE_QUESTIONS
                    WHERE 
                        VOTE_SEQ = :VOTE_SEQ AND
                        VOTE_CLASS = '2'
                    ORDER BY 
                        QUESTION_ORDER ASC";

        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);

        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result;
    }

    /*
     *  투표 양식 응답 목록
     */
    public function getVoteFormAnswers($vote_seq, $question_seq)
    {
        $query = "SELECT 
                        ANSWERS_SEQ,
                        VOTE_SEQ,
                        QUESTION_SEQ,
                        ANSWER_INDEX,
                        ANSWER_TEXT,
                        ANSWER_TYPE,
                        IS_CORRECT,
                        ANSWER_RESOURCE_PATH,
                        ANSWER_RESOURCE_TYPE,
                        ANSWER_REGI_DATE
                    FROM 
                        VOTE_ANSWERS
                    WHERE
                        VOTE_SEQ = :VOTE_SEQ AND
                        QUESTION_SEQ = :QUESTION_SEQ AND
                        VOTE_CLASS = '2'
                    ORDER BY
                        ANSWERS_SEQ ASC";

        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        $this->bind("QUESTION_SEQ", $question_seq);

        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result;
    }

    /*
     * 투표 양식 등록
     */
    public function registerVoteForm($array)
    {
        // print_r($array);
        // exit;
        $vote_seq               = $array["vote_form_seq"];
        $write_seq              = $_SESSION["admin_seq"];
        $vote_kind              = $array["vote_kind"];
        $vote_type              = $array["vote_type"];
        $vote_subject           = $array["vote_subject"];
        $vote_cate_seq          = $array["vote_cate1_seq"];
        $vote_cate_sub_seq      = $array["vote_cate2_seq"];
        $vote_url               = $array["vote_url"];
        $vote_context           = $array["vote_context"];
        $vote_resource_path = "";
        $resource_type          = $array["vote_resource_type"];
        if ($resource_type == "1")        
            $vote_resource_path = $array["vote_real_name"];
        else if ($resource_type == "2" || $resource_type == "3")
            $vote_resource_path = $array["vote_resource_url"];
        
        if ($vote_resource_path == "")
        {
            $resource_type == "0";
            $vote_resource_path = $array["vote_real_name"];
        }
        
        $query = "";
        if ($vote_seq == "")
        {
            $query = "INSERT INTO VOTE_FORM
                        (
                          VOTE_WRITER_SEQ,
                          VOTE_FORM_KIND,
                          VOTE_TYPE,
                          VOTE_SUBJECT,
                          VOTE_CATE_SEQ,
                          VOTE_CATE_SUB_SEQ,
                          VOTE_RESOURCE_PATH,
                          VOTE_RESOURCE_TYPE,
                          VOTE_URL,
                          VOTE_FORM_CONTEXT,
                          VOTE_VIEW_COUNT,
                          VOTE_USE_COUNT
                        )
                        VALUES
                        (
                          :VOTE_WRITER_SEQ,
                          :VOTE_FORM_KIND,
                          :VOTE_TYPE,
                          :VOTE_SUBJECT,
                          :VOTE_CATE_SEQ,
                          :VOTE_CATE_SUB_SEQ,
                          :VOTE_RESOURCE_PATH,
                          :VOTE_RESOURCE_TYPE,
                          :VOTE_URL,
                          :VOTE_FORM_CONTEXT,
                          '0',
                          '0'
                        )";

            $queryType = CCore_Lib_Routines_Handler::INSERT;
        }
        else
        {
            $query = "UPDATE VOTE_FORM
                        SET
                            VOTE_WRITER_SEQ = :VOTE_WRITER_SEQ,
                            VOTE_FORM_KIND = :VOTE_FORM_KIND,
                            VOTE_TYPE = :VOTE_TYPE,
                            VOTE_SUBJECT = :VOTE_SUBJECT,
                            VOTE_CATE_SEQ = :VOTE_CATE_SEQ,
                            VOTE_CATE_SUB_SEQ = :VOTE_CATE_SUB_SEQ,
                            VOTE_RESOURCE_PATH = :VOTE_RESOURCE_PATH,
                            VOTE_RESOURCE_TYPE = :VOTE_RESOURCE_TYPE,
                            VOTE_URL = :VOTE_URL,
                            VOTE_FORM_CONTEXT = :VOTE_FORM_CONTEXT
                        WHERE
                            VOTE_FORM_SEQ = :VOTE_FORM_SEQ";

            $queryType = CCore_Lib_Routines_Handler::UPDATE;
        }

        $this->query($query);
        if ($vote_seq != "")
            $this->bind("VOTE_FORM_SEQ", $vote_seq);

        $this->bind("VOTE_WRITER_SEQ", $write_seq);
        $this->bind("VOTE_FORM_KIND", $vote_kind);
        $this->bind("VOTE_TYPE", $vote_type);
        $this->bind("VOTE_SUBJECT", $vote_subject);
        $this->bind("VOTE_CATE_SEQ", $vote_cate_seq);
        $this->bind("VOTE_CATE_SUB_SEQ", $vote_cate_sub_seq);
        $this->bind("VOTE_RESOURCE_PATH", $vote_resource_path);
        $this->bind("VOTE_FORM_CONTEXT", $vote_context);
        $this->bind("VOTE_URL", $vote_url);
        $this->bind("VOTE_RESOURCE_TYPE", $resource_type); // 동영상인지 이미지인지

        $result = $this->execute($queryType);
        if (! $result)
            return false;

        if ($vote_seq == "")
        {
            $query = "SELECT VOTE_FORM_SEQ
                        FROM VOTE_FORM
                        ORDER BY VOTE_FORM_SEQ DESC
                        LIMIT 1;";

            $this->query($query);
            $queryType = CCore_Lib_Routines_Handler::SELECT;
            $result = $this->execute($queryType);
            $vote_seq = $result[0]["VOTE_FORM_SEQ"];
        }

        $deleteQuestionQuery = "DELETE FROM VOTE_QUESTIONS
                                   WHERE VOTE_SEQ = :VOTE_FORM_SEQ";

        $this->query($deleteQuestionQuery);
        $this->bind("VOTE_FORM_SEQ", $vote_seq);

        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);
        if (! $result)
            return false;

        $deleteAnswerQuery = "DELETE FROM VOTE_ANSWERS
                                   WHERE VOTE_SEQ = :VOTE_FORM_SEQ";

        $this->query($deleteAnswerQuery);
        $this->bind("VOTE_FORM_SEQ", $vote_seq);

        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);
        if (! $result)
            return false;

        $insertQuestionQuery = "INSERT INTO VOTE_QUESTIONS
                                    (
                                        VOTE_CLASS,
                                        VOTE_TYPE,
                                    	VOTE_KIND,
                                    	VOTE_SEQ,
                                        QUESTION_INDEX,
                                        QUESTION_ORDER,
                                    	QUESTION_SUBJECT,
                                    	QUESTION_RESOURCE_PATH,
                                        QUESTION_RESOURCE_TYPE,
                                    	QUESTION_RESP_TYPE
                                    )
                                    VALUES
                                    (
                                        '2',
                                        :VOTE_TYPE,
                                    	:VOTE_KIND,
                                    	:VOTE_SEQ,
                                        :QUESTION_INDEX,
                                        :QUESTION_ORDER,
                                    	:QUESTION_SUBJECT,
                                    	:QUESTION_RESOURCE_PATH,
                                        :QUESTION_RESOURCE_TYPE,
                                    	:QUESTION_RESP_TYPE
                                    )";

        if ($vote_type != "5")
        {
            $insertAnswerQuery = "INSERT INTO VOTE_ANSWERS
                                    (
                                      VOTE_CLASS,
                                      VOTE_TYPE,
                                      VOTE_SEQ,
                                      QUESTION_SEQ,
                                      ANSWER_INDEX,
                                      ANSWER_TEXT,
                                      ANSWER_TYPE,
                                      IS_CORRECT,
                                      ANSWER_RESOURCE_PATH,
                                      ANSWER_RESOURCE_TYPE
                                    )
                                    VALUES
                                    (
                                      '2',
                                      :VOTE_TYPE,
                                      :VOTE_SEQ,
                                      :QUESTION_SEQ,
                                      :ANSWER_INDEX,
                                      :ANSWER_TEXT,
                                      :ANSWER_TYPE,
                                      :IS_CORRECT,
                                      :ANSWER_RESOURCE_PATH,
                                      :ANSWER_RESOURCE_TYPE
                                    )";
        }

        $question_seqs          = $array["question_seq"];
        $question_indexs        = $array["question_index"];
        $question_subjects      = $array["question_subject"];
        $question_orders        = $array["question_order"];
        $question_real_names    = $array["question_real_name"];
        $question_answer_kinds  = $array["question_answer_kind"];
        $question_resource_type = $array["vote_question_resource_type"];
        $question_resource_path = $array["vote_question_resource_url"];

        for ($i = 0; $i < count($question_seqs); $i ++)
        {
            $questionIndex          = $question_indexs[$i];
            $questionSubject        = $question_subjects[$i];
            $questionRealName       = $question_real_names[$i];
            $questionOrder          = $question_orders[$i];
            $questionAnswerKind     = $question_answer_kinds[$i];
            $questionResourceType   = $question_resource_type[$i];
            $questionResourceUrl    = $question_resource_path[$i];
            $questionResourcePath   = "";
            if ($questionResourceType == "1")
                $questionResourcePath   = $questionRealName;
            else if ($questionResourceType == "2" || $questionResourceType == "3")
                $questionResourcePath   = $questionResourceUrl;
            
            if ($questionResourcePath == "")
                $questionResourceType   = "0";
            
            $this->query($insertQuestionQuery);
            $this->bind("VOTE_TYPE", $vote_type);
            $this->bind("VOTE_KIND", $vote_kind);
            $this->bind("VOTE_SEQ", $vote_seq);
            $this->bind("QUESTION_INDEX", $questionIndex);
            $this->bind("QUESTION_ORDER", $questionOrder);
            $this->bind("QUESTION_SUBJECT", $questionSubject);
            $this->bind("QUESTION_RESOURCE_PATH", $questionResourcePath);
            $this->bind("QUESTION_RESOURCE_TYPE", $questionResourceType);
            $this->bind("QUESTION_RESP_TYPE", $questionAnswerKind);

            $result     = $this->execute(CCore_Lib_Routines_Handler::INSERT);
            if (! $result)
                return false;

            $answer_seqs            = $array["answer_seq_" . $questionIndex];
            $answer_indexs          = $array["answer_index_" . $questionIndex];
            $answer_subjects        = $array["answer_subject_" . $questionIndex];
            $answer_real_names      = $array["answer_real_name_" . $questionIndex];
            $answer_corrects        = $array["answer_correct_" . $questionIndex];
            $answer_resource_types  = $array["vote_answer_resource_type_" . $questionIndex];
            $answer_resource_urls   = $array["vote_answer_resource_url_" . $questionIndex];

            $questionSelectQuery = "SELECT QUESTION_SEQ FROM VOTE_QUESTIONS ORDER BY QUESTION_SEQ DESC LIMIT 1";
            $this->query($questionSelectQuery);
            $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
            
            if ($questionAnswerKind != "5")
            {
                for ($j = 0; $j < count($answer_seqs); $j++)
                {
                    $answerSubject      = $answer_subjects[$j];
                    $answerRealName     = $answer_real_names[$j];
                    $answexIndex        = $answer_indexs[$j];
                    $isCorrect          = "0";
                    for ($k = 0; $k < count($answer_corrects); $k ++)
                    {
                        $answerCorrect = $answer_corrects[$k];
                        if ($answerCorrect == "")
                            $answerCorrect = "0";
                        
                        if ($answexIndex == $answerCorrect)
                        {
                            $isCorrect = "1";
                            break;
                        }
                    }
                    
                    $answerResourceType     = $answer_resource_types[$j];
                    $answerResourcePath     = $answer_resource_urls[$j];
                    if ($answerResourceType == "1")
                        $answerResourcePath     = $answerRealName;
                    else if ($answerResourceType == "2" || $answerResourceType == "3")
                        $answerResourcePath     = $answerResourcePath;
                    
                    if ($answerResourcePath == "")
                        $answerResourceType   = "0";
                
                    $this->query($insertAnswerQuery);
                    $this->bind("VOTE_TYPE", $vote_type);
                    $this->bind("VOTE_SEQ", $vote_seq);
                    $this->bind("QUESTION_SEQ", (integer) $result[0]["QUESTION_SEQ"]);
                    $this->bind("ANSWER_INDEX", $answexIndex);
                    $this->bind("ANSWER_TEXT", $answerSubject);
                    $this->bind("ANSWER_TYPE", $questionAnswerKind);
                    $this->bind("IS_CORRECT", $isCorrect);
                    $this->bind("ANSWER_RESOURCE_PATH", $answerResourcePath);
                    $this->bind("ANSWER_RESOURCE_TYPE", $answerResourceType);
    
                    $answerResult = $this->execute(CCore_Lib_Routines_Handler::INSERT);
                }
            }
        }

        // exit;

        return $vote_seq;
    }

    /*
     *  투표 양식 삭제
     */
    public function deleteVoteForm($array)
    {
        $vote_seq = $array["vote_form_seq"];
        $query = "DELETE FROM VOTE_FORM
                       WHERE VOTE_FORM_SEQ = :VOTE_SEQ";

        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);

        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);

        $query = "DELETE FROM VOTE_QUESTIONS
                       WHERE VOTE_TYPE = '1' AND VOTE_SEQ = :VOTE_SEQ";

        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);

        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);

        $query = "DELETE FROM VOTE_ANSWERS
                       WHERE VOTE_TYPE = '1' AND VOTE_SEQ = :VOTE_SEQ";

        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);

        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);

        return $result;
    }
    
    /*
     *  투표 양식 업데이트
     */
    public function updateViewCountVoteForm($vote_form_seq)
    {
        $query  = "UPDATE VOTE_FORM
                    SET
                      VOTE_VIEW_COUNT = VOTE_VIEW_COUNT + 1
                    WHERE 
                      VOTE_FORM_SEQ = :VOTE_FORM_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_FORM_SEQ", $vote_form_seq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        return $result;
    }
    
    /*
     *  투표 양식 업데이트
     */
    public function updateUseCountVoteForm($vote_form_seq)
    {
        $query  = "UPDATE VOTE_FORM
                    SET
                      VOTE_USE_COUNT = VOTE_USE_COUNT + 1
                    WHERE
                      VOTE_FORM_SEQ = :VOTE_FORM_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_FORM_SEQ", $vote_form_seq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        return $result;
    }
    
    /*
     *  투표 질문 목록
     */
    public function getVoteQuestions($vote_seq)
    {
        $query = "SELECT
                        QUESTION_SEQ,
                        VOTE_KIND,
                        VOTE_SEQ,
                        QUESTION_INDEX,
                        QUESTION_SUBJECT,
                        QUESTION_RESOURCE_TYPE,
                        QUESTION_RESOURCE_PATH,
                        QUESTION_RESP_TYPE,
                        QUESTION_REGI_DATE
                    FROM
                        VOTE_QUESTIONS
                    WHERE
                        VOTE_SEQ = :VOTE_SEQ AND
                        VOTE_CLASS = '1'
                    ORDER BY
                        QUESTION_INDEX ASC";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  투표 양식 응답 목록
     */
    public function getVoteQuizAnswers($vote_seq, $question_seq)
    {
        $query = "SELECT
                        A.ANSWERS_SEQ,
                        A.VOTE_SEQ,
                        A.QUESTION_SEQ,
                        A.ANSWER_INDEX,
                        A.ANSWER_TEXT,
                        A.ANSWER_TYPE,
                        A.IS_CORRECT,
                        A.ANSWER_RESOURCE_PATH,
                        A.ANSWER_RESOURCE_TYPE,
                        A.ANSWER_REGI_DATE,
                        CASE WHEN CC.VOTE_ANSWER_SELECT_SEQ IS NOT NULL THEN 'checked'
                             ELSE                                           ''
                        END AS CHECKED
                    FROM
                        VOTE_ANSWERS A
                        LEFT JOIN
                        (
							SELECT
								B.VOTE_ANSWER_SELECT_SEQ
							FROM
								VOTE_RESP_LOG B
								INNER JOIN
								MEMBER C
								ON B.VOTE_MEMBER_SEQ = C.member_seq
                        ) CC
                        ON A.ANSWERS_SEQ = CC.VOTE_ANSWER_SELECT_SEQ
                    WHERE
						A.VOTE_SEQ = :VOTE_SEQ AND
                        A.QUESTION_SEQ = :QUESTION_SEQ AND
                        VOTE_CLASS = '1'
                    ORDER BY
                        ANSWERS_SEQ ASC";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        $this->bind("QUESTION_SEQ", $question_seq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  투표 양식 응답 목록
     */
    public function getVoteAnswers($vote_seq, $question_seq)
    {
        $query = "SELECT
                        ANSWERS_SEQ,
                        VOTE_SEQ,
                        QUESTION_SEQ,
                        ANSWER_INDEX,
                        ANSWER_TEXT,
                        ANSWER_TYPE,
                        IS_CORRECT,
                        ANSWER_RESOURCE_PATH,
                        ANSWER_RESOURCE_TYPE,
                        ANSWER_REGI_DATE
                    FROM
                        VOTE_ANSWERS
                    WHERE
                        VOTE_SEQ = :VOTE_SEQ AND
                        QUESTION_SEQ = :QUESTION_SEQ AND
                        VOTE_CLASS = '1'
                    ORDER BY
                        ANSWERS_SEQ ASC";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        $this->bind("QUESTION_SEQ", $question_seq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  자유 응답 목록
     */
    public function getVoteFreeAnswers($vote_seq, $question_seq)
    {
        $query  = "SELECT
                        VOTE_FREE_ANSWERS_SEQ,
                    	VOTE_SEQ,
                    	VOTE_QUESTION_SEQ,
                    	VOTE_MEMBER_SEQ,
                    	nname,
                    	pic,
                    	VOTE_ANSWER_TEXT,
                    	VOTE_ANSWER_REGI_DATE,
                    	ANSWER_COUNT,
                    	TOTAL,
                    	PERCENTAGE
                    FROM
                    (
                        SELECT 
                        	VOTE_FREE_ANSWERS_SEQ,
                        	VOTE_SEQ,
                        	VOTE_QUESTION_SEQ,
                        	AAA.VOTE_MEMBER_SEQ,
                        	AAA.nname,
                        	AAA.pic,
                        	VOTE_ANSWER_TEXT,
                        	VOTE_ANSWER_REGI_DATE,
                        	ANSWER_COUNT,
                            TOTAL,
                            (ANSWER_COUNT / TOTAL) * 100 AS PERCENTAGE
                        FROM
                        (
                        	SELECT 
                        		VOTE_FREE_ANSWERS_SEQ,
                        		VOTE_SEQ,
                        		VOTE_QUESTION_SEQ,
                        		A.VOTE_MEMBER_SEQ,
                        		B.nname,
                        		B.pic,
                        		VOTE_ANSWER_TEXT,
                        		VOTE_ANSWER_REGI_DATE,
                        		(SELECT COUNT(*)  AS ANSWERS_COUNT FROM VOTE_RESP_LOG AA WHERE AA.VOTE_ANSWER_SELECT_SEQ = A.VOTE_FREE_ANSWERS_SEQ) AS ANSWER_COUNT,
                                (SELECT	COUNT(*) AS TOTAL FROM VOTE_RESP_LOG A WHERE VOTE_SEQ = :VOTE_SEQ AND VOTE_QUESTION_SEQ = :VOTE_QUESTION_SEQ) AS TOTAL
                        	FROM 
                        		VOTE_FREE_ANSWERS A INNER JOIN
                        		MEMBER B
                        		ON A.VOTE_MEMBER_SEQ = B.member_seq
                        	WHERE
                        		VOTE_SEQ = :VOTE_SEQ AND VOTE_QUESTION_SEQ = :VOTE_QUESTION_SEQ
                        ) AAA
                    ) AAAA
                    ORDER BY PERCENTAGE DESC";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        $this->bind("VOTE_QUESTION_SEQ", $question_seq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     * 투표 양식 등록
     */
    public function registerVote($array)
    {
        $vote_seq           = $array["vote_seq"];
        $write_seq          = $_SESSION["member_seq"];
        $vote_kind          = $array["vote_kind"];
        $vote_type          = $array["vote_type"];
        $vote_subject       = $array["vote_subject"];
        $vote_context       = $array["vote_context"];
        $vote_cate_seq      = $array["vote_cate1_seq"];
        $vote_cate_sub_seq  = $array["vote_cate2_seq"];
        $vote_resource_path = $array["vote_resource_url"];
        $vote_real_name     = $array["vote_real_name"];
        $vote_open_point    = $array["vote_open_point"];
        $vote_resp_point    = $array["vote_resp_point"];
        $vote_resource_type = $array["vote_resource_type"];
        $vote_url           = $array["vote_url"];
        $event_movie_url    = $array["event_movie_url"];
        $event_phone        = $array["event_phone"];
        $event_file         = $array["event_file"];
        $event_real_file    = $array["real_path"];
        $vote_is_open       = $array["is_open"];
        if ($vote_is_open == "on")
            $vote_is_open   = "1";
        $vote_end_date      = $array["vote_end_date"];
        if ($vote_end_date == "")
            $vote_end_date  = $this->default_end_date;
        $query = "";
        $vote_is_event       = $array["is_event"];
        if ($vote_is_event == "")
            $vote_is_event   = "0";
        if ($vote_is_event == "on")
            $vote_is_event   = "1";
        
        if ($vote_seq == "")
        {
            $query = "INSERT INTO VOTE
                        (
                          VOTE_WRITER_SEQ,
                          VOTE_KIND,
                          VOTE_TYPE,
                          VOTE_SUBJECT,
                          VOTE_CONTEXT,
                          VOTE_CATE_SEQ,
                          VOTE_CATE_SUB_SEQ,
                          VOTE_RESOURCE_PATH,
                          VOTE_RESOURCE_TYPE,
                          VOTE_URL,
                          VOTE_OPEN_POINT,
                          VOTE_RESP_POINT,
                          VOTE_VIEW_COUNT,
                          VOTE_PARTICIPATE_COUNT,
                          VOTE_RECOMM_COUNT,
                          VOTE_END_DATE,
                          VOTE_EVENT_MOVIE_URL,
                          VOTE_EVENT_PHONE,
                          VOTE_EVENT_REAL_FILE,
                          VOTE_EVENT_FILE,
                          VOTE_IS_OPEN,
                          VOTE_IS_START,
                          VOTE_IS_EVENT
                        )
                        VALUES
                        (
                          :VOTE_WRITER_SEQ,
                          :VOTE_KIND,
                          :VOTE_TYPE,
                          :VOTE_SUBJECT,
                          :VOTE_CONTEXT,
                          :VOTE_CATE_SEQ,
                          :VOTE_CATE_SUB_SEQ,
                          :VOTE_RESOURCE_PATH,
                          :VOTE_RESOURCE_TYPE,
                          :VOTE_URL,
                          :VOTE_OPEN_POINT,
                          :VOTE_RESP_POINT,
                          '0',
                          '0',
                          '0',
                          DATE(:VOTE_END_DATE),
                          :VOTE_EVENT_MOVIE_URL,
                          :VOTE_EVENT_PHONE,
                          :VOTE_EVENT_REAL_FILE,
                          :VOTE_EVENT_FILE,
                          :VOTE_IS_OPEN,
                          '0',
                          :VOTE_IS_EVENT
                        )";
            
            $queryType = CCore_Lib_Routines_Handler::INSERT;
        }
        else
        {
            $query = "UPDATE VOTE
                            SET
                                VOTE_WRITER_SEQ = :VOTE_WRITER_SEQ,
                                VOTE_KIND = :VOTE_KIND,
                                VOTE_TYPE = :VOTE_TYPE,
                                VOTE_SUBJECT = :VOTE_SUBJECT,
                                VOTE_CONTEXT = :VOTE_CONTEXT,
                                VOTE_CATE_SEQ = :VOTE_CATE_SEQ,
                                VOTE_CATE_SUB_SEQ = :VOTE_CATE_SUB_SEQ,
                                VOTE_RESOURCE_PATH = :VOTE_RESOURCE_PATH,
                                VOTE_RESOURCE_TYPE = :VOTE_RESOURCE_TYPE,
                                VOTE_URL = :VOTE_URL,
                                VOTE_OPEN_POINT = :VOTE_OPEN_POINT,
                                VOTE_RESP_POINT = :VOTE_RESP_POINT,
                                VOTE_END_DATE = DATE(:VOTE_END_DATE),
                                VOTE_EVENT_MOVIE_URL = :VOTE_EVENT_MOVIE_URL,
                                VOTE_EVENT_PHONE = :VOTE_EVENT_PHONE,
                                VOTE_EVENT_REAL_FILE = :VOTE_EVENT_REAL_FILE,
                                VOTE_EVENT_FILE = :VOTE_EVENT_FILE,
                                VOTE_IS_OPEN = :VOTE_IS_OPEN,
                                VOTE_IS_EVENT = :VOTE_IS_EVENT
                            WHERE
                                VOTE_SEQ = :VOTE_SEQ";
            
            $queryType = CCore_Lib_Routines_Handler::UPDATE;
        }
        
        $this->query($query);
        if ($vote_seq != "")
            $this->bind("VOTE_SEQ", $vote_seq);
            
        $this->bind("VOTE_WRITER_SEQ", (integer)$write_seq);
        $this->bind("VOTE_KIND", $vote_kind);
        $this->bind("VOTE_TYPE", $vote_type);
        $this->bind("VOTE_SUBJECT", $vote_subject);
        $this->bind("VOTE_CONTEXT", $vote_context);
        $this->bind("VOTE_CATE_SEQ", $vote_cate_seq);
        $this->bind("VOTE_CATE_SUB_SEQ", $vote_cate_sub_seq);
        $this->bind("VOTE_RESOURCE_PATH", $vote_real_name);
        $this->bind("VOTE_RESOURCE_TYPE", $vote_resource_type); // 동영상인지 이미지인지
        $this->bind("VOTE_OPEN_POINT", $vote_open_point);
        $this->bind("VOTE_RESP_POINT", $vote_resp_point);
        $this->bind("VOTE_URL", $vote_url);
        $this->bind("VOTE_END_DATE", $vote_end_date);
        $this->bind("VOTE_EVENT_MOVIE_URL", $event_movie_url);
        $this->bind("VOTE_EVENT_PHONE", $event_phone);
        $this->bind("VOTE_EVENT_REAL_FILE", $event_real_file);
        $this->bind("VOTE_EVENT_FILE", $event_file);
        $this->bind("VOTE_IS_OPEN", $vote_is_open);
        $this->bind("VOTE_IS_EVENT", $vote_is_event);
        $result = $this->execute($queryType);
        if (!$result)
            return false;
        
        if ($vote_seq == "")
        {
            $query = "SELECT VOTE_SEQ
                        FROM VOTE
                        ORDER BY VOTE_SEQ DESC
                        LIMIT 1;";
            
            $this->query($query);
            $queryType = CCore_Lib_Routines_Handler::SELECT;
            $result = $this->execute($queryType);
            $vote_seq = $result[0]["VOTE_SEQ"];
        }
        
        $deleteQuestionQuery = "DELETE FROM VOTE_QUESTIONS
                                WHERE VOTE_SEQ = :VOTE_SEQ";
            
        $this->query($deleteQuestionQuery);
        $this->bind("VOTE_SEQ", $vote_seq);
            
        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);
        if (!$result)
            return false;
                
        $deleteAnswerQuery = "DELETE FROM VOTE_ANSWERS
                                WHERE VOTE_SEQ = :VOTE_SEQ";
                
        $this->query($deleteAnswerQuery);
        $this->bind("VOTE_SEQ", $vote_seq);
                
        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);
        if (!$result)
            return false;
         
        $insertQuestionQuery = "INSERT INTO VOTE_QUESTIONS
                                (
                                    VOTE_CLASS,
                                    VOTE_TYPE,
                                	VOTE_KIND,
                                	VOTE_SEQ,
                                    QUESTION_INDEX,
                                    QUESTION_ORDER,
                                	QUESTION_SUBJECT,
                                	QUESTION_RESOURCE_PATH,
                                    QUESTION_RESOURCE_TYPE,
                                	QUESTION_RESP_TYPE
                                )
                                VALUES
                                (
                                    '1',
                                    :VOTE_TYPE,
                                	:VOTE_KIND,
                                	:VOTE_SEQ,
                                    :QUESTION_INDEX,
                                    :QUESTION_ORDER,
                                	:QUESTION_SUBJECT,
                                	:QUESTION_RESOURCE_PATH,
                                    :QUESTION_RESOURCE_TYPE,
                                	:QUESTION_RESP_TYPE
                                )";
                    
        $insertAnswerQuery = "INSERT INTO VOTE_ANSWERS
                                (
                                  VOTE_CLASS,
                                  VOTE_TYPE,
                                  VOTE_SEQ,
                                  QUESTION_SEQ,
                                  ANSWER_INDEX,
                                  ANSWER_TEXT,
                                  ANSWER_TYPE,
                                  IS_CORRECT,
                                  ANSWER_RESOURCE_PATH,
                                  ANSWER_RESOURCE_TYPE
                                )
                                VALUES
                                (
                                  '1',
                                  :VOTE_TYPE,
                                  :VOTE_SEQ,
                                  :QUESTION_SEQ,
                                  :ANSWER_INDEX,
                                  :ANSWER_TEXT,
                                  :ANSWER_TYPE,
                                  :IS_CORRECT,
                                  :ANSWER_RESOURCE_PATH,
                                  :ANSWER_RESOURCE_TYPE
                                )";
                    
        $question_seqs              = $array["question_seq"];
        $question_indexs            = $array["question_index"];
        $question_subjects          = $array["question_subject"];
        $question_orders            = $array["question_order"];
        $question_resource_paths    = $array["vote_question_resource_url"];
        $question_real_names        = $array["question_real_name"];
        $question_resource_types    = $array["vote_question_resource_type"];
        $question_answer_kinds      = $array["question_answer_kind"];
                    
        for ($i = 0; $i < count($question_seqs); $i ++)
        {
            $questionIndex          = $question_indexs[$i];
            $questionSubject        = $question_subjects[$i];
            $questionRealName       = $question_real_names[$i];
            $questionResourceType   = $question_resource_types[$i];
            $questionOrder          = $question_orders[$i];
            $questionAnswerKind     = $question_answer_kinds[$i];
            
            $this->query($insertQuestionQuery);
            $this->bind("VOTE_KIND", $vote_kind);
            $this->bind("VOTE_TYPE", $vote_type);
            $this->bind("VOTE_SEQ", (integer)$vote_seq);
            $this->bind("QUESTION_INDEX", $questionIndex);
            $this->bind("QUESTION_ORDER", $questionOrder);
            $this->bind("QUESTION_SUBJECT", $questionSubject);
            $this->bind("QUESTION_RESOURCE_PATH", $questionRealName);
            $this->bind("QUESTION_RESOURCE_TYPE", $questionResourceType);
            $this->bind("QUESTION_RESP_TYPE", $questionAnswerKind);
            
            $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
            if (!$result)
                return false;
        
            $answer_seqs            = $array["answer_seq_" . $questionIndex];
            $answer_indexs          = $array["answer_index_" . $questionIndex];
            $answer_subjects        = $array["answer_subject_" . $questionIndex];
            $answer_resource_urls   = $array["vote_answer_resource_url_" . $questionIndex];
            $answer_real_names      = $array["answer_real_name_" . $questionIndex];
            $answer_resource_types  = $array["vote_answer_resource_type_" . $questionIndex];
            $answer_corrects        = $array["answer_correct_" . $questionIndex];
                            
            $questionSelectQuery = "SELECT QUESTION_SEQ FROM VOTE_QUESTIONS ORDER BY QUESTION_SEQ DESC LIMIT 1";
            $this->query($questionSelectQuery);
            $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
            for ($j = 0; $j < count($answer_seqs); $j ++)
            {
                $answerSubject      = $answer_subjects[$j];
                $answerRealName     = $answer_real_names[$j];
                $answerResourceType = $answer_resource_types[$j];
                $answexIndex        = $answer_indexs[$j];
                $isCorrect          = "0";
                // print_r($answer_corrects);
                for ($k = 0; $k < count($answer_corrects); $k ++)
                {
                    $answerCorrect = $answer_corrects[$k];
                    // echo($k."=".$answerCorrect."<br/>\r\n");
                    if ($answerCorrect == "")
                        $answerCorrect = "0";
                        // echo($answexIndex."-".$answerCorrect."<br/>\r\n");
                    if ($answexIndex == $answerCorrect)
                    {
                        // echo("V"."<br/>\r\n");
                        $isCorrect = "1";
                        break;
                    }
                }
                                
                $this->query($insertAnswerQuery);
                $this->bind("VOTE_TYPE", $vote_type);
                $this->bind("VOTE_SEQ", (integer)$vote_seq);
                $this->bind("QUESTION_SEQ", (integer) $result[0]["QUESTION_SEQ"]);
                $this->bind("ANSWER_INDEX", $answexIndex);
                $this->bind("ANSWER_TEXT", $answerSubject);
                $this->bind("ANSWER_TYPE", $questionAnswerKind);
                $this->bind("IS_CORRECT", $isCorrect);
                $this->bind("ANSWER_RESOURCE_PATH", $answerRealName);
                $this->bind("ANSWER_RESOURCE_TYPE", $answerResourceType);
                
                $answerResult = $this->execute(CCore_Lib_Routines_Handler::INSERT);
            }
        }
        
        $pointPosition  = "";
        if ($vote_kind == "1")
            $pointPosition  = "101";
        else
            $pointPosition  = "111";
            
        //$pointInfo  = new CApp_Handler_Point_Ctrl();
        CApp_Handler_Point_Ctrl::instance()->setPointByPosition($write_seq, $pointPosition, "1", "1");
        
        $vote_form_seq  = $array["vote_form_seq"];
        if ($vote_form_seq != "")
            $this->updateUseCountVoteForm($vote_form_seq);
        
        return $vote_seq;
    }
    
    /*
     *  투표 정보 업데이트
     */
    public function updateVoteInfo($array)
    {
        $vote_seq               = $array["vote_seq"];
        $vote_kind              = $array["vote_kind"];
        $vote_type              = $array["vote_type"];
        $voteWriterSeq          = $array["vote_writer_seq"];
        $vote_subject           = $array["vote_subject"];
        $vote_context           = $array["vote_context"];
        $vote_cate_seq          = $array["cate_seq"];
        $vote_cate_sub_seq      = $array["vote_cate2_seq"];
        $vote_resource_type     = $array["vote_resource_type"];
        $vote_resource_path     = "";
        if ($vote_resource_type == "1")
            $vote_resource_path = $array["real_name"];
        else 
            $vote_resource_path = $array["vote_resource_url"];
        $vote_url               = $array["vote_url"];
        $vote_security_code     = $array["vote_security_code"];
        $vote_end_date          = $array["vote_end_date"];
        $is_open                = $array["is_open"];
        $is_start               = $array["is_start"];
        $is_premium             = $array["is_premium"];
        $is_event               = $array["is_event"];
        $is_hot                 = $array["is_hot"];
        $coupon_seq             = $array["coupon_Seq"];
        if ($coupon_seq == "")
            $coupon_seq         = "0";
        $voteOrginOpenPoint     = (integer)$array["vote_origin_open_point"];
        $voteOpenPoint          = (integer)$array["vote_open_point"];
        $voteRespPoint          = (integer)$array["vote_resp_point"];
        
        $voteQuery  = "UPDATE VOTE
                        SET
                          VOTE_KIND = :VOTE_KIND,
                          VOTE_TYPE = :VOTE_TYPE,
                          VOTE_SUBJECT = :VOTE_SUBJECT,
                          VOTE_CONTEXT = :VOTE_CONTEXT,
                          VOTE_CATE_SEQ = :VOTE_CATE_SEQ,
                          VOTE_CATE_SUB_SEQ = :VOTE_CATE_SUB_SEQ,
                          VOTE_RESOURCE_PATH = :VOTE_RESOURCE_PATH,
                          VOTE_RESOURCE_TYPE = :VOTE_RESOURCE_TYPE,
                          VOTE_URL = :VOTE_URL,
                          VOTE_END_DATE = :VOTE_END_DATE,
                          VOTE_IS_OPEN = :VOTE_IS_OPEN,
                          VOTE_IS_PREMIUM = :VOTE_IS_PREMIUM,
                          VOTE_IS_EVENT = :VOTE_IS_EVENT,
                          VOTE_IS_START = :VOTE_IS_START,
                          VOTE_IS_HOT = :VOTE_IS_HOT,
                          COUPON_SEQ = :COUPON_SEQ,
                          VOTE_OPEN_POINT = :VOTE_OPEN_POINT,
                          VOTE_RESP_POINT = :VOTE_RESP_POINT,
                          VOTE_SECURITY_CODE = :VOTE_SECURITY_CODE
                        WHERE 
                          VOTE_SEQ = :VOTE_SEQ";
        
        $this->query($voteQuery);
        $this->bind("VOTE_SEQ", $vote_seq);
        $this->bind("VOTE_KIND", $vote_kind);
        $this->bind("VOTE_TYPE", $vote_type);
        $this->bind("VOTE_SUBJECT", $vote_subject);
        $this->bind("VOTE_CONTEXT", $vote_context);
        $this->bind("VOTE_CATE_SEQ", $vote_cate_seq);
        $this->bind("VOTE_CATE_SUB_SEQ", $vote_cate_sub_seq);
        $this->bind("VOTE_RESOURCE_TYPE", $vote_resource_type);
        $this->bind("VOTE_RESOURCE_PATH", $vote_resource_path);
        $this->bind("VOTE_URL", $vote_url);
        $this->bind("VOTE_END_DATE", $vote_end_date);
        $this->bind("VOTE_SECURITY_CODE", $vote_security_code);
        $this->bind("VOTE_IS_PREMIUM", $is_premium);
        $this->bind("VOTE_IS_OPEN", $is_open);
        $this->bind("VOTE_IS_EVENT", $is_event);
        $this->bind("VOTE_IS_START", $is_start);
        $this->bind("VOTE_IS_HOT, $is_hot");
        $this->bind("COUPON_SEQ", $coupon_seq);
        $this->bind("VOTE_OPEN_POINT", $voteOpenPoint);
        $this->bind("VOTE_RESP_POINT", $voteRespPoint);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        if (! $result)
            return false;
        
        if ($is_premium == "1")
        {
            $vote_service_seq       = $array["vote_service_seq"];
            $service_prem_seq       = $array["service_prem_seq"];
            $vote_service_price     = $array["vote_service_price"];
            $vote_service_price     = str_replace(",", "", $vote_service_price);
            $vote_payment_type      = $array["vote_payment_type"];
            $service_account_type   = $array["service_account_type"];
            $vote_service_account   = $array["vote_service_account"];
            $vote_service_payer     = $array["vote_service_payer"];
            $bank_account_seq       = $array["bank_account_seq"];
            
            $premiumQuery   = "UPDATE VOTE_PAYMENT_LOG
                                SET
                                  VOTE_SEQ = :VOTE_SEQ,
                                  SERVICE_TYPE = '1',
                                  PRODUCT_SEQ = :PRODUCT_SEQ,
                                  SERVICE_END_DATE = :SERVICE_END_DATE,
                                  SERVICE_ACCOUNT_SEQ = :SERVICE_ACCOUNT_SEQ,
                                  SERVICE_PRICE = :SERVICE_PRICE,
                                  SERVICE_PAYMENT_TYPE = :SERVICE_PAYMENT_TYPE,
                                  SERVICE_ACCOUNT_TYPE = :SERVICE_ACCOUNT_TYPE,
                                  SERVICE_ACCOUNT = :SERVICE_ACCOUNT,
                                  SERVICE_PAYER = :SERVICE_PAYER
                                WHERE 
                                  SERVICE_PAYMENT_SEQ = :SERVICE_PAYMENT_SEQ";
            
            $this->query($premiumQuery);
            $this->bind("SERVICE_PAYMENT_SEQ", $service_prem_seq);
            $this->bind("VOTE_SEQ", $vote_seq);
            $this->bind("PRODUCT_SEQ", $vote_service_seq);
            $this->bind("SERVICE_END_DATE", $vote_end_date);
            $this->bind("SERVICE_ACCOUNT_SEQ", $bank_account_seq);
            $this->bind("SERVICE_PRICE", $vote_service_price);
            $this->bind("SERVICE_PAYMENT_TYPE", $vote_payment_type);
            $this->bind("SERVICE_ACCOUNT_TYPE", $service_account_type);
            $this->bind("SERVICE_ACCOUNT", $vote_service_account);
            $this->bind("SERVICE_PAYER", $vote_service_payer);
            
            $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
            if (! $result)
                return false;
        }
        
        //개설한 사용자에게 포인트 지급 처리
        if ($voteOrginOpenPoint < $voteOpenPoint)
        {
            $votelastPoint  = $voteOpenPoint - $voteOrginOpenPoint;
            $pointPosition  = "";
            if ($vote_kind == "1")
                $pointPosition  = "101";
            else 
                $pointPosition  = "111";
                    
            $pointInfo  = new CApp_Handler_Point_Ctrl();
            return $pointInfo->setPoint2Member($voteWriterSeq, $pointPosition, "1", "2", $votelastPoint);
        }
        
        return true;
    }
    
    /*
     *  전체 투표 목록 갯수
     */
    public function getVoteCount()
    {
        $query  = "SELECT
                        COUNT(*) AS CNT
                    FROM
                        VOTE";
        
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  카테고리에 따른 투표 목록 갯수
     */
    public function getVoteListCount4Admin($cate_seq, $cate_sub_seq, $vote_kind, $keyword)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query = "SELECT
    					COUNT(*) AS CNT
    				FROM
    				    VOTE A
                    WHERE
                        (VOTE_KIND = :VOTE_KIND) AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0))";
        
        $this->query($query);
        $this->bind("VOTE_KIND", $vote_kind);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  투료 참여 횟수
     */
    public function getParticipantVoteCount()
    {
        $query  = "SELECT SUM(VOTE_PARTICIPATE_COUNT) AS CNT FROM VOTE";
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  투표 목록
     */
    public function getVoteList4Admin($cate_seq, $cate_sub_seq, $vote_kind, $keyword, $paging)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query  = "SELECT
                        VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_ORIGIN_IMAGE_PATH,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_ORIGIN_IMAGE_PATH,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_RECOMM_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                    VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        VOTE_REGI_DATE
                    FROM
                        VOTE A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                    WHERE
                        (VOTE_KIND = :VOTE_KIND) AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0))
                    ORDER BY VOTE_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("VOTE_KIND", $vote_kind);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  투표 검색 목록 갯수
     */
    public function getVoteSearchListCount($cate_seq, $cate_sub_seq, $keyword)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query = "SELECT
        				COUNT(*) AS CNT
        			FROM
        			    VOTE A
                    WHERE
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0) AND
                        (VOTE_SUBJECT LIKE :VOTE_SUBJECT OR VOTE_CONTEXT LIKE :VOTE_CONTEXT)";
        
        $this->query($query);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        $this->bind("VOTE_SUBJECT", "%".$keyword."%");
        $this->bind("VOTE_CONTEXT", "%".$keyword."%");
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  투표 검색 목록
     */
    public function getVoteSearchList($cate_seq, $cate_sub_seq, $keyword, $paging)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
                
        $query  = "SELECT
                    VOTE_SEQ,
                    VOTE_WRITER_SEQ,
                    B.nname AS VOTE_WRITER_NAME,
                    B.pic AS VOTE_WRITER_IMAGE,
                    VOTE_KIND,
                    CASE WHEN VOTE_TYPE = '1' THEN '투표'
                         WHEN VOTE_TYPE = '2' THEN '일반설문'
                         WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                         WHEN VOTE_TYPE = '4' THEN '퀴즈'
                         ELSE '기타'
                    END AS VOTE_TYPE_NAME,
                    VOTE_TYPE,
                    VOTE_SUBJECT,
                    VOTE_CONTEXT,
                    VOTE_CATE_SEQ,
                    (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                    (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_REAL_IMAGE_PATH,
                    (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_ORIGIN_IMAGE_PATH,
                    VOTE_CATE_SUB_SEQ,
                    (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                    (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_REAL_IMAGE_PATH,
                    (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_ORIGIN_IMAGE_PATH,
                    VOTE_RESOURCE_PATH,
                    VOTE_RESOURCE_TYPE,
                    VOTE_URL,
                    VOTE_VIEW_COUNT,
                    VOTE_RECOMM_COUNT,
                    VOTE_PARTICIPATE_COUNT,
                    CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                         ELSE                                    VOTE_END_DATE
                    END AS VOTE_END_DATE,
                    CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                         ELSE                         '비공개'
                    END AS VOTE_IS_OPEN_NAME,
                    VOTE_IS_OPEN,
                    VOTE_IS_PREMIUM,
                    VOTE_IS_START,
                    VOTE_IS_HOT,
                    VOTE_SECURITY_CODE,
                    VOTE_REGI_DATE
                FROM
                    VOTE A
                    INNER JOIN
                    MEMBER B
                    ON B.member_seq = A.VOTE_WRITER_SEQ
                WHERE
                    (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                    (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                    (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0) AND
                    (VOTE_SUBJECT LIKE :VOTE_SUBJECT OR VOTE_CONTEXT LIKE :VOTE_CONTEXT)
                ORDER BY VOTE_SEQ DESC
                LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        $this->bind("VOTE_SUBJECT", "%".$keyword."%");
        $this->bind("VOTE_CONTEXT", "%".$keyword."%");
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  투표 목록 갯수
     */
    public function getVoteListCount($cate_seq, $cate_sub_seq, $keyword)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query = "SELECT
    					COUNT(*) AS CNT
    				FROM
    				    VOTE A
                    WHERE
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SUB_SEQ IS NULL AND 0 = 0)";
        
        $this->query($query);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  투표 목록
     */
    public function getVoteList($cate_seq, $cate_sub_seq, $keyword, $paging)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query  = "SELECT
                        VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                             WHEN VOTE_TYPE = '2' THEN '일반설문'
                             WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                             WHEN VOTE_TYPE = '4' THEN '퀴즈'
                             ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_ORIGIN_IMAGE_PATH,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_ORIGIN_IMAGE_PATH,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_RECOMM_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                    VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        VOTE_REGI_DATE
                    FROM
                        VOTE A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                    WHERE
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0)
                    ORDER BY VOTE_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  투표 목록 갯수
     */
    public function getVoteListCountByMember($member_seq, $keyword)
    {
        $query = "SELECT
    					COUNT(*) AS CNT
    				FROM
    				    VOTE A
                    WHERE
                        A.VOTE_WRITER_SEQ = :VOTE_WRITER_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_WRITER_SEQ", $member_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  내(회원) 투표 목록
     */
    public function getVoteListByMember($member_seq, $keyword, $paging)
    {
        $query  = "SELECT
                        VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                             WHEN VOTE_TYPE = '2' THEN '일반설문'
                             WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                             WHEN VOTE_TYPE = '4' THEN '퀴즈'
                             ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_RECOMM_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                    VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        VOTE_REGI_DATE
                    FROM
                        VOTE A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                    WHERE
                        A.VOTE_WRITER_SEQ = :VOTE_WRITER_SEQ
                    ORDER BY VOTE_SEQ DESC";
        
        $this->query($query);
        $this->bind("VOTE_WRITER_SEQ", $member_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  투표 정보 조회
     */
    public function getVoteInfo($vote_seq)
    {
        $query  = "SELECT 
                        VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                             WHEN VOTE_TYPE = '2' THEN '일반설문'
                             WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                             WHEN VOTE_TYPE = '4' THEN '퀴즈'
                             ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        VOTE_RECOMM_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                    VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN '기한 없음'
                             ELSE                                    CONCAT(DATEDIFF(VOTE_END_DATE, VOTE_REGI_DATE), '일')
                        END AS PERIOD,
                        VOTE_EVENT_MOVIE_URL,
                        VOTE_EVENT_PHONE,
                        VOTE_EVENT_REAL_FILE,
                        VOTE_EVENT_FILE,
                        COUPON_SEQ,
                        VOTE_OPEN_POINT,
                        VOTE_RESP_POINT,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_EVENT,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        VOTE_REGI_DATE
                    FROM 
                        VOTE A 
                        INNER JOIN 
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                    WHERE
                        VOTE_SEQ = :VOTE_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    /*
     *  질문 정보
     */
    public function getQuestionList($vote_seq)
    {
        $query  = "SELECT 
                        QUESTION_SEQ,
                        VOTE_CLASS,
                        VOTE_TYPE,
                        VOTE_KIND,
                        VOTE_SEQ,
                        QUESTION_INDEX,
                        QUESTION_ORDER,
                        QUESTION_SUBJECT,
                        QUESTION_RESOURCE_PATH,
                        QUESTION_RESOURCE_TYPE,
                        QUESTION_RESP_TYPE,
                        QUESTION_REGI_DATE
                    FROM 
                        VOTE_QUESTIONS
                    WHERE
                        VOTE_SEQ = :VOTE_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    /*
     *  관리자 투표 정보 조회
     */
    public function getVoteInfoByAdmin($vote_seq)
    {
        $query  = "SELECT
                        A.VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                             WHEN VOTE_TYPE = '2' THEN '일반설문'
                             WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                             WHEN VOTE_TYPE = '4' THEN '퀴즈'
                             ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        VOTE_RECOMM_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                   VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_EVENT,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        COUPON_SEQ,
                        VOTE_OPEN_POINT,
                        VOTE_RESP_POINT,
                        VOTE_REGI_DATE,
                        SERVICE_TYPE,
                        SERVICE_PAYMENT_SEQ,
                        CASE WHEN SERVICE_TYPE = '1' THEN '프리미엄 서비스'
                             ELSE                         '이벤트 투표'
                        END AS SERVICE_PRODUCT_NAME,
                        PRODUCT_SEQ,
                        SERVICE_PRICE,
                        SERVICE_PAYMENT_TYPE,
                        CASE WHEN SERVICE_PAYMENT_TYPE = '1' THEN '무통장 입금'
                             ELSE                                 ''
                        END AS PAYMENT_TYPE_NAME,
                        SERVICE_ACCOUNT_TYPE,
                        SERVICE_ACCOUNT,
                        SERVICE_PAYER,
                        SERVICE_PAYMENT_DATE,
                        SERVICE_REGI_DATE
                    FROM
                        VOTE A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                        LEFT OUTER JOIN
                        VOTE_PAYMENT_LOG C
                        ON C.VOTE_SEQ = A.VOTE_SEQ
                    WHERE
                        A.VOTE_SEQ = :VOTE_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    /*
     *  선거 참여 횟수
     */
    public function getParticipantVoteCountByMe()
    {
        $query  = "SELECT 
                    	COUNT(*) AS CNT 
                    FROM
                    (
                    	SELECT
                    		VOTE_SEQ
                    	FROM
                    		VOTE_RESP_LOG
                    	WHERE
                    		VOTE_MEMBER_SEQ = :MEMBER_SEQ
                        GROUP BY VOTE_SEQ
                    ) A";
        
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $_SESSION["member_seq"]);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  선거/투표 참여 여부
     */
    public function checkParticipateVote($vote_seq)
    {
        $query  = "SELECT 
                        COUNT(*) AS CNT
                    FROM 
                        VOTE_RESP_LOG
                    WHERE
                        VOTE_SEQ  = :VOTE_SEQ AND VOTE_MEMBER_SEQ = :VOTE_MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        $this->bind("VOTE_MEMBER_SEQ", $_SESSION["member_seq"]);
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  투표 보안 코드 업데이트
     */
    public function updateSecurityCode($vote_seq, $code)
    {
        $query  = "UPDATE VOTE
                    SET
                    VOTE_SECURITY_CODE = :VOTE_SECURITY_CODE
                    WHERE VOTE_SEQ = :VOTE_SEQ;";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        $this->bind("VOTE_SECURITY_CODE", $code);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        return $result;
    }
    
    /*
     *  투표 프리미엄 여부 업데이트
     */
    public function updateIsPremium($vote_seq)
    {
        $query  = "UPDATE VOTE
                    SET
                    VOTE_IS_PREMIUM = '1',
                    VOTE_IS_OPEN = '0'
                    WHERE VOTE_SEQ = :VOTE_SEQ;";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        return $result;
    }
    
    /*
     *  투표 보안 코드 조회
     */
    public function getSecurityCode($vote_seq)
    {
        $query  = "SELECT
                        VOTE_SECURITY_CODE
                    FROM
                        VOTE
                    WHERE
                        VOTE_SEQ = :VOTE_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        return $result[0]["VOTE_SECURITY_CODE"];
    }
    
    /*
     *  투표 삭제
     */
    public function deleteVote($array)
    {
        $vote_seq   = $array["vote_form_seq"];
        $query      = "DELETE FROM VOTE
                       WHERE VOTE_SEQ = :VOTE_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::DELETE);
        
        $query      = "DELETE FROM VOTE_QUESTIONS
                       WHERE VOTE_TYPE = '1' AND VOTE_SEQ = :VOTE_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::DELETE);
        
        $query      = "DELETE FROM VOTE_ANSWERS
                       WHERE VOTE_TYPE = '1' AND VOTE_SEQ = :VOTE_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $vote_seq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);
        
        return $result;
    }
    
    /*
     *  프리미엄 투표 검색 목록 갯수
     */
    public function getVoteSearchListByPremiumCount($cate_seq, $cate_sub_seq, $keyword)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query = "SELECT
        				COUNT(*) AS CNT
        			FROM
        			    VOTE A
                    WHERE
                        VOTE_IS_PREMIUM = '1' AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0)) AND
                        (VOTE_SUBJECT LIKE :VOTE_SUBJECT OR VOTE_CONTEXT LIKE :VOTE_CONTEXT)";
        
        $this->query($query);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        $this->bind("VOTE_SUBJECT", "%".$keyword."%");
        $this->bind("VOTE_CONTEXT", "%".$keyword."%");
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  프리미엄 투표 검색 목록
     */
    public function getVoteSearchListByPremium($cate_seq, $cate_sub_seq, $keyword)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query  = "SELECT
                        VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                             WHEN VOTE_TYPE = '2' THEN '일반설문'
                             WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                             WHEN VOTE_TYPE = '4' THEN '퀴즈'
                             ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_ORIGIN_IMAGE_PATH,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_ORIGIN_IMAGE_PATH,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_RECOMM_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                    VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        VOTE_REGI_DATE
                    FROM
                        VOTE A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                    WHERE
                        VOTE_IS_PREMIUM = '1' AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0)) AND
                        (VOTE_SUBJECT LIKE :VOTE_SUBJECT OR VOTE_CONTEXT LIKE :VOTE_CONTEXT)
                    ORDER BY VOTE_SEQ DESC
                    LIMIT 0, 10";
        
        $this->query($query);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        $this->bind("VOTE_SUBJECT", "%".$keyword."%");
        $this->bind("VOTE_CONTEXT", "%".$keyword."%");
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  프리미엄 투표 목록 갯수
     */
    public function getVoteListByPremiumCount($cate_seq, $cate_sub_seq, $keyword)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query = "SELECT
    					COUNT(*) AS CNT
    				FROM
    				    VOTE A
                    WHERE
                        VOTE_IS_PREMIUM = '1' AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0))";
        
        $this->query($query);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  프리미엄 투표 목록
     */
    public function getVoteListByPremium($cate_seq, $cate_sub_seq, $keyword, $paging)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query  = "SELECT
                        VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                             WHEN VOTE_TYPE = '2' THEN '일반설문'
                             WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                             WHEN VOTE_TYPE = '4' THEN '퀴즈'
                             ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_ORIGIN_IMAGE_PATH,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_ORIGIN_IMAGE_PATH,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_RECOMM_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                    VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        VOTE_REGI_DATE
                    FROM
                        VOTE A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                    WHERE
                        VOTE_IS_PREMIUM = '1' AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0))
                    ORDER BY VOTE_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  프리미엄 투표 슬라이드 목록
     */
    public function getVoteListByPremiumSlide($cate_seq, $cate_sub_seq)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query  = "SELECT
                        VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                             WHEN VOTE_TYPE = '2' THEN '일반설문'
                             WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                             WHEN VOTE_TYPE = '4' THEN '퀴즈'
                             ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_ORIGIN_IMAGE_PATH,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_ORIGIN_IMAGE_PATH,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_RECOMM_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                    VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        VOTE_REGI_DATE
                    FROM
                        VOTE A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                    WHERE
                        VOTE_IS_PREMIUM = '1' AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0))
                    ORDER BY VOTE_SEQ DESC
                    LIMIT 1, 10";
        
        $this->query($query);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  이벤트 투표 검색 목록 갯수
     */
    public function getVoteSearchListByEventCount($cate_seq, $cate_sub_seq, $keyword)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query = "SELECT
        				COUNT(*) AS CNT
        			FROM
        			    VOTE A
                    WHERE
                        (VOTE_KIND = '2') AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0)) AND
                        (VOTE_SUBJECT LIKE :VOTE_SUBJECT OR VOTE_CONTEXT LIKE :VOTE_CONTEXT)";
        
        $this->query($query);
        $this->bind("VOTE_SUBJECT", "%".$keyword."%");
        $this->bind("VOTE_CONTEXT", "%".$keyword."%");
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  이벤트 투표 검색 목록
     */
    public function getVoteSearchListByEvent($cate_seq, $cate_sub_seq, $keyword)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
                
        $query  = "SELECT
                    VOTE_SEQ,
                    VOTE_WRITER_SEQ,
                    B.nname AS VOTE_WRITER_NAME,
                    B.pic AS VOTE_WRITER_IMAGE,
                    VOTE_KIND,
                    CASE WHEN VOTE_TYPE = '1' THEN '투표'
                         WHEN VOTE_TYPE = '2' THEN '일반설문'
                         WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                         WHEN VOTE_TYPE = '4' THEN '퀴즈'
                         ELSE '기타'
                    END AS VOTE_TYPE_NAME,
                    VOTE_TYPE,
                    VOTE_SUBJECT,
                    VOTE_CONTEXT,
                    VOTE_CATE_SEQ,
                    (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                    (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_REAL_IMAGE_PATH,
                    (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_ORIGIN_IMAGE_PATH,
                    VOTE_CATE_SUB_SEQ,
                    (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                    (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_REAL_IMAGE_PATH,
                    (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_ORIGIN_IMAGE_PATH,
                    VOTE_RESOURCE_PATH,
                    VOTE_RESOURCE_TYPE,
                    VOTE_URL,
                    VOTE_VIEW_COUNT,
                    VOTE_RECOMM_COUNT,
                    VOTE_PARTICIPATE_COUNT,
                    CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                         ELSE                                    VOTE_END_DATE
                    END AS VOTE_END_DATE,
                    CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                         ELSE                         '비공개'
                    END AS VOTE_IS_OPEN_NAME,
                    VOTE_IS_OPEN,
                    VOTE_IS_PREMIUM,
                    VOTE_IS_START,
                    VOTE_IS_HOT,
                    VOTE_SECURITY_CODE,
                    VOTE_REGI_DATE
                FROM
                    VOTE A
                    INNER JOIN
                    MEMBER B
                    ON B.member_seq = A.VOTE_WRITER_SEQ
                WHERE
                    (VOTE_KIND = '2') AND
                    ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                    (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                    (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0)) AND
                    (VOTE_SUBJECT LIKE :VOTE_SUBJECT OR VOTE_CONTEXT LIKE :VOTE_CONTEXT)
                ORDER BY VOTE_SEQ DESC
                LIMIT 0, 10";
        
        $this->query($query);
        $this->bind("VOTE_SUBJECT", "%".$keyword."%");
        $this->bind("VOTE_CONTEXT", "%".$keyword."%");
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  이벤트 투표 목록 갯수
     */
    public function getVoteListByEventCount($cate_seq, $cate_sub_seq, $keyword)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query = "SELECT
    					COUNT(*) AS CNT
    				FROM
    				    VOTE A
                    WHERE
                        (VOTE_KIND = '2') AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0))";
        
        $this->query($query);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  이벤트 투표 목록
     */
    public function getVoteListByEvent($cate_seq, $cate_sub_seq, $keyword, $paging)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query  = "SELECT
                        VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                             WHEN VOTE_TYPE = '2' THEN '일반설문'
                             WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                             WHEN VOTE_TYPE = '4' THEN '퀴즈'
                             ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_ORIGIN_IMAGE_PATH,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_ORIGIN_IMAGE_PATH,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_RECOMM_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                    VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        VOTE_REGI_DATE
                    FROM
                        VOTE A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                    WHERE
                        (VOTE_KIND = '2') AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0))
                    ORDER BY VOTE_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  이벤트 투표 슬라이드 목록
     */
    public function getVoteListByEventSlide($cate_seq, $cate_sub_seq)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query  = "SELECT
                        VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                             WHEN VOTE_TYPE = '2' THEN '일반설문'
                             WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                             WHEN VOTE_TYPE = '4' THEN '퀴즈'
                             ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_ORIGIN_IMAGE_PATH,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_ORIGIN_IMAGE_PATH,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_RECOMM_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                    VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        VOTE_REGI_DATE
                    FROM
                        VOTE A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                    WHERE
                        (VOTE_KIND = '2') AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0))
                    ORDER BY VOTE_SEQ DESC
                    LIMIT 1, 10";
        
        $this->query($query);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  핫이슈 투표 목록 갯수
     */
    public function getVoteListByHotissueCount($cate_seq, $cate_sub_seq, $keyword)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query = "SELECT
    					COUNT(*) AS CNT
    				FROM
    				    VOTE A
                    WHERE
                        (VOTE_IS_HOT = '1') AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0))";
        
        $this->query($query);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  핫이슈 투표 목록
     */
    public function getVoteListByHotissue($cate_seq, $cate_sub_seq, $keyword, $paging)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
        
        $query  = "SELECT
                        VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                             WHEN VOTE_TYPE = '2' THEN '일반설문'
                             WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                             WHEN VOTE_TYPE = '4' THEN '퀴즈'
                             ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_ORIGIN_IMAGE_PATH,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_ORIGIN_IMAGE_PATH,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_RECOMM_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                    VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        VOTE_REGI_DATE
                    FROM
                        VOTE A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                    WHERE
                        (VOTE_IS_HOT = '1') AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0))
                    ORDER BY VOTE_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  핫이슈 투표 검색 목록 갯수
     */
    public function getVoteSearchListByHotissueCount($cate_seq, $cate_sub_seq, $keyword)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query = "SELECT
        				COUNT(*) AS CNT
        			FROM
        			    VOTE A
                    WHERE
                        (VOTE_IS_HOT = '1') AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0)) AND
                        (VOTE_SUBJECT LIKE :VOTE_SUBJECT OR VOTE_CONTEXT LIKE :VOTE_CONTEXT)";
        
        $this->query($query);
        $this->bind("VOTE_SUBJECT", "%".$keyword."%");
        $this->bind("VOTE_CONTEXT", "%".$keyword."%");
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     *  핫이슈 투표 검색 목록
     */
    public function getVoteSearchListByHotissue($cate_seq, $cate_sub_seq, $keyword)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
                
        $query  = "SELECT
                        VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                             WHEN VOTE_TYPE = '2' THEN '일반설문'
                             WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                             WHEN VOTE_TYPE = '4' THEN '퀴즈'
                             ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_ORIGIN_IMAGE_PATH,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_ORIGIN_IMAGE_PATH,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_RECOMM_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                    VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        VOTE_REGI_DATE
                    FROM
                        VOTE A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                    WHERE
                        (VOTE_IS_HOT = '1') AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0)) AND
                        (VOTE_SUBJECT LIKE :VOTE_SUBJECT OR VOTE_CONTEXT LIKE :VOTE_CONTEXT) 
                    ORDER BY VOTE_SEQ DESC
                    LIMIT 0, 10";
        
        $this->query($query);
        $this->bind("VOTE_SUBJECT", "%".$keyword."%");
        $this->bind("VOTE_CONTEXT", "%".$keyword."%");
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  핫이슈 투표 슬라이드 목록
     */
    public function getVoteListByHotissueSlide($cate_seq, $cate_sub_seq, $keyword)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query  = "SELECT
                        VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                             WHEN VOTE_TYPE = '2' THEN '일반설문'
                             WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                             WHEN VOTE_TYPE = '4' THEN '퀴즈'
                             ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_ORIGIN_IMAGE_PATH,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_ORIGIN_IMAGE_PATH,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_RECOMM_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                    VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        VOTE_REGI_DATE
                    FROM
                        VOTE A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                    WHERE
                        (VOTE_IS_HOT = '1') AND
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0))
                    ORDER BY VOTE_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     *  신규 투표 목록
     */
    public function getVoteNewList($cate_seq, $cate_sub_seq, $keyword, $start, $limit)
    {
        if ($cate_seq == "")
            $cate_seq       = null;
        if ($cate_sub_seq == "")
            $cate_sub_seq   = null;
            
        $query  = "SELECT
                        VOTE_SEQ,
                        VOTE_WRITER_SEQ,
                        B.nname AS VOTE_WRITER_NAME,
                        B.pic AS VOTE_WRITER_IMAGE,
                        VOTE_KIND,
                        CASE WHEN VOTE_TYPE = '1' THEN '투표'
                             WHEN VOTE_TYPE = '2' THEN '일반설문'
                             WHEN VOTE_TYPE = '3' THEN '자유응답설문'
                             WHEN VOTE_TYPE = '4' THEN '퀴즈'
                             ELSE '기타'
                        END AS VOTE_TYPE_NAME,
                        VOTE_TYPE,
                        VOTE_SUBJECT,
                        VOTE_CONTEXT,
                        VOTE_CATE_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS VOTE_CATE_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SEQ) AS CATE_ORIGIN_IMAGE_PATH,
                        VOTE_CATE_SUB_SEQ,
                        (SELECT CATE_NAME FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS VOTE_CATE_SUB_NAME,
                        (SELECT CATE_REAL_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_REAL_IMAGE_PATH,
                        (SELECT CATE_ORIGIN_IMAGE_PATH FROM CATEGORY WHERE CATE_SEQ = A.VOTE_CATE_SUB_SEQ) AS CATE_SUB_ORIGIN_IMAGE_PATH,
                        VOTE_RESOURCE_PATH,
                        VOTE_RESOURCE_TYPE,
                        VOTE_URL,
                        VOTE_VIEW_COUNT,
                        VOTE_RECOMM_COUNT,
                        VOTE_PARTICIPATE_COUNT,
                        CASE WHEN VOTE_END_DATE = '9999-12-31' THEN 'nolimit'
                             ELSE                                    VOTE_END_DATE
                        END AS VOTE_END_DATE,
                        CASE WHEN VOTE_IS_OPEN = '1' THEN '공개'
                             ELSE                         '비공개'
                        END AS VOTE_IS_OPEN_NAME,
                        VOTE_IS_OPEN,
                        VOTE_IS_PREMIUM,
                        VOTE_IS_START,
                        VOTE_IS_HOT,
                        VOTE_SECURITY_CODE,
                        VOTE_REGI_DATE
                    FROM
                        VOTE A
                        INNER JOIN
                        MEMBER B
                        ON B.member_seq = A.VOTE_WRITER_SEQ
                    WHERE
                        ((:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NOT NULL AND A.VOTE_CATE_SEQ = :CATE_SEQ) OR
                        (:CATE_SUB_SEQ IS NOT NULL AND A.VOTE_CATE_SUB_SEQ = :CATE_SUB_SEQ) OR
                        (:CATE_SUB_SEQ IS NULL AND :CATE_SEQ IS NULL AND 0 = 0))
                    ORDER BY VOTE_SEQ DESC
                    LIMIT :start, :length";
        
        $this->query($query);
        $this->bind("start", $start);
        $this->bind("length", $limit);
        $this->bind("CATE_SEQ", $cate_seq);
        $this->bind("CATE_SUB_SEQ", $cate_sub_seq);
        
        $result     = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    public function getVoteIsOpen($voteSeq)
    {
        $query = "SELECT
        				VOTE_IS_OPEN
        			FROM
        			    VOTE A
                    WHERE
                        VOTE_SEQ = :VOTE_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $voteSeq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["VOTE_IS_OPEN"];
    }
    
    public function recommandVote($voteSeq)
    {
        $query  = "SELECT
                        COUNT(*) AS CNT
                    FROM 
                        RECOMM_VOTE_LOG
                    WHERE
                        VOTE_SEQ = :VOTE_SEQ AND
                        MEMBER_SEQ = :MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $voteSeq);
        $this->bind("MEMBER_SEQ", $_SESSION["member_seq"]);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        if (intval($result[0]["CNT"]) > 0)
            return -1;
        
        $query  = "UPDATE VOTE
                    SET
                      VOTE_RECOMM_COUNT = VOTE_RECOMM_COUNT + 1
                    WHERE VOTE_SEQ = :VOTE_SEQ;";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $voteSeq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        $query  = "SELECT
                        VOTE_RECOMM_COUNT
                    FROM
                        VOTE
                    WHERE
                        VOTE_SEQ = :VOTE_SEQ";
        
        $this->query($query);
        $this->bind("VOTE_SEQ", $voteSeq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        $query  = "INSERT INTO RECOMM_VOTE_LOG
                    (
                      VOTE_SEQ,
                      MEMBER_SEQ
                    )
                    VALUES
                    (
                      :VOTE_SEQ,
                      :MEMBER_SEQ
                    )";
        
        $this->query($query);
        
        $this->bind("VOTE_SEQ", $voteSeq);
        $this->bind("MEMBER_SEQ", $_SESSION["member_seq"]);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        
        return $result[0];
    }
}