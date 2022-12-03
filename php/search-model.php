<?php
	$v_model = $_POST['model'];
	$dbhost = getenv("MYSQL_SERVICE_HOST");
	$dbport = getenv("MYSQL_SERVICE_PORT");
	$dbuser = getenv("MYSQL_USER");
	$dbpwd = getenv("MYSQL_PASSWORD");
	$dbname = getenv("MYSQL_DATABASE");

	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
	if($conn->connect_error){
		echo "Connection error: ".mysqli_connect_error();
	} else {
		$sql = "SELECT car_year, make, model, style, miles, price FROM inventory WHERE model='$v_model'";
		$result = $conn->query($sql);
		print("<h1>Search Completed by Vehicle Model</h1>");
		if (!$result) {
			die("Could not successfully run query from $dbname: ".mysqli_error($conn));
        }
        if (mysqli_num_rows($result) == 0) {
			print("No records found with Model: $v_model");
        } else {
			print("<h1></h1>");
			print("<table border = \"1\">");
			print("<table><thead><tr><th>Year</th><th>Make</th><th>Model</th><th>Style</th><th>Miles</th><th>Price</th></tr></thead><tbody>"); 
			while($row = mysqli_fetch_assoc($result)) {
				print ("<tr><td>".$row["car_year"]."</td><td>".$row["make"]."</td><td>".$row["model"]."</td><td>".$row["style"]."</td><td>".$row["miles"]."</td><td>"
				.number_format($row["price"], 2, ".", ",")."</td></tr>");
			}
			print ("</table>");
			print ("<h3>Thank you for using my program.</h3>");
			print ('<br><footer><a calss="white" href="search-model.html">
	 				Return to Form Entry</a></footer>');
	  	}	
	}
?>