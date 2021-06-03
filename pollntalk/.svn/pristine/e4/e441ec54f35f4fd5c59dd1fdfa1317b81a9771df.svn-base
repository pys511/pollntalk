<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200605
 *  파일을 업로드를 받아서 처리
 */
try
{
    trigger_error("ddddd", E_USER_ERROR);
    $upload             = new CApp_Handler_Util_Fileupload();
    $pcResult           = $upload->uploadPCAdFile();
    if (! $pcResult)
        $pcResult = "FALSE";
    else
        $pcResult       = json_encode($pcResult, JSON_UNESCAPED_UNICODE);
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<head>
<script type="text/javascript">
	parent.setPCFile(<?php echo($pcResult); ?>);
</script>
</head>
<body>
</body>
</html>