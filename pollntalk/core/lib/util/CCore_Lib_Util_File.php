<?php

/**
 *  @auth : JEON JY
 *  @date : 20180403
 *  파일을 읽고 쓰는 기능을 상속받도록 하는 추상 클래스
 */
abstract class CCore_Lib_Util_File
{

    private $m_path = "";

    private $m_result = "";

    public function __construct ()
    {}

    /*
     * 초기화 하여 경로를 받는다.
     */
    public function init ($path)
    {
        $this->m_path = $path;
    }

    /*
     * 파일 정보를 읽는다.
     */
    public function readFile ()
    {
        if ($this->m_path == "")
            return false;

        if (! file_exists($this->m_path))
            return false;

        $file = @fopen($this->m_path, 'r');
        if (! $file)
            return false;

        $this->m_result = "";
        $this->m_result = @fread($file, filesize($this->m_path));
        @fclose($file);

        return true;
    }

    /*
     * 파일을 작성한다.
     */
    public function writeFile ($message)
    {
        $file = null;
        if (false == file_exists($this->m_path))
            $file = fopen($this->m_path, 'w+');
        else
            $file = fopen($this->m_path, 'r+');
        @fseek($file, 0, SEEK_END);
        @fwrite($file, $message);
        @fclose($file);

        return true;
    }

    public function getResult ()
    {
        return $this->m_result;
    }
}