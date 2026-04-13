<!--2026_search.php-->

<html>
	<body>
		<h1>Search Employee</h1>
		<form action="2026_search_process.php" method="post">

		Search by:
		<select name="Field">
			<option value="FirstName">First Name</option>
			<option value="LastName">Last Name</option>
			<option value="Email">Email</option>
			<option value="Department">Department</option>
			<option value="Status">Status</option>
		</select><br><br>

		Search value: <input type="text" id="value" name="value"><br><br>

		<input type="submit" value="Search">
		</form>
		<br>
		<a href="2026_menu.html">Back to Menu</a>
	</body>
</html>