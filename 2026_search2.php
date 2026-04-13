<!--2026_search2.php-->

<html>
	<body>
		<h1>Search Contact V2</h1>
		<form action="2026_search_process2.php" method="post">
		Search by:
		<select name = "Field">
		<option value = "Name">Name</option>
		<option value = "Email">E-mail</option>
		<option value = "Phone">Phone</option>
		</select>
		Field Value: <input type="text" id="value" name= "Value"><br>
		<input type="submit">
		</form>
	</body>
</html>