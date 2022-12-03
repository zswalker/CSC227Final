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
		$dbhost = getenv("MYSQL_SERVICE_HOST");
		$dbport = getenv("MYSQL_SERVICE_PORT");
		$dbuser = getenv("MYSQL_USER");
		$dbpwd = getenv("MYSQL_PASSWORD");
		$dbname = getenv("MYSQL_DATABASE");

		function insert_vehicle($conn, int $v_year, $v_make, $v_model, $v_type, int $v_miles, int $v_price){
			$sql = "SELECT * FROM inventory";
			$result = $conn->query($sql);
			$v_id = 0;
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$v_id = $row['id'];
				}
			}
			$v_id += 1;
			$sql2 = "insert into inventory(id, car_year, make, model, car_type, miles, price) values
			(".$v_id.",".$v_year.",".$v_make.",".$v_model.",".$v_type.",".$v_miles.",".$v_price.")";
			$result = $conn->query($sql2);
			print "Vehicle Added\n";
		}

		$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
		if($conn->connect_error){
			echo "Connection error: ".mysqli_connect_error();
		} else {
			
			$sql3 = "create table if not exists inventory(id serial primary key, car_year YEAR not null, make varchar(30) not null, model varchar(30) not null, car_type varchar(30) not null, miles int(6) not null, price int(8) not null)";
			$result = mysqli_query($conn, $sql3);			
		}
	
?>
<div class="container">
	<header id="top">
		<h1>Walker's Used Car Lot</h1>
	</header>
	<main>
		<div id="about">
			<nav>
				<img src="cars.jpg" alt="Cars Image" style="width:400px;height:350px;">
				<h2>About</h2>
				<p>This website is used for finding your next used car from our used car lot.</p>
				<br><br><br><br><br><br />
			</nav>
		</div>
		<section id="tools">
			<h3>Tools</h3>
			<table>
				<thead>
					<tr>
						<th>Search/Add Vehicle</th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td>
						<ul>
							<li> <a href="model\search-model.php">Search By Year, Make, and Model</a></li>
							<li> <a href="search-budget.php">Search By Budget</a></li>
							<li> <a href="search-style.php">Search By Style</a></li>
							<li> <a href="add-vehicle.php">Add Vehicle</a></li>
						</ul>
					</td>
				</tr>
				</tbody>
			</table>
		</section>
	</main>
</body>
</html>