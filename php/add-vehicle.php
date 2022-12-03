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

	// Tests
	echo $v_year." ".$v_make." ".$v_model."<br>";
	echo $v_style." ".$v_miles." ".$v_price."<br>";

	// Connect to database and executes main. Prints error if unsuccessful.
	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	if($conn->connect_error){
		echo "Connection error: ".mysqli_connect_error();
	} else {
		// Test entries, if valid add vehicle
		$sql = "INSERT INTO inventory(car_year, make, model, style, miles, price, sold) 
		VALUES($v_year, $v_make, $v_model, $v_style, $v_miles, $v_price, 'Not Sold')";
		if(!$conn->query($sql)){
			echo "Error - ".$conn->error;
		} else {
			echo "Vehicle Added<br>";
		}
		echo '<br /><a href="..\index.php">Return to Home Page</a>';
		$conn->close();
	}
?>