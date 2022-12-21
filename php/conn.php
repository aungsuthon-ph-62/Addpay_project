<?php
$host = 'addpaycrypto.com';
$dbname = 'addpay_e_office';
$username = 'addpay_backoffice';
$password = 'ae_2022';

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Set the character set to UTF-8
mysqli_set_charset($conn, "utf8");

