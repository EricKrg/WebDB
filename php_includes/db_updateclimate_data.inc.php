<?php


echo "test";
//check, if user clicked submit button
if (isset($_POST['submit_d'])) {
    include 'db_connect.inc.php';
    $myfile = fopen("UP_DATA/".$_FILES['userfile']['name'], "r") or die("Unable to open file!");
    echo fgets($myfile);    
    /*
    while(!feof($myfile)) {
            $temp = fgets($myfile);
            
        }
      */      
    /*        
    } else {
        //check if characters are valid
        if (!preg_match("/^[a-zA-Z]*$/", $first_upd) || !preg_match("/^[a-zA-Z]*$/", $last_upd) || !preg_match("/^[a-zA-Z]*$/", $street_upd) || !preg_match("/^[0-9]+$/", $hnr_upd) //
                || !preg_match("/^[0-9]+$/", $postcode_upd) //
                || !preg_match("/^[a-zA-Z]*$/", $town_upd) || !preg_match("/^[a-zA-Z]*$/", $country_upd) || !preg_match("/^[0-9]+$/", $phone_upd)) {
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
              }  else {
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
     * 
     */
}  else {
    header("Location: ../fileupload.php");
    exit();
} 
?>