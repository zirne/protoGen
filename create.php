<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />
<meta charset="utf-8" />
<title></title>
</head>
<?php
include 'errors.php';
//Check if POST is set
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
//Include all the things!
include 'functions.php';
include 'variables.php';
include 'setup.php';

$scriptStarted = 1;

//Set stuff up regarding file creation
$meetingFolder = trim($currentSeed . "/");
if (!file_exists($meetingFolder)) 
{
	mkdir($meetingFolder, 0777, true);
	//Create empty index-file to hide stuff from snooping ppl
	$file = fopen($meetingFolder . "index.php", "w");
	fwrite($file, '<?php echo "nope"; ?>');
	fclose($file);
	unset($file);
}



	
//Declare Variables
$privDebug = 0;
$progress = 0;




//First, upload files to directory
include 'upload.php';

//Second, run through validator
include 'validator.php';

//Third, generate Document info
include 'docInfo.php';


//If validation checks out, run generation scripts.
if($progress === 2)
{
	//echo "SUCCESS!!";
	
	
	/* - REMOVE LATER
	//print_r(array_keys(get_defined_vars()));
	foreach(get_defined_vars() as $key => $value)
	{
		if(is_array($value)) 
		{
			foreach($value as $key2 => $value2)
			{
				if(is_array($value2)) 
				{
					foreach($value as $key3 => $value3)
					{
						echo "$key3 = $value3 <br>";
					}
				}
				else 
				{			
				echo "$key2 = $value2 <br>";
				}
			}
		}
		else 
		{			
		echo "$key = $value <br>";
		}
	}*/
	
	//Create raw data based on variables.php, just in case we modified something.
	include 'variables.php';
	//Generate documents
	include 'generator.php';

	//Generate Keys for Signing
	include 'keygen.php';
	
	//Display everything
	include 'display.php';
	
	

}
else 
{
	echo "Gå tillbaka och se över protokollet. Har ni fortfarande problem efter detta, ring förbundet.";
}









/*
	//$newFolder = $currentSeed . "/" . $sanitizedOrgName . "/" . date('Y') . "/";
	
	
	
	//Call for script that generates all data needed for display
		//Generate Documents
		include 'generateDocuments.php';
				
		//Call Raw Data Generator 
		include 'generateminutes.php';
		
	
	echo $currentSeed . "<br><br>";
	
	echo "List of Links:<br>";
	echo $linkToMinutes . "<br>";
	echo $linkToMinutes . "<br>";
	echo $linkToMinutes . "<br>";
	echo $linkToMinutes . "<br>";
	echo $linkToMinutes . "<br>";
*/	
	
	//When you are ready to show the world
	//include 'display.php';		

	
	
	
	
	//End of script, cleanup (chmod and other fun crap)
	



//Nothing below here
}
else
{
	echo "Stop trying to do shit you don't understand.<br>" . $errorIDs[100];
}
?>