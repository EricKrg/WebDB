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
   
        <div class="w3-container w3-center"><b>Fill in the Meta-data and upload your data file: </b>
        <form enctype="multipart/form-data" action="fileupload.php" method="post">
            <p><b>Dataset: </b></p>
            <div class="w3-center ">
        <p><input class="w3-container w3-red w3-opacity" type="text" name="DataT" placeholder="Dataset Title" />
           <input class="w3-container  w3-opacity" type="text" name="Descr" placeholder="Description" /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="rstat" placeholder="Reliability Status" />
           <input class="w3-container  w3-opacity" type="text" name="rdesc" placeholder="Reliability Desc." /></p>
        <p><input class="w3-container w3-red  w3-opacity" type="text" name="start" placeholder="Start" />
           <input class="w3-container w3-red w3-opacity" type="text" name="enddt" placeholder="End" /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="naval" placeholder="Value for Missing Data" />
           <input class="w3-container  w3-opacity" type="text" name="tstep" placeholder=" Time Step" /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="respo" placeholder="Responsible Party" />
           <input class="w3-container  w3-opacity" type="text" name="metad" placeholder="Metadata Stamp" /></p>
        <p><b>Station: </b></p>  
        <p><input class="w3-container w3-red w3-opacity" type="text" name="sname" placeholder="Name" />
           <input class="w3-container  w3-opacity" type="text" name="River" placeholder="River system" /></p>
        <p><input class="w3-container w3-red  w3-opacity" type="text" name="Latcr" placeholder="Latitude" />
           <input class="w3-container w3-red w3-opacity" type="text" name="Loncr" placeholder="Longitude" /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="utmzn" placeholder="UTM Zone" />
           <input class="w3-container  w3-opacity" type="text" name="eleva" placeholder="Elevation (m)" /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="yearE" placeholder="year of est." />
           <input class="w3-container  w3-opacity" type="text" name="yearC" placeholder="year of closing" /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="rarea" placeholder="represented Area (sqkm)" />
            <input class="w3-container  w3-opacity" type="text" name="statd" placeholder="Station Description" /></p>
        <p><input class="w3-container  w3-opacity" type="text" name="respp" placeholder="Responsible Party" /></p>                 
        <p><input type="hidden" name="MAX_FILE_SIZE" value="1000000">
         <input class="w3-button w3-black w3-medium w3-margin-top"  name="userfile" type="file">
         <input class="w3-button w3-black w3-medium w3-margin-top" type="submit" name="submit" value="Send File"></p><br>
      </form></div></div>
    <br>
    

        <?php
       
        if (isset($_POST['submit'])) {
                $uploaddir = "UP_DATA/";
                $tmpfile = $_FILES['userfile']['tmp_name'];
         if (pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION) != 'txt') { ?>  
                <div class="w3-container w3-red w3-center">
                <?php print "File is not valid or no File selected. Only txt-files allowed"; ?> </div> 
                    <?php
            } else { 
                if ($_POST['DataT'] == 'Dataset Title' | $_POST['DataT'] == '' ){ ?>
                    <div class="w3-container w3-red">
                    <?php print "no Dataset title";?></div> <?php
                 } if ($_POST['start'] == 'Start'|$_POST['start'] == ''){ ?>
                    <div class="w3-container w3-red ">
                    <?php print "no Start date";?></div> <?php   
                 } if ($_POST['enddt'] == 'End'|$_POST['enddt'] == ''){ ?>
                    <div class="w3-container w3-red ">
                    <?php print "no End date";?></div> <?php
                 } if ($_POST['sname'] == 'Name'| $_POST['sname'] == ''){ ?>
                    <div class="w3-container w3-red ">
                    <?php print "no Station name";?></div> <?php
                 } if ($_POST['Latcr'] == 'Latitude'| $_POST['Latcr'] == ''){ ?>
                    <div class="w3-container w3-red ">
                    <?php print "no Latitude";?></div> <?php
                 } if ($_POST['Loncr'] == 'Longitude'| $_POST['Loncr'] == ''){ ?>
                    <div class="w3-container w3-red ">
                    <?php print "no Longitude";?></div> <?php
                 }
                 else { ?>
                    <div class="w3-container w3-green ">
                    <?php print "File is valid.";
                    $newpath = $uploaddir . $_FILES['userfile']['name'];
                    move_uploaded_file($tmpfile, $newpath);?> </div>
                    <div class="w3-container w3-yellow "> <?php echo "moved to $newpath"; ?> </div>
                 <?php 
                    $meta_file = fopen($_FILES['userfile']['name'] , "w");
                    $meta_path = "UP_DATA/meta/";
                    $var = array('DataT','Descr','rstat','rdesc','start','enddt','naval',
                        'tstep','respo','metad', 'sname','River', 'Latcr', 'Loncr','utmzn','eleva',
                        'yearE','yearC','rarea','statd','respp');
                    $i = 0;
                    foreach ($var as $value){
                        if ($_POST[$value] == ''){
                            $txt = $value.": "."NA"."\n";
                        } else {
                    $txt = $value.": ".$_POST[$value]."\n";
                        }
                    fwrite($meta_file, $txt);
                    $i++;
                    }
                    fclose($meta_file);  
                    rename($_FILES['userfile']['name'], 
                            "UP_DATA/meta/"."meta_".$_FILES['userfile']['name']);                         
                 }
            }
        }  else {  ?>
                <div class="w3-container w3-red w3-center">
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