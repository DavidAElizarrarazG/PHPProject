<!--2026_modify_process.php-->

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

// Get POST values
$EmployeeID = $_POST["EmployeeID"];
$FirstName = $_POST["firstname"];
$LastName = $_POST["lastname"];
$Email = $_POST["email"];
$Phone = $_POST["phone"];
$Department = $_POST["department"];
$Gender = $_POST["gender"];

// Checkboxes come as an array, join them with commas
if(isset($_POST["skills"])) {
  $Skills = implode(", ", $_POST["skills"]);
} else {
  $Skills = "";
}

$Bio = $_POST["bio"];
$HireDate = $_POST["hiredate"];
$Salary = $_POST["salary"];
$Status = $_POST["status"];

// SQL UPDATE query template
$sql = "UPDATE Employees SET FirstName=?, LastName=?, Email=?, Phone=?, Department=?, Gender=?, Skills=?, Bio=?, HireDate=?, Salary=?, Status=? WHERE EmployeeID=?";

// Prepare the SQL query template
if($stmt = $conn->prepare($sql)) {
  // Bind parameters (11 fields + 1 WHERE)
  $stmt->bind_param("sssssssssdsi", $FirstName, $LastName, $Email, $Phone, $Department, $Gender, $Skills, $Bio, $HireDate, $Salary, $Status, $EmployeeID);

  if($stmt->execute()){
    echo "Employee " . $FirstName . " " . $LastName . " updated successfully.";
  }else{
    echo "Error updating employee.";
  }
} else {
  echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
<br><br>
<a href="2026_modify.php">Modify Another</a> |
<a href="2026_menu.html">Back to Menu</a>