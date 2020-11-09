<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
error_reporting(0);
@ini_set('display_errors', 0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bai07";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>