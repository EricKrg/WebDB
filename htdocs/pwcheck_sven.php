<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        $password = '$2y$10$hzQ3clDBx7nr.2G5BZWC/est7Stlb2Vq9V1.XmREex3AduW66iepi'; //"geheim"
        
//        echo password_hash("meingeheimespasswort", PASSWORD_DEFAULT), "<br>";
//        echo password_hash("meingeheimespasswort", PASSWORD_DEFAULT), "<br>";
       
        $cookiepassword = $formpassword = "";
        if (isset($_COOKIE['password'])) {
            $cookiepassword = $_COOKIE["password"];
        }
        if (isset($_POST['password'])) {
            $formpassword = $_POST['password'];
        }

        if (password_verify($formpassword, $password)) {
            setcookie("password", $password, time() + 10, "/");
            echo "Hurra, bin per Formular eingeloggt";
        } else if ($password == $cookiepassword) {
            setcookie("password", $password, time() + 10, "/");
            echo "Hurra, bin per Cookie eingeloggt";
        } else {
            ?>
            <form action="pwcheck.php" method="post">
                Passwort:  <input type="password" name="password"><br>
                <input type="submit" name="submit" value="Login">
            </form>
            <?php
        }
        ?>
    </body>
</html>