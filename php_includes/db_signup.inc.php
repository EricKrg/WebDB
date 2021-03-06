<?php

/*check, if user clicked submit button. If so, fetch data from the input formular 
given via POST method and proove the data for several conditions. 
 * If conditions are not met, pass the user back to the sign up formular 
 */
if (isset($_POST['submit'])) {

    include_once 'db_connect.inc.php';
    //to ensure that no sql injection can be done; mysqli function is used
    //$status = mysqli_real_escape_string($conn, $_POST['status']);
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $ulog = mysqli_real_escape_string($conn, $_POST['ulog']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $hnr = mysqli_real_escape_string($conn, $_POST['hnr']);
    $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
    $town = mysqli_real_escape_string($conn, $_POST['town']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    // error handlers
    /* check, if everything is filled out (no empty fields). If not,
      show error message in the url */
    if (empty($first) || empty($last) || empty($ulog) || empty($street) 
            || empty($hnr) || empty($postcode) || empty($town) || empty($country) 
            || empty($email) || empty($phone) || empty($pwd)) {
        header("Location: ../signup.php?signup=empty");
        exit();
    } else {
        /*check if characters of personal contact data contains either only letters 
        or only digits. Otherwise, show error message in the url */ 
        if (!preg_match("/^[a-zA-Z]*$/", $first) 
                || !preg_match("/^[a-zA-Z]*$/", $last)
                || !preg_match("/^[a-zA-Z]*$/", $street)
                || !preg_match("/^[0-9]+$/", $hnr) //
                || !preg_match("/^[0-9]+$/", $postcode) //
                || !preg_match("/^[a-zA-Z]*$/", $town)
                || !preg_match("/^[a-zA-Z]*$/", $country)
                || !preg_match("/^[0-9]+$/", $phone)) {
            header("Location: ../signup.php?signup=invalid");
            exit();
        } else {
            // Check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../signup.php?signup=email");
                exit();
            } else {
                /* check if user name is already registered in the data base. 
                  If so, print error message in url */
                $sql_check = "SELECT * FROM person WHERE login = '$ulog'";
                $result = mysqli_query($conn, $sql_check);
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    header("Location: ../signup.php?signup=usertaken");
                } else {
                    // use hash funtction to encrypt the password
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    /*insert the user into the database;
                    the common user status is 'user' and has to be changed
                    manually in the database to 'admin' */
                    $sql_insert = "INSERT INTO person "
                            . "(status, firstname, lastname, login, street, "
                            . "hnr, postcode, town, country, email, phone,"
                            . "password) "
                            . "VALUES ('user','$first', '$last', '$ulog',"
                            . " '$street', '$hnr', '$postcode', '$town', "
                            . "'$country', '$email', '$phone', '$hashedPwd');";
                    //$result = mysqli_query($conn, $sql_insert);
                    // print successful login in the url
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../signup.php");
    exit();
}
