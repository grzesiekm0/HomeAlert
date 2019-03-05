<?php
 include 'db_connection.php';
 $conn = OpenCon();
 echo "Connected Successfully";

// $servername = "localhost";
// $username = "root";
// $password = "root";
// $dbname = "home";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } 

$sql = "SELECT home_data_id, description FROM home_data";
$result = $conn->query($sql);
$baz = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["home_data_id"]. " - Name: " . $row["description"]. "<br>";
		array_push($baz, $row);
	}
} else {
    echo "0 results";
}

CloseCon($conn);
?>