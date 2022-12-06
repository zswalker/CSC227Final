<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Lot - Sold</title>
	<link href="..\style.css" type="text/css" rel="stylesheet" />
</head>

<body>
	<?php
        // Create header and back button
        echo '<a id="back" href="..\index.php">&lt;-Back</a><br />';
        echo "<header id='top'><h1>Vehicles Sold</h1></header>";

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
        } else {
            // SQL Query to search for model, diplays error if necessary
            $sql = "SELECT * FROM inventory WHERE sold='Sold'";
            $result = $conn->query($sql);
            if (!$result) {
                die("<h3>Could not successfully run query from $dbname: ".mysqli_error($conn)."</h3>");
            }

            // Displays message if no results found
            if (mysqli_num_rows($result) == 0) {
                echo "<h3>No records found</h3>";
            } else {
                // else: Prints total and table of sold vehicles
                $total = 0;

                // Prints table of vehicles found
                echo "<table border='1'><thead><tr><th>ID</th><th>Year</th><th>Make</th>
                    <th>Model</th><th>Style</th><th>Miles</th><th>Purchased</th><th>Sold</th></tr></thead><tbody>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>".$row["id"]."</td><td>".$row["car_year"]."</td>
                    <td>".$row["make"]."</td><td>".$row["model"]."</td>
                    <td>".$row["style"]."</td><td>"
                    .number_format($row["miles"], 0, ",")."</td><td>$"
                    .number_format($row["pur_price"], 0, ",")."</td><td>$"
                    .number_format($row["sold_price"], 0, ",")."</td></tr>";
                    $total += ($row["sold_price"] - $row["pur_price"]);
                }
                echo "</table>";
                echo "<h4>Total Revenue: $".number_format($total, 0, ",")."</h4><br />";
                echo "<p>Thank you for using my program - <a href='#top'>return to top</a></p>";
            }
            echo '<br><footer><a calss="white" href="..\index.php">
                Return to Homepage</a></footer>';
            $conn->close();
        }
	
    ?>
</body>
</html>