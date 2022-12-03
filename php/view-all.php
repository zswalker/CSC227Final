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
        } else {
            $sql = "SELECT * FROM inventory";
            $result = $conn->query($sql);
            if (!$result) {
                die("Could not successfully run query from $dbname: ".mysqli_error($conn));
            }
            if (mysqli_num_rows($result) == 0) {
                print("No records found");
            } else {
                print("<h1></h1>");
                print("<table border = \"1\">");
                print("<table><thead><tr><th>Year</th><th>Make</th><th>Model</th><th>Type</th><th>Miles</th><th>Price</th></tr></thead><tbody>"); 
                while($row = mysqli_fetch_assoc($result)) {
                    print ("<tr><td>".$row["car_year"]."</td><td>".$row["make"]."</td><td>".$row["model"]."</td><td>".$row["car_type"]."</td><td>".$row["miles"]."</td><td>"
                    .number_format($row["price"], 2, ".", ",")."</td></tr>");
                }
                print ("</table>");
                print ("<h3>Thank you for using my program.</h3>");
                print ('<br><footer><a calss="white" href="search-model.html">
                         Return to Form Entry</a></footer>');
              }	
        }
	
    ?>
</body>
</html>