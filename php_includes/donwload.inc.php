<?php
function makeDownload($file, $dir, $type) {
    
    header("Content-Type: $type");

    header("Content-Disposition: attachment; filename=\"$file\"");

    readfile($dir.$file);
    
}

$dir = "../UP_DATA/";
$type = 'txt';

    if(file_exists ($dir.$_POST['file_name']))     {
        makeDownload($_POST['file_name'], $dir, $type);
    }
        


?>
