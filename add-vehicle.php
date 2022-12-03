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
		// import index.php
		require "index.php";
		
		function main($conn){
			// Function Header
			insert_vehicle($conn, 2005, 'Chevy', 'Silverado', 'Truck', 101050, 58000);
			insert_vehicle($conn, 2008, 'Ford', 'Mustang GT', 'Coupe', 65658, 16800);
			insert_vehicle($conn, 1980, 'Chevy', 'Corvette','Coupe', 95000, 22500);
			insert_vehicle($conn, 2019, 'Honda', 'Civic Type R', 'Sedan', 21800, 35899);
			insert_vehicle($conn, 2022, 'Acura', 'NSX', 'Coupe', 20, 171400);
		}

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
			main($conn);
		}
	
    ?>
</body>
</html>