<?php
// import scripts and their variables 
include_once 'header_new.php';
include_once 'php_includes/db_connect.inc.php';
?>

<section id ="scroll" class="w3-container w3-green">
    <div class="w3-panel">
        <h2>Manage User Account</h2>

        <?php
        // use session data to welcome the user and present its login data
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
        <!-- Create form for updating user data and a button to submit the changes -->
        <p> If you want to change your user contact data, fill in the form and click 'Update'. <br>
            Then, please log in again. </p>
        <form class="signup-form" action="/php_includes/db_updatedata.inc.php" method="POST">
            <input type="text" name="first_upd" placeholder="Firstname"> 
            <input type="text" name="last_upd" placeholder="Lastname">
            <input type="text" name="street_upd" placeholder="Street">
            <input type="text" name="hnr_upd" placeholder="House No.">
            <input type="text" name="postcode_upd" placeholder="Postcode">
            <input type="text" name="town_upd" placeholder="Town">
            <input type="text" name="country_upd" placeholder="Country">
            <input type="text" name="email_upd" placeholder="E-mail">
            <input type="text" name="phone_upd" placeholder="Phone">
            <input type="text" name="pwd_upd" placeholder="Password"> 
            <button type="submit" name="submit_upd">Update</button>
        </form>
    </div>

</section>

<?php
include_once 'footer.php';


