
<?php
include_once 'header_new.php';
?>
<body>

    <header class="w3-container w3-green w3-center w3-medium" style="padding:20px 16px">
        <h1 class="w3-margin w3-jumbo"><font size="6">Data download</h1></font>
    </header>
    <form class="w3-container w3-center" method="post" action="/php_includes/donwload.inc.php" name="form">  
        <select class="w3-button w3-grey w3-medium w3-margin-top" name="file_name"><p>
            <option class="w3-button w3-red w3-medium w3-margin-top" value="select" selected="selected">Select data</option>
            <?php
            $dir = "UP_DATA/";
            $folder = opendir($dir);

            while (($file = readdir($folder)) !== false){
                if (pathinfo($file, PATHINFO_EXTENSION) == 'txt'){
                $files[] = $file;
                }
            }
                closedir($folder);
            foreach($files as $val){
                echo '<option value="'.$val.'">'.$val."</option>\n";
            }
            ?>
        </select>
        <input class="w3-button w3-red w3-medium w3-margin-top" name="down" type="submit" value="DOWNLOAD"></p>
</form>

<?php
include_once 'footer.php';
?>

</html>
