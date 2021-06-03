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
    $result     = $vote->getVoteIsOpen($_POST["secure_vote_seq"]);
    if (! $result)
    {
        echo ("FALSE");
        exit();
    }
    // trigger_error ( print_r($result, true), E_USER_ERROR );
    echo ($result);
}
catch (CException $ex)
{
    $ex->printException();
}
exit();
?>