<?php
if (isset($_POST['upload'])) {

    $uploaddir = "files/";
    $tmpfile = $_FILES['userfile']['tmp_name'];
    $newpath = $uploaddir . $_FILES['userfile']['name'];

    if (move_uploaded_file($tmpfile, $newpath)) {
        echo "File is valid. Here's some debugging info:\n";
        print_r($_FILES);
    } else {
        echo "Possible file upload attack! Here's some debugging info:\n";
        print_r($_FILES);
        exit();
    }

    $datei = fopen($newpath, "r");

    $summe = 0;
    $count = 0;

    while (!feof($datei)) {
        $zeile = fgets($datei, 1000);
        if ($zeile[0] != "#") {
            $pieces = explode("\t", $zeile);
            $newvalue = (float) $pieces[1];
            $summe = $summe + $newvalue;
            
            $count = $count + 1;
        }
    }

    $mittelwert = ($summe / $count);
    echo "<br>Mittelwert = $mittelwert<br>";
    echo "Summe = $summe<br>";
    echo "Count = $count";

    fclose($datei);
} else {
    ?>
    <!DOCTYPE html>
    <html>
        <head>
            <title>TODO supply a title</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
        <body>
            <form enctype="multipart/form-data" action="filestats_sven.php" method="post">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                Send this file: <input name="userfile" type="file">
                <input type="submit" name="upload" value="Send File">
            </form>
        </body>
    </html>
    <?php
}
?>
