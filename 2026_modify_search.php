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
      echo '  <h1><span class="gradient-text">Modify:</span> ' . htmlspecialchars($row["FoodName"]) . '</h1>';
      echo '  <p>Current data shown below. Update the fields and submit.</p>';
      echo '</div>';

      // Current data table
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

      // Parse current dietary tags
      $currentDietaryTags = explode(", ", $row["DietaryTags"]);
?>

    <h2>Edit Details</h2>
    <form action="2026_modify_process.php" method="post" class="styled-form">
        <input type="hidden" name="FoodID" value="<?php echo $row["FoodID"]?>">

        <div class="form-grid">
            <div class="form-group">
                <label for="foodname">Food Name</label>
                <input type="text" name="foodname" id="foodname" value="<?php echo htmlspecialchars($row["FoodName"])?>">
            </div>

            <div class="form-group">
                <label for="origin">Origin</label>
                <input type="text" name="origin" id="origin" list="origin-list" value="<?php echo htmlspecialchars($row["Origin"])?>">
                <datalist id="origin-list">
                    <option value="Mexican"><option value="Italian"><option value="Japanese">
                    <option value="Indian"><option value="American"><option value="Thai">
                    <option value="Chinese"><option value="French"><option value="Korean">
                    <option value="Mediterranean"><option value="Brazilian"><option value="Spanish">
                </datalist>
            </div>

            <div class="form-group">
                <label for="chefemail">Chef Email</label>
                <input type="email" name="chefemail" id="chefemail" value="<?php echo htmlspecialchars($row["ChefEmail"])?>" placeholder="chef@example.com">
            </div>

            <div class="form-group">
                <label for="imageurl">Image URL</label>
                <input type="url" name="imageurl" id="imageurl" value="<?php echo htmlspecialchars($row["ImageURL"])?>">
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" list="category-list" value="<?php echo htmlspecialchars($row["Category"])?>">
                <datalist id="category-list">
                    <option value="Italian"><option value="Mexican"><option value="Dessert">
                    <option value="Fast Food"><option value="Healthy"><option value="Seafood">
                    <option value="Vegan"><option value="BBQ"><option value="Breakfast">
                    <option value="Street Food"><option value="Soup"><option value="Salad">
                </datalist>
            </div>

            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" name="price" id="price" step="0.01" value="<?php echo $row["Price"]?>">
            </div>

            <div class="form-group">
                <label>Spicy Level</label>
                <div class="radio-group">
                    <label><input type="radio" name="spicylevel" value="None" <?php if($row["SpicyLevel"]=="None") echo "checked";?>> None</label>
                    <label><input type="radio" name="spicylevel" value="Mild" <?php if($row["SpicyLevel"]=="Mild") echo "checked";?>> 🌶️ Mild</label>
                    <label><input type="radio" name="spicylevel" value="Hot" <?php if($row["SpicyLevel"]=="Hot") echo "checked";?>> 🌶️🌶️🌶️ Hot</label>
                </div>
            </div>

            <div class="form-group">
                <label for="dateadded">Date Added</label>
                <input type="date" name="dateadded" id="dateadded" value="<?php echo $row["DateAdded"]?>">
            </div>

            <div class="form-group full-width">
                <label>Dietary Tags</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="dietarytags[]" value="Dairy" <?php if(in_array("Dairy", $currentDietaryTags)) echo "checked";?>> Dairy</label>
                    <label><input type="checkbox" name="dietarytags[]" value="Nuts" <?php if(in_array("Nuts", $currentDietaryTags)) echo "checked";?>> Nuts</label>
                    <label><input type="checkbox" name="dietarytags[]" value="Gluten" <?php if(in_array("Gluten", $currentDietaryTags)) echo "checked";?>> Gluten</label>
                    <label><input type="checkbox" name="dietarytags[]" value="Soy" <?php if(in_array("Soy", $currentDietaryTags)) echo "checked";?>> Soy</label>
                    <label><input type="checkbox" name="dietarytags[]" value="Shellfish" <?php if(in_array("Shellfish", $currentDietaryTags)) echo "checked";?>> Shellfish</label>
                </div>
            </div>

            <div class="form-group full-width">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="3"><?php echo htmlspecialchars($row["Description"])?></textarea>
            </div>

            <div class="form-group">
                <label for="availability">Availability</label>
                <select name="availability" id="availability">
                    <option value="Available" <?php if($row["Availability"]=="Available") echo "selected";?>>Available</option>
                    <option value="Out of Stock" <?php if($row["Availability"]=="Out of Stock") echo "selected";?>>Out of Stock</option>
                    <option value="Seasonal" <?php if($row["Availability"]=="Seasonal") echo "selected";?>>Seasonal</option>
                </select>
            </div>

            <div class="form-group" style="display:flex;align-items:flex-end;">
                <input type="submit" value="Update Food →">
            </div>
        </div>
    </form>

    <?php
    }else{
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
    <a href="2026_modify.php">Search Again</a>
    <span class="separator">·</span>
    <a href="2026_menu.php">← Back to Dashboard</a>
</div>

<?php include 'footer.php'; ?>
