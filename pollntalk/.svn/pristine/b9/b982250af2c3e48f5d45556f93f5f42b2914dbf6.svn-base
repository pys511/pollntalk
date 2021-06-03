<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20201006
 *  입금 계좌 정보 조회
 */
try
{
    $product    = new CApp_Handler_Product_Ctrl();
    //trigger_error(print_r($_POST, true), E_USER_ERROR);
    $result     = $product->getBankAccount($_POST["bank_account_seq"]);
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