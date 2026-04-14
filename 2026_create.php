<?php include 'header.php'; ?>

<div class="page-header" id="tour-header">
    <h1><span class="gradient-text">Add Food</span></h1>
    <p>Fill in the details below to add a new food item.</p>
</div>

<form action="2026_create_process.php" method="post" class="styled-form" id="tour-form">
    <div class="form-grid">

        <div class="form-group" id="tour-foodname">
            <label for="foodname">Food Name</label>
            <input type="text" id="foodname" name="foodname" placeholder="e.g. Tacos al Pastor" required>
        </div>

        <div class="form-group" id="tour-origin">
            <label for="origin">Origin</label>
            <input type="text" id="origin" name="origin" list="origin-list" placeholder="Type or select…">
            <datalist id="origin-list">
                <option value="Mexican">
                <option value="Italian">
                <option value="Japanese">
                <option value="Indian">
                <option value="American">
                <option value="Thai">
                <option value="Chinese">
                <option value="French">
                <option value="Korean">
                <option value="Mediterranean">
                <option value="Brazilian">
                <option value="Spanish">
                <option value="Greek">
                <option value="Vietnamese">
            </datalist>
        </div>

        <div class="form-group">
            <label for="chefemail">Chef Email</label>
            <input type="email" id="chefemail" name="chefemail" placeholder="chef@example.com">
        </div>

        <div class="form-group">
            <label for="imageurl">Image URL</label>
            <input type="url" id="imageurl" name="imageurl" placeholder="https://…">
        </div>

        <div class="form-group" id="tour-category">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" list="category-list" placeholder="Type or select…">
            <datalist id="category-list">
                <option value="Italian">
                <option value="Mexican">
                <option value="Dessert">
                <option value="Fast Food">
                <option value="Healthy">
                <option value="Seafood">
                <option value="Vegan">
                <option value="BBQ">
                <option value="Breakfast">
                <option value="Street Food">
                <option value="Soup">
                <option value="Salad">
                <option value="Bakery">
                <option value="Beverage">
            </datalist>
        </div>

        <div class="form-group">
            <label for="price">Price ($)</label>
            <input type="number" id="price" name="price" step="0.01" placeholder="0.00">
        </div>

        <div class="form-group">
            <label>Spicy Level</label>
            <div class="radio-group">
                <label><input type="radio" id="spicy-none" name="spicylevel" value="None" checked> None</label>
                <label><input type="radio" id="spicy-mild" name="spicylevel" value="Mild"> 🌶️ Mild</label>
                <label><input type="radio" id="spicy-hot" name="spicylevel" value="Hot"> 🌶️🌶️🌶️ Hot</label>
            </div>
        </div>

        <div class="form-group">
            <label for="dateadded">Date Added</label>
            <input type="date" id="dateadded" name="dateadded">
        </div>

        <div class="form-group full-width">
            <label>Dietary Tags</label>
            <div class="checkbox-group">
                <label><input type="checkbox" id="tag-dairy" name="dietarytags[]" value="Dairy"> Dairy</label>
                <label><input type="checkbox" id="tag-nuts" name="dietarytags[]" value="Nuts"> Nuts</label>
                <label><input type="checkbox" id="tag-gluten" name="dietarytags[]" value="Gluten"> Gluten</label>
                <label><input type="checkbox" id="tag-soy" name="dietarytags[]" value="Soy"> Soy</label>
                <label><input type="checkbox" id="tag-shellfish" name="dietarytags[]" value="Shellfish"> Shellfish</label>
            </div>
        </div>

        <div class="form-group full-width">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3" placeholder="Describe the dish…"></textarea>
        </div>

        <div class="form-group">
            <label for="availability">Availability</label>
            <select id="availability" name="availability">
                <option value="">-- Select --</option>
                <option value="Available">Available</option>
                <option value="Out of Stock">Out of Stock</option>
                <option value="Seasonal">Seasonal</option>
            </select>
        </div>

        <div class="form-group" style="display:flex;align-items:flex-end;">
            <input type="submit" value="Create Food →">
        </div>
    </div>
</form>

<div class="action-links">
    <a href="2026_menu.php">← Back to Dashboard</a>
</div>

<script>
window._tourSteps = [
    {
        target: '#tour-header',
        title: '➕ Add Food',
        description: 'Use this form to add a new food item to your collection.'
    },
    {
        target: '#tour-origin',
        title: '🌍 Origin Field',
        description: 'Type any origin or pick from suggestions. You can repeat values — "Mexican" can appear on many foods!'
    },
    {
        target: '#tour-category',
        title: '📂 Category Field',
        description: 'Same here — type any category or choose from the dropdown. Categories can be reused freely.'
    },
    {
        target: '#tour-form',
        title: '📝 Two-Column Layout',
        description: 'The form uses a responsive grid. On mobile it stacks to one column automatically.'
    }
];
</script>

<?php include 'footer.php'; ?>
