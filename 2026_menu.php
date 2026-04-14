<?php include 'header.php'; ?>

<div class="page-header" id="tour-header">
    <h1>Dashboard</h1>
    <p>Your culinary collection at a glance.</p>
</div>

<?php
$servername = "db";
$username   = "user2025";
$password   = "user2025";
$dbname     = "kashi";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo '<div class="empty-state"><span class="empty-icon">⚠</span><h2>Connection Failed</h2><p>Database connection failed. Please ensure setup is complete.</p><a href="2026_setup.php" class="btn">Run Setup</a></div>';
    include 'footer.php';
    exit;
}

// Stats queries
$totalFoods = 0; $totalCategories = 0; $avgPrice = 0; $availableCount = 0;

$res = $conn->query("SELECT COUNT(*) as cnt FROM Foods");
if ($res) { $totalFoods = $res->fetch_assoc()['cnt']; }

$res = $conn->query("SELECT COUNT(DISTINCT Category) as cnt FROM Foods");
if ($res) { $totalCategories = $res->fetch_assoc()['cnt']; }

$res = $conn->query("SELECT AVG(Price) as avg_p FROM Foods");
if ($res) { $avgPrice = number_format($res->fetch_assoc()['avg_p'] ?? 0, 2); }

$res = $conn->query("SELECT COUNT(*) as cnt FROM Foods WHERE Availability = 'Available'");
if ($res) { $availableCount = $res->fetch_assoc()['cnt']; }
?>

<!-- Stats Row -->
<div class="stats-grid" id="tour-stats">
    <div class="stat-card animate-in">
        <div class="stat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2h18l-2 7H5L3 2z"/><path d="M5 9l1 13h12l1-13"/><line x1="9" y1="14" x2="15" y2="14"/></svg>
        </div>
        <div class="stat-card-text">
            <div class="stat-value"><?php echo $totalFoods; ?></div>
            <div class="stat-label">Total Foods</div>
        </div>
    </div>
    <div class="stat-card animate-in">
        <div class="stat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7h16M4 12h16M4 17h10"/></svg>
        </div>
        <div class="stat-card-text">
            <div class="stat-value"><?php echo $totalCategories; ?></div>
            <div class="stat-label">Categories</div>
        </div>
    </div>
    <div class="stat-card animate-in">
        <div class="stat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
        </div>
        <div class="stat-card-text">
            <div class="stat-value">$<?php echo $avgPrice; ?></div>
            <div class="stat-label">Avg Price</div>
        </div>
    </div>
    <div class="stat-card animate-in">
        <div class="stat-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22,4 12,14.01 9,11.01"/></svg>
        </div>
        <div class="stat-card-text">
            <div class="stat-value"><?php echo $availableCount; ?></div>
            <div class="stat-label">Available</div>
        </div>
    </div>
</div>

<?php
// Fetch distinct categories for the filter bar
$categories = [];
$catRes = $conn->query("SELECT DISTINCT Category FROM Foods ORDER BY Category");
if ($catRes) {
    while ($r = $catRes->fetch_assoc()) {
        $categories[] = $r['Category'];
    }
}
?>

<!-- Category Filter Bar -->
<?php if (!empty($categories)): ?>
<div class="category-bar" id="tour-categories">
    <button class="cat-pill active" data-cat="all" onclick="filterCards(this, 'all')">All</button>
    <?php foreach ($categories as $cat): ?>
    <button class="cat-pill" data-cat="<?php echo htmlspecialchars($cat); ?>" onclick="filterCards(this, '<?php echo htmlspecialchars(addslashes($cat)); ?>')">
        <?php echo htmlspecialchars($cat); ?>
    </button>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<?php
$sql    = "SELECT * FROM Foods ORDER BY DateAdded DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo '<div class="masonry-grid" id="tour-cards">';
    while ($row = $result->fetch_assoc()) {
        $imageUrl  = !empty($row["ImageURL"]) ? htmlspecialchars($row["ImageURL"]) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&q=80';
        $foodName  = htmlspecialchars($row["FoodName"]);
        $category  = htmlspecialchars($row["Category"]);
        $origin    = htmlspecialchars($row["Origin"]);
        $price     = htmlspecialchars($row["Price"]);
        $spicy     = htmlspecialchars($row["SpicyLevel"]);
        $avail     = htmlspecialchars($row["Availability"] ?? '');

        $spicyLabel = '';
        if ($spicy === 'Mild')   $spicyLabel = '🌶';
        elseif ($spicy === 'Medium') $spicyLabel = '🌶🌶';
        elseif ($spicy === 'Hot')    $spicyLabel = '🌶🌶🌶';

        // Availability dot color
        $availDot = $avail === 'Available' ? '#06c167' : '#E85353';

        echo '<div class="food-card" data-cat="' . $category . '">';

        // Image section with hover actions
        echo '  <div class="food-card-img-wrap">';
        echo '    <img src="' . $imageUrl . '" alt="' . $foodName . '" loading="lazy">';
        echo '    <div class="food-card-actions">';
        echo '      <a href="2026_modify.php" class="card-action-btn" title="Edit">&#9998; Edit</a>';
        echo '      <a href="2026_delete.php" class="card-action-btn danger" title="Delete">&#128465; Del</a>';
        echo '    </div>';
        echo '  </div>';

        // Text body below image
        echo '  <div class="food-card-body">';
        echo '    <h3>' . $foodName . '</h3>';
        echo '    <div style="font-size:0.8rem;color:#999;margin-bottom:0.5rem;">' . $origin . ($spicyLabel ? ' &middot; ' . $spicyLabel : '') . '</div>';
        echo '    <div class="food-card-meta">';
        echo '      <div class="food-card-tags">';
        echo '        <span class="category-tag">' . $category . '</span>';
        if ($avail) {
            echo '        <span style="display:inline-flex;align-items:center;gap:0.25rem;font-size:0.72rem;color:' . $availDot . ';font-weight:500;">'
                .'<svg width="6" height="6" viewBox="0 0 6 6"><circle cx="3" cy="3" r="3" fill="' . $availDot . '"/></svg>' . $avail . '</span>';
        }
        echo '      </div>';
        echo '      <span class="price-tag">$' . $price . '</span>';
        echo '    </div>';
        echo '  </div>';

        echo '</div>'; // .food-card
    }
    echo '</div>'; // .masonry-grid
} else {
    echo '<div class="empty-state">';
    echo '  <span class="empty-icon">🍳</span>';
    echo '  <h2>No foods yet</h2>';
    echo '  <p>Start adding delicious foods to populate your dashboard.</p>';
    echo '  <a href="2026_create.php" class="btn" style="margin-right:0.75rem;">Add Food</a>';
    echo '  <a href="2026_setup.php" class="btn btn-secondary">Run Setup</a>';
    echo '</div>';
}

$conn->close();
?>

<script>
// Category filter
function filterCards(pill, cat) {
    document.querySelectorAll('.cat-pill').forEach(function(p) { p.classList.remove('active'); });
    pill.classList.add('active');
    document.querySelectorAll('.food-card').forEach(function(card) {
        if (cat === 'all' || card.dataset.cat === cat) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

window._tourSteps = [
    {
        target: '#tour-header',
        title: 'Welcome to the Dashboard',
        description: 'This is your main overview page. See all your foods at a glance.'
    },
    {
        target: '#sidebarNav',
        title: 'Navigation Bar',
        description: 'Use the top navbar to navigate between Dashboard, Reports, and all CRUD operations.'
    },
    {
        target: '#tour-stats',
        title: 'Quick Stats',
        description: 'Real-time summaries: total foods, categories, average price, and availability.'
    },
    {
        target: '#tour-categories',
        title: 'Category Filter',
        description: 'Click any pill to filter foods by category instantly — no page reload needed.'
    },
    {
        target: '#tour-cards',
        title: 'Food Cards',
        description: 'Hover over any card to see Edit and Delete action buttons. Clean image + info layout.'
    }
];
</script>

<?php include 'footer.php'; ?>
