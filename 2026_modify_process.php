<?php include 'header.php'; ?>
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
  die("<div class='msg-error'>⚠️ Connection failed: " . $conn->connect_error . "</div>");
}

// Get POST values
$FoodID = $_POST["FoodID"];
$FoodName = $_POST["foodname"];
$Origin = $_POST["origin"];
$ChefEmail = $_POST["chefemail"];
$ImageURL = $_POST["imageurl"];
$Category = $_POST["category"];
$SpicyLevel = $_POST["spicylevel"];

// Checkboxes come as an array, join them with commas
if(isset($_POST["dietarytags"])) {
  $DietaryTags = implode(", ", $_POST["dietarytags"]);
} else {
  $DietaryTags = "";
}

$Description = $_POST["description"];
$DateAdded = empty($_POST["dateadded"]) ? date("Y-m-d") : $_POST["dateadded"];
$Price = $_POST["price"];
$Availability = $_POST["availability"];

// SQL UPDATE query template
$sql = "UPDATE Foods SET FoodName=?, Origin=?, ChefEmail=?, ImageURL=?, Category=?, SpicyLevel=?, DietaryTags=?, Description=?, DateAdded=?, Price=?, Availability=? WHERE FoodID=?";

// Prepare the SQL query template
if($stmt = $conn->prepare($sql)) {
  // Bind parameters (11 fields + 1 WHERE)
  $stmt->bind_param("sssssssssdsi", $FoodName, $Origin, $ChefEmail, $ImageURL, $Category, $SpicyLevel, $DietaryTags, $Description, $DateAdded, $Price, $Availability, $FoodID);

  if($stmt->execute()){
    echo '<div class="page-header"><h1><span class="gradient-text">Updated!</span></h1></div>';
    echo '<div class="msg-success">✅ <strong>' . htmlspecialchars($FoodName) . '</strong> (' . htmlspecialchars($Origin) . ') has been updated successfully.</div>';
  }else{
    echo '<div class="page-header"><h1>Error</h1></div>';
    echo '<div class="msg-error">⚠️ Error updating food.</div>';
  }
} else {
  echo '<div class="msg-error">⚠️ Error: ' . $conn->error . '</div>';
}

$stmt->close();
$conn->close();
?>

<div class="action-links">
    <a href="2026_modify.php">✏️ Modify Another</a>
    <span class="separator">·</span>
    <a href="2026_menu.php">← Back to Dashboard</a>
</div>

<?php include 'footer.php'; ?>
