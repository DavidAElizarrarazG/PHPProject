<?php include 'header.php'; ?>
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
$ChefEmail = $_POST["chefemail"];
$ImageURL = $_POST["imageurl"];

$sql = "INSERT INTO contacts (Name, ChefEmail, ImageURL)
VALUES ('" . $Name . "', '" . $ChefEmail . "', '" . $ImageURL . "')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<?php include 'footer.php'; ?>
