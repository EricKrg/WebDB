<?php

include_once 'db_connect.inc.php';
if (!isset($_POST['cbox'])) {
     echo "No results.";   
    } else {
    
    // separate retrieved arrays
    $userid = implode(",", $_POST['cbox']);
    //print for testing
    //print_r($userid);
    // do query based on checkboxes
    $sql = "SELECT * FROM person WHERE id IN ($userid)  "; //$userid
    // Query ausführen
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        exit("Abfrage fehlgeschlagen: " . mysqli_error($conn));
    }
    // Anzahl der Ergebnis-Tupel abfragen und ablaufen
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p>User ID " . $row["id"] . ": " . "<br>"
            . "Name: " . $row["firstname"]
            . " " . $row["lastname"] . "<br>"
            . "Status: " . $row["status"] . "<br>"
            . "Address: " . $row["street"] . " " . $row["hnr"] . ", "
            . $row["postcode"] . " "
            . $row["town"] . "<br>"
            . "Country: " . $row["country"] . "<br>"
            . "E-mail: " . $row["email"] . "<br>"
            . "Phone: " . $row["phone"] . "<br>"
            . "Login: " . $row["login"] . "<br></p>";
        }
    }
    mysqli_close($conn);
    exit();}


  
/*
 if (isset($_POST['show'])) {
     
    include_once 'db_connect.inc.php'; 
  
 // SQL query
$sql = "DELETE FROM person WHERE id=?";
 
// Statement (Abfrage) erzeugen
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
 
if (!$stmt) {
    exit("Abfrage fehlgeschlagen: " . mysql_error());
}
 
// Statement ausführen
mysqli_stmt_execute($stmt);
 */
  
 /* FUNKTIONIERT 
if (isset($_POST['show'])) {
     
    include_once 'db_connect.inc.php'; 
 // SQL query
  $sql = "SELECT * FROM person";
  // Query ausführen
  $result = mysqli_query($conn, $sql);
  if (!$result) {
  exit("Abfrage fehlgeschlagen: " . mysqli_error($conn));
  }
  // Anzahl der Ergebnis-Tupel abfragen und ablaufen
  if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
  echo "<p>User ID " .  $row["id"] . ": ". "<br>"
         . "Name: " . $row["firstname"] 
         . " " . $row["lastname"] . "<br>" 
         . "E-mail: " . $row["email"] . "<br>"
         . "Login: " . $row["login"] . "<br></p>";
   
  }
  } else {
  echo "0 Ergebnisse";
  }
}
 
 */