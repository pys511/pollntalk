<?php
/**
 *  @auth   : PARK Y.S.
 *  @date   : 20210423
 *  광고 링크처리
 */
try
{
    $seq        = $_GET["num"];
    $ip = $_SERVER['REMOTE_ADDR'];
    
    $mainCtrl   = new CApp_Handler_Util_AdSetting();
    if($seq != "")
    {
        $result     = $mainCtrl->getAd($seq);
    
        $ad_index         = $result["ad_index"];
        $ad_subject    = $result["ad_subject"];
        $ad_url     = $result["ad_url"];
    }

    $dbctrl = new CApp_Handler_Util_AdLink();
    $result = $dbctrl->insertDB($ip, $ad_subject);
    
    if (! $result)
    {
        header("location: $ad_url");
    }
    else
    {
        header("location: $ad_url");
    }
}
catch (CException $ex)
{
    $ex->printException();
    header("location: $ad_url");
}
?>