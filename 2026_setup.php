<?php include 'header.php'; ?>

<div class="page-header">
    <h1><span class="gradient-text">Database Setup</span></h1>
    <p>Initializing the Foods table…</p>
</div>

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

// Create Foods table
$sql = "CREATE TABLE IF NOT EXISTS Foods (
  FoodID INT AUTO_INCREMENT PRIMARY KEY,
  FoodName VARCHAR(100) NOT NULL,
  Origin VARCHAR(100) NOT NULL,
  ChefEmail VARCHAR(150),
  ImageURL VARCHAR(255),
  Category VARCHAR(50),
  SpicyLevel VARCHAR(10),
  DietaryTags VARCHAR(255),
  Description TEXT,
  DateAdded DATE,
  Price DECIMAL(10,2),
  Availability VARCHAR(20)
)";

if ($conn->query($sql) === TRUE) {
  echo '<div class="msg-success">✅ Table <strong>Foods</strong> created successfully!</div>';
} else {
  echo '<div class="msg-error">⚠️ Error creating table: ' . $conn->error . '</div>';
}

$conn->close();
?>

<div class="action-links">
    <a href="2026_menu.php">← Go to Dashboard</a>
    <span class="separator">·</span>
    <a href="2026_create.php">➕ Add Your First Food</a>
</div>

<?php include 'footer.php'; ?>
