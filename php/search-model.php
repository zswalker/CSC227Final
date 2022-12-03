<?php
	// Create variables for connection
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	$dbport = getenv("MYSQL_SERVICE_PORT");
	$dbuser = getenv("MYSQL_USER");
	$dbpwd = getenv("MYSQL_PASSWORD");
	$dbname = getenv("MYSQL_DATABASE");

	// Create variable used in form
	$v_model = $_POST['model'];

	// Connect to database and gets info from database. Prints error if unsuccessful.
	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	if($conn->connect_error){
		echo "Connection error: ".mysqli_connect_error();
	} else {
		// SQL Query to search for model
		$sql = "SELECT car_year, make, model, style, miles, price FROM inventory WHERE model='$v_model'";
		$result = $conn->query($sql);
		
		// Diplay error if necessary
		if (!$result) {
			die("Could not successfully run query from $dbname: ".mysqli_error($conn));
		}

		// Displays message if no results found
		if (mysqli_num_rows($result) == 0) {
			echo "No records found";
		} else {
			// else: Prints table of vehicles found
			echo "<h1>Vehicles Found</h1>";
			echo "<table border='1'><thead><tr><th>Year</th><th>Make</th>
			<th>Model</th><th>Style</th><th>Miles</th><th>Price</th></tr></thead><tbody>"; 
			while($row = mysqli_fetch_assoc($result)) {
				echo("<tr><td>".$row["car_year"]."</td>
				<td>".$row["make"]."</td><td>".$row["model"]."</td>
				<td>".$row["style"]."</td><td>".$row["miles"]."</td><td>"
				.number_format($row["price"], ",")."</td></tr>");
			}
			echo("</table>");
			echo("<h3>Thank you for using my program.</h3>");
			echo('<br><footer><a calss="white" href="..\index.php">
						Return to Form Entry</a></footer>');
		}
		$conn->close();
		}
?>