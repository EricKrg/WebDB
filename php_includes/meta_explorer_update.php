<?php
include_once '../header_new.php';
?>

       <?php if(!empty($_POST['act'])){ ?>
           
           <div class="w3-container w3-red w3-left">
                    <?php print "changed Meta data of: ".$_POST['file_name'] ;?></div>
 <?php echo '<form action = "../meta_explorer.php" method = "POST">' ?>
                    <button class ="w3-button w3-grey " type = "submit" name = "submit">Back</button></form>
                    
    <?php

            $save =  $_POST['file_name'];
            $fname_m = substr($save, 5);
            $meta_file = fopen($save , "w");
            $var = array('DataT','Descr','rstat','rdesc','start','enddt','naval',
                        'tstep','respo','metad', 'sname','River', 'Latcr', 'Loncr','utmzn','eleva',
                        'yearE','yearC','rarea','statd','respp');
            foreach ($var as $value){
                $txt = $value.": ".$_POST[$value]."\n";
                fwrite($meta_file, $txt);
                $meta[] = substr($txt,6);
                }
            $col_var = implode(", ", $var);
            $col_var = "Data_name, ".$col_var;
                    
            $row_val = implode("', '", $meta);
            $row_val = "$fname_m', '".$row_val;
            include 'db_connect.inc.php';
            mysqli_query($conn,"DELETE FROM meta_data WHERE `Data_name` = '$fname_m'");
            $meta_update = "INSERT INTO meta_data ($col_var) VALUES ('$row_val')";
            mysqli_query($conn, $meta_update);
            mysqli_close($conn);


            fclose($meta_file);  
            rename($save, "../UP_DATA/meta/".$save);      
            
    } 
     ?>
<?php
include_once '../footer.php';
?>
      