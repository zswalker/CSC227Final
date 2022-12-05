<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Lot Search</title>
	<link href="..\style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php
	// Create a back button
	echo '<a href="..\html\search-style.html"><-Back</a><br />';

	// Create variables for connection
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	$dbport = getenv("MYSQL_SERVICE_PORT");
	$dbuser = getenv("MYSQL_USER");
	$dbpwd = getenv("MYSQL_PASSWORD");
	$dbname = getenv("MYSQL_DATABASE");

	// Connect to database and executes main. Prints error if unsuccessful.
	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	if($conn->connect_error){
		echo "<p>Connection error: ".mysqli_connect_error()."</p>";
	} else {
		// Tests Form variables and adds vehicle to database

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Create variables for testing
			$v_style = $_POST['style'];
			$error_message = "";

			// Verify Style
			if (empty($v_style)){
				$error_message = "<p>Error - Body Style not selected</p>";
			}

			// Displays error message if necessary, else searches for style
			if ($error_message != ""){
				echo "<p>".$error_message."</p>";
			} else {
				// SQL Query to search for model, diplays error if necessary
				$sql = "SELECT car_year, make, model, style, miles, price 
						FROM inventory WHERE style='$v_style' && sold='Not Sold'";
				$result = $conn->query($sql);
				if (!$result) {
					die("<p>Could not successfully run query from $dbname: ".mysqli_error($conn)."</p>");
				}
		
				// Displays message if no results found
				if (mysqli_num_rows($result) == 0) {
					echo "<p>No vehicles found with '".$v_style."' body style</p>";
				} else {
					// else: Prints table of vehicles found
					echo "<h1>Vehicles Found</h1>";
					echo "<table border='1'><thead><tr><th>Year</th><th>Make</th>
					<th>Model</th><th>Style</th><th>Miles</th><th>Price</th></tr></thead><tbody>"; 
					while($row = mysqli_fetch_assoc($result)) {
						echo "<tr><td>".$row["car_year"]."</td>
						<td>".$row["make"]."</td><td>".$row["model"]."</td>
						<td>".$row["style"]."</td><td>"
						.number_format($row["miles"], 0, ",")."</td><td>"
						.number_format($row["price"], 0, ",")."</td></tr>";
					}
					echo "</table>";
					echo "<h3>Thank you for using my program.</h3>";
					echo '<br><footer><a calss="white" href="..\index.php">
								Return to Form Entry</a></footer>';
				}
				$conn->close();
			}
		}
	}
?>
</body>
</html>