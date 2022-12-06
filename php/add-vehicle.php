<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Lot Modify</title>
	<link href="..\style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php
	// Create a back button
	echo '<a href="..\html\add-vehicle.html">&lt;-Back</a><br />';

	// Create variables for connection
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	$dbport = getenv("MYSQL_SERVICE_PORT");
	$dbuser = getenv("MYSQL_USER");
	$dbpwd = getenv("MYSQL_PASSWORD");
	$dbname = getenv("MYSQL_DATABASE");

	// Connect to database and executes main. Prints error if unsuccessful.
	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	if($conn->connect_error){
		echo "<h3>Connection error: ".mysqli_connect_error()."</h3>";
		exit();
	}
	// Tests Form variables and adds vehicle to database
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Create variable used in form
		$v_year = $_POST['year'];
		$v_make = $_POST['make'];
		$v_model = $_POST['model'];
		$v_style = $_POST['style'];
		$v_miles = $_POST['miles'];
		$pur_price = $_POST['price_pur'];
		$list_price = $_POST['price_list'];
		$error_message = "";
		
		// Verify year
		if ($v_year < 1886 || $v_year > 2025){
			$error_message = "<h3>Error - Invalid Year Entered (Must be 1886 - 2025)</h3>";
		}

		// Verify make
		if (empty($v_make)){
			$error_message = "<h3>Error - Make not selected</h3>";
		}

		// Verify model entry
		if (empty($v_model)){
			$error_message = "<h3>Error - Model not entered</h3>";
		}

		// Verify Style
		if (empty($v_style)){
			$error_message = "<h3>Error - Body Style not selected</h3>";
		}

		// Verify miles
		if ($v_miles < 0 || $v_miles > 500000){
			$error_message = "<h3>Error - Invalid Miles Entered (Must be 0 - 500,000)</h3>";
		}

		// Verify purchase price
		if ($pur_price < 0 || $pur_price > 200000){
			$error_message = "<h3>Error - Invalid Purchase Price Entered (Must be 0 - 200,000)</h3>";
		}

		// Verify list price
		if ($list_price < 0 || $list_price > 200000){
			$error_message = "<h3>Error - Invalid List Price Entered (Must be 0 - 200,000)</h3>";
		}

		// Display error message if necessary, else adds vehicle
		if ($error_message != ""){
			echo "<h3>".$error_message."</h3>";
		} else {
			// Adds vehicle to database, displays error if necessary
			$sql = "INSERT INTO inventory(car_year, make, model, style, 
						miles, sold, list_price, pur_price) 
					VALUES($v_year, '$v_make', '$v_model', '$v_style', 
						$v_miles, 'Not Sold', $list_price, '$pur_price')";
			if(!mysqli_query($conn, $sql)){
				echo "<h3>Error - ".$conn->error."</h3>";
			} else {
				echo "<h4>Vehicle Successfully Added!</h4><br />";
			}
			echo '<br /><a href="..\index.php">Return to Home Page</a>';
			$conn->close();
		}
	}
?>
</body>
</html>