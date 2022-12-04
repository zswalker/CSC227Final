<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Lot Modify</title>
	<link href="style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php
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
		exit();
	}
	// Tests Form variables and adds vehicle to database
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Create variable used in form
		$v_id = $_POST['car_id'];
		$error_message = "";

		// Verify vehicle ID
		if (empty($v_id)){
			$error_message = "Error - Vehicle ID not entered";
		}
        
        // Display error message if necessary, else sets vehicle to sold
		if ($error_message != ""){
			echo "<h3>".$error_message."<h3>";
		} else {
            // Sets vehicle to sold in database, displays error if necessary
			$sql = "UPDATE inventory SET sold='Sold' WHERE id='$v_id'";
			if(!mysqli_query($conn, $sql)){
				echo "Error - ".$conn->error;
			} else {
				echo "Vehicle Sold!<br>";
			}
			echo '<br /><a href="..\index.php">Return to Home Page</a>';
			$conn->close();
		}
	}
?>
</body>
</html>