<?php
/**
 * @auth   	: PARK YS
 * @date	: 20210404
 * 검색어 삭제
 */

try
{
    $product    = new CApp_Handler_Search_Ctrl();
    $result     = $product->deletekeyword($_POST);
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