<?php

if (! file_exists("/work/project/pollntalk/app/images/mark_01.png"))
    return false;
    
$file = @fopen("/work/project/pollntalk/app/images/mark_01.png", 'r');
if (! $file)
    return false;
    
$result = "";
//$result = @fread($file, filesize("/work/project/pollntalk/app/images/mark_01.png"));


$imageData = base64_encode(file_get_contents("/work/project/pollntalk/app/images/mark_01.png"));

// Format the image SRC:  data:{mime};base64,{data};
$src = 'data: '.mime_content_type("/work/project/pollntalk/app/images/mark_01.png").';base64,'.$imageData;

//@fclose($file);
echo($src);
?>

<img src="<?php echo($src); ?>" />