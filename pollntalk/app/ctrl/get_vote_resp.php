<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20201006
 *
 */
try
{
    //print_r($_POST);
    //exit;
    trigger_error(print_r($_POST, true), E_USER_ERROR);
    $respCtrl       = new CApp_Handler_Vote_Respctrl();
    
    if ($_POST["view_type"] == "")
        $result     = $respCtrl->getVoteRespChart($_GET["vote_seq"], $_POST["question_seq"][0]);
    else 
        $result     = $respCtrl->getVoteRespChartByKind($_GET["vote_seq"], $_POST["question_seq"][0], $_POST["view_type"]);
    
        trigger_error(print_r($result, true), E_USER_ERROR);
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