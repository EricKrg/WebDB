<?php

//check, if user clicked submit button
if (isset($_POST['admin_edit_upd'])) {

    include_once 'db_connect.inc.php';
//include 'db_admin_edit.inc.php';
//to ensure that no sql injection is done; mysqli function is used
    $first_edt = mysqli_real_escape_string($conn, $_POST['first_upd']);
    $last_edt = mysqli_real_escape_string($conn, $_POST['last_upd']);
    $street_edt = mysqli_real_escape_string($conn, $_POST['street_upd']);
    $hnr_edt = mysqli_real_escape_string($conn, $_POST['hnr_upd']);
    $postcode_edt = mysqli_real_escape_string($conn, $_POST['postcode_upd']);
    $town_edt = mysqli_real_escape_string($conn, $_POST['town_upd']);
    $country_edt = mysqli_real_escape_string($conn, $_POST['country_upd']);
    $email_edt = mysqli_real_escape_string($conn, $_POST['email_upd']);
    $phone_edt = mysqli_real_escape_string($conn, $_POST['phone_upd']);
    $pwd_edt = mysqli_real_escape_string($conn, $_POST['pwd_upd']);

    $id_edt = mysqli_real_escape_string($conn, $_POST['id_upd']);

// error handlers
// check, if everything is filled out (no empty fields)
    if (empty($first_edt) || empty($last_edt) || empty($street_edt) || empty($hnr_edt) || empty($postcode_edt) || empty($town_edt) || empty($country_edt) || empty($email_edt) || empty($phone_edt) || empty($pwd_edt)) {
        header("Location: ../adminaccount.php?userupdate=empty");
        exit();
    } else {
//check if characters of personal contact data are valid
        if (!preg_match("/^[a-zA-Z]*$/", $first_edt) || !preg_match("/^[a-zA-Z]*$/", $last_edt) || !preg_match("/^[a-zA-Z]*$/", $street_edt) || !preg_match("/^[0-9]+$/", $hnr_edt) //
                || !preg_match("/^[0-9]+$/", $postcode_edt) //
                || !preg_match("/^[a-zA-Z]*$/", $town_edt) || !preg_match("/^[a-zA-Z]*$/", $country_edt) || !preg_match("/^[0-9]+$/", $phone_edt)) {
            header("Location: ../adminaccount.php?userupdate=invalid");
            exit();
        } else {
// Check if email is valid
            if (!filter_var($email_edt, FILTER_VALIDATE_EMAIL)) {
                header("Location: ../adminaccount.php?userupdate=emailunvalid");
                exit();
            } else {
// hashing the password
                $hashedPwd_edt = password_hash($pwd_edt, PASSWORD_DEFAULT);
//insert the user into the database
// the common user status is 'user' and has to be changed
// manually in the database to 'admin'. 
                $sql_update_edt = "UPDATE person SET firstname = '$first_edt', "
                        . "lastname = '$last_edt', "
                        . "street = '$street_edt', "
                        . "hnr = '$hnr_edt', "
                        . "postcode = '$postcode_edt', "
                        . "town = '$town_edt', "
                        . "country = '$country_edt', "
                        . "email = '$email_edt', "
                        . "phone = '$phone_edt', "
                        . "email = '$email_edt', "
                        . "password = '$hashedPwd_edt' "
                        . "WHERE id = '$id_edt'";

//$result_update = mysqli_query($conn, $sql_update_edt);
                if (mysqli_query($conn, $sql_update_edt)) {
                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }

//session_destroy();
header("Location: ../adminaccount.php?update=success");
                exit();
            }
        }
    }
} else {
    header("Location: ../php_includes/db_admin_edit.php?userupdate=error");
    exit();
}
