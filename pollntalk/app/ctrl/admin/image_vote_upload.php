<?php
/**
 *  @auth   : JEON JY
 *  @date   : 20200605
 *  파일을 업로드를 받아서 처리
 */
try
{
    $question_index = $_POST["question_upload_index"];
    $answer_index   = $_POST["answer_upload_index"];
    if ($question_index == "")
        $question_index = null;
    if ($answer_index == "")
        $answer_index   = null;
    
    $upload = new CApp_Handler_Util_Fileupload();
    $result = $upload->uploadImageFile();
    if (! $result)
        $result = "FALSE";

    $result = json_encode($result, JSON_UNESCAPED_UNICODE);
}
catch (CException $ex)
{
    $ex->printException();
}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
		parent.setVoteFile(<?php echo($result); ?>, '<?php echo($question_index); ?>', '<?php echo($answer_index); ?>');
	</script>
</head>
<body>
</body>
</html>