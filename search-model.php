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
		$dbuser = getenv("dbuser");
		$dbpwd = getenv("dbpass");
		$dbname = getenv("dbname");

		$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);
		if(!$conn){
			echo "Connection error: ".mysqli_connect_error();
		} else {
			echo "Connection SUCCESS";
		}
		$conn->close();
	
    ?>
</body>
</html>