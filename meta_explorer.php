<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
    .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
    .fa-anchor,.fa-coffee {font-size:200px} // css anlegen 
    </style>
    <body>
    <header class="w3-container w3-green w3-center" style="padding:20px 16px">
        <h1 class="w3-margin w3-jumbo"><font size="6">Meta explorer</h1></font>
</header>
    <form class="w3-container " method="post" action="" name="form">  
        <select class="w3-button w3-grey w3-medium w3-margin-top" name="metafile"><p>
            <option class="w3-button w3-red w3-medium w3-margin-top" value="" selected="selected">Select meta data</option>
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
        ?> <p><div class="w3-container w3-yellow w3-left"> Current Meta data:</div> </p><br><br>
        <?php
        while(!feof($myfile)) {
            $temp = fgets($myfile);
            $old[] = $temp;
            echo $temp."<br>";            
        }

        ?>
        <div class="w3-container"><b>Edit the Data of:<b>
                    <form enctype="multipart/form-data" action="" method="post">
                        <input class ="w3-container w3-opacity" size ="35" type="text" name="file_name" value= <?php echo $meta_select ?> readonly/><br>
                        <p> Date/User: </p>
      <p><input class="w3-container w3-left w3-opacity" type="text" name="Date" value= <?php echo substr($old[0],6) ?> />
          <input class="w3-container w3-left w3-opacity" type="text" name="User" value= <?php echo substr($old[1],6) ?> /></p><br>
      <p>Data set/Time series ID: </p>
      <p><input class="w3-container w3-left w3-opacity" type="text" name="Dataset" value= <?php echo substr($old[2],9) ?> />
         <input class="w3-container w3-left w3-opacity" type="text" name="Time" value=<?php echo substr($old[3],6) ?> /></p><br>
      <p><input class="w3-button w3-red w3-medium w3-margin-top" name ="act" type="submit" value="change"></p><br>
      </div></form>
        <?php }
    }
       if(!empty($_POST['act'])){ ?>
           
           <div class="w3-container w3-red w3-left">
                    <?php print "changed Meta data of: ".$_POST['file_name'] ;?></div>
    <?php

           $save =  $_POST['file_name'];
            $meta_file = fopen($save , "w");
            $var = array('Date', 'User', 'Dataset','Time');
            $i = 0;
            foreach ($var as $value){
                $txt = $value.": ".$_POST[$value]."\n";
                fwrite($meta_file, $txt);
                }

            fclose($meta_file);  
            rename($save, "UP_DATA/meta/".$save);         
    } 
     ?>
      
      
      </body>
    <!-- Footer -->
    <footer class="w3-container w3-padding-64 w3-center w3-opacity">  
        <div class="w3-xlarge w3-padding-32"></div>
        <p>Authors: Luise Treumer, Eric Krueger</p>
    </footer>
  </html>