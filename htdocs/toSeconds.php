<!NOCH UNVOLLSTÄNDIG!!!-->

<!DOCTYPE HTML>
<html>
    <head>
        <title>Seitentitel</title>
    </head>
    <body>

        <?php
        function toSeconds($tage, $stunden, $minuten) {
        $sekunden = 3600 * 24 * $tage + 3600 * $stunden + 60 * $minuten;
        return $sekunden;
        }
        

        if (isset($_POST['button'])) 
        $tage = $_POST['Tage'];
        $stunden = $_POST['Stunden'];
        $minuten = $_POST['Minuten'];
        if ($a <= 0) {
        echo "Anzahl zu klein.";
        } else {
        output($tage, $stunden, $minuten);
        }
        } else {
        $tage = $_POST['Tage'];
        $stunden = $_POST['Stunden'];
        $minuten = $_POST['Minuten'];


        echo '<form action="formprint3.php" method="post">
                <!-- hier folgen die Formularelemente -->
                <input name="string" type="text" size="30" maxlength="30" value="' . $s . '">
                <input name="anzahl" type="text" size="4" maxlength="4" value="' . $a . '">
                <input type="submit" name="button" value="Absenden">
            </form>';
        }
        ?>
    </body>
</html>
