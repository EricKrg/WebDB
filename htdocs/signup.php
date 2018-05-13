<?php
    include_once 'header.php';
?>
    
    <section class="main-container">
        <div class="main-wrapper">
            <h2>Sign up</h2>
            <form class="signup-form" action="/php_includes/db_signup.inc.php" method="POST">
            <input type="text" name="first" placeholder="Firstname" > 
            <input type="text" name="last" placeholder="Lastname">
            <input type="text" name="ulog" placeholder="Username">
            <input type="text" name="street" placeholder="Street">
            <input type="text" name="hnr" placeholder="House No.">
            <input type="text" name="postcode" placeholder="Postcode">
            <input type="text" name="town" placeholder="Town">
            <input type="text" name="country" placeholder="Country">
            <input type="text" name="email" placeholder="E-mail">
            <input type="text" name="phone" placeholder="Phone">
            <input type="text" name="pwd" placeholder="Password"> 
                <button type="submit" name="submit">Sign up</button
            </form>
        </div>
    </section>
 
<?php
    include_once 'footer.php';
?>

