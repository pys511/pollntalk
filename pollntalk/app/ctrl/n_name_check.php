<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200806
 *  이메일 체크
 */
try
{
    $memberCtrl = new CApp_Handler_Member_Ctrl();
    $result = $memberCtrl->checkN_name($_POST);
    
    if (! $result)
        echo (FALSE);
    else
        echo (TRUE);
}
catch (CException $ex)
{
    $ex->printException();
}
?>