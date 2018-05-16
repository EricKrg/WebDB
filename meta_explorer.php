<?php
include_once 'header_new.php';
if (isset($_SESSION['u_id'])) {
?>

    <body>
    <header class="w3-container w3-green w3-center" style="padding:20px 16px">
        <h1 class="w3-margin w3-jumbo"><font size="6">Meta explorer</h1></font>
    </header>
        <div id ="scroll">
    <form class="w3-container w3-center" method="post" action="" name="form">  
        <select class="w3-button w3-grey w3-medium w3-margin-top" name="metafile"><p>
            <option class="w3-button w3-red w3-medium w3-margin-top" value="select" selected="selected">Select meta data</option>
            <?php
            $dir = "UP_DATA/meta/";
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
        <input class="w3-button w3-black w3-medium w3-margin-top" name="submit" type="submit"></p>
</form>
  <?php    
    if (empty($_POST['metafile'])){
        echo "" ;
    } else {
        $meta_select = $_POST['metafile'];
        global $meta_select;
        if(pathinfo($meta_select, PATHINFO_EXTENSION) == 'txt'){
        
        $myfile = fopen("UP_DATA/meta/".$meta_select, "r") or die("Unable to open file!");
            // Output one line until end-of-file
        ?> <p><div class="w3-container w3-yellow w3-center"> Current Meta data:</div> </p>
        <?php
        $old =array();
        while(!feof($myfile)) {
            $temp = fgets($myfile);
            $old[] = $temp; 
         
        }

        ?> 
        <div class="w3-container w3-center"><b>Edit the Data of:
                <form enctype="multipart/form-data" action="/php_includes/meta_explorer_update.php" method="post">
            <input class ="w3-container w3-opacity" size ="35" type="text" name="file_name" value= <?php echo $meta_select ?> readonly/><br>
            <p><b>Dataset: </b></p>
            <div class="w3-center ">
                <p><input class="w3-container w3-red w3-opacity" type="text" name="DataT" placeholder="Dataset Title" value= <?php echo substr($old[0], 6) ?> />
           <input class="w3-container  w3-opacity" type="text" name="Descr" placeholder="Description"  value= <?php echo substr($old[1], 6) ?>  /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="rstat" placeholder="Reliability Status" value= <?php echo substr($old[2], 6) ?> />
           <input class="w3-container  w3-opacity" type="text" name="rdesc" placeholder="Reliability Desc." value= <?php echo substr($old[3], 6) ?>  /></p>
        <p><input class="w3-container w3-red  w3-opacity" type="text" name="start" placeholder="Start" value= <?php echo substr($old[4], 6) ?>  />
           <input class="w3-container w3-red w3-opacity" type="text" name="enddt" placeholder="End" value= <?php echo substr($old[5], 6) ?> /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="naval" placeholder="Value for Missing Data" value= <?php echo substr($old[6], 6) ?>  />
           <input class="w3-container  w3-opacity" type="text" name="tstep" placeholder=" Time Step" value= <?php echo substr($old[7], 6) ?>  /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="respo" placeholder="Responsible Party" value= <?php echo substr($old[8], 6) ?>  />
           <input class="w3-container  w3-opacity" type="text" name="metad" placeholder="Metadata Stamp" value= <?php echo substr($old[9], 6) ?>  /></p>
        <p><b>Station: </b></p>  
        <p><input class="w3-container w3-red w3-opacity" type="text" name="sname" placeholder="Name" value= <?php echo substr($old[10], 6) ?>  />
           <input class="w3-container  w3-opacity" type="text" name="River" placeholder="River system" value= <?php echo substr($old[11], 6) ?>  /></p>
        <p><input class="w3-container w3-red  w3-opacity" type="text" name="Latcr" placeholder="Latitude" value= <?php echo substr($old[12], 6) ?>  />
           <input class="w3-container w3-red w3-opacity" type="text" name="Loncr" placeholder="Longitude"value= <?php echo substr($old[13], 6) ?>  /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="utmzn" placeholder="UTM Zone" value= <?php echo substr($old[14], 6) ?>  />
           <input class="w3-container  w3-opacity" type="text" name="eleva" placeholder="Elevation" value= <?php echo substr($old[15], 6) ?>  /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="yearE" placeholder="Year of est." value= <?php echo substr($old[16], 6) ?>  />
           <input class="w3-container  w3-opacity" type="text" name="yearC" placeholder="Year of Closing" value= <?php echo substr($old[17], 6) ?>  /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="rarea" placeholder="Represented Area (sqkm)"value= <?php echo substr($old[18], 6) ?>  />
            <input class="w3-container  w3-opacity" type="text" name="statd" placeholder="Station Description" value= <?php echo substr($old[19], 6) ?>  /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="respp" placeholder="Responsible Party" value= <?php echo substr($old[20], 6) ?>  /></p>                 
         <input class="w3-button w3-red w3-medium w3-margin-top" type="submit" name="act" value="CHANGE"></p><br>
         </form></div></div> </div>
    <br>
        <?php }
    } ?>
      
      </body>
    
<?php
}
include_once 'footer.php';
?>
  </html>