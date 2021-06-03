<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200605
 *  파일을 업로드를 받아서 처리
 */
try
{
    $upload = new CApp_Handler_Util_Fileupload();
    $result = $upload->uploadFile();
    if (! $result)
        $result = "FALSE";
        
    $result = json_encode($result, JSON_UNESCAPED_UNICODE);
    //echo($result);
    //trigger_error ( $result, E_USER_ERROR );
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
	parent.setFile(<?php echo($result); ?>);
</script>
</head>
<body>
</body>
</html>