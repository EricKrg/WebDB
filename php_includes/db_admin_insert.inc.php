<?php

include_once 'db_connect.inc.php';
if (isset($_POST['insert'])) {

    // separate retrieved arrays
    $userid = implode(",", $_POST['cbox']);
    //print for testing
    //print_r($userid);
    
    // do query based on checkboxes
    $sql = "SELECT * FROM person WHERE id IN ($userid)  "; //$userid
    // Query ausführen
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        exit("Abfrage fehlgeschlagen: " . mysqli_error($conn));
    }
    // Anzahl der Ergebnis-Tupel abfragen und ablaufen
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>User ID " . $row["id"] . ": " . "<br>"
            . "Name: " . $row["firstname"]
            . " " . $row["lastname"] . "<br>"
            . "E-mail: " . $row["email"] . "<br>"
            . "Login: " . $row["login"] . "<br></p>";
        }
    } else {
        echo "keine Ergebnisse";
    }
}
 