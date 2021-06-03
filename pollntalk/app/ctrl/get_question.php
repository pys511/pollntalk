<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20201006
 *
 */
try
{
    $voteCtrl   = new CApp_Handler_Vote_Ctrl();
    $result     = $voteCtrl->getQuestionList($_POST["vote_seq"]);
    if (!$result)
    {
        echo ("FALSE");
        exit();
    }
    
    $json       = json_encode($result, JSON_UNESCAPED_UNICODE);
    echo ($json);
}
catch (CException $ex)
{
    $ex->printException();
}
exit();
?>