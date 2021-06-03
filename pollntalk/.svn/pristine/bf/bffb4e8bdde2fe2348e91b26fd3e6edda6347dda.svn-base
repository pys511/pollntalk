<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20210211
 *
 */
try
{
    $vote       = new CApp_Handler_Vote_Ctrl();
    trigger_error(print_r($_POST, true), E_USER_ERROR);
    $result     = $vote->getSecurityCode($_POST["secure_vote_seq"]);
    if (!$result)
    {
        echo ("FALSE");
        exit();
    }
    
    if (!$result != $_POST["securecode"])
    {
        echo ("FALSE");
        exit();
    }
    
    echo("TRUE");
    exit();
}
catch (CException $ex)
{
    $ex->printException();
}
exit();
?>