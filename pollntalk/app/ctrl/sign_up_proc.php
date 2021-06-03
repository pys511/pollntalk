<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200806
 *  
 */
try
{
    $memberCtrl = new CApp_Handler_Member_Ctrl();
    $result = $memberCtrl->signupMember($_POST);
    if (! $result)
        echo ("FALSE");
    else
        echo ("TRUE");
}
catch (CException $ex)
{
    $ex->printException();
}
?>