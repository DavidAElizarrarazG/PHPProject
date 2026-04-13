<!--2026_delete_process.php-->

<?php
$servername = "db";
$username = "user2025";
$password = "user2025";
$dbname = "kashi";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL query template
$sql = "DELETE FROM Employees WHERE EmployeeID = ?";

// Prepare the SQL query template
if($stmt = $conn->prepare($sql)) {
  // Bind parameters
  $stmt->bind_param("i", $EmployeeID);

  // Set parameters and execute
  $EmployeeID = $_POST["EmployeeID"];

  if($stmt->execute()){
	echo "Employee deleted successfully.";
  }else{
	  echo "Employee not found.";
  }
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
<br><br>
<a href="2026_delete.php">Delete Another</a> |
<a href="2026_menu.html">Back to Menu</a>