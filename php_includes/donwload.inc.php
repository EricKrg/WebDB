<?php
//donwload function
function makeDownload($file, $dir, $type) {
    
    header("Content-Type: $type");

    header("Content-Disposition: attachment; filename=\"$file\"");

    readfile($dir.$file);
    
}

$dir = "../UP_DATA/";
$type = 'txt';

    if(file_exists ($dir.$_POST['file_name']))     { //checks if file is present - actually obsolet but nice to have
        makeDownload($_POST['file_name'], $dir, $type);
    }
        


?>
