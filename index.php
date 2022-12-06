<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Lot Inventory</title>
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

	// Connect to database and executes sql. Prints error if unsuccessful.
	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	if($conn->connect_error){
		echo "Connection error: ".$conn->connect_error;
		exit();
	} else {
		// Creates table if doesn't already exist
		$sql = "CREATE TABLE if not exists inventory(id serial primary key,
			car_year YEAR not null, make varchar(30) not null, model varchar(30) not null,
			style varchar(30) not null, miles int(6) not null, list_price int(6) not null, 
			pur_price int(6) not null, sold varchar(8) not null, sold_price int(6))";
		$result = mysqli_query($conn, $sql);
		$conn->close();
	}
?>
<div class="container">
	<header id="top">
		<h1>Walker's Used Car Lot</h1>
	</header>
	<main>
		<section id="tools">
			<img src="images\cars.jpg" alt="Cars Image" style="width:450px;height:350px;">
			<h2>Search</h2>
			<ul>
				<li><a href="html\search-model.html">Search By Make/Model</a></li>
				<li><a href="html\search-budget.html">Search By Price</a></li>
				<li><a href="html\search-style.html">Search By Style</a></li>
				<br />
				<li><a href="php\view-inventory.php">View Inventory</a></li>
				<li><a href="php\sold-vehicles.php">View Sold Vehicles</a></li>
			</ul>
			<h2>Modify</h2>
			<ul>
				<li><a href="html\add-vehicle.html">Add Vehicle</a></li>
				<li><a href="html\sell-remove.html">Sell/Remove Vehicle</a></li>
			</ul>	
		</section>
		<div id="about">				
				<h2>About</h2>
				<p>This website is used for finding your next used car from our used car lot.</p>
		</div>
	</main>
</body>
</html>