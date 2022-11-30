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
		$dbuser = getenv("inventoryusername");
		$dbpwd = getenv("inventorypassword");
		$dbname = getenv("databasename");

		$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);
		if($conn->connect_error){
			echo "Connection error: ".mysqli_connect_error();
			exit();
		} else {
			$sql = "SELECT * FROM inventory";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>".$row['id']."</td><td>".$row['car_year'].
					"</td><td>".$row['make']."</td><td>".$row['model']."</td><td>".
					$row['car_type']."</td><td>".$row['miles']."</td><td>".
					$row['price']."</td></tr>";
				}
			}
			$conn->close();
		}
	
    ?>
</body>
</html>