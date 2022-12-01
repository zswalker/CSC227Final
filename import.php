<?php
    $conn = mysqli_connect('localhost', 'root', '', 'inventory');
    
    $filename = 'inventory.sql';
    $handle = fopen($filename, "r+");
    $contents = fread($handle, filesize($filename));

    $sql = explode(';', $contents)
    foreach($sql as $query){
        $result = mysqli_query($conn, $query);
        if($result){
            echo '<tr><td><br></td></tr>';
            echo '<tr><td>'.$query.'<b>SUCCESS</b></td></tr>';
            echo '<tr><td><br></td></tr>';
        }
    }
    $fclose($handle);
    echo "SUCCESS";


    $sql = "SELECT * FROM inventory";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>".$row['id']."</td><td>".$row['car_year'].
					"</td><td>".$row['make']."</td><td>".$row['model']."</td><td>".
					$row['car_type']."</td><td>".$row['miles']."</td><td>".
					$row['price']."</td></tr>";
				}
			}

?>