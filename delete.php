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
        <h1 class="w3-margin w3-jumbo"><font size="6">Delete Files</h1></font>
</header>
    <form class="w3-container w3-center w3-center " method="post" action="" name="form">  
        <select class="w3-button w3-grey w3-medium w3-margin-top  w3-center" name="file"><p>
            <option class="w3-button w3-red w3-medium w3-margin-top  w3-center" value="" selected="selected">Select data </option>
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
        <input class="w3-button w3-black w3-medium w3-margin-top" name="submit" type="submit" value="Select"></p>
</form>
    <?php    
    if (empty($_POST['file'])){
        echo "" ;
    } else {
        $meta_select = $_POST['file']; ?>
    <div class="w3-container style="display: inline-block; text-align: left;"><b> Delete the Data of:
                    <form  enctype="multipart/form-data" action="" method="post">
        <input class ="w3-container w3-opacity" size ="35" type="text" name="file_name" value= <?php echo $meta_select ?> readonly/><br>
        <p><input class="w3-button w3-red w3-medium w3-margin-top" name ="delete" type="submit" value="DELETE"></p><br>
                    </form></div></b> <?php
    }
    if(!empty($_POST['delete'])){ ?>
        <div class="w3-container w3-red w3-center">
                    <?php print "Deleted: ".$_POST['file_name'] ;?></div>
    <?php
        $file_delete =  $_POST['file_name'];
        unlink("UP_DATA/".$file_delete);
        unlink("UP_DATA/meta/"."meta_".$file_delete);        

    }
    ?>
      </body>
    <!-- Footer -->
    <footer class="w3-container w3-padding-64 w3-center w3-opacity">  
        <div class="w3-xlarge w3-padding-32"></div>
        <p>Authors: Luise Treumer, Eric Krueger</p>
    </footer>
  </html>