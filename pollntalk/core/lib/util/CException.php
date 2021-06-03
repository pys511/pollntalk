<?php

/**
 * 	@auth : JEON JY
 * 	@date : 20200529
 * 	exception 결과
 */
class ExceptionType
{

    const SUCCESS = 1;

    const FAILED = 0;

    const ERROR = - 1;

    const FATAL = - 2;

    const NOTICE = - 3;

    const EXIST = - 4;

    private $m_value;

    final public function __construct ($value)
    {
        $this->m_value = $value;
    }

    final public function __toString ()
    {
        return $this->m_value;
    }
}

/**
 *
 * @auth : JEON JY
 * @date : 20200529
 * exception 정의
 */
class CException extends Exception
{

    private $m_message = "";

    private $m_result = null;

    private $m_parent = null;

    public function __construct ($parent, $type, $message)
    {
        $this->m_parent = $parent;
        $this->m_result = $type;
        $this->m_message = $message;
    }

    public function executeException ()
    {
        trigger_error("###############################START###############################", E_USER_ERROR);
        $this->printException();
        trigger_error("#################################END###############################", E_USER_ERROR);
    }

    public function printException ()
    {
        $arrFile = explode("/", $this->getFile());
        $arrFile = explode(".", $arrFile[count($arrFile) - 1]);
        if ($this->m_parent != null) 
        {
            if (strcmp(get_class($this->m_parent), get_class($this)) === 0)
                $this->m_parent->printException();
            else
                trigger_error("[" . $_SESSION[CONST_MAP::CONNUMBER] . "][" .$arrFile[0] . "][" . $this->m_result . "]" .$this->m_parent, E_USER_ERROR);
        }

        if (! array_key_exists(CONST_MAP::CONNUMBER, $_SESSION))
            $_SESSION[CONST_MAP::CONNUMBER] = $_SERVER['REQUEST_TIME'];

        $errMessage = "[" . $_SESSION[CONST_MAP::CONNUMBER] . "][" . $arrFile[0] ."][" . $this->m_result . "]" . $this->m_message;
        trigger_error($errMessage, E_USER_ERROR);

        return;
    }
}
?>