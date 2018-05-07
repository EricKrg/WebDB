<!DOCTYPE HTML>
<html>
    <head>
        <title>Seitentitel</title>
    </head>
    <body>
<?php
$datei = fopen("input_for_counter.txt","r+");

while (!feof($datei)) {
$zeile = fgets($datei,1000);
echo $zeile, "<br>\n";
}

?>
    </body>
</html>