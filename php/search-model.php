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
		if(!mysqli_query($conn, $sql)){
			echo "Error - ".$conn->error;
		} else {
			$result = $conn->query($sql);
            if (!$result) {
                die("Could not successfully run query from $dbname: ".mysqli_error($conn));
            }
            if (mysqli_num_rows($result) == 0) {
                echo "No records found";
            } else {
                echo "<h1>Vehicles Found</h1>";
                echo "<table border='1'><table><thead><tr><th>Year</th><th>Make</th>
                <th>Model</th><th>Style</th><th>Miles</th><th>Price</th></tr></thead><tbody>"; 
                while($row = mysqli_fetch_assoc($result)) {
                    echo("<tr><td>".$row["car_year"]."</td>
                    <td>".$row["make"]."</td><td>".$row["model"]."</td>
                    <td>".$row["style"]."</td><td>".$row["miles"]."</td><td>"
                    .number_format($row["price"], 1, ",")."</td></tr>");
                }
                echo("</table>");
                echo("<h3>Thank you for using my program.</h3>");
                echo('<br><footer><a calss="white" href="..\index.php">
                         Return to Form Entry</a></footer>');
            }
            $conn->close();
		}
	}
?>