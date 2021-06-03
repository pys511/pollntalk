<?php
/**
 *  @auth   : Park Yoon Sik
 *  @date   : 20201006
 *
 */
try
{
    $cateCtrl   = new CApp_Handler_Category_Ctrl();
    $result     = $cateCtrl->getCategoryInfo($_POST["cate_seq"]);
    if (! $result)
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