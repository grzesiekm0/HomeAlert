<pre><?php
/*
	@phpSolutions
	Kursy video dotyczące zagadnień związanych z PHP
	
	Odcinek 01: Pobieranie informacji z innych stron
*/

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

$wia['tresc'];

while ($info['tytul'] != "") {
	$info['tytul']	= $html->find(".stre1vda-tre1vda-title",$i)->innertext;
	$info['opis']	= $html->find(".stre1vda-tre1vda-title",$i)->parent()->parent()->parent()->children(1)->children(1)->innertext;
	$info['cena']	= $html->find(".stre1vda-tre1vda-title",$i)->parent()->parent()->parent()->children(1)->children(0)->children(0)->children(3)->innertext;
	$info['tel']	= $html->find(".stre1vda-tre1vda-title",$i)->parent()->parent()->parent()->children(2)->children(0)->children(0)->children(2)->innertext;
	$i ++;
    print_r($info);

}
print_r($info);


//$info['tytul']	= $html->find(".stre1vda-tre1vda-title",1)->innertext;
// $info['opis']	= $html->find(".stre1vda-tre1vda-title",1)->parent()->parent()->parent()->children(1)->children(1)->innertext;
// $info['cena']	= $html->find(".stre1vda-tre1vda-title",1)->parent()->parent()->parent()->children(1)->children(0)->children(0)->children(3)->innertext;
// $info['tel']	= $html->find(".stre1vda-tre1vda-title",1)->parent()->parent()->parent()->children(2)->children(0)->children(0)->children(2)->innertext;

//print_r($info);
//echo $html;
?>