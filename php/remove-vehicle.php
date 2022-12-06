<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Lot Modify</title>
	<link href="..\style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php
	// Create a back button
	echo '<a href="..\html\sell-remove.html"><-Back</a><br />';

	// Create variables for connection
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	$dbport = getenv("MYSQL_SERVICE_PORT");
	$dbuser = getenv("MYSQL_USER");
	$dbpwd = getenv("MYSQL_PASSWORD");
	$dbname = getenv("MYSQL_DATABASE");

	// Connect to database. Prints error if unsuccessful.
	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	if($conn->connect_error){
		echo "<h3>Connection error: ".mysqli_connect_error()."</h3>";
		exit();
	}

	// Tests Form variables and adds vehicle to database
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Create variable used in form
		$v_id = $_POST['car_id'];
		$error_message = "";

		// Verify vehicle ID
		if (empty($v_id)){
			$error_message = "<h3>Error - Vehicle ID not entered</h3>";
		}
		$sql = "SELECT * FROM inventory WHERE id='$v_id'";
		$result = mysqli_query($conn, $sql);
		if (!$result){
			echo "<h3>Error - ".$conn->error."</h3>";
		} else {
			if (mysqli_num_rows($result) == 0) {
				echo "<h3>Vehicle ID '".$v_id."' is not in inventory</h3>";
				exit();
			}
		}

        // Display error message if necessary, else remove vehicle
		if ($error_message != ""){
			echo "<h3>".$error_message."</h3>";
		} else {
            // Removes vehicle from database, displays error if necessary
			$sql2 = "DELETE FROM inventory WHERE id='$v_id'";
			if(!mysqli_query($conn, $sql2)){
				echo "<h3>Error - ".$conn->error."</h3>";
			} else {
				echo "<h4>Vehicle Successfully Removed!</h4>";
			}
			echo '<br /><a href="..\index.php">Return to Home Page</a>';
			$conn->close();
		}
	}
?>
</body>
</html>