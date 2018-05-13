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
        $sql = "SELECT id, vorname, nachname FROM person ORDER BY nachname";

        // Statement (Abfrage) erzeugen
        $stmt = mysqli_prepare($link, $sql);
        if (!$stmt) {
            exit("Abfrage fehlgeschlagen: " . mysql_error());
        }

        // Statement ausführen
        mysqli_stmt_execute($stmt);

        // Variablen an Ergebnisse des Statements binden
        mysqli_stmt_bind_result($stmt, $id, $vorname, $nachname);

        // Ergebnis-Tupel der Statements ablaufen
        while (mysqli_stmt_fetch($stmt)) {
//            echo "$id $vorname $nachname <br>";
            echo "<a href=\"person_detail.php?id=$id\">$vorname $nachname</a> [<a href=\"person_delete.php?id=$id\">Löschen</a>]<br>";
        }

        // Statement schließen
        mysqli_stmt_close($stmt);

        // Datenbankverbindung beenden
        mysqli_close($link);

        echo '<b><a href="person_insert.php">Person hinzufügen</a></b>';
        ?>
    </body>
</html>