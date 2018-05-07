
<!DOCTYPE HTML>
<html>
    <head>
        <title>Seitentitel</title>
    </head>
    <body>
        <?php
        session_set_cookie_params(time() + 3, "/", "", 0);
//        session_id(42);

        session_start();

        if (isset($_SESSION['zaehler'])) {
            $c = $_SESSION['zaehler'];
        } else {
            $c = 0;
        }
        $_SESSION['zaehler'] = $c + 1;

        echo "Anzahl Zugriffe: ", $c, "<br>\n";
        echo "Meine Session ID: ";
        echo session_id(),"<br>\n";
        echo '<a href="sessionzaehler.php?' . SID . '">Klick</a>', "<br>\n";
        
        ?>
    </body>
</html>