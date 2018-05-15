<?php

// define variables for connecting to the data base
$dbServername = "localhost";
$dbUsername = "webdb_user";
$dbPassword = "password";
$dbName = "webdb";
// connect to data base
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
// show an error if connection fails
if (!$conn) {
    echo "error connecting to database: ", mysqli_connect_error();
    exit();
}

// set charset for data base
mysqli_set_charset($conn, "utf8");




