<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200806
 *
 */
try
{
    $cateCtrl   = new CApp_Handler_Category_Ctrl();
    //trigger_error(print_r($_POST, true), E_USER_ERROR);
    $result     = $cateCtrl->getCategoryInfo($_POST["cate_seq"]);
    if (! $result)
    {
        echo ("FALSE");
        exit();
    }
    // trigger_error ( print_r($result, true), E_USER_ERROR );
    $json       = json_encode($result, JSON_UNESCAPED_UNICODE);
    //trigger_error($json, E_USER_ERROR);
    echo ($json);
}
catch (CException $ex)
{
    $ex->printException();
}
exit();
?>