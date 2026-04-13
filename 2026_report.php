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

echo "<h1>Employee Report</h1>";

$sql = "SELECT * FROM Employees";
$result = $conn->query($sql);

if ($result->num_rows > 0){
	echo '<table border=1>';
	echo '<tr><td>ID</td><td>First Name</td><td>Last Name</td><td>Email</td><td>Phone</td><td>Department</td><td>Gender</td><td>Skills</td><td>Bio</td><td>Hire Date</td><td>Salary</td><td>Status</td></tr>';

	while($row = $result->fetch_assoc()){
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
	}

	echo "</table>";
}else{
	echo "No employees found.";
}

$conn->close();
?>
<br><br>
<a href="2026_menu.html">Back to Menu</a>