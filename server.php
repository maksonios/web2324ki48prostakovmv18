<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $text = $_POST["text"];

    if ($email) {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, text) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $text);

        if ($stmt->execute()) {
            echo "Success";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid email";
    }
}

$conn->close();
?>