<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20200806
 *
 */
try
{
    if ($_POST["cate_seq"] == "")
    {
        echo ("FALSE");
        exit();
    }

    $cateCtrl = new CApp_Handler_Category_Ctrl();
    // trigger_error ( print_r($_POST, true), E_USER_ERROR );
    $result = $cateCtrl->getCategorySubList($_POST["cate_seq"]);
    if (! $result)
    {
        echo ("FALSE");
        exit();
    }

    $json = json_encode($result, JSON_UNESCAPED_UNICODE);
    echo ($json);
}
catch (CException $ex)
{
    $ex->printException();
}
?>