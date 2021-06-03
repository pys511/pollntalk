<?php
/**
 *  @auth   : JEON JY
 *  @date   : 202001006
 *  image 처리
 *  singleton으로 처리
 */
class CCore_Util_Image_Control
{
    private static  $m_instance = null;
    
    private function __construct()
    {
        
    }
    
    /*
     * instance 반환
     */
    public static function instance ()
    {
        if (is_null(self::$m_instance))
            self::$m_instance = new CCore_Util_Image_Control();
            
        return self::$m_instance;
    }
    
    /*
     *  이미지 크기 조정
     */
    public function resizeImage($width, $height, $filePath, $targetName)
    {
        $arrExt 		= explode ( ".", $filePath);
        list($oldWidth, $oldHeight)	= getimagesize("./".$filePath);
        //$lastTargetName = $_SERVER["DOCUMENT_ROOT"]."/".$targetName;
        //trigger_error ( "--file:".$lastTargetName, E_USER_ERROR );
        //trigger_error ( print_r($_SERVER, true), E_USER_ERROR );
        
        if ($oldWidth > $width || $oldHeight > $height)
        {
            $thumb				= imagecreatetruecolor($width, $height);
            $source				= null;
            switch ($arrExt[1])
            {
                case "jpeg" :
                    trigger_error ( "file : " .$arrExt[1], E_USER_ERROR );
                    //header('Content-type: image/jpeg');
                    $source		= imagecreatefromjpeg("./".$filePath);
                    break;
                    
                case "jpg" :
                    trigger_error ( "file : " .$arrExt[1], E_USER_ERROR );
                    //header('Content-type: image/jpeg');
                    $source		= imagecreatefromjpeg("./".$filePath);
                    break;
                    
                case "gif":
                    //header('Content-type: image/gif');
                    $source		= imagecreatefromgif("./".$filePath);
                    break;
                    
                case "png":
                    //header('Content-type: image/png');
                    $source		= imagecreatefrompng("./".$filePath);
                    break;
                    
                default:
                    break;
            }
            
            if ($source == null)
            {
                trigger_error ( "허용되지 않은 이미지 파일입니다. 파일 이름 : ".$filePath, E_USER_ERROR );
                return -1;
            }
            
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $width, $height, $oldWidth, $oldHeight);
            $isConvert	= true;
            switch ($arrExt[1])
            {
                case "jpg" || "jpeg" :
                    header('Content-type: image/jpeg');
                    imagejpeg($thumb, "./".$targetName);
                    break;
                    
                case "gif":
                    header('Content-type: image/gif');
                    imagegif($thumb, "./".$targetName);
                    break;
                    
                case "png":
                    header('Content-type: image/png');
                    imagepng($thumb, "./".$targetName);
                    break;
                    
                default:
                    $isConvert	= false;
                    break;
            }
            
            imagedestroy($thumb);
            header_remove();
            header('Content-type: text/html; charset=utf-8');
        }
        else
        {
            trigger_error ( "이미지 크기가 너무 작습니다. 파일 이름 : ".$filePath, E_USER_ERROR );
            return -2;
        }
        
        if (!$isConvert)
        {
            trigger_error ( "이미지 크기 조정에 실패하였습니다. 파일 이름 : ".$filePath, E_USER_ERROR );
            return -3;
        }
        
        return 1;
    }
}