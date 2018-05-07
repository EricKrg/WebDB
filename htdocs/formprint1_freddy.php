<html>
    <head>
        <meta charset="UTF-8"> 
        <title></title>
    </head>
    <body>
        <form action="formprint1.php" method="post">
            Text: <input type="text" name="text" value="Hier der Text"><br>
            Zahl: <input type="integer" name="zahl"><br>
            <input type="submit" name="submit" value="Abschicken!">
        </form>
        <?php
        $text = $_POST['text'];
        $zahl = $_POST['zahl'];


        $i = 0;
        while ($i < $zahl) {
            echo $i, $text, "<br>";
            $i++;
        }
        ?>
    </body>
</html>
