<!--2026_search_process2.php-->

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

$Field = $_POST["Field"];
$Value = $_POST["Value"];


// SQL query template
switch($Field){
	
	case "Name":
		$stmt = $conn->prepare("SELECT Name, Email, Phone FROM contacts WHERE Name = ?");
		$stmt->bind_param("s", $Value);
		break;
		
	case "Email":
		$stmt = $conn->prepare("SELECT Name, Email, Phone FROM contacts WHERE Email = ?");
		$stmt->bind_param("s", $Value);
		break;
		
	case "Phone":
		$stmt = $conn->prepare("SELECT Name, Email, Phone FROM contacts WHERE Phone = ?");
		$stmt->bind_param("i", $Value);
		break;
	
}
  
if($stmt->execute()){
$result = $stmt->get_result();
echo '<table border=1>';
echo '<tr><td>Name</td><td>Email</td><td>Phone</td></tr>';

while($row = $result->fetch_assoc()){
	echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["Phone"] . "</td></tr>";
}

echo "</table>";
}else{
  echo "Error";
}

$stmt->close();
$conn->close();
?>