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
        $sql = "INSERT INTO person (vorname, nachname, email, login, passwort) VALUES (?, ?, ?, ?, ?)";

        // Statement (Abfrage) erzeugen
        $stmt = mysqli_prepare($link, $sql);

        if (!$stmt) {
            exit("Abfrage fehlgeschlagen: " . mysqli_error($link));
        }

        // Variablen an Parameter des Statements binden
        mysqli_stmt_bind_param($stmt, "sssss", $vorname, $nachname, $email, $login, $password);

        // Statement ausführen
        $vorname = "Anita";
        $nachname = "Martin";
        $email = "c5mman@uni-jena.de";
        $login = "c5maan";
        $password = password_hash("bla", PASSWORD_DEFAULT);
        mysqli_stmt_execute($stmt);

        // Ausführung wiederholen
        $vorname = "Rainer";
        $nachname = "Hoffmann";
        $email = "c5raho@uni-jena.de";
        $login = "c5raho";
        $password = password_hash("geheim", PASSWORD_DEFAULT);
        mysqli_stmt_execute($stmt);

        // Statement schließen
        mysqli_stmt_close($stmt);

        // Datenbankverbindung beenden
        mysqli_close($link);
        
        echo "Datasets successfully inserted!"
        ?>
    </body>
</html>