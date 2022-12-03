<?php
	// Function for adding a vehicle to database
	function insert_vehicle($conn, int $v_year, $v_make, $v_model, $v_type, int $v_miles, int $v_price){
		$sql = "SELECT * FROM inventory";
		$result = $conn->query($sql);
		$v_id = 0;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$v_id = $row['id'];
			}
		}
		$v_id += 1;
		$sql2 = "insert into inventory(id, car_year, make, model, car_type, miles, price) values
		(".$v_id.",".$v_year.",".$v_make.",".$v_model.",".$v_type.",".$v_miles.",".$v_price.")";
		$result = $conn->query($sql2);
		print "Vehicle Added\n";
	}

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
		insert_vehicle($conn, $car_year, $make, $model, $style, $miles, $price);
	}
?>