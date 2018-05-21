<?php
@ob_start();
session_start();
// if login button was submitted, check if login data are correct
if (isset($_POST['submit'])) {

    include 'db_connect.inc.php';
    //retrieve login data
    $ulog = mysqli_real_escape_string($conn, $_POST['ulog']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    //Error handlers
    // check if inputs are empty
    if (empty($ulog) || empty($pwd)) {
        header("Location: ../index.php?login=empty");
        exit();
    } else {
        // if fields are not empty, create database query
        $sql = "SELECT * FROM person WHERE login='$ulog' OR email='$ulog'";
        $result = mysqli_query($conn, $sql);
        // Check, if there is a user registered with login data in the database
        $resultCheck = mysqli_num_rows($result);
        // if not, show error message
        if ($resultCheck < 1) {
            header("Location: ../index.php?login=loginfalse");
            exit();
        } else {
            // if yes, compare the hashed password from database with the 
            // hashed password from input form
            if ($row = mysqli_fetch_assoc($result)) {
                echo $row['login'];
                // de-heshing the password
                $hashedPwdCheck = password_verify($pwd, $row['password']);
                // if passwords are not equal, show error message
                if ($hashedPwdCheck == false) {
                    header("Location: ../index.php?login=pwderror");
                    exit();
                 // if passwords macht, start the user session 
                } elseif ($hashedPwdCheck == true) {
                    //log in the user here
                    session_start();
                    $_SESSION['u_id'] = $row['id'];
                    $_SESSION['u_status'] = $row['status'];
                    $_SESSION['u_first'] = $row['firstname'];
                    $_SESSION['u_last'] = $row['lastname'];
                    $_SESSION['u_log'] = $row['login'];
                    $_SESSION['u_street'] = $row['street'];
                    $_SESSION['u_hnr'] = $row['hnr'];
                    $_SESSION['u_postcode'] = $row['postcode'];
                    $_SESSION['u_town'] = $row['town'];
                    $_SESSION['u_country'] = $row['country'];
                    $_SESSION['u_email'] = $row['email'];
                    $_SESSION['u_phone'] = $row['phone'];
                    $_SESSION['u_pwd'] = $row['password'];
                    header("Location: ../index.php?login=success");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../index.php?login=error");
    exit();
}


