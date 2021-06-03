<?php
/*
 *  파일 다운로드
 */
$num            = $_GET["file_seq"];

try
{
    $board  = new CApp_Handler_Board_Ctrl();
    $result = $board->getBoardFile($num);
    
    $path   = $result["FILE_PATH"];
    $file   = $result["FILE_NAME"];
    
    $path   = $_SERVER["DOCUMENT_ROOT"]."/".$path;
     
    if (file_exists($path))
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$file.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }
}
catch (CException $ex)
{
    $ex->printException();
}
?>