<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200816
 *  
 */
try
{
    $voteCtrl   = new CApp_Handler_Vote_Ctrl();
    $result     = $voteCtrl->checkParticipateVote($_POST);
    if (! $result)
        echo ("FALSE");
    else
        echo ($result);
}
catch (CException $ex)
{
    $ex->printException();
}
?>