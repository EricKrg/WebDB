<?php
include_once '../header_new.php';
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
    } else { ?>
            <div class="w3-container w3-red w3-left">No File selected </div>
                        <?php echo '<form action = "../download.php" method = "POST">' ?>
                    <button class ="w3-button w3-grey " type = "submit" name = "submit">Back</button>
    <?php
    }
    include_once '../footer.php';
    ?>
