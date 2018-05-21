<?php
// if the logout button was submitted, end the session and pass user to start page
if (isset($_POST['submit'])) {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit();
}