<?php
//script for time series analysis (just descr. stats) and plotting 
include 'db_connect.inc.php';
//include all jpgraph dependencies
include_once '../jpgraph-4.2.0/src/jpgraph.php';
include_once '../jpgraph-4.2.0/src/jpgraph_line.php';
include_once '../jpgraph-4.2.0/src/jpgraph_plotline.php';
include_once '../jpgraph-4.2.0/src/jpgraph_legend.inc.php';
    //DB queries to extract values from db -------------------------------------
    preg_match('([0-9]+)', $_POST['visual_file'], $match); //filter the time series id for query
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

//stat functions----------------------------------------------------------------
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
    // stat values--------------------------------------------------------------
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
   
//graph plotting----------------------------------------------------------------
    $graph = new Graph(1024, 720, "auto");
    $graph->SetScale("intint");

// Linie generieren
    $lineplot = new LinePlot($ydata);
    $mean_line = new PlotLine(HORIZONTAL,$mean,"orange",2);
    $median_line = new PlotLine(HORIZONTAL,$x50,"red",2);
// Linie zur Grafik hinzufügen
    $graph->Add($lineplot);
    $graph->AddLine($mean_line); 
    $graph->AddLine($median_line); 

// ADD legend
    $mean_line->SetLegend("Mean");
    $median_line->SetLegend("Median");
    $graph->legend->SetLayout(LEGEND_HOR);
    $graph->legend->Pos(0.4,0.99,"center","bottom");
    $graph->legend->SetFont(FF_ARIAL,FS_NORMAL,14);
    $graph->legend->SetLineWeight(4);
    

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
    @unlink("mygraph2.png");
   $graph->Stroke("mygraph2.png");
?>
