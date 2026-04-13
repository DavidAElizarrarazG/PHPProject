<!--2026_modify_search.php-->

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
		echo "<h1>Modify Employee: " . $row["FirstName"] . " " . $row["LastName"] . "</h1>";

		// Show current data in a table
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

		// Parse current skills into array for checkbox pre-selection
		$currentSkills = explode(", ", $row["Skills"]);

		?>

		<h2>Edit Employee Details</h2>
		<form action="2026_modify_process.php" method="post">

		<!-- Hidden field to identify the record -->
		<input type="hidden" name="EmployeeID" value="<?php echo $row["EmployeeID"]?>">

		First Name: <input type="text" name="firstname" value="<?php echo $row["FirstName"]?>"><br><br>

		Last Name: <input type="text" name="lastname" value="<?php echo $row["LastName"]?>"><br><br>

		E-mail: <input type="email" name="email" value="<?php echo $row["Email"]?>"><br><br>

		Phone: <input type="tel" name="phone" value="<?php echo $row["Phone"]?>"><br><br>

		<!-- SELECT control -->
		Department:
		<select name="department">
			<option value="HR" <?php if($row["Department"]=="HR") echo "selected";?>>HR</option>
			<option value="IT" <?php if($row["Department"]=="IT") echo "selected";?>>IT</option>
			<option value="Sales" <?php if($row["Department"]=="Sales") echo "selected";?>>Sales</option>
			<option value="Marketing" <?php if($row["Department"]=="Marketing") echo "selected";?>>Marketing</option>
			<option value="Finance" <?php if($row["Department"]=="Finance") echo "selected";?>>Finance</option>
		</select><br><br>

		<!-- RADIO BUTTON set -->
		Gender:
		<input type="radio" name="gender" value="Male" <?php if($row["Gender"]=="Male") echo "checked";?>> Male
		<input type="radio" name="gender" value="Female" <?php if($row["Gender"]=="Female") echo "checked";?>> Female
		<input type="radio" name="gender" value="Other" <?php if($row["Gender"]=="Other") echo "checked";?>> Other<br><br>

		<!-- CHECKBOX set -->
		Skills:<br>
		<input type="checkbox" name="skills[]" value="PHP" <?php if(in_array("PHP", $currentSkills)) echo "checked";?>> PHP
		<input type="checkbox" name="skills[]" value="MySQL" <?php if(in_array("MySQL", $currentSkills)) echo "checked";?>> MySQL
		<input type="checkbox" name="skills[]" value="JavaScript" <?php if(in_array("JavaScript", $currentSkills)) echo "checked";?>> JavaScript
		<input type="checkbox" name="skills[]" value="HTML/CSS" <?php if(in_array("HTML/CSS", $currentSkills)) echo "checked";?>> HTML/CSS
		<input type="checkbox" name="skills[]" value="Python" <?php if(in_array("Python", $currentSkills)) echo "checked";?>> Python<br><br>

		<!-- TEXTAREA control -->
		Bio:<br>
		<textarea name="bio" rows="4" cols="50"><?php echo $row["Bio"]?></textarea><br><br>

		<!-- DATE control -->
		Hire Date: <input type="date" name="hiredate" value="<?php echo $row["HireDate"]?>"><br><br>

		Salary: <input type="number" name="salary" step="0.01" value="<?php echo $row["Salary"]?>"><br><br>

		<!-- SELECT control -->
		Status:
		<select name="status">
			<option value="Active" <?php if($row["Status"]=="Active") echo "selected";?>>Active</option>
			<option value="Inactive" <?php if($row["Status"]=="Inactive") echo "selected";?>>Inactive</option>
			<option value="On Leave" <?php if($row["Status"]=="On Leave") echo "selected";?>>On Leave</option>
		</select><br><br>

		<input type="submit" value="Update Employee">
		</form>

	<?php
	}else{
		echo "Employee not found.";
	}
  }
} else {
  echo "Error";
}

$stmt->close();
$conn->close();
?>
<br>
<a href="2026_menu.html">Back to Menu</a>