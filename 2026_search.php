<?php include 'header.php'; ?>

<div class="page-header" id="tour-header">
    <h1><span class="gradient-text">Search</span></h1>
    <p>Find food items by any field.</p>
</div>

<div class="panel" id="tour-form">
    <form action="2026_search_process.php" method="post">
        <div class="form-grid">
            <div class="form-group">
                <label for="searchField">Search by</label>
                <select name="Field" id="searchField">
                    <option value="FoodName">Food Name</option>
                    <option value="Origin">Origin</option>
                    <option value="ChefEmail">Chef Email</option>
                    <option value="Category">Category</option>
                    <option value="Availability">Availability</option>
                </select>
            </div>

            <div class="form-group">
                <label for="value">Search value</label>
                <input type="text" id="value" name="value" placeholder="Enter search term…">
            </div>

            <div class="form-group" style="display:flex;align-items:flex-end;">
                <input type="submit" value="🔍 Search">
            </div>
        </div>
    </form>
</div>

<div class="action-links">
    <a href="2026_menu.php">← Back to Dashboard</a>
</div>

<script>
window._tourSteps = [
    {
        target: '#tour-header',
        title: '🔍 Search Foods',
        description: 'Search your food database by name, origin, category, email, or availability.'
    },
    {
        target: '#tour-form',
        title: '📝 Search Form',
        description: 'Pick a field to search by, type your value, and hit Search to find matching records.'
    }
];
</script>

<?php include 'footer.php'; ?>
