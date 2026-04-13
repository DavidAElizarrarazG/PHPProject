<?php
$servername = "localhost";
$username = "user2025";
$password = "user2025";
$dbname = "kashi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$Name = $_POST["name"];
$Email = $_POST["email"];
$Phone = $_POST["phone"];

$sql = "INSERT INTO contacts (Name, Email, Phone)
VALUES ('" . $Name . "', '" . $Email . "', '" . $Phone . "')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>