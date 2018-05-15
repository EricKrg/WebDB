<?php
include_once '../header_new.php';
include 'db_connect.inc.php';
include_once '../jpgraph-4.2.0/src/jpgraph.php';
include_once '../jpgraph-4.2.0/src/jpgraph_line.php';


if(!empty($_POST['visual_b'])){ 
    preg_match('([0-9]+)', $_POST['visual_file'], $match);
    $data_id = $match;
    //climate data
    $result = mysqli_query($conn, "SELECT climate_value FROM `climate_data` WHERE `time_id` = '$data_id[0]'");
    $ydata = array();
    while(($row = mysqli_fetch_assoc($result))) {
        $ydata[] = $row['climate_value'];
    }
    // time stamp
    $result_time = mysqli_query($conn, "SELECT datestamp FROM `climate_data` WHERE `time_id` = '$data_id[0]'");
    $xdata = array();
    while(($row = mysqli_fetch_assoc($result_time))) {
        $xdata[] = substr($row['datestamp'],0,4);
    }
    $xmax = max($xdata);
    
    //data type
    $type = mysqli_query($conn, "SELECT DISTINCT data_type FROM `climate_data` WHERE `time_id` = '$data_id[0]'");
    $type_d = mysqli_fetch_assoc($type);
    $data_type =  $type_d['data_type']; 

//graph plotting
    $graph = new Graph(600, 400, "auto");
    $graph->SetScale("intlin");

// Linie generieren
    $lineplot = new LinePlot($ydata);

// Linie zur Grafik hinzufügen
    $graph->Add($lineplot);

// Grafik Formatieren
    //$graph->img->SetMargin(40, 20, 20, 40);
    $graph->title->Set("Plot of: ".$data_id[0]." Datatype: ".$data_type);
    $graph->xaxis->title->Set("X-Axis: Year");
    $graph->xaxis->SetTickLabels($xdata);
    
    $graph->yaxis->title->Set("Y-Axis: ".$data_type);

    $lineplot->SetColor("blue");
    $lineplot->SetWeight(2);

    $graph->yaxis->SetColor("red");
    $graph->yaxis->SetWeight(2);
    $graph->SetShadow();

// Grafik anzeigen
    @unlink("mygraph.png");
    $graph->Stroke('mygraph.png');
   
} 
?>
<div class ="w3-center w3-padding-32">
<img src='mygraph.png' alt='my graph' />
</div>
<?php echo '<form action = "../visual.php" method = "POST">' ?>
<button class ="w3-button w3-grey " type = "submit" name = "submit">Back</button></form>
        
<?php
include_once '../footer.php';
?>

