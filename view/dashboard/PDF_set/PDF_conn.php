<?php
$servername = "addpaycrypto.com";
$username = "addpay_backoffice";
$password = "ae_2022";
$dbname = "addpay_e_office";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn,"utf8");
?>
