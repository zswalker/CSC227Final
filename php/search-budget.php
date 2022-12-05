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
	echo '<a href="..\html\search-budget.html"><-Back</a><br />';

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
		exit();
	}
	
	// Tests Form variables and adds vehicle to database
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Create variables for testing
		$price_low = $_POST['low'];
		$price_high = $_POST['high'];
		$error_message = "";
		
		// Verify price entries
		if (empty($price_low)){
			$price_low = 0;
		}
		if (empty($price_high)){
			$price_high = 10000000;
		}
		if ($price_low < 0){
			$error_message = "<p>Error - Price can not be nagative</p>";
		}
		if ($price_high < 0){
			$error_message = "<p>Error - Price can not be nagative</p>";
		}
		if ($price_low > $price_high){
			$error_message = "<p>Error - Lower price can not be larger than Higher price</p>";
		}

		// Displays error message if necessary, else searches for price range
		if ($error_message != ""){
			echo "<p>".$error_message."</p>";
		} else {
			// SQL Query to search for model, diplays error if necessary
			$sql = "SELECT car_year, make, model, style, miles, price FROM inventory 
					WHERE price>'$price_low' && price<'$price_high' && sold='Not Sold'";
			$result = $conn->query($sql);
			if (!$result) {
				die("Could not successfully run query from $dbname: ".mysqli_error($conn));
			}
	
			// Displays message if no results found
			if (mysqli_num_rows($result) == 0) {
				if ($price_low == 0){
					echo "<p>No vehicles less than $".number_format($price_high, 0, ",")."</p>";
				} else {
					echo "<p>No vehicles found between $".number_format($price_low, 0, ",").
						" and $".number_format($price_high, 0, ",")."</p>";
				}
			} else {
				// else: Prints table of vehicles found
				echo "<h1>Vehicles Found</h1>";
				if ($price_low == 0){
					echo "<p>Vehicles below $".number_format($price_high, 0, ",")."</p>";
				} else {
					echo "<p>Vehicles between $".number_format($price_low, 0, ",").
						" and ".number_format($price_high, 0, ",")."</p>";
				}
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
?>
</body>
</html>