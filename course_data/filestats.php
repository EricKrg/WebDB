<!DOCTYPE HTML>
<html>
    <head>
        <title>Seitentitel</title>
    </head>
    <body>

        <!--        <form enctype="multipart/form-data" action="filestats.php" method="post">
                    <input type="hidden" name="MAX_FILE_SIZE" value="300000">
                    Send this file: <input name="userfile" type="file">
                    <input type="submit" name="upload" value="Send File">-->
    </form>
    <?php
    if (isset($_POST['submit'])) {

        $uploaddir = "files/";
        $tmpfile = $_FILES['userfile']['tmp_name'];
        $newpath = $uploaddir . $_FILES['userfile']['name'];

        if (move_uploaded_file($tmpfile, $newpath)) {
            echo "File is valid. Here's some debugging info:\n";
            print_r($_FILES);
        } else {
            echo "Possible file upload attack! Here's some debugging info:\n";
            print_r($_FILES);
        }
    }
    $sum = 0;
    $zeilen = file("data_Durchfluss_Camburg-S_527.txt");
    foreach ($zeilen as $zeile_num => $zeile) {
        if ($zeile[0] != "#") {
            $pieces = explode("\t", $zeile);
            $value = $pieces[1];
            $sum = $sum + (float) $value;
        }
    }
    echo $sum;
//            echo "Zeile #<b>{$zeile_num}</b> : $zeile <br>\n";
    ?>
</body>
</html>