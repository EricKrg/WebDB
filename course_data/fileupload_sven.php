<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>File upload example</title>
    </head>
    <body>
        <form enctype="multipart/form-data" action="fileupload.php" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            Send this file: <input name="userfile" type="file">
            <input type="submit" name="submit" value="Send File">
        </form>

        <?php
        if (isset($_POST['submit'])) {

            $uploaddir = "files/";
            $tmpfile = $_FILES['userfile']['tmp_name'];
            $newpath = $uploaddir . $_FILES['userfile']['name'];

            echo "Verschiebe $tmpfile nach $newpath<br>";

            if (move_uploaded_file($tmpfile, $newpath)) {
                print "File is valid. Here's some debugging info:\n";
                print_r($_FILES);
            } else {
                print "Possible file upload attack! Here's some debugging info:\n";
                print_r($_FILES);
            }
        }
        ?>
    </body>
</html>