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
        // Create header and back button
        echo '<a id="back" href="..\index.php"><-Back</a><br />';
        echo "<header id='top'><h1>Used Car Lot</h1></header>";

        // Create variables for connection
		$dbhost = getenv("MYSQL_SERVICE_HOST");
        $dbport = getenv("MYSQL_SERVICE_PORT");
        $dbuser = getenv("MYSQL_USER");
        $dbpwd = getenv("MYSQL_PASSWORD");
        $dbname = getenv("MYSQL_DATABASE");

		// Connect to database and executes main. Prints error if unsuccessful.
        $conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
        if($conn->connect_error){
            echo "<p>Connection error: ".mysqli_connect_error()."</p>";
        } else {
            // SQL Query to search for model, diplays error if necessary
            $sql = "SELECT * FROM inventory WHERE sold='Not Sold'";
            $result = $conn->query($sql);
            if (!$result) {
                die("<p>Could not successfully run query from $dbname: ".mysqli_error($conn)."</p>");
            }

            // Displays message if no results found
            if (mysqli_num_rows($result) == 0) {
                echo "<h3>No records found</h3>";
            } else {
                // else: Prints table of vehicles found
                echo "<table border='1'><thead><tr><th>ID</th><th>Year</th><th>Make</th>
                <th>Model</th><th>Style</th><th>Miles</th><th>Price</th></tr></thead><tbody>"; 
                while($row = mysqli_fetch_assoc($result)) {
                    echo("<tr><td>".$row["id"]."</td><td>".$row["car_year"]."</td>
                    <td>".$row["make"]."</td><td>".$row["model"]."</td>
                    <td>".$row["style"]."</td><td>".number_format($row["miles"], 0, ",")."</td><td>$"
                    .number_format($row["price"], 0, ",")."</td></tr>");
                }
                echo "</table>";
                echo "<h3>Thank you for using my program <a href='#top'><top></a></h3>";
            }
            echo '<br><footer><a calss="white" href="..\index.php">
                Return to Homepage</a></footer>';
            $conn->close();
        }
	
    ?>
</body>
</html>