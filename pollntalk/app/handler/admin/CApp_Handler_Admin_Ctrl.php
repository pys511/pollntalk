<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200529
 *  관리자 정보 관리
 */
class CApp_Handler_Admin_Ctrl extends CCore_Lib_Routines_Handler
{

    /*
     * 관리자 로그인
     */
    public function loginAdmin($array)
    {
        // 이미 로그인이 되어 있다면
        if ($_SESSION["admin_id"] != "")
            return true;
            
        // 로그인 처리
        session_destroy();
        session_start();
        
        $admin_id = $array["adminid"];
        $admin_pw = $array["adminpw"];
        
        if ($admin_id != "" && $admin_pw != "")
        {
            $query = "";
            $query = "SELECT
        					COUNT(*) AS CNT,
        					ADMIN_SEQ,
        					ADMINID,
        					ADMINNAME,
                            ADMINMAIL,
        					GRADE
        				FROM
        					ptp_admin
        				WHERE
        					ADMINID = :adminid AND
        		        	ADMINPW = PASSWORD(:adminpw)";
            
            $this->query($query);
            $this->bind("adminid", $admin_id);
            $this->bind("adminpw", $admin_pw);
            $member = $this->execute(CCore_Lib_Routines_Handler::SELECT);
            $cnt = (integer) $member[0]["CNT"];
            
            if ($cnt <= 0)
                return false;
                
            $_SESSION["admin_seq"] = $member[0]["ADMIN_SEQ"];
            $_SESSION["admin_id"] = $member[0]["ADMINID"];
            $_SESSION["admin_name"] = $member[0]["ADMINNAME"];
            $_SESSION["admin_mail"] = $member[0]["ADMINMAIL"];
            $_SESSION["grade"] = $member[0]["GRADE"];
        }
        
        return true;
    }

    /*
     * id check
     */
    public function checkID($array)
    {
        $admin_id = $array["admin_id"];
        //trigger_error(print_r($array, true), E_USER_ERROR);
        if ($admin_id == "admin001")
            return false;
        $query = "";
        $query = "SELECT
						COUNT(*) AS CNT
					FROM
						ptp_admin
					WHERE
						USERID = :admin_id";

        $this->query($query);
        $this->bind("admin_id", $admin_id);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $cnt = (integer) $result[0]["CNT"];
        //trigger_error($cnt, E_USER_ERROR);
        if ($cnt <= 0)
            return false;

        return true;
    }



    /*
     * admin 정보
     */
    public function getAdminInfo($admin_seq)
    {
        if ($admin_seq == "")
            return false;

        $result = array();
        $query = "";
        $query = "SELECT
                    CNT,
					ADMIN_SEQ AS admin_seq,
					ADMINID AS admin_id,
					ADMINNAME AS admin_name,
                    PIC AS imagePath,
                    PHONENUMBER AS phonenumber,
                    ADMINMAIL AS admin_mail,
    				left(PHONENUMBER, 3) AS phone_comp,
    				CASE LENGTH(PHONENUMBER)
						WHEN 11 THEN substring(PHONENUMBER, 4, 4)
						WHEN 10 THEN substring(PHONENUMBER, 4, 3)
					END AS phone_first,
    				CASE LENGTH(PHONENUMBER)
						WHEN 11 THEN right(PHONENUMBER, 4)
						WHEN 10 THEN right(PHONENUMBER, 4)
					END AS phone_second,
					GRADE AS grade
				FROM
				(
					SELECT
						COUNT(*) AS CNT,
						ADMIN_SEQ,
						ADMINID,
						ADMINPW,
						ADMINNAME,
                        PIC,
						PHONENUMBER,
                        ADMINMAIL,
						LAST_LOGIN,
						GRADE
					FROM
						ptp_admin
					WHERE
						ADMIN_SEQ = :user_seq
				) A";

        $this->query($query);
        $this->bind("user_seq", (integer) $admin_seq);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        $count = (integer) $result[0]["CNT"];
        if ($count <= 0)
            return false;

        return $result;
    }

    public function getAdminListCount()
    {
        $query = "SELECT
						COUNT(*) AS CNT
					FROM
					    ptp_admin";

        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result[0]["CNT"];
    }

    /*
     * admin list
     */
    public function getAdminList($param, $paging)
    {
        $query = "SELECT
    						ADMIN_SEQ AS admin_seq,
    						ADMINID AS admin_id,
    						ADMINNAME AS admin_name,
    						CASE LENGTH(PHONENUMBER)
    							WHEN 11 THEN CONCAT(left(PHONENUMBER, 3), '-', substring(PHONENUMBER, 4, 4), '-', right(PHONENUMBER, 4))
    							WHEN 10 THEN CONCAT(left(PHONENUMBER, 3), '-', substring(PHONENUMBER, 4, 3), '-', right(PHONENUMBER, 4))
    						END AS phone_number,
                            ADMINMAIL AS admin_mail,
    						DATE_FORMAT(LAST_LOGIN, '%Y-%c-%e %T') AS last_login,
    					    CASE
    							WHEN GRADE = 0 THEN '마스터 관리자'
    							WHEN GRADE = 1 THEN '주 관리자'
    							WHEN GRADE = 2 THEN '서브 관리자'
    				        END AS admin_grade
						FROM
						    ptp_admin
                        ORDER BY ADMIN_SEQ DESC
                        LIMIT :start, :length";

        $this->query($query);
        $start = (((integer) $paging["current"]) - 1) * 15; // 현재 페이지의 시작 항목
        $this->bind("start", $start);
        $this->bind("length", 15);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $result;
    }

    /*
     * admin 정보 등록
     */
    public function registerAdmin($array)
    {
        $adminSeq = $array["admin_seq"];
        $userid = $array["admin_id"];
        $userpw = $array["admin_pw"];
        $username = $array["admin_name"];
        $imageName = $array["real_name"];
        $phonenumber = $array["phonenumber"];
        $admin_mail = $array["admin_mail"];
        $grade = $array["grade"];
        $query = "";
        if ($adminSeq == "")
        {
            $query = "INSERT INTO ptp_admin
    		   			(
    		   				ADMINID,
    						ADMINPW,
    						ADMINNAME,
                            PHONENUMBER,
                            ADMINMAIL,
                            PIC,
                            GRADE,
    						LAST_LOGIN,
    						LOGIN_COUNT
    					)
    					VALUE
    					(
    						:userid,
    						PASSWORD(:userpw),
    						:username,
    						:phonenumber,
                            :admin_mail,
                            :real_name,
    						:grade,
    						NOW(),
    						0
    					)";

            $queryType = CCore_Lib_Routines_Handler::INSERT;
        }
        else
        {
            $query = "UPDATE
    					ptp_admin
    				SET
    					ADMINPW = PASSWORD(:userpw),
    					ADMINNAME = :username,
    					PHONENUMBER = :phonenumber,
                        ADMINMAIL = :admin_mail,
                        PIC = :real_name,
    					GRADE = :grade
    				WHERE
    					ADMIN_SEQ = :admin_seq";

            $queryType = CCore_Lib_Routines_Handler::UPDATE;
        }

        $this->query($query);
        if ($adminSeq != "")
            $this->bind("admin_seq", $adminSeq);
        else
            $this->bind("userid", $userid);
        
        $this->bind("userpw", $userpw);
        $this->bind("username", $username);
        $this->bind("phonenumber", $phonenumber);
        $this->bind("admin_mail", $admin_mail);
        $this->bind("real_name", $imageName); // 이미지
        $this->bind("grade", $grade);

        $result = $this->execute($queryType);
        if (! $result)
            return false;

        if ($adminSeq == "")
        {
            $query = "SELECT
                           ADMIN_SEQ AS admin_seq
                        FROM
                           ptp_admin
                        ORDER BY ADMIN_SEQ DESC
                        LIMIT 1";

            $this->query($query);
            $queryType = CCore_Lib_Routines_Handler::SELECT;
            $result = $this->execute($queryType);
            $adminSeq = $result[0]["admin_seq"];
        }

        return $adminSeq;
    }
}
