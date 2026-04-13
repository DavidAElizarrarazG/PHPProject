<!--2026_delete_search.php-->

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
$sql = "SELECT * FROM Employees WHERE FirstName = ?";

// Prepare the SQL query template
if($stmt = $conn->prepare($sql)) {
  // Bind parameters
  $stmt->bind_param("s", $FirstName);

  // Set parameters and execute
  $FirstName = $_POST["firstname"];

  if($stmt->execute()){
	$result = $stmt->get_result();

	if($row = $result->fetch_assoc()){
		echo "<h1>Delete Employee</h1>";
		echo '<table border=1>';
		echo '<tr><td>ID</td><td>First Name</td><td>Last Name</td><td>Email</td><td>Phone</td><td>Department</td><td>Gender</td><td>Skills</td><td>Bio</td><td>Hire Date</td><td>Salary</td><td>Status</td></tr>';
		echo "<tr>";
		echo "<td>" . $row["EmployeeID"] . "</td>";
		echo "<td>" . $row["FirstName"] . "</td>";
		echo "<td>" . $row["LastName"] . "</td>";
		echo "<td>" . $row["Email"] . "</td>";
		echo "<td>" . $row["Phone"] . "</td>";
		echo "<td>" . $row["Department"] . "</td>";
		echo "<td>" . $row["Gender"] . "</td>";
		echo "<td>" . $row["Skills"] . "</td>";
		echo "<td>" . $row["Bio"] . "</td>";
		echo "<td>" . $row["HireDate"] . "</td>";
		echo "<td>" . $row["Salary"] . "</td>";
		echo "<td>" . $row["Status"] . "</td>";
		echo "</tr>";
		echo "</table>";
	}

	?>

		<form action="2026_delete_process.php" method="post">
			Are you sure you want to delete this employee?<br><br>
			<input type="hidden" name="EmployeeID" value="<?php echo $row["EmployeeID"]?>">
			<input type="submit" value="Delete">
		</form>

	<?php

  }
} else {
  echo "Error";
}

$stmt->close();
$conn->close();
?>
<br>
<a href="2026_menu.html">Back to Menu</a>