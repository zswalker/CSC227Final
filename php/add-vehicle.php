<?php
	// Create variables for connection
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	$dbport = getenv("MYSQL_SERVICE_PORT");
	$dbuser = getenv("MYSQL_USER");
	$dbpwd = getenv("MYSQL_PASSWORD");
	$dbname = getenv("MYSQL_DATABASE");

	// Create variable used in form
	$car_year = $_POST['year'];
	$make = $_POST['make'];
	$model = $_POST['model'];
	$style = $_POST['style'];
	$miles = $_POST['miles'];
	$price = $_POST['price'];

	// Connect to database and executes main. Prints error if unsuccessful.
	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	if($conn->connect_error){
		echo "Connection error: ".mysqli_connect_error();
	} else {
		// Test entries, if valid add vehicle
		$sql = "INSERT INTO inventory(car_year, make, model, style, miles, price, sold) 
		VALUES($car_year, $make, $model, $style, $miles, $price, 'Not Sold')";
		$result = $conn->query($sql);
		if(!$result){
			echo "Error - Could not add vehicle";
		} else {
			echo "Vehicle Added<br>";
		}
		echo '<br /><a href="..\index.php">Return to Home Page</a>';
		$conn->close();
	}
?>