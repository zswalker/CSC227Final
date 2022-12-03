<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Lot Search</title>
	<link href="style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php
	// Create variables for connection
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	$dbport = getenv("MYSQL_SERVICE_PORT");
	$dbuser = getenv("MYSQL_USER");
	$dbpwd = getenv("MYSQL_PASSWORD");
	$dbname = getenv("MYSQL_DATABASE");

	// Connect to database and executes main. Prints error if unsuccessful.
	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	if($conn->connect_error){
		echo "Connection error: ".mysqli_connect_error();
	} else {
		// Tests Form variables and adds vehicle to database

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			// Create variables for testing
			$price_low = $_POST['low'];
			$price_high = $_POST['high'];
			$error_message = "";
			
			// Verify price entries
			if (empty($price_low) || empty($price_high)){
				$error_message = "Error - Must enter price.";
			}
			if ($price_low < 0){
				$error_message = "Error - Price can not be nagative.";
			}
			if ($price_high < 0){
				$error_message = "Error - Price can not be nagative.";
			}
			if ($price_low > $price_high){
				$error_message = "Error - Lower price can not be larger than Higher price.";
			}

			// Displays error message if necessary, else searches for price range
			if ($error_message != ""){
				echo "<p>".$error_message."<p>";
			} else {
				// SQL Query to search for model, diplays error if necessary
				$sql = "SELECT car_year, make, model, style, miles, price FROM inventory 
						WHERE price>'$price_low' && price<'$price_high'";
				$result = $conn->query($sql);
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
						.number_format($row["price"], 0, ",")."</td></tr>");
					}
					echo("</table>");
					echo("<h3>Thank you for using my program.</h3>");
					echo('<br><footer><a calss="white" href="..\index.php">
								Return to Form Entry</a></footer>');
				}
				$conn->close();
			}
		}
	}
?>
</body>
</html>