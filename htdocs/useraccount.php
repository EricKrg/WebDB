<?php
include_once 'header.php';
include_once 'D:/geo406/htdocs/php_includes/db_connect.inc.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Manage User Account</h2>

        <?php
        if (isset($_SESSION['u_id'])) {
            echo "<p>Hi, " . $_SESSION['u_first'] . " " . " . You are logged in!</p>"
            . "Here you can see your user data: <br>";
            echo "<p>Firstname: " . $_SESSION['u_first'] . " <br> "
            . "Lastname: " . $_SESSION['u_last'] . " <br> "
            . "Status: " . $_SESSION['u_status'] . " <br> "
            . "Login: " . $_SESSION['u_log'] . " </p> "
            . "Street: " . $_SESSION['u_street'] . "<br>"
            . "House No.: " . $_SESSION['u_hnr'] . "<br>"
            . "Postcode: " . $_SESSION['u_postcode'] . "<br>"
            . "Town: " . $_SESSION['u_town'] . "<br>"
            . "Country: " . $_SESSION['u_country'] . "<br>"
            . "E-mail: " . $_SESSION['u_email'] . "<br>"
            . "Phone: " . $_SESSION['u_phone'] . "<br>";
           // . "Password: " . $_SESSION['u_pwd'] . "<br>"; 
        }
        ?>
        <p> If you want to change your user contact data, fill in the form and click 'Update'. <br>
            Then, please log in again. </p>
        <form class="signup-form" action="/php_includes/db_updatedata.inc.php" method="POST">
            <input type="text" name="first_upd" value='<?php echo $_SESSION['u_first']; ?>'> 
            <input type="text" name="last_upd" value='<?php echo $_SESSION['u_last']; ?>'>
            <!-- <input type="text" name="ulog_upd" placeholder="Username"> -->
            <input type="text" name="street_upd" value='<?php echo $_SESSION['u_street']; ?>'>
            <input type="text" name="hnr_upd" value='<?php echo $_SESSION['u_hnr']; ?>'>
            <input type="text" name="postcode_upd" value='<?php echo $_SESSION['u_postcode']; ?>'>
            <input type="text" name="town_upd" value='<?php echo $_SESSION['u_town']; ?>'>
            <input type="text" name="country_upd" value='<?php echo $_SESSION['u_country']; ?>'>
            <input type="text" name="email_upd" value='<?php echo $_SESSION['u_email']; ?>'>
            <input type="text" name="phone_upd" value='<?php echo $_SESSION['u_phone']; ?>'>
            <input type="text" name="pwd_upd" placeholder="Password"> 
            <button type="submit" name="submit_upd">Update</button>
        </form>
    </div>

    <?php
    /*
      $data = "fargo";

      $sql = "SELECT * FROM person WHERE login=?;";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "SQL statement failed";
      } else {
      //bind parameters to the placeholder
      mysqli_stmt_bind_param($stmt, 's', $data);
      // run parameters inside database
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      while ($row = mysqli_fetch_assoc($result)) {
      echo $row['login'] . "<br>";
      }
      }
      ?>



     */
    ?>


</section>

<?php
include_once 'footer.php';
?>

