<?php
//script to display the data analysis results 
include_once '../header_new.php';
if (isset($_SESSION['u_id'])) {
include (dirname(__DIR__).'/php_includes/visual.inc.php'); //includes the script where the calculations happens
?>
<body>
    <div class="w3-green">
<h5><b> Data analysis of Time series:</b> <?php echo $data_id[0]. "<b> Data type: </b>". $data_type ?> </h5>    
    </div>
 <div id="scroll" class="w3-panel">
     <!-- plot img from jpgraph !-->
    <div class="w3-row-padding w3-padding-32" style="margin:5 -16px">
      <div class="w3-twothird">
          <img src="/php_includes/mygraph2.png" style="width:100%" alt='my graph' />
    </div>

        <!-- stats table !-->
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
}
include_once '../footer.php';
?>

