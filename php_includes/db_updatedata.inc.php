<?php

session_start();

//check, if user clicked submit button
if (isset($_POST['submit_upd'])) {
    include_once '../useraccount.php';
    include 'db_connect.inc.php';

    //to ensure that no sql injection is done; mysqli function is used
    $first_upd = mysqli_real_escape_string($conn, $_POST['first_upd']);
    $last_upd = mysqli_real_escape_string($conn, $_POST['last_upd']);
    //$ulog_upd = mysqli_real_escape_string($conn, $_POST['ulog_upd']);
    $street_upd = mysqli_real_escape_string($conn, $_POST['street_upd']);
    $hnr_upd = mysqli_real_escape_string($conn, $_POST['hnr_upd']);
    $postcode_upd = mysqli_real_escape_string($conn, $_POST['postcode_upd']);
    $town_upd = mysqli_real_escape_string($conn, $_POST['town_upd']);
    $country_upd = mysqli_real_escape_string($conn, $_POST['country_upd']);
    $email_upd = mysqli_real_escape_string($conn, $_POST['email_upd']);
    $phone_upd = mysqli_real_escape_string($conn, $_POST['phone_upd']);
    $pwd_upd = mysqli_real_escape_string($conn, $_POST['pwd_upd']);
    // error handlers
    // check, if everything is filled out (no empty fields)
    if (empty($first_upd) || empty($last_upd) //|| empty($ulog_upd) 
            || empty($street_upd) || empty($hnr_upd) || empty($postcode_upd) 
            || empty($town_upd) || empty($country_upd) || empty($email_upd) 
            || empty($phone_upd) || empty($pwd_upd)) {
        header("Location: ../useraccount.php?update=empty");
        exit();
    } else {
        //check if characters are valid
        if (!preg_match("/^[a-zA-Z]*$/", $first_upd) || !preg_match("/^[a-zA-Z]*$/", $last_upd) 
                || !preg_match("/^[a-zA-Z]*$/", $street_upd) 
                || !preg_match("/^[0-9]+$/", $hnr_upd) //
                || !preg_match("/^[0-9]+$/", $postcode_upd) //
                || !preg_match("/^[a-zA-Z]*$/", $town_upd) 
                || !preg_match("/^[a-zA-Z]*$/", $country_upd) 
                || !preg_match("/^[0-9]+$/", $phone_upd)) {
            header("Location: ../useraccount.php?update=invalid");
            exit();
        } else {
            // Check if email is valid
            if (!filter_var($email_upd, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../useraccount.php?update=email");
                exit();
            } /* else {
              $sql_check = "SELECT * FROM person WHERE login = '$ulog_upd'";
              $result = mysqli_query($conn, $sql_check);
              $resultCheck = mysqli_num_rows($result);

              if ($resultCheck > 0) {
              header("Location: ../useraccount.php?update=usertaken");
              exit();
              } */ else {
                // hashing the password
                $hashedPwd_upd = password_hash($pwd_upd, PASSWORD_DEFAULT);
                //update all user account attributes that have been changed by the user
                $sql_update = "UPDATE person SET firstname = '$first_upd', "
                        . "lastname = '$last_upd', "
                        //. "login = '$ulog_upd' "
                        . "street = '$street_upd', "
                        . "hnr = '$hnr_upd', "
                        . "postcode = '$postcode_upd', "
                        . "town = '$town_upd', "
                        . "country = '$country_upd', "
                        . "email = '$email', "
                        . "phone = '$phone_upd', "
                        . "email = '$email_upd', "
                        . "password = '$hashedPwd_upd' "
                        . "WHERE id = '" . $_SESSION["u_id"] . "'";
                $result_update = mysqli_query($conn, $sql_update);
                if (mysqli_query($conn, $sql_update)) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }

                session_destroy();
                header("Location: ../index.php?update=success");
                exit();
            }
        }
    //}
    }
} else {
    header("Location: ../useraccount.php");
    exit();
}