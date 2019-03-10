<?php
 include 'db_connection.php';
 $conn = OpenCon();
 echo "Connected Successfully";

$sql = "SELECT home_data_id, description FROM home_data";
$result = $conn->query($sql);
$baza = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["home_data_id"]. " - Name: " . $row["description"]. "<br>";
        $baza[] = $row["description"];
    }
} else {
    echo "0 results";
}

CloseCon($conn);

require('simple_html_dom.php');

$base = 'https://krosno24.pl/anonse/kategoria/27';
 $curl = curl_init();
 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
 curl_setopt($curl, CURLOPT_HEADER, false);
 curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
 curl_setopt($curl, CURLOPT_URL, $base);
 curl_setopt($curl, CURLOPT_REFERER, $base);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
 $str = curl_exec($curl);
 curl_close($curl);
// Create a DOM object
 $html = new simple_html_dom();
 // Load HTML from a string
 $html->load($str);
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

			mysqli_query($conn, $sql_sms);
			mysqli_query($conn, $sql_home);
			
			}
	
$ind = 0;

	//print_r("index ".$ind);
	CloseCon($conn);
    print_r($wyn);
}
print_r($info);


?>