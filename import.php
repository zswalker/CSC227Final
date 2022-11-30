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

?>