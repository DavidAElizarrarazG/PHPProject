<?php include 'header.php'; ?>

<div class="page-header">
    <h1><span class="gradient-text">Modify Food</span></h1>
    <p>Search for a food item to edit its details.</p>
</div>

<div class="panel">
    <form action="2026_modify_search.php" method="post">
        <div class="form-group">
            <label for="foodname">Food Name to modify</label>
            <input type="text" id="foodname" name="foodname" placeholder="Enter food name…">
        </div>
        <input type="submit" value="🔍 Search">
    </form>
</div>

<div class="action-links">
    <a href="2026_menu.php">← Back to Dashboard</a>
</div>

<?php include 'footer.php'; ?>
