<?php

include_once 'db_connect.inc.php';
if (isset($_REQUEST['delete_button'])) {



    $user = $_REQUEST['delete_users'];
    $userid_tmp = implode(",", $user);
    $userid = preg_split("/[\s,]+/", $userid_tmp);

// split the array and take the first element (the user id)

    $sql_id = $userid[0];
    print_r($sql_id);
// SQL query
    $sql_del = "DELETE FROM person WHERE id = $sql_id";

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


