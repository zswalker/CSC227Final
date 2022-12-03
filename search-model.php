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
		$dbhost = getenv("MYSQL_SERVICE_HOST");
		$dbport = getenv("MYSQL_SERVICE_PORT");
		$dbuser = getenv("MYSQL_USER");
		$dbpwd = getenv("MYSQL_PASSWORD");
		$dbname = getenv("MYSQL_DATABASE");

		$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
		if($conn->connect_error){
			echo "Connection error: ".mysqli_connect_error();
		} else {
			$sql = "SELECT * FROM inventory";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$year = $row['car_year'];
					$make = $row['make'];
					$model = $row['model'];
					$car_type = $row['car_type'];
					$miles = $row['miles'];
					$price = $row['price'];
					echo $year." ".$make." ".$model.", ".$car_type.", Milage: ".$miles.", $".$price."\n";
				}
			}
		}
	
    ?>
</body>
</html>