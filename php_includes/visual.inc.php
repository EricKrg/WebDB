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
    $xmin = min($xdata);
    //data type
    $type = mysqli_query($conn, "SELECT DISTINCT data_type FROM `climate_data` WHERE `time_id` = '$data_id[0]'");
    $type_d = mysqli_fetch_assoc($type);
    $data_type =  $type_d['data_type']; 

//stat parameter
    function variance($array,$mean){
        foreach($array as $item){
            $tmp[] = pow(($item - $mean),2);
        }
        $s = array_sum($tmp)/count($array);
        return $s;
    }
    function quan($array, $x){
        sort($array);
        $length= count($array); 
        $q1 = $length * $x;  
        return $array[round($q1)-1];      
  }
    function Stand_Deviation($arr)
    {
        $num_of_elements = count($arr);
         
        $variance = 0.0;
         
                // calculating mean using array_sum() method
        $average = array_sum($arr)/$num_of_elements;
         
        foreach($arr as $i)
        {
            // sum of squares of differences between 
                        // all numbers and means.
            $variance += pow(($i - $average), 2);
        }
         
        return (float)sqrt($variance/$num_of_elements);
    }
     
    $a = array_filter($ydata);
    
    $mean = array_sum($a)/count($a);
    $min = min($a);
    $max = max($a);
    $R = $max - $min;
    $s = variance($a, $mean);
    $x2 = 0.25;
    $x25 = quan($a, $x2);
    $x5 = 0.5;
    $x50 = quan($a, $x5);
    $x7 = 0.75;
    $x75 = quan($a, $x7);
    $sd = Stand_Deviation($a);
   
//graph plotting
    $graph = new Graph(1024, 720, "auto");
    $graph->SetScale("intint");

// Linie generieren
    $lineplot = new LinePlot($ydata);

// Linie zur Grafik hinzufügen
    $graph->Add($lineplot);

// Grafik Formatieren
    //$graph->img->SetMargin(40, 20, 20, 40);
    $graph->title->Set("Plot of: ".$data_id[0]." Datatype: ".$data_type);
    $graph->title->SetFont(FF_ARIAL,FS_BOLD,16);
    
    $graph->xaxis->title->Set("X-Axis: Year "."| Y-Axis: ".$data_type);
    $graph->xaxis->title->SetFont(FF_ARIAL,FS_NORMAL,14);
    $graph->xaxis->SetTitleMargin(65);
    $graph->xaxis->SetTickLabels($xdata);
    $graph->xaxis->SetLabelAngle(90);
    $graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,14);
    
    
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
<body>
    <div class="w3-green">
<h5><b> Data analysis of Time series:</b> <?php echo $data_id[0]. "<b> Data type: </b>". $data_type ?> </h5>    
    </div>
 <div id="scroll" class="w3-panel">
     
    <div class="w3-row-padding w3-padding-32" style="margin:5 -16px">
      <div class="w3-twothird">
    <img src='mygraph.png' style="width:100%" alt='my graph' />
    </div>

<div class="w3-third">
<table id = "table" class="w3-table w3-striped w3-white w3-padding-32" >
  <tr>
    <th>Stat. Parameter</th>
    <th>Value</th>
  </tr>
  <tr>
    <td>Mean</td>
    <td><?php echo round($mean,3); ?></td>
  </tr>
  <tr>
    <td>Min.</td>
    <td><?php echo round($min,3) ?></td>
  </tr>
  <tr>
    <td>Max.</td>
    <td><?php echo round($max,3) ?></td>
  </tr>
  <tr>
    <td>Range</td>
    <td><?php echo round($R,3) ?></td>
  </tr>
  <tr>
    <td>Variance</td>
    <td><?php echo round($s,3) ?></td>
  </tr>
  <tr>
    <td>Standard deviation</td>
    <td><?php echo round($sd,3) ?></td>
  </tr>
  <tr>
    <td>quantile .25</td>
    <td><?php echo round($x25,3) ?></td>
  </tr>
  <tr>
    <td>quantile .5 / Median</td>
    <td><?php echo round($x50,3) ?></td>
  </tr>
  <tr>
    <td>quantile .75</td>
    <td><?php echo round($x75,3) ?></td>
  </tr>
</table>     
        </div>
    </div>
 </div>
<?php echo '<form action = "../visual.php" method = "POST">' ?>
<button class ="w3-button w3-grey " type = "submit" name = "submit">Back</button></form>
</body>        
<?php
include_once '../footer.php';
?>

