<!DOCTYPE HTML>
<html>
    <head>
        <title>Seitentitel</title>
    </head>
    <body>

        <?php
        if (isset($_POST['button'])) {
            $a = $_POST['anzahl'];
            $s = $_POST['string'];
            if ($a <= 0) {
                echo "Anzahl zu klein.";
            } else {
                for ($i = 0; $i < $a; $i++) {  
                    echo $i + 1, ": ", $s, "<br>\n";
                }
            }
        } else {
            
            $a = $_GET['anzahl'];
            $s = $_GET['string'];
            
            echo '<form action="formprint2.php" method="post">
                <!-- hier folgen die Formularelemente -->
                <input name="string" type="text" size="30" maxlength="30" value="'.$s.'">
                <input name="anzahl" type="text" size="4" maxlength="4" value="'.$a.'">
                <input type="submit" name="button" value="Absenden">
            </form>';
            
        }
        ?>
    </body>
</html>
