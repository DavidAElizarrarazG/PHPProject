<!--2026_search_process.php-->

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

$Field = $_POST["Field"];
$Value = $_POST["value"];

// Validate the field name to prevent SQL injection
$allowedFields = array("FirstName", "LastName", "Email", "Department", "Status");

if(in_array($Field, $allowedFields)) {
  // SQL query template
  $sql = "SELECT * FROM Employees WHERE $Field = ?";

  // Prepare the SQL query template
  if($stmt = $conn->prepare($sql)) {
    // Bind parameters
    $stmt->bind_param("s", $Value);

    if($stmt->execute()){
      $result = $stmt->get_result();

      if($result->num_rows > 0){
        echo "<h1>Search Results</h1>";
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
        echo "No employees found matching your search.";
      }
    }

    $stmt->close();
  } else {
    echo "Error preparing query.";
  }
} else {
  echo "Invalid search field.";
}

$conn->close();
?>
<br><br>
<a href="2026_search.php">Search Again</a> |
<a href="2026_menu.html">Back to Menu</a>