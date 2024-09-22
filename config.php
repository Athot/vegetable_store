<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "vegetable_store";

$conn = mysqli_connect($server, $username, $password,$database);
if(!$conn) 
    {die("Error: Unable to connect to the database. " . mysqli_connect_error());
}