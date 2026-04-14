<?php include 'header.php'; ?>

<div class="page-header">
    <h1><span class="gradient-text">Delete Food</span></h1>
    <p>Search for a food item to remove it.</p>
</div>

<div class="panel">
    <form action="2026_delete_search.php" method="post">
        <div class="form-group">
            <label for="foodname">Food Name to delete</label>
            <input type="text" id="foodname" name="foodname" placeholder="Enter food name…">
        </div>
        <input type="submit" value="🔍 Search" class="btn-danger">
    </form>
</div>

<div class="action-links">
    <a href="2026_menu.php">← Back to Dashboard</a>
</div>

<?php include 'footer.php'; ?>
