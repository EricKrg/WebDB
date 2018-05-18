<?php
//script for the removal of time series data 
include_once 'header_new.php';
if (isset($_SESSION['u_id'])) {
?>
    <body>
    <header class="w3-container w3-green w3-center" style="padding:20px 16px">
        <h1 class="w3-margin w3-jumbo"><font size="6">Delete Files</h1></font>
</header>
    <form class="w3-container w3-center w3-center " method="post" action="" name="form">  
        <select class="w3-button w3-grey w3-medium w3-margin-top  w3-center" name="file"><p>
            <option class="w3-button w3-red w3-medium w3-margin-top  w3-center" value="" selected="selected">Select data </option>
            <?php
            //listing all exisiting time series - similar to meta explorer 
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
        <input class="w3-button w3-black w3-medium w3-margin-top" name="submit" type="submit" value="Select"></p>
</form>
        <!-- removal is not instant, user will be asked to hit the delete button after selecting the file !-->
    <?php    
    if (empty($_POST['file'])){
        echo "" ;
    } else {
        $meta_select = $_POST['file']; ?>
    <div class="w3-container" style="display: inline-block; text-align: left;"><b> Delete the Data of: 
            <form  enctype="multipart/form-data" action="/php_includes/delete.inc.php" method="post"> <!-- to delete function !-->
        <input class ="w3-container w3-opacity" size ="35" type="text" name="file_name" value= <?php echo $meta_select ?> readonly/><br>
        <p><input class="w3-button w3-red w3-medium w3-margin-top" name ="delete" type="submit" value="DELETE"></p><br>
                    </form></div></b> 
                        <?php
    } ?>
    
      </body>
    <!-- Footer -->
<?php
}
include_once 'footer.php';
?>

</html>
