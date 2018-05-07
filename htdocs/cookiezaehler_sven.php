<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        if (isset($_COOKIE['zaehler'])) {
            $z = $_COOKIE['zaehler'];
        } else {
            $z = 0;
        }
        $z++;
        setcookie("zaehler", $z, time() + 100000, "/", "", 0);
        echo "Anzahl Zugriffe:", $z;
        ?>
    </body>
</html>
