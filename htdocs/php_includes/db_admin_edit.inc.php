<?php

include_once 'db_connect.inc.php';
if (!isset($_REQUEST['edit_users'])) {
     echo "No results.";   
    } else {
echo "Succes";
 

    //request the chosen user  
    $user = $_REQUEST['edit_users'];
    //print_r($user);
// split the array and take the first element (the user id)
    $userid_tmp = implode(",", $user);
    $userid = preg_split("/[\s,]+/", $userid_tmp);
    //echo gettype($userid_edit);

    $sql_id =  $userid[0];
// SQL query
    $sql_edit = "SELECT * FROM person WHERE id = $sql_id";

// Query ausführen
    $result_edit = mysqli_query($conn, $sql_edit);
    if (!$result_edit) {
        exit("Query failed: " . mysqli_error($conn));
    }
    
   // echo mysqli_num_rows($result_edit);
    
    // Anzahl der Ergebnis-Tupel abfragen und ablaufen
    if (mysqli_num_rows($result_edit) > 0) {
        while ($row = mysqli_fetch_assoc($result_edit)) {
            echo "<p>User ID " . $row["id"] . ": " . "<br>"
            . "Name: " . $row["firstname"]
            . " " . $row["lastname"] . "<br>"
            . "Status: " . $row["status"] . "<br>"
            . "Address: " . $row["street"] . " " . $row["hnr"] . ", "
            . $row["postcode"] . " "
            . $row["town"] . "<br>"
            . "Country: " . $row["country"] . "<br>"
            . "E-mail: " . $row["email"] . "<br>"
            . "Phone: " . $row["phone"] . "<br>"
            . "Login: " . $row["login"] . "<br></p>";
        }
    }
    }
    
    /*
    // Statement ausführen
    mysqli_stmt_execute($stmt);

// Statement schließen
    mysqli_stmt_close($stmt);

// Datenbankverbindung beenden
    // mysqli_close($conn);

   // header("Location: ../adminaccount.php?dedit=success");
    //exit();
} */
    
    ?>

        

        
<form class="signup-form" action="/php_includes/db_updatedata.inc.php" method="POST">
            <input type="text" name="first_upd" value='<?php echo $row["firstname"]; ?>'> 
            <input type="text" name="last_upd" value=' '>
            <input type="text" name="street_upd" value=''>
            <input type="text" name="hnr_upd" value=''>
            <input type="text" name="postcode_upd" value=''>
            <input type="text" name="town_upd" value=''>
            <input type="text" name="country_upd" value=''>
            <input type="text" name="email_upd" value=''>
            <input type="text" name="phone_upd" value=''>
            <input type="text" name="pwd_upd" placeholder="Password"> 
            <button type="submit" name="edit_upd">Edit </button>
</form> 

