<?php
include_once '../header_new.php';
include 'db_connect.inc.php';

if(!empty($_POST['delete'])){ ?>
        <div class="w3-container w3-red w3-center">
                    <?php print "Deleted: ".$_POST['file_name'] ;?></div>
        <?php echo '<form action = "../delete.php" method = "POST">' ?>
         <button class ="w3-button w3-grey " type = "submit" name = "submit">Back</button></form>
                    
    <?php
    // deletes the all txt files - meta & data, as well as the db entry of this time series 
        $file_delete =  $_POST['file_name'];
        preg_match('([0-9]+)', $file_delete, $match);
        //db delete
        $sql = "DELETE FROM climate_data WHERE time_id='$match[0]'";
        mysqli_query($conn, $sql);
        //meta delete
        $sql_meta = "DELETE FROM meta_data WHERE `Data_name`='$file_delete'";
        mysqli_query($conn, $sql_meta);
        //delete data files
        unlink("../UP_DATA/".$file_delete);
        unlink("../UP_DATA/meta/"."meta_".$file_delete);        
        mysqli_close($conn);
    }
include_once '../footer.php';
?>
