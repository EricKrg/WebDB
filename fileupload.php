<?php
//form for user file upload --> file selection and meta data input
include_once 'header_new.php';
if (isset($_SESSION['u_id'])) {  //check if user is logged in 
?>
<body>

    <header class="w3-container w3-green w3-center w3-medium" style="padding:20px 16px">
        <h1 class="w3-margin w3-jumbo"><font size="6">Data Upload</h1></font>
    </header>
   
        <div id ="scroll" class="w3-container w3-center"><b>Fill in the Meta-data and upload your data file: </b>
            <form enctype="multipart/form-data" action="/php_includes/upload.php" method="post">  <!-- to upload include function !-->
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
         <input class="w3-button w3-black w3-medium w3-margin-top" type="submit" name="submit_d" value="Send File"></p><br>
      </form></div>

        </div> 
    </body>
    <!-- Footer -->
    
<?php
}
include_once 'footer.php';
?>
</html>
