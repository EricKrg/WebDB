<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>   
    </head>
    <body>
        <?php
        $id = $_GET['id'];

        // Datenbankverbindung aufbauen
        $link = mysqli_connect("localhost", "geo406user", "geheim", "geo406");
        if (!$link) {
            echo "keine Verbindung möglich: ", mysqli_connect_error();
            exit();
        }

        // Zeichensatz setzen
        mysqli_set_charset($link, "utf8");

        // SQL query
        $sql = "SELECT vorname, nachname, email, login, passwort FROM person WHERE id=?";

        // Statement (Abfrage) erzeugen
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (!$stmt) {
            exit("Abfrage fehlgeschlagen: " . mysql_error());
        }

        // Statement ausführen
        mysqli_stmt_execute($stmt);

        // Variablen an Ergebnisse des Statements binden
        mysqli_stmt_bind_result($stmt, $vorname, $nachname, $email, $login, $passwort);

        // Ergebnis-Tupel der Statements ablaufen
        while (mysqli_stmt_fetch($stmt)) {
            echo "Name: $vorname $nachname<br>";
            echo "Email: $email<br>";
            echo "Login: $login<br>";
            echo "Passwort: $passwort<br>";
        }

        // Statement schließen
        mysqli_stmt_close($stmt);

        // Datenbankverbindung beenden
        mysqli_close($link);
        ?>
    </body>
</html>