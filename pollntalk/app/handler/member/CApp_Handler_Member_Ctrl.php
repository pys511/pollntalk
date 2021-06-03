<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 202001008
 *  회원 정보 관리
 */
class CApp_Handler_Member_Ctrl extends CCore_Lib_Routines_Handler
{
    public function __construct()
    {
    }

    /*
     * 회원가입
     */
    public function signupMember($array)
    {
        $email      = $array['email'];
        $password   = $array['password1'];
        $u_name     = $array['u_name'];
        $n_name     = $array['n_name'];
        $b_birth    = $array['b_birth'];
        $gender     = $array['gender'];
        $abode      = $array['abode'];
        
        $check      = "SELECT COUNT(*) AS CNT FROM MEMBER WHERE email = :MEMBER_EMAIL";
        $this->query($check);
        $this->bind("MEMBER_EMAIL", $email);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        if (((integer) $result[0]["CNT"]) > 0)
            return 0;
        else
        {
            $query = "INSERT INTO MEMBER 
                       (
                            email,password,uname,nname,birthday,phon_number,gender,abode,grade,agree,cert,pic
                       ) 
                       VALUES
                       (
                            :MEMBER_EMAIL,PASSWORD(:MEMBER_PWD),:USER_NAME,:NICK_NAME,:BIRTHDAY,' ',:GENDER,:ABODE,'0','1','0','pic/default.png'
                       )";

            $this->query($query);
            $this->bind("MEMBER_EMAIL", $email);
            $this->bind("MEMBER_PWD", $password);
            $this->bind("USER_NAME", $u_name);
            $this->bind("NICK_NAME", $n_name);
            $this->bind("BIRTHDAY", $b_birth);
            $this->bind("GENDER", $gender);
            $this->bind("ABODE", $abode);
            $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
            
            if (! $result)
                return - 1;

            return 1;
        }
    }

    /*
     * 회원가입
     */
    public function checkEmail($array)
    {
        $email = $array['email'];
        $check = "SELECT COUNT(*) AS CNT FROM MEMBER WHERE email = :MEMBER_EMAIL";
        $this->query($check);
        $this->bind("MEMBER_EMAIL", $email);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $cnt = (integer) $result[0]["CNT"];
        if ($cnt > 0)
            return false;

        return true;
    }
    
    /*
     * 회원가입
     */
    public function checkN_name($array)
    {
        $n_name = $array['n_name'];
        $check = "SELECT COUNT(*) AS CNT FROM MEMBER WHERE nname = :MEMBER_N_NAME";
        $this->query($check);
        $this->bind("MEMBER_N_NAME", $n_name);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $cnt = (integer) $result[0]["CNT"];
        if ($cnt > 0)
            return false;
            
        return true;
    }

    /*
     * 로그인
     */
    public function loginMember($array)
    {
        $email      = $array['email'];
        $password   = $array['password'];
        $query      = "SELECT COUNT(*) AS CNT, member_seq, cert, birthday FROM MEMBER WHERE email = :MEMBER_EMAIL AND password= PASSWORD(:MEMBER_PWD)";

        $this->query($query);
        $this->bind("MEMBER_EMAIL", $email);
        $this->bind("MEMBER_PWD", $password);
        $member = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $cnt = (integer) $member[0]["CNT"];
        if ($cnt <= 0)
            return false;

            
        $bDayY = substr($member[0]["birthday"], 0, 4);
        $_SESSION['email'] = $email;
        $_SESSION['member_seq'] = $member[0]["member_seq"];
        $_SESSION['cert'] = $member[0]["cert"];
        $_SESSION['adult'] = $this->check_age($bDayY, 18);
                
        return true;
    }

    /*
     * 회원정보 조회
     */
    public function recvMemberInfo($array)
    {
        $memberSeq = $array['member_seq'];
        $query = "SELECT * FROM MEMBER WHERE member_seq = :MEMBER_SEQ";

        $this->query($query);
        $this->bind("MEMBER_SEQ", $memberSeq);
        $member = $this->execute(CCore_Lib_Routines_Handler::SELECT);

        return $member;
    }

    /*
     * 회원정보변경
     */
    public function updateMember($array)
    {
        $memberSeq = $_SESSION["member_seq"];
        $password = $array['password1'];
        $u_name = $array['u_name'];
        $n_name = $array['n_name'];
        $b_birth = $array['b_birth'];
        $gender = $array['gender'];
        $abode = $array['abode'];

        $query = "UPDATE MEMBER set
                            password = PASSWORD(:MEMBER_PWD),
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
     *  회원수
     */
    public function getMemberCount()
    {
        $query  = "SELECT COUNT(*) AS CNT FROM MEMBER";
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        return $result[0]["CNT"];
    }
    
    /*
     * 휴대전화인증
     */
    public function certMember($array)
    {
        $memberSeq = $_SESSION["member_seq"];
        $u_name = $array['user_name'];
        $b_birth = $array['birth_day'];
        $phon_number =$array['phone_no'];
        $sex = $array['sex_code'];
        if($sex == '01'){
            $gender = 'm';
        }else{
            $gender = 'f';
        }
        
        $query = "UPDATE MEMBER set
                            uname = :USER_NAME,
                            birthday = :BIRTHDAY,
                            phon_number = :PHON_NUMBER,
                            gender = :GENDER,
                            cert = '1'
                           where member_seq = :MEMBER_SEQ";
        
        $this->query($query);
        $this->bind("USER_NAME", $u_name);
        $this->bind("BIRTHDAY", $b_birth);
        $this->bind("PHON_NUMBER", $phon_number);
        $this->bind("GENDER", $gender);
        $this->bind("MEMBER_SEQ", $memberSeq);
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        if (! $result)
            return - 1;
            
            return 1;
    }
    
    //성인여부확인
    public function check_age($year, $check_age) {
        
        $age = date("Y") - $year;
        if($age > $check_age){
            $check = 1;
        } else {
            $check = 0;
        }
        return $check;
   
    }
    
    //인증번호 부여
    public function setAuthNum($array){
        
        $email      = $array['email'];
        $randomNum = mt_rand(100000, 999999);
        
        $query = "UPDATE MEMBER set
                            authNum = :AUTHNUM
                           where email = :EMAIL";
        
        $this->query($query);
        $this->bind("AUTHNUM", $randomNum);
        $this->bind("EMAIL", $email);
        
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        if (! $result)
            return - 1;
            
            return $randomNum;
        
    }
    
    // 비밀번호 변경
    
    public function changePassword($array){
        
        $email      = $array['email'];
        $authNum      = $array['authNum'];
        $password      = $array['password1'];
        
        $query = "SELECT COUNT(*) AS CNT FROM MEMBER WHERE email = :EMAIL AND authNum= :AUTHNUM";
        
        $this->query($query);
        $this->bind("EMAIL", $email);
        $this->bind("AUTHNUM", $authNum);
        $member = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        $cnt = (integer) $member[0]["CNT"];
        if ($cnt <= 0)
            return - 2;
        
        $query = "UPDATE MEMBER set
                           password = PASSWORD(:MEMBER_PWD),
                           authNum = ''
                           where email = :EMAIL";
        
        $this->query($query);
        $this->bind("EMAIL", $email);
        $this->bind("MEMBER_PWD", $password);
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        
        if (! $result)
            return - 1;
            
            return 1;
        
    }
    
    
    
}
?> 