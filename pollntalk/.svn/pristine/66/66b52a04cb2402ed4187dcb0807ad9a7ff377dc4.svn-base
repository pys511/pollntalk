<?php
/**
 *  @auth   : JY JEON
 *  @date   : 20210509
 *  메시지 전송
 */
try
{
    $vote    = new CApp_Handler_Vote_Ctrl();
    $result  = $vote->recommandVote($_POST["vote_seq"]);
    if (!$result)
        echo("FALSE");
    else
        echo("TRUE");
}
catch (CException $ex)
{
    $ex->printException();
}
?>