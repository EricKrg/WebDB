<?php

$id = $_GET['id'];

// Datenbankverbindung aufbauen
$link = mysqli_connect("localhost", "geo406user", "geheim", "geo406");
if (!$link) {
    echo "keine Verbindung möglich: " ,mysqli_connect_error();
    exit();
}

// Zeichensatz setzen
mysqli_set_charset($link, "utf8");

// SQL query
$sql = "DELETE FROM person WHERE id=?";

// Statement (Abfrage) erzeugen
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if (!$stmt) {
    exit("Abfrage fehlgeschlagen: " . mysql_error());
}

// Statement ausführen
mysqli_stmt_execute($stmt);

// Statement schließen
mysqli_stmt_close($stmt);

// Datenbankverbindung beenden
mysqli_close($link);

header("Location: person_overview.php");
?>    
