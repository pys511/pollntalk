<?php

/**
 *  @auth   : JEON JY
 *  @date   : 20200605
 *  파일 업로드 처리
 */
class CApp_Handler_Util_Fileupload extends CCore_Lib_Routines_Handler
{

    private function getComplateNumber($nNumber)
    {
        if (strlen($nNumber) < 2)
            $nNumber = "0" . $nNumber;

        return $nNumber;
    }

    private function getNameByDate()
    {
        $arrTime = getDate();

        $strResultName = "";
        $strResultName .= $arrTime['year'];
        $strMonth = (string) $arrTime['mon'];
        $strResultName .= $this->getComplateNumber($strMonth);
        $strDay = (string) $arrTime['mday'];
        $strResultName .= $this->getComplateNumber($strDay);
        $strHour = $arrTime['hours'];
        $strResultName .= $this->getComplateNumber($strHour);
        $strMinutes = $arrTime['minutes'];
        $strResultName .= $this->getComplateNumber($strMinutes);
        $strSeconds = $arrTime['seconds'];
        $strResultName .= $this->getComplateNumber($strSeconds);

        return $strResultName;
    }

    public function uploadImageFile()
    {
        $seedNumber = (integer) microtime() * 1234567;
        srand($seedNumber);
        $strRand = rand(0, 1000);
        $fileName = $this->getNameByDate();
        $fileName .= $strRand;
        $curName = $_FILES['uploadName']['name'];

        $arrExt = explode(".", $curName);
        $fileName .= "." . $arrExt[1];

        if (! @is_uploaded_file($_FILES['uploadName']['tmp_name']))
        {
            trigger_error("임시파일에 업로드한 파일이 존재하지 않습니다. file : " . print_r($_FILES, true), E_USER_ERROR);
            return false;
        }

        // 파일을 임시경로에 이동시킨다.
        $targetFileName = "app/file/" . $fileName;
        $realFileName   = "app/file/" . "real_".$fileName;
        if (! @move_uploaded_file($_FILES['uploadName']['tmp_name'], "./" . $targetFileName))
        {
            trigger_error("임시파일에서 파일 복사가 실패되었습니다.", E_USER_ERROR);
            return false;
        }
        
        //$tempTargetName = $_FILES['uploadName']['tmp_name'], "./" 
        $imgResult      = CCore_Util_Image_Control::instance()->resizeImage(350, 350, $targetFileName, $realFileName);
        if ($imgResult == -2)
            $realFileName   = $targetFileName;

        $result = array(
            "temp_path" => $targetFileName,
            "real_name" => $realFileName
        );

        return $result;
    }
    
    public function uploadEventImage()
    {
        $seedNumber = (integer) microtime() * 1234567;
        srand($seedNumber);
        $strRand = rand(0, 1000);
        $fileName = $this->getNameByDate();
        $fileName .= $strRand;
        $curName = $_FILES['eventImageFile']['name'];
        
        $arrExt = explode(".", $curName);
        $fileName .= "." . $arrExt[1];
        
        if (! @is_uploaded_file($_FILES['eventImageFile']['tmp_name']))
        {
            trigger_error("임시파일에 업로드한 파일이 존재하지 않습니다. file : " . print_r($_FILES, true), E_USER_ERROR);
            return false;
        }
        
        // 파일을 임시경로에 이동시킨다.
        $targetFileName = "app/file/" . $fileName;
        $realFileName   = "app/file/" . "real_".$fileName;
        if (! @move_uploaded_file($_FILES['eventImageFile']['tmp_name'], "./" . $targetFileName))
        {
            trigger_error("임시파일에서 파일 복사가 실패되었습니다.", E_USER_ERROR);
            return false;
        }
        
        //$tempTargetName = $_FILES['uploadName']['tmp_name'], "./"
        $imgResult      = CCore_Util_Image_Control::instance()->resizeImage(350, 350, $targetFileName, $realFileName);
        if ($imgResult == -2)
            $realFileName   = $targetFileName;
            
        $result = array(
            "temp_path" => $targetFileName,
            "real_name" => $realFileName
        );
        
        return $result;
    }
    
    public function uploadBannerImage()
    {
        $seedNumber = (integer) microtime() * 1234567;
        srand($seedNumber);
        $strRand = rand(0, 1000);
        $fileName = $this->getNameByDate();
        $fileName .= $strRand;
        $curName = $_FILES['bannerImageFile']['name'];
        
        $arrExt = explode(".", $curName);
        $fileName .= "." . $arrExt[1];
        
        if (! @is_uploaded_file($_FILES['bannerImageFile']['tmp_name']))
        {
            trigger_error("임시파일에 업로드한 파일이 존재하지 않습니다. file : " . print_r($_FILES, true), E_USER_ERROR);
            return false;
        }
        
        // 파일을 임시경로에 이동시킨다.
        $targetFileName = "app/file/" . $fileName;
        $realFileName   = "app/file/" . "real_".$fileName;
        if (! @move_uploaded_file($_FILES['bannerImageFile']['tmp_name'], "./" . $targetFileName))
        {
            trigger_error("임시파일에서 파일 복사가 실패되었습니다.", E_USER_ERROR);
            return false;
        }
        
        //$tempTargetName = $_FILES['uploadName']['tmp_name'], "./"
        $imgResult      = CCore_Util_Image_Control::instance()->resizeImage(350, 350, $targetFileName, $realFileName);
        if ($imgResult == -2)
            $realFileName   = $targetFileName;
            
        $result = array(
            "temp_path" => $targetFileName,
            "real_name" => $realFileName
        );
        
        return $result;
    }
    
    public function uploadFile()
    {
        $seedNumber = (integer) microtime() * 1234567;
        srand($seedNumber);
        $strRand = rand(0, 1000);
        $fileName = $this->getNameByDate();
        $fileName .= $strRand;
        $curName = $_FILES['docFile']['name'];
        
        $arrExt = explode(".", $curName);
        $fileName .= "." . $arrExt[1];
        
        if (! @is_uploaded_file($_FILES['docFile']['tmp_name']))
        {
            trigger_error("임시파일에 업로드한 파일이 존재하지 않습니다. file : " . print_r($_FILES, true), E_USER_ERROR);
            return false;
        }
        
        // 파일을 임시경로에 이동시킨다.
        $targetFileName = "app/file/" . $fileName;
        $realFileName   = "app/file/" . "real_".$fileName;
        if (! @move_uploaded_file($_FILES['docFile']['tmp_name'], "./" . $targetFileName))
        {
            trigger_error("임시파일에서 파일 복사가 실패되었습니다.", E_USER_ERROR);
            return false;
        }
            
        $result = array(
            "file_name" => $curName,
            "real_name" => $realFileName
        );
        
        return $result;
    }

    public function uploadVoteFile()
    {
        $seedNumber = (integer) microtime() * 1234567;
        srand($seedNumber);
        $strRand = rand(0, 1000);
        $fileName = $this->getNameByDate();
        $fileName .= $strRand;
        $curName = $_FILES['uploadName']['name'];

        $arrExt = explode(".", $curName);
        $fileName .= "." . $arrExt[1];

        if (! @is_uploaded_file($_FILES['uploadName']['tmp_name']))
        {
            trigger_error("임시파일에 업로드한 파일이 존재하지 않습니다. file : " . print_r($_FILES, true), E_USER_ERROR);
            return false;
        }

        // 파일을 임시경로에 이동시킨다.
        $targetFileName = "app/file/" . $fileName;
        if (! @move_uploaded_file($_FILES['uploadName']['tmp_name'], "./" . $targetFileName))
        {
            trigger_error("임시파일에서 파일 복사가 실패되었습니다.", E_USER_ERROR);
            return false;
        }

        $result = array(
            "temp_path" => $_SERVER['SCRIPT_URI'] . $targetFileName,
            "real_name" => $targetFileName
        );

        return $result;
    }

    // 유저사진 업로드
    public function uploadPicFile()
    {
        $fileName = "pic_" . $_SESSION["member_seq"];
        $curName = $_FILES['myPic']['name'];

        $arrExt = explode(".", $curName);
        $fileName .= "." . $arrExt[1];

        if (! @is_uploaded_file($_FILES['myPic']['tmp_name']))
        {
            trigger_error("임시파일에 업로드한 파일이 존재하지 않습니다. file : " . print_r($_FILES, true), E_USER_ERROR);
            return false;
        }

        // 파일을 임시경로에 이동시킨다.
        $targetFileName = "pic/" . $fileName;
        if (! @move_uploaded_file($_FILES['myPic']['tmp_name'], "./" . $targetFileName))
        {
            trigger_error("임시파일에서 파일 복사가 실패되었습니다.", E_USER_ERROR);
            return false;
        }

        $result = array(
            "temp_path" => $_SERVER['SCRIPT_URI'] . $targetFileName,
            "real_name" => $targetFileName
        );

        $query = "UPDATE MEMBER set pic = :FILE where member_seq = :MEMBER_SEQ";
        $this->query($query);
        $this->bind("FILE", $targetFileName);
        $this->bind("MEMBER_SEQ", $_SESSION["member_seq"]);
        $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);

        return $result;
    }
    
    // 게시판 이미지 업로드
    public function uploadBoardImage()
    {
        $seedNumber = (integer) microtime() * 1234567;
        srand($seedNumber);
        $strRand = rand(0, 1000);
        $fileName = $this->getNameByDate();
        $fileName .= $strRand;
        $curName = $_FILES['uploadImage']['name'];
        
        $arrExt = explode(".", $curName);
        $fileName .= "." . $arrExt[1];
        
        if (! @is_uploaded_file($_FILES['uploadImage']['tmp_name']))
        {
            trigger_error("임시파일에 업로드한 파일이 존재하지 않습니다. file : " . print_r($_FILES, true), E_USER_ERROR);
            return false;
        }
        
        // 파일을 임시경로에 이동시킨다.
        $targetFileName = "app/file/" . $fileName;
        if (! @move_uploaded_file($_FILES['uploadImage']['tmp_name'], "./" . $targetFileName))
        {
            trigger_error("임시파일에서 파일 복사가 실패되었습니다.", E_USER_ERROR);
            return false;
        }
        
        $result = array(
            "temp_path" => $_SERVER['SCRIPT_URI'] . $targetFileName,
            "real_name" => $targetFileName
        );
        
        return $result;
    }
    
    // 게시판 파일 업로드
    public function uploadBoardFile()
    {
        $seedNumber = (integer) microtime() * 1234567;
        srand($seedNumber);
        $strRand = rand(0, 1000);
        $fileName = $this->getNameByDate();
        $fileName .= $strRand;
        $curName = $_FILES['uploadFile']['name'];
        
        $arrExt = explode(".", $curName);
        $fileName .= "." . $arrExt[1];
        
        if (! @is_uploaded_file($_FILES['uploadFile']['tmp_name']))
        {
            trigger_error("임시파일에 업로드한 파일이 존재하지 않습니다. file : " . print_r($_FILES, true), E_USER_ERROR);
            return false;
        }
        
        // 파일을 임시경로에 이동시킨다.
        $targetFileName = "app/file/" . $fileName;
        if (! @move_uploaded_file($_FILES['uploadFile']['tmp_name'], "./" . $targetFileName))
        {
            trigger_error("임시파일에서 파일 복사가 실패되었습니다.", E_USER_ERROR);
            return false;
        }
        
        $result = array(
            "temp_path" => $_SERVER['SCRIPT_URI'] . $targetFileName,
            "real_name" => $curName
        );
        
        return $result;
    }
    
    //게시판 파일 삭제
    public function deleteBoardFile($array)
    {
        
    }
    
    //main이미지
    public function setMainPic()
    {

        $fileName = "main_image" ;
        $curName = $_FILES['mainImg']['name'];
        
        $arrExt = explode(".", $curName);
        $fileName .= "." . $arrExt[1];
        
        if (! @is_uploaded_file($_FILES['mainImg']['tmp_name']))
        {
            echo ("<script>alert(1)</script>");
            trigger_error("임시파일에 업로드한 파일이 존재하지 않습니다. file : " . print_r($_FILES, true), E_USER_ERROR);
            return false;
        }
        
        // 파일을 임시경로에 이동시킨다.
        $targetFileName = "app/file/" . $fileName;
        if (! @move_uploaded_file($_FILES['mainImg']['tmp_name'], "./" . $targetFileName))
        {
            trigger_error("임시파일에서 파일 복사가 실패되었습니다.", E_USER_ERROR);
            return false;
        }
        
        $result = array(
            "temp_path" => $_SERVER['SCRIPT_URI'] . $targetFileName,
            "real_name" => $targetFileName
        );
        
        $query  = "SELECT COUNT(*) AS CNT FROM PTP_MAIN WHERE main_seq = 1";
        
        $this->query($query);
        $result = $this->execute(CCore_Lib_Routines_Handler::SELECT);
        
        if (intval($result[0]["CNT"]) > 0)
        {
            $query  = "UPDATE PTP_MAIN set
                       m_img = :M_IMG
                       WHERE main_seq = 1";
            $this->query($query);
            $this->bind("M_IMG", $targetFileName);
            $result = $this->execute(CCore_Lib_Routines_Handler::UPDATE);
        }
        else
        {
            $query  = "INSERT INTO PTP_MAIN
                    (
                      m_img
                    )
                    VALUES
                    (
                      :M_IMG
                    )";
            $this->query($query);
            $this->bind("M_IMG", $targetFileName);
            $result = $this->execute(CCore_Lib_Routines_Handler::INSERT);
        }
        
        if (! $result)
            return false;
            
            return true;
    }
    
    // 이메일 이미지 업로드
    public function uploadMailImage()
    {
        $seedNumber = (integer) microtime() * 1234567;
        srand($seedNumber);
        $strRand = rand(0, 1000);
        $fileName = $this->getNameByDate();
        $fileName .= $strRand;
        $curName = $_FILES['uploadImage']['name'];
        
        $arrExt = explode(".", $curName);
        $fileName .= "." . $arrExt[1];
        
        if (! @is_uploaded_file($_FILES['uploadImage']['tmp_name']))
        {
            trigger_error("임시파일에 업로드한 파일이 존재하지 않습니다. file : " . print_r($_FILES, true), E_USER_ERROR);
            return false;
        }
        
        // 파일을 임시경로에 이동시킨다.
        $targetFileName = "app/file/mail/img/" . $fileName;
        if (! @move_uploaded_file($_FILES['uploadImage']['tmp_name'], "./" . $targetFileName))
        {
            trigger_error("임시파일에서 파일 복사가 실패되었습니다.", E_USER_ERROR);
            return false;
        }
        
        $result = array(
            "temp_path" => $_SERVER['SCRIPT_URI'] . $targetFileName,
            "real_name" => $targetFileName
        );
        
        return $result;
    }
    
    // 이메일 파일 업로드
    public function uploadMailFile()
    {
        $seedNumber = (integer) microtime() * 1234567;
        srand($seedNumber);
        $strRand = rand(0, 1000);
        $fileName = $this->getNameByDate();
        $fileName .= $strRand;
        $curName = $_FILES['uploadFile']['name'];
        
        $arrExt = explode(".", $curName);
        $fileName .= "." . $arrExt[1];
        
        if (! @is_uploaded_file($_FILES['uploadFile']['tmp_name']))
        {
            trigger_error("임시파일에 업로드한 파일이 존재하지 않습니다. file : " . print_r($_FILES, true), E_USER_ERROR);
            return false;
        }
        
        // 파일을 임시경로에 이동시킨다.
        $targetFileName = "app/file/mail/att/" . $curName;
        if (! @move_uploaded_file($_FILES['uploadFile']['tmp_name'], "./" . $targetFileName))
        {
            trigger_error("임시파일에서 파일 복사가 실패되었습니다.", E_USER_ERROR);
            return false;
        }
        
        $result = array(
            "temp_path" => $_SERVER['SCRIPT_URI'] . $targetFileName,
            "real_name" => $curName
        );
        
        return $result;
    }
    
    //PC 광고 파일 업로그
    public function uploadPCAdFile()
    {
        $seedNumber = (integer) microtime() * 1234567;
        srand($seedNumber);
        $strRand = rand(0, 1000);
        $fileName = $this->getNameByDate();
        $fileName .= $strRand;
        $curName = $_FILES['pc_image']['name'];
        
        $arrExt = explode(".", $curName);
        $fileName .= "." . $arrExt[1];
        
        if (! @is_uploaded_file($_FILES['pc_image']['tmp_name']))
        {
            trigger_error("임시파일에 업로드한 파일이 존재하지 않습니다. file : " . print_r($_FILES, true), E_USER_ERROR);
            return false;
        }
        
        // 파일을 임시경로에 이동시킨다.
        $targetFileName = "app/file/" . $fileName;
        $realFileName   = "app/file/" . "real_".$fileName;
        if (! @move_uploaded_file($_FILES['pc_image']['tmp_name'], "./" . $targetFileName))
        {
            trigger_error("임시파일에서 파일 복사가 실패되었습니다.", E_USER_ERROR);
            return false;
        }
        
        $result = array(
            "temp_path" => $targetFileName,
            "real_name" => $realFileName
        );
        
        return $result;
    }
    
    //PC 광고 파일 업로그
    public function uploadMobileAdFile()
    {
        $seedNumber = (integer) microtime() * 1234567;
        srand($seedNumber);
        $strRand = rand(0, 1000);
        $fileName = $this->getNameByDate();
        $fileName .= $strRand;
        $curName = $_FILES['mobile_image']['name'];
        
        $arrExt = explode(".", $curName);
        $fileName .= "." . $arrExt[1];
        
        if (! @is_uploaded_file($_FILES['mobile_image']['tmp_name']))
        {
            trigger_error("임시파일에 업로드한 파일이 존재하지 않습니다. file : " . print_r($_FILES, true), E_USER_ERROR);
            return false;
        }
        
        // 파일을 임시경로에 이동시킨다.
        $targetFileName = "app/file/" . $fileName;
        $realFileName   = "app/file/" . "real_".$fileName;
        if (! @move_uploaded_file($_FILES['mobile_image']['tmp_name'], "./" . $targetFileName))
        {
            trigger_error("임시파일에서 파일 복사가 실패되었습니다.", E_USER_ERROR);
            return false;
        }
        
        //$tempTargetName = $_FILES['uploadName']['tmp_name'], "./"
        $result = array(
            "mtemp_path" => $targetFileName,
            "mreal_name" => $realFileName
        );
        
        return $result;
    }
}
