<?php include 'header.php'; ?>
<!--2026_delete_process.php-->

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

// SQL query template
$sql = "DELETE FROM Foods WHERE FoodID = ?";

// Prepare the SQL query template
if($stmt = $conn->prepare($sql)) {
  // Bind parameters
  $stmt->bind_param("i", $FoodID);

  // Set parameters and execute
  $FoodID = $_POST["FoodID"];

  if($stmt->execute()){
    echo '<div class="page-header"><h1><span class="gradient-text">Deleted</span></h1></div>';
    echo '<div class="msg-success">✅ Food item has been permanently deleted.</div>';
  }else{
    echo '<div class="page-header"><h1>Error</h1></div>';
    echo '<div class="msg-error">⚠️ Food not found or could not be deleted.</div>';
  }
} else {
  echo '<div class="msg-error">⚠️ Error: ' . $conn->error . '</div>';
}

$stmt->close();
$conn->close();
?>

<div class="action-links">
    <a href="2026_delete.php">🗑️ Delete Another</a>
    <span class="separator">·</span>
    <a href="2026_menu.php">← Back to Dashboard</a>
</div>

<?php include 'footer.php'; ?>
