<?php 
// Database credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "facerec";

// Create connection
$cn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($cn->connect_error) {
  die("Connection failed: " . $cn->connect_error);
}
?>