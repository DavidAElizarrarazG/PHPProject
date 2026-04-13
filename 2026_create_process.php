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
$sql = "INSERT INTO Employees (FirstName, LastName, Email, Phone, Department, Gender, Skills, Bio, HireDate, Salary, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the SQL query template
if($stmt = $conn->prepare($sql)) {
  // Bind parameters
  $stmt->bind_param("sssssssssds", $FirstName, $LastName, $Email, $Phone, $Department, $Gender, $Skills, $Bio, $HireDate, $Salary, $Status);

  // Set parameters from POST
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

  $stmt->execute();

  echo "New employee created successfully: " . $FirstName . " " . $LastName;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
<br><br>
<a href="2026_create.html">Create Another</a> |
<a href="2026_menu.html">Back to Menu</a>