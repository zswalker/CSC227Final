<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Lot Search</title>
	<link href="..\style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<?php
	// Create a back button
	echo '<a href="..\html\search-model.html"><-Back</a><br />';

	// Create variables for connection
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	$dbport = getenv("MYSQL_SERVICE_PORT");
	$dbuser = getenv("MYSQL_USER");
	$dbpwd = getenv("MYSQL_PASSWORD");
	$dbname = getenv("MYSQL_DATABASE");

	// Connect to database. Prints error if unsuccessful.
	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	if($conn->connect_error){
		echo "<p>Connection error: ".mysqli_connect_error()."</p>";
		exit();
	} 
	
	// Tests Form variables and adds vehicle to database
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Create variables for testing
		$v_make = $_POST['make'];
		$v_model = $_POST['model'];
		$error_message = "";

		// Verify make
		if (empty($v_make)){
			$error_message = "<h3>Error - Make not selected</h3>";
		}

		// Displays error message if necessary, else searches for vehicle
		if ($error_message != ""){
			echo "<h3>".$error_message."</h3>";
		} else {
			// SQL Query to search for year, make, and model, diplays error if necessary
			$sql = "SELECT * FROM inventory 
					WHERE make='$v_make' && model LIKE '%$v_model%' && sold='Not Sold'";
			$result = $conn->query($sql);
			if (!$result) {
				die("<h3>Could not successfully run query from $dbname: ".mysqli_error($conn)."</h3>");
			}
	
			// Displays message if no results found
			if (mysqli_num_rows($result) == 0) {
				if ($v_model == ""){
					echo "<h3>No vehicles found with '".$v_make."' make</h3>";
				} else {
					echo "<h3><h3>No vehicles found with '".$v_make."' make and '".$v_model."' model</h3>";
				}
			} else {
				// else: Prints table of vehicles found
				echo "<header id='top'><h1>Vehicles Found</h1></header>";
				echo "<table border='1'><thead><tr><th>ID</th><th>Year</th><th>Make</th>
                    <th>Model</th><th>Style</th><th>Miles</th><th>List Price</th></tr></thead><tbody>";
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr><td>".$row["id"]."</td><td>".$row["car_year"]."</td>
                        <td>".$row["make"]."</td><td>".$row["model"]."</td>
                        <td>".$row["style"]."</td><td>"
                        .number_format($row["miles"], 0, ",")."</td><td>$"
                        .number_format($row["list_price"], 0, ",")."</td></tr>";
				}
				echo "</table>";
				echo "<p>Thank you for using my program - <a href='#top'>return to top</a></p>";
				echo '<br><footer><a calss="white" href="..\index.php">
							Return to Form Entry</a></footer>';
			}
			$conn->close();
		}
	}
?>
</body>
</html>