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
        if (!isset($_POST['button'])) {
            ?>

            <form class="form-horizontal" action="person_insert.php" method="post">
                <div class="form-group">
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="name1" placeholder="Given Name">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="name2" placeholder="Family Name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="login" placeholder="Login">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-1">
                        <button type="submit" name="button" class="btn btn-default">Submit</button>
                    </div>
                </div>
            </form>             

            <?php
            exit();
        }

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

        // Daten extrahieren
        $vorname = $_POST['name1'];
        $nachname = $_POST['name2'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Statement ausführen
        mysqli_stmt_execute($stmt);

        // Statement schließen
        mysqli_stmt_close($stmt);

        // Datenbankverbindung beenden
        mysqli_close($link);
        header("Location: person_overview.php");
        ?>
    </body>
</html>