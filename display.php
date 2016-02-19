<?php


//Display Page for getting documents

echo "<a href='" . $documentFilePaths['zip'] . "' target='_blank'>Hämta protokoll och samtliga bilagor som ZIP</a><br>";
echo "<a href='" . $documentFilePaths['Protokoll'] . "' target='_blank'>Hämta protokoll som ODT</a><br>";
echo "<a href='view.php?ID=" . $currentSeed . "' target='_blank'>För att visa protokollet i efterhand.</a><br>";

$htmlDataString = "";
foreach ($rawDataArray as $key => $value)
{
	if(trim($value) == "") //Credits to ceve who reminded me of trim()
	{
		unset($rawDataArray[$key]);
	}
	else 
	{
		//$txt = textToHtml($value);
		//echo htmlspecialchars(textToHtml($value)) . "<br>";
		echo textToHtml($value) . "<br>";
		$htmlDataString = $htmlDataString . textToHtml($value) . "<br>";
	}
		
}

//Generate Config File
//Declare variables that are supposed to be saved in the config
$cfgArray = array(
$documentFilePaths['zip'],
$documentFilePaths['Protokoll'],
$htmlDataString,
$meetingChairperson,
$meetingSecretary,
$meetingAdjustor1,
$meetingAdjustor2
);

//Create Config File
$cfgFile = fopen($meetingFolder . "cfg.php", "w") or die("Error creating file!");
fwrite($cfgFile, "<?php ");
$counter = 0;
foreach ($cfgArray as $key => $value)
{
	fwrite($cfgFile, "$" . "cfgVar" . $counter . ' = "');
	fwrite($cfgFile, $value);
	fwrite($cfgFile, '";');
	$counter++;
}
fwrite($cfgFile, "?>");
fclose($cfgFile);




?>