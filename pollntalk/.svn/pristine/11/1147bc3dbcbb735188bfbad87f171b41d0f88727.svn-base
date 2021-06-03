<?php
/**
 *  @auth   : Jeon JY
 *  @date   : 202000814
 *  카테고리 정보 관리
 */
class CApp_Handler_Category_Ctrl extends CCore_Lib_Routines_Handler
{

    public function __construct()
    {
    }

    public function deleteCategory($array)
    {
        $cateSeq = $array['cate_seq'];

        if ($cateSeq == "")
            return false;

        $query = "DELETE FROM CATEGORY WHERE CATE_SEQ = :CATE_SEQ";

        $this->query($query);
        $this->bind("CATE_SEQ", $cateSeq);

        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);

        if (! $result)
            return false;

        return true;
    }

    public function registerCategory($array)
    {
        //print_r($array);
        //exit;
        
        $cateSeq        = $array['cate_seq'];
        $cateName       = $array['cate_name'];
        $cateParentSeq  = $array['cate_parent_seq'];
        $cateImagePath  = $array['real_name'];
        $tempImagePath  = $array['temp_path'];
        $cateText       = $array['cate_text'];
        $cateCert       = $array['cate_is_cert'];

        if ($cateParentSeq == "-")
            $cateParentSeq = "0";

        if ($cateSeq == "")
        {
            $query = "INSERT INTO CATEGORY
                       (
                            CATE_NAME,CATE_PARENT_SEQ,CATE_TEXT,CATE_IS_CERT,CATE_REAL_IMAGE_PATH, CATE_ORIGIN_IMAGE_PATH
                       )
                       VALUES
                       (
                            :CATE_NAME,:CATE_PARENT_SEQ,:CATE_TEXT,:CATE_IS_CERT, :CATE_REAL_IMAGE_PATH, :CATE_ORIGIN_IMAGE_PATH
                       )";
        }
        else
        {
            $query = "UPDATE CATEGORY
                        SET
                          CATE_NAME = :CATE_NAME,
                          CATE_PARENT_SEQ = :CATE_PARENT_SEQ,
                          CATE_TEXT = :CATE_TEXT,
                          CATE_IS_CERT = :CATE_IS_CERT,
                          CATE_REAL_IMAGE_PATH = :CATE_REAL_IMAGE_PATH,
                          CATE_ORIGIN_IMAGE_PATH = :CATE_ORIGIN_IMAGE_PATH
                        WHERE CATE_SEQ = :CATE_SEQ";
        }

        $this->query($query);
        if ($cateSeq != "")
            $this->bind("CATE_SEQ", $cateSeq);

        $this->bind("CATE_NAME", $cateName);
        $this->bind("CATE_PARENT_SEQ", $cateParentSeq);
        $this->bind("CATE_TEXT", $cateText);
        $this->bind("CATE_IS_CERT", $cateCert);
        $this->bind("CATE_REAL_IMAGE_PATH", $cateImagePath);
        $this->bind("CATE_ORIGIN_IMAGE_PATH", $tempImagePath);
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);

        if (! $result)
            return false;

        return true;
    }

    public function getCategoryList()
    {
        $query = "SELECT * FROM CATEGORY WHERE CATE_PARENT_SEQ = '0' ORDER BY CATE_SEQ ASC";

        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result;
    }

    public function getCategoryList4Form()
    {
        $query = "SELECT * FROM CATEGORY WHERE CATE_PARENT_SEQ = '0' ORDER BY CATE_SEQ ASC";

        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result;
    }

    public function getCategorySubList($cateSeq)
    {
        $query = "SELECT 
                        * 
                    FROM 
                        CATEGORY 
                    WHERE 
                        CATE_PARENT_SEQ = :CATE_PARENT_SEQ 
                    ORDER BY CATE_SEQ ASC";

        $this->query($query);
        $this->bind("CATE_PARENT_SEQ", $cateSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result;
    }

    public function getCategoryInfo($cateSeq)
    {
        $query = "SELECT 
                        CATE_SEQ,
                        CATE_NAME,
                        CATE_PARENT_SEQ,
                        CATE_TEXT,
                        CATE_IS_CERT,
                        CATE_REAL_IMAGE_PATH,
                        CATE_ORIGIN_IMAGE_PATH,
                        CATE_REGI_DATE 
                    FROM 
                        CATEGORY 
                    WHERE 
                        CATE_SEQ = :CATE_SEQ";

        $this->query($query);
        $this->bind("CATE_SEQ", $cateSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result;
    }

    public function getCategory4View($cateSeq, $cateSubSeq)
    {
        $query = "SELECT
                    	CATE_SEQ,
                    	CATE_NAME,
                    	CATE_TEXT,
                    	CATE_REAL_IMAGE_PATH,
                        CATE_ORIGIN_IMAGE_PATH,
                    	CATE_SUB_SEQ,
                    	CATE_SUB_NAME,
                    	CATE_SUB_TEXT,
                        CATE_IS_CERT,
                    	CATE_SUB_IMAGE_PATH
                    FROM
                    (
                    	SELECT 
                    		CATE_SEQ AS CATE_SEQ,
                    		CATE_NAME AS CATE_NAME,
                    		CATE_TEXT AS CATE_TEXT,
                            CATE_IS_CERT,
                    		CATE_REAL_IMAGE_PATH AS CATE_REAL_IMAGE_PATH,
                            CATE_ORIGIN_IMAGE_PATH
                    	FROM CATEGORY
                    	WHERE
                    	  :CATE_1_SEQ IS NOT NULL AND CATE_SEQ = :CATE_1_SEQ
                    ) AS AA
                    JOIN
                    (
                    	SELECT
                    		CASE
                    			WHEN CNT > 0 THEN CATE_SEQ 
                                ELSE 			  0 
                    		END AS CATE_SUB_SEQ,
                    		CASE
                    			WHEN CNT > 0 THEN CATE_NAME 
                                ELSE 			  '' 
                    		END AS CATE_SUB_NAME,
                            CASE
                    			WHEN CNT > 0 THEN CATE_TEXT 
                                ELSE 			  '' 
                    		END AS CATE_SUB_TEXT,
                            CASE
                    			WHEN CNT > 0 THEN CATE_REAL_IMAGE_PATH 
                                ELSE 			  '' 
                    		END AS CATE_SUB_IMAGE_PATH
                    	FROM
                        (
                    		SELECT 
                    			COUNT(*) AS CNT,
                    			CATE_SEQ,
                    			CATE_NAME,
                    			CATE_PARENT_SEQ,
                    			CATE_TEXT,
                                CATE_IS_CERT,
                    			CATE_REAL_IMAGE_PATH,
                                CATE_ORIGIN_IMAGE_PATH
                    		FROM CATEGORY
                    		WHERE
                    			:CATE_2_SEQ IS NOT NULL AND CATE_SEQ = :CATE_2_SEQ AND CATE_PARENT_SEQ = :CATE_1_SEQ
                    	) AS B
                    ) AS BB";

        $this->query($query);
        $this->bind("CATE_1_SEQ", $cateSeq);
        $this->bind("CATE_2_SEQ", $cateSubSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result;
    }

    public function getSubCategory4View()
    {
        $query = "SELECT * FROM CATEGORY WHERE CATE_PARENT_SEQ <> '0' ORDER BY CATE_PARENT_SEQ, CATE_SEQ ASC";

        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result;
    }
}
?>