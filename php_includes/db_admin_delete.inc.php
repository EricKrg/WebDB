<?php

include_once 'db_connect.inc.php';
// if teh delete form is submitted, take the chosen user details
if (isset($_REQUEST['delete_button'])) {
    
    $user = $_REQUEST['delete_users'];
    // seperate the array elements by , 
    $userid_tmp = implode(",", $user);
// split the array and take the first element (the user id)
    $userid = preg_split("/[\s,]+/", $userid_tmp);
    $sql_id = $userid[0];
    print_r($sql_id);
// SQL query
    $sql_del = "DELETE FROM person WHERE id = $sql_id";

    //echo $sql_del;   
// applay query to database
    $stmt = mysqli_prepare($conn, $sql_del);
    if (!$stmt) {
        exit("Query failed: " . mysqli_error($conn));
    }

    // execute query statemnet
    mysqli_stmt_execute($stmt);

// close statement and database connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
// inform user via url if deleting was successfull
    header("Location: ../adminaccount.php?delete=success");
    exit();
} 


