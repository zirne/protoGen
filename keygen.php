<?php


/*
//KeyGen
echo "KeyGen<br>";

echo "Seed: " . $currentSeed;
echo "<br>Chair: " . $meetingChairperson;
echo "<br>Secr: " . $meetingSecretary;
echo "<br>Adj1: " . $meetingAdjustor1;
echo "<br>Adj2: " . $meetingAdjustor2;
echo "<br><br>";

echo "Seed: " . md5($currentSeed);
echo "<br>Chair: " . md5($meetingChairperson);
echo "<br>Secr: " . md5($meetingSecretary);
echo "<br>Adj1: " . md5($meetingAdjustor1);
echo "<br>Adj2: " . md5($meetingAdjustor2);
echo "<br><br>";

$chairKey = md5($meetingChairperson . $currentSeed);
$secrKey = md5($meetingSecretary . $currentSeed);
$adj1Key = md5($meetingAdjustor1 . $currentSeed);
$adj2Key = md5($meetingAdjustor2 . $currentSeed);

echo "$chairKey <br>";
echo "$secrKey <br>";
echo "$adj1Key <br>";
echo "$adj2Key <br>";

preg_match_all('!\d+!', $chairKey, $matches);
print_r($matches);


/*
//::Parser::
function genKey($string)
{
	//Convert name + seed to MD5
	$string = md5($string);
	
	//Reduce them to numbers
	preg_match_all('!\d+!', $string, $array);
	print_r($array);
	
	//Add up the numbers
	$product = 0;
	foreach($array as $key => $value)
	{
		echo "$value <br>";
		$product = $product + (int)$value;
	}
	return $product;
}
echo genKey($meetingChairperson) . "<br>";
echo genKey($meetingSecretary) . "<br>";
echo genKey($meetingAdjustor1) . "<br>";
echo genKey($meetingAdjustor2) . "<br>";
*/
?>