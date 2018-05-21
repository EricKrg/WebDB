<?php
include '../header_new.php';
include_once 'db_connect.inc.php';
// if the checboxes form was not submitted, show 'no results', otherwise request user data
if (!isset($_POST['cbox'])) {
    echo '<form action = "../adminaccount.php" method = "POST">' ?>
    <div class="w3-container w3-red"> NO results </div>
    <button class ="w3-button w3-grey " type = "submit" name = "submit">Back</button></form>
    <?php
    } else {
    
    // separate retrieved arrays and use user id
    $userid = implode(",", $_POST['cbox']);
    //print for testing
    //print_r($userid);
    //
    // do query based on checkboxes
    $sql = "SELECT * FROM person WHERE id IN ($userid)  "; //$userid
    // apply query
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        exit("Query failed: " . mysqli_error($conn));
    }
    // request resulting tuples and show them to the admin
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
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
            //back button 
            echo '<form action = "../adminaccount.php" method = "POST">' ?> 
    <button class ="w3-button w3-grey " type = "submit" name = "submit">Back</button></form>
    <?php
        }
    }
    mysqli_close($conn);
    exit();
    
        }

