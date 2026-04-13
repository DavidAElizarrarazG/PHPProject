<!--2026_search_process3.php-->

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

// SQL query template

$sql = "SELECT Name, Email, Phone FROM contacts WHERE Name = ?";

// Prepare the SQL query template
if($stmt = $conn->prepare($sql)) {
  // Bind parameters
  $stmt->bind_param("s", $Name);

  // Set parameters and execute
  $Name = $_GET["name"];
  
  if($stmt->execute()){
	$result = $stmt->get_result();
	echo '<table border=1>';
	echo '<tr><td>Name</td><td>Email</td><td>Phone</td></tr>';
	
	while($row = $result->fetch_assoc()){
		echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["Phone"] . "</td></tr>";
	}
	
	echo "</table>";
  }
} else {
  echo "Error";
}

$stmt->close();
$conn->close();
?>