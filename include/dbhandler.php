<?php

$servername = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "reader_dbase";

$conn = mysqli_connect($servername, $dbUser, $dbPass, $dbName);

if(!$conn){
    die("Failed Connection: ".mysqli_connect_error());
}
?>