<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        // Datenbankverbindung aufbauen
        $link = mysqli_connect("localhost", "geo406user", "geheim", "geo406");
        if (!$link) {
            echo "keine Verbindung möglich: ", mysqli_connect_error();
            exit();
        }

        // Zeichensatz setzen
        mysqli_set_charset($link, "utf8");

        // SQL query
        $sql = "SELECT * FROM person ORDER BY nachname";

        // Query ausführen
        $result = mysqli_query($link, $sql);
        if (!$result) {
            exit("Abfrage fehlgeschlagen: " . mysqli_error($link));
        }

        // Anzahl der Ergebnis-Tupel abfragen und ablaufen
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row["id"] . ": " . $row["nachname"] . ", " . $row["vorname"] . "<br>";
            }
        } else {
            echo "0 Ergebnisse";
        }

        // Datenbankverbindung beenden
        mysqli_close($link);
        ?>
    </body>
</html>