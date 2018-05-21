<?php
//upload functionalities
include_once '../header_new.php';
    if (isset($_POST['submit_d'])) {
                $uploaddir = "../UP_DATA/"; // set up dir for txt files
                $tmpfile = $_FILES['userfile']['tmp_name'];
   
         if (pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION) != 'txt') { //only txt files are allowed for upload
            ?>  
                <div class="w3-container w3-red w3-center">
                <?php print "File is not valid or no File selected. Only txt-files allowed"; ?> </div> 
                    <?php echo '<form action = "../fileupload.php" method = "POST">' ?>
                    <button class ="w3-button w3-grey " type = "submit" name = "submit">Back</button></form>
                    <?php
    //special cases
    //print out message if required fields are empty            
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
                    // DATA UPLOAD----------------------------------------------
                    $newpath = $uploaddir.$_FILES['userfile']['name'];
                    move_uploaded_file($tmpfile, $newpath);  //upload txt file first
                     ?> </div>
                    <div class="w3-container w3-yellow "> <?php echo "moved to $newpath"; ?> </div>
                        <?php 
                    // DB entry clima values----------------------------------
                    include 'db_connect.inc.php';
                    $myfile = fopen($uploaddir.$_FILES['userfile']['name'], "r") or die("Unable to open file!"); // upload file 
                    $lineNo = 0;
                    $start = 5;
                    $end = 7;
                    // first whlie gets all ids from the data header
                    while($line = fgets($myfile)){
                        $lineNo++;
                        if ($lineNo == 5){
                            //echo substr($line,16)."<br>";
                            $time_id = substr($line,16);
                        }
                        if ($lineNo == 6){
                            //echo substr($line, 13)."<br>";   
                            $meta_id = substr($line,13);
                        }
                        if ($lineNo == $end){
                            //echo substr($line,10)."<br>";
                            $data_type = substr($line,10);
                            $time = 0;
                            break;
                        }
                    }
                    //second while loop extracts actual data
                    while(!feof($myfile)){
                        $line = fgets($myfile);
                        $lineNo++;
                        if ($lineNo > 7){
                            $pieces = explode("\t", $line);
                            if (count($pieces) == 2){ //stops if last line is empty
                            
                            $date = str_replace("-","",$pieces[0]);
                            $value = $pieces[1];
                            // regex filters time stamp with no entry - and signs them as null values
                            preg_match('([0-9]+)',$value);
                            if(!preg_match('([0-9]+)',$value)){
                                $value = NULL;
                                $date = NULL;
                            }
                            if($date == 0){
                                $value = NULL;
                                $date = NULL;
                            }
                            // DB input query executed on each loop iteration -
                            // db table is designed that no double entry of the same time-stamp and time id is possible
                            $sql_update = "INSERT INTO climate_data (time_id,"
                                    . " meta_id,datestamp,timestamp,climate_value,data_type)"
                                    . "VALUES ('$time_id', '$meta_id','$date','$time','$value','$data_type')"; 
                        
                        $result_update = mysqli_query($conn, $sql_update);
                            }
                        }   
                    }
                    mysqli_close($conn);
              
                    //META DATA-------------------------------------------------
                    include 'db_connect.inc.php';
                    $fname = $_FILES['userfile']['name'];  // meta dir 
                    $meta_file = fopen($_FILES['userfile']['name'] , "w");  
                    $meta_path = "../UP_DATA/meta/";
                    $var = array('DataT','Descr','rstat','rdesc','start','enddt','naval',
                        'tstep','respo','metad', 'sname','River', 'Latcr', 'Loncr','utmzn','eleva',
                        'yearE','yearC','rarea','statd','respp'); //all meta variables, listed in array to iterate through them
                    $i = 0;
                    foreach ($var as $value){
                        if (mysqli_real_escape_string($conn, $_POST[$value]) == ''){
                            $txt = $value.": "."NA"."\n"; //if meta data values is empty fill with NA
                        } else {
                    $txt = $value.": ". mysqli_real_escape_string($conn, $_POST[$value]) ."\n";
                        }
                    $meta[] = substr($txt,6);
                    fwrite($meta_file, $txt); //write meta txt file, in case of db problems - the meta data of ech time series is available as txt
                    $i++;
                    }
                    fclose($meta_file);  
                    rename($_FILES['userfile']['name'], 
                            $meta_path."meta_".$_FILES['userfile']['name']); // move meta file
                            
                    // META DATA DB entry---------------------------------------
                    $col_var = implode(", ", $var);
                    $col_var = "Data_name, ".$col_var;
                    // format meta data array for sql query
                    $row_val = implode("', '", $meta);
                    $row_val = "$fname', '".$row_val;
                    
                   
                    //check if meta data is already present and delete the old values
                    $check = mysqli_query($conn, "SELECT * FROM meta_data WHERE `Data_name` = '$fname'");
                    if(mysqli_num_rows($check)>0){
                        mysqli_query($conn,"DELETE FROM meta_data WHERE `Data_name` = '$fname'");
                    }
                    //update new data
                    $meta_update = "INSERT INTO meta_data ($col_var) VALUES ('$row_val')"; //actuall input query
                    mysqli_query($conn, $meta_update);
                    mysqli_close($conn); //close db connection
                     
                    
                    echo '<form action = "../fileupload.php" method = "POST">' ?>
                    <div class ="w3-container w3-light-grey">Time series ID: <?php echo $time_id ?></div>
                    <div class ="w3-container w3-light-grey">Meta Data ID: <?php echo $meta_id ?></div>
                    <div class ="w3-container w3-light-grey">Data type: <?php echo $data_type ?></div>
                    <button class ="w3-button w3-grey " type = "submit" name = "submit">Back</button></form>
                    <?php
                   // upload informations
                 }
            }
        }  else {  ?>
                <div class="w3-container w3-red w3-center">
                <?php print "Upload is Empty";?> </div>
                    <?php echo '<form action = "../fileupload.php" method = "POST">' ?>
                    <button class ="w3-button w3-grey " type = "submit" name = "submit">Back</button></form>
                    <?php

            }               
include_once '../footer.php';
?>
                  

