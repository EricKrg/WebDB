<!NOCH UNVOLLSTÄNDIG!!!-->

<!DOCTYPE HTML>
<html>
    <head>
        <title>Seitentitel</title>
    </head>
    <body>

        <?php
        $hash = password_hash("meingeheimespasswort", PASSWORD_DEFAULT);
        <form action = "pwcheck.php" method = "post">
        Passwort: <input type = "text" name = "pw" value = "Hier das Passwort"><br>
        <input type = "submit" name = "submit" value = "Abschicken!">
        </form >
                
//        if (isset($_COOKIE['zaehler'])) {
//            $z = $_COOKIE['zaehler'];
//        } else {
//            $z = 0;
//        }
////        $_COOKIE['zaehler'] = $z + 1;
//        $z++;
//        setcookie("zaehler", $z, time() + 3600, "/", "", 0);

                $pw = $_POST['passwort'];

        if (password_verify("meingeheimespasswort", $hash)) {
            echo 'Valides Passwort!';
        } else {
            echo 'Invalides Passwort.';
            echo $neu = password_hash("neuesPasswort", PASSWORD_DEFAULT);
            if (password_verify("neuesPasswort", $neu)) {
                echo 'Valides Passwort!';
            }
        }


        echo "<br>\n", "Anzahl Zugriffe: ", $z;
        ?>
    </body>
</html>