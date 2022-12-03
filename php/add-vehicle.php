<?php
	// Create variables for connection
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	$dbport = getenv("MYSQL_SERVICE_PORT");
	$dbuser = getenv("MYSQL_USER");
	$dbpwd = getenv("MYSQL_PASSWORD");
	$dbname = getenv("MYSQL_DATABASE");

	// Create variable used in form
	$v_year = $_POST['year'];
	$v_make = $_POST['make'];
	$v_model = $_POST['model'];
	$v_style = $_POST['style'];
	$v_miles = $_POST['miles'];
	$v_price = $_POST['price'];

	// Connect to database and executes main. Prints error if unsuccessful.
	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	if($conn->connect_error){
		echo "Connection error: ".mysqli_connect_error();
	} else {
		// Tests Form variables and adds vehicle to database

		while True:
			// Verify year
			if ($v_year < 1886 || $v_year > 2025){
				echo "Error - Invalid Year Entered";
				break;
			}

			// Verify model entry
			if ($v_model == ""){
				echo "Error - Model not entered";
				break;
			}

			// Verify miles
			if ($v_miles < 0 || $v_miles > 500000){
				echo "Error - Invalid Miles Entered (Must be 0 - 500,000)";
				break;
			}

			// Verify price
			if ($v_price < 0 || $v_miles > 10000000){
				echo "Error - Invalid Price Entered (Must be 0 - 10,000,000)";
				break;
			}

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
?>