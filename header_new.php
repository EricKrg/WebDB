<?php
session_start();

    

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
    .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
    .fa-anchor,.fa-coffee {font-size:200px} 
    #scroll {overflow-y: auto; height: 600px;}
    #scroll_small {overflow-y: scroll; height: 400px;}
    #table {
    border-collapse: collapse;
    float:left;}
    #table tr:nth-child(even){background-color: #f2f2f2;}
    #table tr:hover {background-color: #ddd;}

    </style>
    

    
        <div class="w3-top">
        <div class="w3-bar w3-black w3-card w3-left-align w3-small">
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-grey" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
        <a href="../index.php" class="w3-bar-item w3-button w3-padding-large w3-black">Home</a>
                <div class="nav-login">
                    <?php
                    // if the user is logged in, create a User Account button for 
                    // managing user data and a log out button 
                    // i fthe user is not logged in, show a Login button 
                    if (isset($_SESSION['u_id'])) {
                        echo '<form action = "../useraccount.php" method = "POST">' ?>
                    <!--    
                
                !-->
                    <button class ="w3-button w3-grey w3-left" type = "submit" name = "submit">User Account</button>
                    </form> <?php
                        echo '<form action = "/php_includes/db_logout.inc.php" method = "POST">' ?>
                    <!--    
                
                !-->
                    <button class ="w3-button w3-grey w3-left" type = "submit" name = "submit">Logout</button>
                    </form> <?php
                    } else {
                        echo '<form action="/php_includes/db_login.inc.php" method="POST">
                            '?>
                    <div class ="w3-button w3-grey">
                        <p><input type="text" name="ulog" placeholder="Username/ E-mail">
                            <input type="password" name="pwd" placeholder="Password"></p> </div>
                        <button  class ="w3-button w3-grey" type="submit" name="submit">Login</button>
                </form>
                        <a class ="w3-button w3-red w3-right" href="signup.php">Sign up</a></button>
                 <?php
                    }
                    // check, if the user has admin status. If so, create admin 
                    // button for managing user data
                    if (isset($_SESSION['u_id']) && $_SESSION['u_status'] == 'admin') {
                        echo '<form action = "../adminaccount.php" method = "POST">' ?>
                    <button class ="w3-button w3-grey w3-right" type = "submit" name = "submit">ADMIN</button>
                <!--    
                
                !-->
                
                </form><?php
                    }

                    ?>

                </div>
        </div>
        
    
        