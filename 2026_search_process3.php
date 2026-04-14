<?php include 'header.php'; ?>
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

$sql = "SELECT Name, ChefEmail, ImageURL FROM contacts WHERE Name = ?";

// Prepare the SQL query template
if($stmt = $conn->prepare($sql)) {
  // Bind parameters
  $stmt->bind_param("s", $Name);

  // Set parameters and execute
  $Name = $_GET["name"];
  
  if($stmt->execute()){
	$result = $stmt->get_result();
	echo "<div class='table-container'><table>";
	echo '<tr><td>Name</td><td>ChefEmail</td><td>ImageURL</td></tr>';
	
	while($row = $result->fetch_assoc()){
		echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["ChefEmail"] . "</td><td><img src=\"" . $row["ImageURL"] . "\" class=\"food-img\" alt=\"Food Image\"></td></tr>";
	}
	
	echo "</table></div>";
  }
} else {
  echo "Error";
}

$stmt->close();
$conn->close();
?>
<?php include 'footer.php'; ?>
