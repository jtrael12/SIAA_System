<?php

$servername= "localhost";
$username= "root";
$password = "";
$db_name = "db_project_system";

$conn = mysqli_connect($servername, $username, $password, $db_name) ;

if (!$conn) {
 die("Connection failed: " .$conn->connect_error);
 }
 ?>