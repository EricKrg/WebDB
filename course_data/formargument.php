<html>
    <head>
        <meta charset="UTF-8"> 
        <title></title>
    </head>
    <body>
        <form action="formargument.php" method="post">
            Name: <input type="text" name="username"><br>
            Email: <input type="text" name="email"><br>
            <input type="submit" name="submit" value="Und ab!">
        </form>
        <?php
        echo $_POST['username'], "<br>";
        echo $_POST['email'];
        ?>
    </body>
</html>
