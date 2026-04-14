<?php include 'header.php'; ?>
<!--2026_search2.php-->


	
	
		<h1>Search Contact V2</h1>
		<form action="2026_search_process2.php" method="post">
		Search by:
		<select name = "Field">
		<option value = "Name">Name</option>
		<option value = "ChefEmail">Chef Email</option>
		<option value = "ImageURL">ImageURL</option>
		</select>
		Field Value: <input type="text" id="value" name= "Value"><br>
		<input type="submit">
		</form>
<?php include 'footer.php'; ?>
