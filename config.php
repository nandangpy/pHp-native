<?php
// Database connection
$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "php_test";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}