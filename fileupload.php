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
        <h1 class="w3-margin w3-jumbo"><font size="6">Data Upload</h1></font>
    </header>
        <div class="w3-row-padding w3-black w3-container">
            <div class="w3-content">
                <div class="w3-twothird">
                    <h5> Fill in the Meta-data and upload your data file: </h5> </div>
            </div>
        </div>
        <form enctype="multipart/form-data" action="fileupload.php" method="post">
      <p> <input class="w3-container w3-left w3-opacity" type="text" name="Date" value="Date" />
          <input class="w3-container w3-left w3-opacity" type="text" name="User" value="User Name" /></p><br>
      <p><input class="w3-container w3-left w3-opacity" type="text" name="Dataset" value="Dataset Name" />
          <input class="w3-container w3-left w3-opacity" type="text" name="Time" value="Time series id" /></p><br>
      <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
      <p><input class="w3-button w3-black w3-medium w3-margin-top"  name="userfile" type="file">
          <input class="w3-button w3-black w3-medium w3-margin-top" type="submit" name="submit" value="Send File"></p><br>
        </form>
    
    <br>
    

        <?php
        if (isset($_POST['submit'])) {
                $uploaddir = "UP_DATA/";
                $tmpfile = $_FILES['userfile']['tmp_name'];
                

                
            if (pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION) != 'txt') { ?>  
                <div class="w3-container w3-red w3-left">
                <?php print "File is not valid. Only txt-files allowed"; ?> </div> 
                    <?php
            } else { 
                if ($_POST['Date'] == 'Date'){ ?>
                    <div class="w3-container w3-red w3-left">
                    <?php print "no Date";?></div> <?php
                 } if ($_POST['User'] == 'User Name'){ ?>
                    <div class="w3-container w3-red w3-left">
                    <?php print "no User Name";?></div> <?php
                     
                 } if ($_POST['Dataset'] == 'Dataset Name'){ ?>
                    <div class="w3-container w3-red w3-left">
                    <?php print "no Dataset name";?></div> <?php
                     
                 } if ($_POST['Time'] == 'Time series id'){ ?>
                    <div class="w3-container w3-red w3-left">
                    <?php print "no Time series id";?></div> <?php
                 }
                 else { ?>
                    <div class="w3-container w3-green w3-left">
                    <?php print "File is valid.";
                    $newpath = $uploaddir . $_FILES['userfile']['name'];
                    move_uploaded_file($tmpfile, $newpath);?> </div>
                    <div class="w3-container w3-yellow w3-left"> <?php echo "moved to $newpath"; ?> </div>
                 <?php 
                    $meta_file = fopen($_FILES['userfile']['name'] , "w");
                    $meta_path = "UP_DATA/meta/";
                    $var = array('Date', 'User', 'Dataset','Time');
                    foreach ($var as $value){
                    $txt = $value.": ".$_POST[$value]."\n";
                    fwrite($meta_file, $txt);
                    }
                    fclose($meta_file);  
                    rename($_FILES['userfile']['name'], 
                            "UP_DATA/meta/"."meta_".$_FILES['userfile']['name']);
                            
                 }
            }
        }  else { ?>
                <div class="w3-container w3-red w3-left">
                <?php print "Upload is Empty";?> </div><?php
            }   
        ?>  
            
    </body>
    <!-- Footer -->
    <footer class="w3-container w3-padding-64 w3-center w3-opacity">  
        <div class="w3-xlarge w3-padding-32"></div>
        <p>Authors: Luise Treumer, Eric Krueger</p>
    </footer>
</html>