<?php
include '../header_new.php';
include_once 'db_connect.inc.php';
// if the edit-user form was submitted, create another fill in form 
// for updating user data. If not, stay on the admin index page
if (!isset($_REQUEST['edit_users'])) {
    echo '<form action = "../adminaccount.php" method = "POST">' ?>
    <div class="w3-container w3-red"> NO results </div>
    <button class ="w3-button w3-grey " type = "submit" name = "submit">Back</button></form>
    <?php
} else {
    //request the chosen user  
    $user = $_REQUEST['edit_users'];
    //print_r($user);
// split the array and take the first element (the user id)
    $userid_tmp = implode(",", $user);
    $userid = preg_split("/[\s,]+/", $userid_tmp);
    //echo gettype($userid_edit);

    $sql_id = $userid[0];
// SQL query
    $sql_edit = "SELECT * FROM person WHERE id = $sql_id";

// applay query to database
    $result_edit = mysqli_query($conn, $sql_edit);
    if (!$result_edit) {
        exit("Query failed: " . mysqli_error($conn));
    }

    // collect resulting tuples and write it into the update form
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
            . "Login: " . $row["login"] . "<br>"
            . " <br> " . " </p>";
            //assign values from database to input variables in edit-form 
            $edit_id = $row["id"];
            $edit_firstname = $row["firstname"];
            $edit_lastname = $row["lastname"];
            $edit_street = $row["street"];
            $edit_hnr = $row["hnr"];
            $edit_postcode = $row["postcode"];
            $edit_town = $row["town"];
            $edit_country = $row["country"];
            $edit_email = $row["email"];
            $edit_phone = $row["phone"];
            
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


  } */
?>


<!-- create a new form containing the user data. The user id cannot be 
edited but gets passed in order to use the data for new query-->

<form class="signup-form" action="/php_includes/db_admin_edit_update.inc.php" method="POST">
    <input type="hidden" name="id_upd" value='<?php echo $edit_id; ?>'>        
    <input type="text" name="first_upd" value='<?php echo $edit_firstname; ?>'> 
    <input type="text" name="last_upd" value='<?php echo $edit_lastname; ?>'>
    <input type="text" name="street_upd" value='<?php echo $edit_street; ?>'>
    <input type="text" name="hnr_upd" value='<?php echo $edit_hnr; ?>'>
    <input type="text" name="postcode_upd" value='<?php echo $edit_postcode; ?>'>
    <input type="text" name="town_upd" value='<?php echo $edit_town; ?>'>
    <input type="text" name="country_upd" value='<?php echo $edit_country; ?>'>
    <input type="text" name="email_upd" value='<?php echo $edit_email; ?>'>
    <input type="text" name="phone_upd" value='<?php echo $edit_phone; ?>'>
    <input type="text" name="pwd_upd" placeholder="Password"> 
    <button type="submit" name="admin_edit_upd">Edit User</button>
</form> 

<?php
            echo '<form action = "../adminaccount.php" method = "POST">' ?>
            <button class ="w3-button w3-grey " type = "submit" name = "submit">Back</button></form>
            <?php
include '../footer.php';
?>