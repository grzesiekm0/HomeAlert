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
$baza = array();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["home_data_id"]. " - Name: " . $row["description"]. "<br>";
        $baza[] = $row["description"];
        //array_push($baza, $row);
    }
} else {
    echo "0 results";
}

CloseCon($conn);


require('simple_html_dom.php');

/*
	Klasa		.nazwaklasy
	ID		#nazwaid
	tag		img
	klasa + name	.nazwaklasy[name='nazwa']
*/


$html = file_get_html("https://krosno24.pl/anonse/kategoria/27");

$i = 0;
$info['tytul']	= " ";


while ($info['tytul'] != "") {
	$info['tytul']	= $html->find(".stre1vda-tre1vda-title",$i)->innertext;
	//$info['opis']	= $html->find(".stre1vda-tre1vda-title",$i)->parent()->parent()->parent()->children(1)->children(1)->innertext;
	$info['cena']	= $html->find(".stre1vda-tre1vda-title",$i)->parent()->parent()->parent()->children(1)->children(0)->children(0)->children(3)->innertext;
	$info['tel']	= $html->find(".stre1vda-tre1vda-title",$i)->parent()->parent()->parent()->children(2)->children(0)->children(0)->children(2)->innertext;
	$i ++;
	$wyn = $info['tytul'] . $info['cena'] . $info['tel'];

	$arrlength = count($baza);
	$conn = OpenCon();
	$ind = 0;

	$sql_home = "INSERT INTO home_data (description) VALUES ('".$wyn."')";
	$sql_sms = "INSERT INTO home_sms (phone, description) VALUES ('728954912','".$wyn."')";
for($x = 0; $x < $arrlength; $x++) {

	if(($wyn == $baza[$x]) == true){
		$ind++;
	}else {}
	
}
if($ind == 0){
	
		if (mysqli_query($conn, $sql_sms)) {
    		echo "New record created successfully";
		} else {
    		 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		echo "Dodaj do dwoch tabel";}
	
$ind = 0;

	//print_r("index ".$ind);
	CloseCon($conn);
    print_r($wyn);
}
print_r($info);


?>