<?php

/**
 *  @auth   : YS PARK
 *  @date   : 202010
 *  관리자 회원관리
 */

class CApp_Handler_Admin_member extends CCore_Lib_Routines_Handler
{
    
    public function __construct()
    {
    }
    
    /*
     *  지역 정보
     */
    public function getMemberAreaInfo($pos)
    {
        $result = "";
        switch ($pos)
        {
            case "01":
                $result = "서울특별시";
                break;
            case "02":
                $result = "부산광역시";
                break;
            case "03":
                $result = "대구광역시";
                break;
            case "04":
                $result = "인천광역시";
                break;
            case "05":
                $result = "광주광역시";
                break;
            case "06":
                $result = "대전광역시";
                break;
            case "07":
                $result = "울산광역시";
                break;
            case "08":
                $result = "세종특별자치시";
                break;
            case "11":
                $result = "경기도";
                break;
            case "12":
                $result = "강원도";
                break;
            case "13":
                $result = "충청북도";
                break;
            case "14":
                $result = "충청남도";
                break;
            case "15":
                $result = "전라북도";
                break;
            case "16":
                $result = "전라남도";
                break;
            case "17":
                $result = "경상북도";
                break;
            case "18":
                $result = "경상남도";
                break;
            case "20":
                $result = "제주특별자치도";
                break;
            default:
                $result = "서울특별시";
                break;
        }
        
        return $result;
    }
    
    /*
     * 회원 리스트
     */
    public function getMemberList($startNum, $listSize)
    {
        $query = "";
        $query = "SELECT * FROM MEMBER order by member_seq limit :startNum, :listSize";
        
        $this->query($query);
        $this->bind("startNum", $startNum);
        $this->bind("listSize", $listSize);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    
    /*
     * 전체 회원수 가져오기
     */
    public function getMembercount()
    {
        $query = "";
        $query = "SELECT count(*) FROM MEMBER";
        
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $count = $result[0]["count(*)"];
        
        return $count;
    }
    
    /*
     * 회원검색
     */

    public function searchMember($kind, $data)
    {
        $query = "";
        if($kind == 1)
        {
            $query = "SELECT * FROM MEMBER where email = :EMAIL";
            $this->query($query);
            $this->bind("EMAIL", $data);
        }
        elseif($kind == 2)
        {
            $data = '%'.$data.'%';
            $query = "SELECT * FROM MEMBER where uname like :UNAME";
            $this->query($query);
            $this->bind("UNAME", $data);
        }
        else 
        {
            $data = '%'.$data.'%';
            $query = "SELECT * FROM MEMBER where nname like :NNAME";
            $this->query($query);
            $this->bind("NNAME", $data);
        }
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    public function searchMemberCount($kind, $data)
    {
        $query = "";
        if($kind == 1)
        {
            $query = "SELECT count(*) FROM MEMBER where email = :EMAIL";
            $this->query($query);
            $this->bind("EMAIL", $data);
        }
        elseif($kind == 2)
        {
            $data = '%'.$data.'%';
            $query = "SELECT count(*) FROM MEMBER where uname like :UNAME";
            $this->query($query);
            $this->bind("UNAME", $data);
        }
        else
        {
            $data = '%'.$data.'%';
            $query = "SELECT count(*) FROM MEMBER where nname like :NNAME";
            $this->query($query);
            $this->bind("NNAME", $data);
        }
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $count = $result[0]["count(*)"];
        
        return $count;
    }
    
    /*
     *  회원 정보 조회
     */   
    public function getMemberInfo($member_seq)
    {
        $query = "SELECT 
                    member_seq,
                    email,
                    password,
                    uname,
                    nname,
                    birthday,
                    gender,
                    abode,
                    grade,
                    agree,
                    pic,
                    regidate
                FROM 
                    MEMBER
                WHERE
                    member_seq = :MEMBER_SEQ";
        $this->query($query);
        $this->bind("MEMBER_SEQ", $member_seq);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0];
    }
    
    /*
     *  관리자 화면에서 회원정보변경
     */
    public function updateMemberByAdmin($array)
    {
        $memberSeq  = $array["member_seq"];
        $password   = $array['password1'];
        $u_name     = $array['uname'];
        $n_name     = $array['nname'];
        $b_birth    = $array['b_birth'];
        $gender     = $array['gender'];
        $abode      = $array['abode'];
        
        $query = "UPDATE MEMBER set
                            uname = :USER_NAME,
                            nname = :NICK_NAME,
                            birthday = :BIRTHDAY,
                            gender = :GENDER,
                            abode = :ABODE,
                            grade = '0',
                            agree = '1'
                           where member_seq = :MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("MEMBER_PWD", $password);
        $this->bind("USER_NAME", $u_name);
        $this->bind("NICK_NAME", $n_name);
        $this->bind("BIRTHDAY", $b_birth);
        $this->bind("GENDER", $gender);
        $this->bind("ABODE", $abode);
        $this->bind("MEMBER_SEQ", $memberSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        if (! $result)
            return - 1;
            
            return 1;
    }
    
    /*
     *  관리자 화면에서 회원 탈퇴 처리
     */
    public function outMemberByAdmin($array)
    {
        $memberSeq  = $array["member_seq"];
        $query      = "INSERT INTO OUT_MEMBER_LIST
                        (
                            MEMBER_SEQ,
                            EMAIL,
                            JOIN_DATE
                        )
                        SELECT member_seq , email, regidate FROM MEMBER WHERE member_seq = :MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $memberSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        
        $query      = "DELETE FROM MEMBER WHERE member_seq = :MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("MEMBER_SEQ", $memberSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::DELETE);
        
        if (! $result)
            return - 1;
            
        return 1;
    }
    
    /*
     * 탈퇴 회원 리스트
     */
    public function getOutMemberList($startNum, $listSize)
    {
        $query = "";
        $query = "SELECT * FROM OUT_MEMBER_LIST order by member_seq limit :startNum, :listSize";
        
        $this->query($query);
        $this->bind("startNum", $startNum);
        $this->bind("listSize", $listSize);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    
    /*
     * 전체 탈퇴 회원수 가져오기
     */
    public function getOutMembercount()
    {
        $query = "";
        $query = "SELECT count(*) FROM OUT_MEMBER_LIST";
        
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $count = $result[0]["count(*)"];
        
        return $count;
    }
    
    /*
     * 탈퇴 회원 검색
     */
    public function searchOutMember($data)
    {
        $query = "SELECT * FROM OUT_MEMBER_LIST where email = :EMAIL";
        $this->query($query);
        $this->bind("EMAIL", $data);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result;
    }
    
    /*
     * 탈퇴 회원 검색 카운트
     */
    public function searchOutMemberCount($data)
    {
        $query = "";
        $query = "SELECT count(*) FROM OUT_MEMBER_LIST where email = :EMAIL";
        $this->query($query);
        $this->bind("EMAIL", $data);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $count = $result[0]["count(*)"];
        
        return $count;
    }
}
?>