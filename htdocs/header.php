<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Data portal</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="authors" content="Eric&Luise">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>

    <body>
        <header>
            <nav>
                <div class="main-wrapper">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                    </ul>   
                </div>
                <div class="nav-login">
                    <?php
                    // if the user is logged in, create a User Account button for 
                    // managing user data and a log out button 
                    // i fthe user is not logged in, show a Login button 
                    if (isset($_SESSION['u_id'])) {
                        echo '<form action = "useraccount.php" method = "POST">
                    <button type = "submit" name = "submit">User Account</button>
                    </form>';
                        echo '<form action = "/php_includes/db_logout.inc.php" method = "POST">
                    <button type = "submit" name = "submit">Logout</button>
                    </form>';
                    } else {
                        echo '<form action="/php_includes/db_login.inc.php" method="POST">
                        <input type="text" name="ulog" placeholder="Username/ E-mail">
                        <input type="password" name="pwd" placeholder="Password">
                        <button type="submit" name="submit">Login</button>
                    </form>
                        <a href="signup.php">Sign up</a>';
                    }
                    // check, if the user has admin status. If so, create admin 
                    // button for managing user data
                    if (isset($_SESSION['u_id']) && $_SESSION['u_status'] == 'admin') {
                        echo '<form action = "adminaccount.php" method = "POST">
                    <button type = "submit" name = "submit">ADMIN</button>
                    </form>';
                    }
                    ?>

                </div>
            </nav>
        </header> 