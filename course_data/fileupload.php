<!--MIschung aus fileupload.html/.php-->
<!DOCTYPE HTML>
<html>
    <head>
        <title>Seitentitel</title>
    </head>
    <body>

        <form enctype="multipart/form-data" action="fileupload.php" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="30000">
            Send this file: <input name="userfile" type="file">
            <input type="submit" name="upload" value="Send File">
        </form>
        <?php
        //print_r($_FILES);
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
        ?>
    </body>
</html>