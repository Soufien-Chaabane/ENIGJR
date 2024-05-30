<?php

// Connection to database
$host = "localhost";
$dbname = "database1";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}