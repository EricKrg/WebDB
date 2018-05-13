<?php

include_once 'db_connect.inc.php';
if (isset($_REQUEST['delete'])) {

    $user = $_REQUEST['users'];
    $userid_del = implode(" ", $user);
    //echo $userid_del[0];
// SQL query
    $sql_del = "DELETE FROM person WHERE id IN ($userid_del[0])";
    //echo $sql_del;   
// Query ausführen
    $stmt = mysqli_prepare($conn, $sql_del);
    if (!$stmt) {
        exit("Abfrage fehlgeschlagen: " . mysqli_error($conn));
    }

    // Statement ausführen
    mysqli_stmt_execute($stmt);

// Statement schließen
    mysqli_stmt_close($stmt);

// Datenbankverbindung beenden
    mysqli_close($conn);

    header("Location: ../adminaccount.php?delete=success");
    exit();
} 


