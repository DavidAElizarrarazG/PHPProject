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

// Create Employees table
$sql = "CREATE TABLE IF NOT EXISTS Employees (
  EmployeeID INT AUTO_INCREMENT PRIMARY KEY,
  FirstName VARCHAR(100) NOT NULL,
  LastName VARCHAR(100) NOT NULL,
  Email VARCHAR(150),
  Phone VARCHAR(20),
  Department VARCHAR(50),
  Gender VARCHAR(10),
  Skills VARCHAR(255),
  Bio TEXT,
  HireDate DATE,
  Salary DECIMAL(10,2),
  Status VARCHAR(20)
)";

if ($conn->query($sql) === TRUE) {
  echo "Table 'Employees' created successfully.<br>";
  echo "<a href='2026_menu.html'>Go to Menu</a>";
} else {
  echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
