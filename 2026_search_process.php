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

$Field = $_POST["Field"];
$Value = $_POST["value"];

$allowedFields = array("FoodName", "Origin", "ChefEmail", "Category", "Availability");

if(in_array($Field, $allowedFields)) {
  $sql = "SELECT * FROM Foods WHERE $Field = ?";

  if($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $Value);

    if($stmt->execute()){
      $result = $stmt->get_result();

      if($result->num_rows > 0){
        echo '<div class="page-header">';
        echo '  <h1><span class="gradient-text">Search Results</span></h1>';
        echo '  <p>Found ' . $result->num_rows . ' record(s) matching <strong>' . htmlspecialchars($Value) . '</strong> in <strong>' . htmlspecialchars($Field) . '</strong></p>';
        echo '</div>';

        echo '<div class="table-container"><table>';
        echo '<thead><tr><th>ID</th><th>Food Name</th><th>Origin</th><th>Chef Email</th><th>Image</th><th>Category</th><th>Spicy</th><th>Dietary Tags</th><th>Description</th><th>Date Added</th><th>Price</th><th>Status</th></tr></thead>';
        echo '<tbody>';

        while($row = $result->fetch_assoc()){
          echo "<tr>";
          echo "<td>" . $row["FoodID"] . "</td>";
          echo "<td><strong>" . htmlspecialchars($row["FoodName"]) . "</strong></td>";
          echo "<td><span class='badge badge-violet'>" . htmlspecialchars($row["Origin"]) . "</span></td>";
          echo "<td>" . htmlspecialchars($row["ChefEmail"]) . "</td>";
          echo "<td><img src=\"" . htmlspecialchars($row["ImageURL"]) . "\" class=\"food-img\" alt=\"Food\"></td>";
          echo "<td><span class='badge badge-blue'>" . htmlspecialchars($row["Category"]) . "</span></td>";

          $s = $row["SpicyLevel"];
          if ($s === 'Hot') echo '<td><span class="badge badge-rose">🌶️ Hot</span></td>';
          elseif ($s === 'Mild') echo '<td><span class="badge badge-amber">🌶️ Mild</span></td>';
          else echo '<td><span class="badge badge-emerald">None</span></td>';

          echo "<td>" . htmlspecialchars($row["DietaryTags"]) . "</td>";
          echo "<td style='max-width:200px;white-space:normal;font-size:0.85rem;color:var(--text-secondary);'>" . htmlspecialchars($row["Description"]) . "</td>";
          echo "<td>" . $row["DateAdded"] . "</td>";
          echo "<td><strong>$" . $row["Price"] . "</strong></td>";

          $a = $row["Availability"];
          if ($a === 'Available') echo '<td><span class="badge badge-emerald">✓ Available</span></td>';
          elseif ($a === 'Out of Stock') echo '<td><span class="badge badge-rose">✗ Out of Stock</span></td>';
          else echo '<td><span class="badge badge-amber">🕐 ' . htmlspecialchars($a) . '</span></td>';

          echo "</tr>";
        }

        echo '</tbody></table></div>';
      }else{
        echo '<div class="empty-state"><span class="empty-icon">🔍</span><h2>No results</h2><p>No foods found matching your search.</p></div>';
      }
    }

    $stmt->close();
  } else {
    echo "<div class='msg-error'>⚠️ Error preparing query.</div>";
  }
} else {
  echo "<div class='msg-error'>⚠️ Invalid search field.</div>";
}

$conn->close();
?>

<div class="action-links">
    <a href="2026_search.php">🔍 Search Again</a>
    <span class="separator">·</span>
    <a href="2026_menu.php">← Back to Dashboard</a>
</div>

<?php include 'footer.php'; ?>
