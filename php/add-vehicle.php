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
		$v_price = $_POST['price'];
		$error_message = "";
		
		// Verify year
		if ($v_year < 1886 || $v_year > 2025){
			$error_message = "Error - Invalid Year Entered (Must be 1886 - 2025)";
		}

		// Verify make
		if (empty($v_make)){
			$error_message = "Error - Make not selected";
		}

		// Verify model entry
		if (empty($v_model)){
			$error_message = "Error - Model not entered";
		}

		// Verify Style
		if (empty($v_style)){
			$error_message = "Error - Body Style not selected";
		}

		// Verify miles
		if ($v_miles < 0 || $v_miles > 500000){
			$error_message = "Error - Invalid Miles Entered (Must be 0 - 500,000)";
		}

		// Verify price
		if ($v_price < 0 || $v_miles > 10000000){
			$error_message = "Error - Invalid Price Entered (Must be 0 - 10,000,000)";
		}

		// Display error message if necessary, else adds vehicle
		if ($error_message != ""){
			echo "<p>".$error_message."<p>";
		} else {
			// Adds vehicle to database, displays error if necessary
			$sql = "INSERT INTO inventory(car_year, make, model, style, miles, price, sold) 
			VALUES($v_year, '$v_make', '$v_model', '$v_style', $v_miles, $v_price, 'Not Sold')";
			if(!mysqli_query($conn, $sql)){
				echo "Error - ".$conn->error;
			} else {
				echo "Vehicle Successfully Added!<br>";
			}
			echo '<br /><a href="..\index.php">Return to Home Page</a>';
			$conn->close();
		}
	}
?>
</body>
</html>