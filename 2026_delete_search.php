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

$sql = "SELECT * FROM Foods WHERE FoodName = ?";

if($stmt = $conn->prepare($sql)) {
  $stmt->bind_param("s", $FoodName);
  $FoodName = $_POST["foodname"];

  if($stmt->execute()){
    $result = $stmt->get_result();

    if($row = $result->fetch_assoc()){

      echo '<div class="page-header">';
      echo '  <h1><span class="gradient-text">Delete:</span> ' . htmlspecialchars($row["FoodName"]) . '</h1>';
      echo '  <p>Review the record below before confirming deletion.</p>';
      echo '</div>';

      echo '<div class="table-container mb-3"><table>';
      echo '<thead><tr><th>ID</th><th>Food Name</th><th>Origin</th><th>Chef Email</th><th>Image</th><th>Category</th><th>Spicy</th><th>Dietary Tags</th><th>Description</th><th>Date</th><th>Price</th><th>Status</th></tr></thead>';
      echo '<tbody><tr>';
      echo '<td>' . $row["FoodID"] . '</td>';
      echo '<td><strong>' . htmlspecialchars($row["FoodName"]) . '</strong></td>';
      echo '<td><span class="badge badge-violet">' . htmlspecialchars($row["Origin"]) . '</span></td>';
      echo '<td>' . htmlspecialchars($row["ChefEmail"]) . '</td>';
      echo '<td><img src="' . htmlspecialchars($row["ImageURL"]) . '" class="food-img" alt="Food"></td>';
      echo '<td><span class="badge badge-blue">' . htmlspecialchars($row["Category"]) . '</span></td>';
      echo '<td>' . htmlspecialchars($row["SpicyLevel"]) . '</td>';
      echo '<td>' . htmlspecialchars($row["DietaryTags"]) . '</td>';
      echo '<td style="max-width:180px;white-space:normal;font-size:0.85rem;">' . htmlspecialchars($row["Description"]) . '</td>';
      echo '<td>' . $row["DateAdded"] . '</td>';
      echo '<td>$' . $row["Price"] . '</td>';
      echo '<td>' . htmlspecialchars($row["Availability"]) . '</td>';
      echo '</tr></tbody></table></div>';
?>

    <div class="delete-confirm">
        <p>⚠️ Are you sure you want to permanently delete this food item?</p>
        <form action="2026_delete_process.php" method="post" style="display:inline;">
            <input type="hidden" name="FoodID" value="<?php echo $row["FoodID"]?>">
            <input type="submit" value="🗑️ Delete Permanently" class="btn-danger">
        </form>
    </div>

    <?php
    } else {
        echo '<div class="empty-state"><span class="empty-icon">🔍</span><h2>Not Found</h2><p>No food found with that name.</p></div>';
    }
  }
} else {
  echo "<div class='msg-error'>⚠️ Error preparing query.</div>";
}

$stmt->close();
$conn->close();
?>

<div class="action-links">
    <a href="2026_delete.php">Search Again</a>
    <span class="separator">·</span>
    <a href="2026_menu.php">← Back to Dashboard</a>
</div>

<?php include 'footer.php'; ?>
