<?php include 'header.php'; ?>
<?php
$servername = "db";
$username = "user2025";
$password = "user2025";
$dbname = "kashi";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("<div class='msg-error'>⚠️ Connection failed: " . $conn->connect_error . "</div>");
}

$sql = "INSERT INTO Foods (FoodName, Origin, ChefEmail, ImageURL, Category, SpicyLevel, DietaryTags, Description, DateAdded, Price, Availability) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if($stmt = $conn->prepare($sql)) {
  $stmt->bind_param("sssssssssds", $FoodName, $Origin, $ChefEmail, $ImageURL, $Category, $SpicyLevel, $DietaryTags, $Description, $DateAdded, $Price, $Availability);

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

  $stmt->execute();

  echo '<div class="page-header">';
  echo '  <h1><span class="gradient-text">Success!</span></h1>';
  echo '</div>';
  echo '<div class="msg-success">✅ <strong>' . htmlspecialchars($FoodName) . '</strong> (' . htmlspecialchars($Origin) . ') has been added successfully.</div>';
} else {
  echo '<div class="page-header"><h1>Error</h1></div>';
  echo '<div class="msg-error">⚠️ Error: ' . $conn->error . '</div>';
}

$stmt->close();
$conn->close();
?>

<div class="action-links">
    <a href="2026_create.php">➕ Create Another</a>
    <span class="separator">·</span>
    <a href="2026_menu.php">← Back to Dashboard</a>
</div>

<?php include 'footer.php'; ?>
