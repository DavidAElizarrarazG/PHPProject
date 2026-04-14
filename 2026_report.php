<?php include 'header.php'; ?>

<div class="page-header" id="tour-header">
    <h1><span class="gradient-text">Full Report</span></h1>
    <p>Complete data table with all food records. Click column headers to sort.</p>
</div>

<?php
$servername = "db";
$username = "user2025";
$password = "user2025";
$dbname = "kashi";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("<div class='msg-error'>⚠️ Connection failed: " . $conn->connect_error . "</div>");
}

$sql = "SELECT * FROM Foods ORDER BY FoodID ASC";
$result = $conn->query($sql);
?>

<!-- Toolbar -->
<div class="report-toolbar" id="tour-toolbar">
    <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="search" id="tableSearch" placeholder="Filter records…" oninput="filterTable()">
    </div>
    <button class="btn btn-secondary btn-sm" id="tour-export" onclick="exportCSV()">
        📥 Export CSV
    </button>
</div>

<?php if ($result && $result->num_rows > 0): ?>
<div class="table-container" id="tour-table">
    <table id="reportTable">
        <thead>
            <tr>
                <th class="sortable" onclick="sortTable(0)">ID</th>
                <th class="sortable" onclick="sortTable(1)">Food Name</th>
                <th class="sortable" onclick="sortTable(2)">Origin</th>
                <th class="sortable" onclick="sortTable(3)">Chef Email</th>
                <th>Image</th>
                <th class="sortable" onclick="sortTable(5)">Category</th>
                <th class="sortable" onclick="sortTable(6)">Spicy</th>
                <th>Dietary Tags</th>
                <th>Description</th>
                <th class="sortable" onclick="sortTable(9)">Date Added</th>
                <th class="sortable" onclick="sortTable(10)">Price</th>
                <th class="sortable" onclick="sortTable(11)">Status</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row["FoodID"]; ?></td>
                <td><strong><?php echo htmlspecialchars($row["FoodName"]); ?></strong></td>
                <td><span class="badge badge-violet"><?php echo htmlspecialchars($row["Origin"]); ?></span></td>
                <td><?php echo htmlspecialchars($row["ChefEmail"]); ?></td>
                <td><img src="<?php echo htmlspecialchars($row["ImageURL"]); ?>" class="food-img" alt="Food" loading="lazy"></td>
                <td><span class="badge badge-blue"><?php echo htmlspecialchars($row["Category"]); ?></span></td>
                <td>
                    <?php
                    $s = $row["SpicyLevel"];
                    if ($s === 'Hot') echo '<span class="badge badge-rose">🌶️ Hot</span>';
                    elseif ($s === 'Mild') echo '<span class="badge badge-amber">🌶️ Mild</span>';
                    else echo '<span class="badge badge-emerald">None</span>';
                    ?>
                </td>
                <td><?php echo htmlspecialchars($row["DietaryTags"]); ?></td>
                <td style="max-width:200px;white-space:normal;font-size:0.85rem;color:var(--text-secondary);"><?php echo htmlspecialchars($row["Description"]); ?></td>
                <td><?php echo $row["DateAdded"]; ?></td>
                <td><strong>$<?php echo $row["Price"]; ?></strong></td>
                <td>
                    <?php
                    $a = $row["Availability"];
                    if ($a === 'Available') echo '<span class="badge badge-emerald">✓ Available</span>';
                    elseif ($a === 'Out of Stock') echo '<span class="badge badge-rose">✗ Out of Stock</span>';
                    else echo '<span class="badge badge-amber">🕐 ' . htmlspecialchars($a) . '</span>';
                    ?>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php else: ?>
    <div class="empty-state">
        <span class="empty-icon">📋</span>
        <h2>No records found</h2>
        <p>Add some foods to see them in the report.</p>
        <a href="2026_create.php" class="btn">Add Food</a>
    </div>
<?php endif; ?>

<?php $conn->close(); ?>

<div class="action-links">
    <a href="2026_menu.php">← Back to Dashboard</a>
</div>

<script>
// Live filter
function filterTable() {
    var query = document.getElementById('tableSearch').value.toLowerCase();
    var rows = document.querySelectorAll('#reportTable tbody tr');
    rows.forEach(function(row) {
        var text = row.textContent.toLowerCase();
        row.style.display = text.includes(query) ? '' : 'none';
    });
}

// Column sorting
var sortDir = {};
function sortTable(colIdx) {
    var table = document.getElementById('reportTable');
    var tbody = table.querySelector('tbody');
    var rows = Array.from(tbody.querySelectorAll('tr'));
    var headers = table.querySelectorAll('th');

    // Toggle direction
    sortDir[colIdx] = sortDir[colIdx] === 'asc' ? 'desc' : 'asc';
    var asc = sortDir[colIdx] === 'asc';

    // Reset header classes
    headers.forEach(function(h, i) {
        h.classList.remove('sort-asc', 'sort-desc');
        if (i === colIdx) h.classList.add(asc ? 'sort-asc' : 'sort-desc');
    });

    rows.sort(function(a, b) {
        var aVal = a.cells[colIdx].textContent.trim();
        var bVal = b.cells[colIdx].textContent.trim();
        // Try numeric
        var aNum = parseFloat(aVal.replace(/[$,]/g, ''));
        var bNum = parseFloat(bVal.replace(/[$,]/g, ''));
        if (!isNaN(aNum) && !isNaN(bNum)) {
            return asc ? aNum - bNum : bNum - aNum;
        }
        return asc ? aVal.localeCompare(bVal) : bVal.localeCompare(aVal);
    });

    rows.forEach(function(row) { tbody.appendChild(row); });
}

// CSV Export
function exportCSV() {
    var table = document.getElementById('reportTable');
    var rows = table.querySelectorAll('tr');
    var csv = [];
    rows.forEach(function(row) {
        var cols = row.querySelectorAll('th, td');
        var rowData = [];
        cols.forEach(function(col, idx) {
            // Skip image column (index 4)
            if (idx === 4) return;
            var text = col.textContent.trim().replace(/"/g, '""');
            rowData.push('"' + text + '"');
        });
        csv.push(rowData.join(','));
    });
    var blob = new Blob([csv.join('\n')], { type: 'text/csv' });
    var url = URL.createObjectURL(blob);
    var a = document.createElement('a');
    a.href = url;
    a.download = 'pmbx_food_report.csv';
    a.click();
    URL.revokeObjectURL(url);
}

// Tour steps
window._tourSteps = [
    {
        target: '#tour-header',
        title: '📋 Full Report',
        description: 'This page shows all your food records in a detailed table — different from the visual Dashboard cards.'
    },
    {
        target: '#tour-toolbar',
        title: '🔍 Filter & Export',
        description: 'Use the search bar to instantly filter rows. Click "Export CSV" to download all data as a spreadsheet.'
    },
    {
        target: '#tour-table',
        title: '📊 Sortable Table',
        description: 'Click any column header with ↕ to sort the data. Columns show badges for Category, Origin, Spicy Level, and Status.'
    }
];
</script>

<?php include 'footer.php'; ?>
