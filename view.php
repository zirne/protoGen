<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<meta charset="utf-8" />
<title></title>
</head>
<?php
//Include all the things!
include 'functions.php';
include 'variables.php';
include 'setup.php';

$theForm = '<form method="get" action="view.php" enctype="multipart/form-data"><input type="text" name="ID" value=""><button type="submit">Skicka in!</button></form>';


//Check if there is an ID in GET
if(isset($_GET["ID"]))
{
	$checkID = test_input($_GET["ID"]);
	if ($checkID != "")
	{
		$meetingFolder = trim($checkID . "/");
		if (file_exists($meetingFolder)) 
		{//Go ahead and do crazy stuff
			include $meetingFolder . 'cfg.php';
	
			//Display Page for getting documents
			echo "<a href='" . $cfgVar0 . "' target='_blank'>Hämta protokoll och samtliga bilagor som ZIP</a><br>";
			echo "<a href='" . $cfgVar1 . "' target='_blank'>Hämta protokoll som ODT</a><br>";
			echo "<a href='view.php?ID=" . $checkID . "' target='_blank'>För att visa protokollet i efterhand.</a><br>";
			echo $cfgVar2;
			/*
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
				}
		
			}*/
		}
		else
		{
			echo "Ogiltigt ID angivet, prova igen.<br>";
			echo $theForm;
			
		}
	}
	else
	{
		echo "Ogiltigt ID angivet, prova igen.<br>";
		echo $theForm;
	}	
}
else
{
	echo "Inget ID angivet.<br>Ange ID nedan:<br>";
	echo $theForm;
}


?>
</HTML>