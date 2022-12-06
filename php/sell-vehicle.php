<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		Filename: sell_vehicle.php
		Author: Zach Walker
		Purpose: Verifies form info and sells vehicle in sql database
	-->
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

	// Connect to database and executes sql. Prints error if unsuccessful.
	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	if($conn->connect_error){
		echo "<h3>Connection error: ".mysqli_connect_error()."</h3>";
		exit();
	}
	
	// Tests Form variables and adds vehicle to database
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Create variable used in form
		$v_id = $_POST['car_id'];
		$sold_price = $_POST['price'];
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

		// Verify sold price
		if (empty($sold_price) || $sold_price < 0 || $sold_price > 200000){
			if (empty($sold_price)){
				// Sets vehicle sold price to list price if left empty
				$sql2 = "SELECT * FROM inventory WHERE id='$v_id'";
				$result2 = mysqli_query($conn, $sql2);
				if(!$result2){
					echo "<h3>Error - ".$conn->error."</h3>";
				} else {
					while($row = mysqli_fetch_assoc($result2)) {
						$sold_price = $row['list_price'];
					}
				}
			} else {
				$error_message = "<h3>Error - Vehicle price not between $0 and $200,000</h3>";
			}
		}
        
        // Display error message if necessary, else sets vehicle to sold
		if ($error_message != ""){
			echo "<h3>".$error_message."</h3>";
		} else {
            // Sets vehicle to sold in database, displays error if necessary
			$sql3 = "UPDATE inventory SET sold='Sold', sold_price='$sold_price' WHERE id='$v_id'";
			if(!mysqli_query($conn, $sql3)){
				echo "<h3>Error - ".$conn->error."</h3>";
			} else {
				echo "<h4>Vehicle Sold!</h4><br />";
			}
			echo '<br /><a href="..\index.php">Return to Home Page</a>';
			$conn->close();
		}
	}
?>
</body>
</html>