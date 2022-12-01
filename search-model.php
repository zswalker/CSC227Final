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
		$dbuser = getenv("databaseuser");
		$dbpwd = getenv("databasepassword");
		$dbname = getenv("databasename");

		$conn = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);
		if(!$conn){
			echo "Connection error: ".mysqli_connect_error();
			exit();
		} else {
			echo "Connection SUCCESS";
		}
		$conn->close();
	
    ?>
</body>
</html>