<?php
if (isset($_COOKIE['zaehler'])) {
    $z = $_COOKIE['zaehler'];
} else {
    $z = 0;
}
$z++;
setcookie("zaehler", $z, time() + 3600, "/", "", 0);
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Seitentitel</title>
    </head>
    <body>

        <?php
        echo "Anzahl Zugriffe:", $z;
        ?>
    </body>
</html>