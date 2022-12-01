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
		$dbhost = getenv("MYSQL_SERVICE_SERVICE_HOST");
		$dbport = getenv("MYSQL_SERVICE_SERVICE_PORT");
		$dbuser = getenv('root');
		$dbpwd = getenv("MYSQL_ROOT_PASSWORD");
		$dbname = getenv("MYSQL_DATABASE");

		$conn = mysqli_connect($dbhost.":".$dbport, $dbuser, $dbpwd);
		if(!$conn){
			echo "Connection error: ".mysqli_connect_error();
		} else {
			echo "Connection SUCCESS";
		}
		close($conn);
	
    ?>
</body>
</html>