<?php
// Database connection data
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "webdatabase";

$conn = new mysqli($servername, $username, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql_users = "CREATE TABLE IF NOT EXISTS users (
id INT AUTO_INCREMENT PRIMARY KEY,
fullname VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
status VARCHAR(255) NOT NULL
)";

if ($conn->query($sql_users) !== TRUE) {
  echo "Error creating users table: " . $conn->error;
}
?>