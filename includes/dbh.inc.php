<?php
//Establishing connection to the database

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "daps";


$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

//checking if the connection failed
if(!$conn) {
    echo("Connection Failed: " . mysqli_connect_error());
}
