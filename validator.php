<?php
//The purpose of this file is to check all data to make sure that
//nothing is wrong or invalid, no parsing should be done here.
//Parsing is for generator.php and this file should run independently.








//Check if POST is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	//Create log file in document folder
	$logFile = fopen($meetingFolder . "log.txt", "w") or die("Error creating file!");
	foreach(get_defined_vars() as $key => $value)
	{
		if(is_array($value)) 
		{
			foreach($value as $key2 => $value2)
			{
				if(is_array($value2)) 
				{
					foreach($value2 as $key3 => $value3)
					{
						//if(is_array($value3) 
						//{
							
						//}
						$txt = "--------$key3 = $value3" . PHP_EOL;
						fwrite($logFile, $txt);
					}
				}
				else 
				{	
				$txt = "----$key2 = $value2" . PHP_EOL;
				fwrite($logFile, $txt);
				}
			}
		}
		else 
		{			
		$txt = "$key = $value" . PHP_EOL;
				fwrite($logFile, $txt);
		}
	}
	fclose($logFile);
	$txt = "";









	//Set Error levels to 0 and declare stuff
	$superErrors = array();
	$parseErrors = array();
	$uploadErrors = array();
	$generalErrors = array();
	$warningErrors = array();
	$attachmentID = 0;
	$currentYear = date('Y');
	$callForHelp = 0;
	$generatorFlags = array();
	
	//Declare stuff
	//Create empty arrays for parsing
	//$generateFiles = array();
	//$generateTxt = array();
	//$generateOds = array();	
	
	
	// Create Array of Values that cannot be NULL
	$neededParameters = array(
	"orgType",
	"orgName",
	"meetingTime",
	"meetingPlace",
	"meetingOpener",
	"meetingOpenTime",
	"meetingPresentVoters",
	"meetingPresentVotersNumber",
	"meetingChairperson",
	"meetingSecretary",
	"meetingAdjustor1",
	"lastYearPresentationValid",
	"lastYearEconomyValid",
	"lastYearAuditoryValid",
	"boardResponsibility",
	"nextYearPlanText",
	"orgNewChairperson",
	"orgNewTreasurer",
	"orgNewAuditor1",
	"meetingEndTime",
	"nextYearPlanValid",
	"nextYearBudgetValid",
	"lastYearPresentationFormat",
	"meetingCallDate",
	"meetingCallTime",
	"meetingEndDate",
	"meetingValid",
	);
	
	//Create array containing config info - Useful Later I guess
	$configInfo = array(






	);
	
/*//Manage ALL File uploads! - FUTURE PROJECT!	
foreach($_FILES as $value => $key){

echo serialize($key) . "<br>";
echo "Running: " . $value . "<br>";

if(empty($key)) 
	{
	$imageFileType = pathinfo($value,PATHINFO_EXTENSION);
	
	echo $imageFileType;
	
	if ($value["size"] > 10000000) {
		array_push($uploadErrors,121);
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($value == "lastYearPresentationFile") 
	{
		if($imageFileType != "odt" && $imageFileType != "pdf" && $imageFileType != "txt" && $imageFileType != "rtf" ) 
		{
		    array_push($uploadErrors,122);
		    $uploadOk = 0;
		}
		else 
		{//Set Filename
			
		}
	}
	elseif($value == "lastYearEconomyFile") 
	{
		if($privDebug == 1){echo "Checking Filetype ODS/PDF<br>";}
		if($imageFileType != "ods" && $imageFileType != "pdf" ) 
		{
			array_push($uploadErrors,123);
		   $uploadOk = 0;
		}
	}
	elseif($value == "lastYearAuditoryFile") 
	{
		if($privDebug == 1){echo "Checking Filetype PDF<br>";}
		if($imageFileType != "pdf" ) 
		{
			array_push($uploadErrors,124);
		   $uploadOk = 0;
		}
	}
	// Check if $uploadOk is set to 0 by an error
	if($privDebug == 1){echo "Checking value of uploadOk:" . $uploadOk . "<br><br>";}
	if ($uploadOk == 0) 
	{
	   array_push($uploadErrors,125);
	// if everything is ok, try to upload file
	} 
	else 
	if($uploadOk == 0)
		foreach ($uploadErrors as $value) 
		{
	    	echo $value . " - ";
	    	//Match $parseErrors against the $errorIDs Array that contains translations for people that aren't me.
	    	echo $errorIDs[$value] . "<br>";
	   }
	}
}*/

	
	
	
	//Check if meeting info is legit
	if(!empty($orgType)) 
	{ //Check if Organisation Type is valid
		$validator = 0;
		foreach ($licOrg as $key => $value)
		{ //Matching input against licensed organisations
			if($orgType === $value)
			{
			$validator = 1;
			}
		}
		if($validator !== 1) 
		{ //If not valid, stop haxxing pls
			$errorID=101;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
		}
		$validator = 0;
	}
	else 
	{ //If not valid, stop haxxing pls
	$errorID=101;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
	}
	
	
	
		//Validating Times
	if (!empty($meetingTime))
	{ //Validating Date for meeting
		if(validateDate($meetingTime) === false)
		{ //Validate Meeting Call time
			$errorID=600;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
		}
	}
	else 
	{ //If it's empty, throw error
		$errorID=600;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
	}
	
	if (!empty($meetingEndDate))
	{ //Validating Date for end of meeting
		if(validateDate($meetingEndDate) === false)
		{ //Validate Meeting Call time
			$errorID=601;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
		}
	}
	else 
	{ //If it's empty, throw error
		$errorID=601;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
	}
	
	
	if (!empty($meetingOpenTime))
	{ //Validate time for opening
		if(validateMilTime($meetingOpenTime) === false)
		{ //Validate Meeting Open time
			$errorID=602;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
		}
	}
	else 
	{ //If it's empty, throw error
		$errorID=602;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
	}
	
	if (!empty($meetingEndTime))
	{ //Validate time for closing
		if(validateMilTime($meetingEndTime) === false)
		{ //Validate Meeting End time
			$errorID=603;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
		}
	}
	else 
	{ //If it's empty, throw error
		$errorID=603;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
	}
	
	//Validate call for meeting
	if (!empty($meetingCallTime))
	{ //Validate time for opening
		if(validateMilTime($meetingCallTime) === false)
		{ //Validate Meeting Open time
			$errorID=605;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
		}
	}
	else 
	{ //If it's empty, throw error
		$errorID=605;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
	}
		//Validate Call date
	if (!empty($meetingCallDate))
	{ //Check that meeting call time is valid date 
		if(validateDate($meetingCallDate) === false)
		{ //Validate Meeting Call time
			$errorID=604;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
		}
	}
	else 
	{ //If it's empty, throw error
		$errorID=604;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
	}

		//If all times and dates are valid times and dates, check if call times was at least two weeks, display warning otherwise
	if(!empty($meetingTime) && !empty($meetingCallDate) && !empty($meetingCallTime) && !empty($meetingOpenTime)) 
	{	//If not empty, check validity
		if(validateDate($meetingCallDate) === true && validateDate($meetingTime) === true && validateMilTime($meetingCallTime) === true && validateMilTime($meetingOpenTime) === true)
		{ //Check if call times was at least two weeks, display warning otherwise
			$meetingCallTime = convertToTime($meetingCallTime);
			$meetingOpenTime = convertToTime($meetingOpenTime); 
			$meetingEndTime = convertToTime($meetingEndTime); 
			$meetingCallInfo = $meetingCallDate . " " . $meetingCallTime;
			$meetingOpenInfo = $meetingTime . " " . $meetingOpenTime;
			$meetingCallInfo = strtotime($meetingCallDate . " " . $meetingCallTime);
			$meetingOpenInfo = strtotime($meetingTime . " " . $meetingOpenTime);		
			if($meetingOpenInfo - $meetingCallInfo <= 1209600) //1209600 is two weeks in seconds, (60*60*24*14)
			{//If calling time is less than two weeks, display warning
				$errorID=400;if(checkIfErrorSet($warningErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
			}
		}
	}
	//Check if closing time is after opening time
	if(!empty($meetingOpenTime) && !empty($meetingEndTime)) 
	{ //If both are not empty, check values
		if(!empty($meetingTime) && !empty($meetingEndDate) && $meetingTime === $meetingEndDate)
		{ //Only check time if start date and end date are the same 
			if(convertToTime($meetingEndTime) <= convertToTime($meetingOpenTime)) 
			{ //If closing time is after opening time, display Warning
				$errorID=606;if(checkIfErrorSet($warningErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}
			}
		}
	}




	//Check if all required resources are legit.
	$resourceID = 0;
	$missingResources = 0;
	//Check if all nessecary variables are set
	foreach ($neededParameters as $key => $value) 
	{ // Matching values in $_POST against current value of $needed parameter
		$foundresource = 0;
		$resourceEmpty = 0;
		//echo "Key: " . $key . "<br>Value: " . $value . "<br><br>Scanning...<br>";
		//Scan for a match
		foreach ($_POST as $key2 => $value2) 
		{ //Check if current value in $neededParameters exists in $_POST
			if($value == $key2) 
			{
				//Check if value of input is empty
				if(!empty($value2)) 
				{
					$foundresource = 1;
					break;
				}
				/*Code seems unnessecary - for diagnostics while coding
				elseif(empty($value2)) 
				{
					$resourceEmpty = 1;
				}*/
			}
			/*Code seems unnessecary - for diagnostics while coding
			else 
			{
			//	echo "noop...";
			}*/
		}
		if($foundresource === 1) 
		{ //Pointless, but useful if you try shit and want to look at progress
			//echo "<br>Found matching input!<br>Input:" . $key2 . " matches with '" . $value . "' from database and has the value of " . $value2 . "!<br>";
		}
		else 
		{ //If resources are missing, generate error messages
			//Code seems unnessecary - used for diagnostics while coding
			if($resourceEmpty === 1) 
			{
				//echo "<br>Error: Resource is empty!<br>";
				//echo "Resource Missing: [" . $resourceID . "]" . $value;
			}
			else 
			{
				//echo "<br>Error: No match was found in the current input.<br>";
				//echo "Resource Missing: [" . $resourceID . "]" . $value;
			}
		$missingResources++;
		$errorID = 200 + $resourceID;
		array_push($parseErrors,$errorID);
		}	
		$resourceID++;
	}

	//Alright! Time to check what other stuff is set!
	//This means that it is time for manual labor!
	//Check that voting people input is legit
	//Make each row in $meetingPresentVoters
//Converts $meetingPresentVoters into an array, strips blank rows and returns array without unnecessary information
	$meetingPresentVoters = textRowsToArray($meetingPresentVoters);
	if (trim(count($meetingPresentVoters)) === trim($meetingPresentVotersNumber))
	{ //Check if number of voters match with people in list
		foreach ($meetingPresentVoters as $key => $value)
		{ //Check if strings contains whitespace (Which means first name and last name exists)
			if (whitespaceCheck($value) !== true) 
			{
				$errorID=302;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops 
			}
		}
		if(trim(count($meetingPresentVoters)) < 2) //THIS IS THE THING I MIGHT CHANGE!!!
		{ //If number of participants are less than X, generate error
			$errorID=303;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops 
		}
	}
	else 
	{ //If number of voters doesn't match with list, generate error
		if(trim(count($meetingPresentVoters)) < 2) //THIS IS THE THING I MIGHT CHANGE!!!
		{ //If number of participants also are less than X, generate error
			$errorID=303;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops 
		}
		$errorID=301;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops 
	}
	//Reset value of $meetingPresentVoters after processing if it's actually set, by grabbing from $_POST
	// THIS MIGHT BE A BAD IDEA, LET'S KEEP IT A ARRAY!
	//if(isset($_POST['meetingPresentVoters'])){$meetingPresentVoters = test_input($_POST['meetingPresentVoters']);}

	//Check for meeting chairperson, meeting secretary and adjustors, plus who opened the meeting
	if(!empty($meetingChairperson))
	{ //Check if there was a meeting chairperson
		if (whitespaceCheck($meetingChairperson) !== true) 
		{ //Check if Meeting Chairperson has a first name and last name
			$errorID=610;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
		} 
	}
	else 
	{ //If not exists, create error
		$errorID=610;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
	}
	
	if(!empty($meetingSecretary))
	{ //Check if there was a meeting secretary
		if (whitespaceCheck($meetingSecretary) !== true) 
		{ //Check if Meeting Chairperson has a first name and last name
			$errorID=611;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
		}
	}
	else 
	{ //If not exists, create error
		$errorID=611;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
	}
	
	$meetingAdjustors = 0;
	if(!empty($meetingAdjustor1))
	{ //Check if there was a adjustor
		if (whitespaceCheck($meetingAdjustor1) !== true) 
		{ //Check if new adjustor has a first name and last name
			$errorID=612;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
		}
		else 
		{	//If one legit adjustor exists, add one
			$meetingAdjustors++;
		} 
	}
	if(!empty($meetingAdjustor2))
	{ //Check if there was another adjustor
		if (whitespaceCheck($meetingAdjustor2) !== true) 
		{ //Check if new adjustor has a first name and last name
			$errorID=612;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
		}
		else 
		{	//If one legit adjustor exists, add one
			$meetingAdjustors++;
		} 	
	}
	if($meetingAdjustors < 1) 
	{	//If there are less than one adjustor, generate error 
		$errorID=613;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
	}
	
	if(!empty($meetingOpener))
	{ //Check if there was a meeting chairperson
		if (whitespaceCheck($meetingOpener) !== true) 
		{ //Check if Meeting Opener has a first name and last name
			$errorID=614;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
		} 
	}
	else 
	{	//If not exists, create error
		$errorID=614;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
	}
	
	
	//Check that enough people are elected and that they have first names and last names
	$peopleOnBoard = 0;
	if(!empty($orgNewMembers)) 
	{ //Check if board members were elected
		$orgNewMembers = textRowsToArray($orgNewMembers);
		foreach ($orgNewMembers as $key => $value)
		{ //Check if strings contains whitespace (Which means first name and last name exists)
			if (whitespaceCheck($value) !== true) 
			{
				$errorID=618;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops 
			}
		}
		$peopleOnBoard = $peopleOnBoard + count($orgNewMembers);
	}
	
	if(!empty($orgNewChairperson)) 
	{ //Check if there is a new chairperson
		$peopleOnBoard++;
		if (whitespaceCheck($orgNewChairperson) !== true) 
		{ //Check if new Chairperson has a first name and last name
			$errorID=615;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
		}
	}
	else 
	{ //If there isn't a new chairperson, generate error
		$errorID=619;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops	
	}
	
	if(!empty($orgNewTreasurer))
	{ //Check if there is a new treasurer
		$peopleOnBoard++;
		if (whitespaceCheck($orgNewTreasurer) !== true) 
		{ //Check if new Treasurer has a first name and last name
			$errorID=616;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops 
		}
	}
	else 
	{ //If there isn't a new treasurer, generate error
		$errorID=620;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops	
	}
	
	if(!empty($orgNewSecretary)) 
	{ //Check if there is a new secretary
		$peopleOnBoard++;
		if (whitespaceCheck($orgNewSecretary) !== true) 
			{ //Check if new Secretary has a first name and last name
				$errorID=617;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops 
			}
	}
	
	if($peopleOnBoard < 3) 
	{ // If less than three people on the board, generate error
		$errorID=621;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
	}
	//More code
	
	//Check that at least one valid auditor is elected
	$electedAuditors = 0;
	if(!empty($orgNewAuditor1)) 
	{ //Check if Auditor1 is set and legit
		if (whitespaceCheck($orgNewAuditor1) !== true) 
		{ //Check if new Auditor has a first name and last name
			$errorID=622;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops 
		}
		else 
		{	//If one legit auditor exists, add one
			$electedAuditors++;
		}
	}
	if(!empty($orgNewAuditor2)) 
	{ //Check if Auditor2 is set and legit
		if (whitespaceCheck($orgNewAuditor2) !== true) 
		{ //Check if new Auditor has a first name and last name
			$errorID=622;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops 
		}
		else 
		{	//If one legit auditor exists, add one
			$electedAuditors++;
		}
	}
	if($electedAuditors < 1) 
	{	//If there are less than one auditor, generate error 
		$errorID=623;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
	}
	
	//Did you elect people twice?
	//Is meeting secretary also adjustor?
	if(trim($meetingSecretary) === trim($meetingAdjustor1) OR trim($meetingSecretary) === trim($meetingAdjustor2)) 
	{
		$errorID=626;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
	}
	//Is auditor also on the board?
	if(!empty($orgNewAuditor1))
	{
		if(!empty($orgNewMembers))
		{
			foreach($orgNewMembers as $key => $value)
			{
				//echo "Comparing $value with $orgNewAuditor1 and $orgNewAuditor2 ... <br>";
				if (strpos($value,$orgNewAuditor1) !== false) 
				{
	    		$errorID=627;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
				}
			}
		}
		//echo "Comparing $orgNewChairperson , $orgNewTreasurer and $orgNewSecretary with $orgNewAuditor1 and $orgNewAuditor2 ... <br>";
		if (strpos($orgNewChairperson,$orgNewAuditor1) !== false OR strpos($orgNewTreasurer,$orgNewAuditor1) !== false OR strpos($orgNewSecretary,$orgNewAuditor1) !== false) 
		{
    		$errorID=627;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
		}
	}
	if(!empty($orgNewAuditor2))
	{
		if(!empty($orgNewMembers))
		{
			foreach($orgNewMembers as $key => $value)
			{
				//echo "Comparing $value with $orgNewAuditor1 and $orgNewAuditor2 ... <br>";
				if (strpos($value,$orgNewAuditor2) !== false) 
				{
	    		$errorID=627;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
				}
			}
		}
		//echo "Comparing $orgNewChairperson , $orgNewTreasurer and $orgNewSecretary with $orgNewAuditor1 and $orgNewAuditor2 ... <br>";
		if (strpos($orgNewChairperson,$orgNewAuditor2) !== false OR strpos($orgNewTreasurer,$orgNewAuditor1) !== false OR strpos($orgNewSecretary,$orgNewAuditor2) !== false) 
		{
			
    		$errorID=627;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
		}
	}
	
	
	//Is election commitee also on the board?
	if(!empty($orgNewElectioners)) 
	{
		foreach(textRowsToArray($orgNewElectioners) as $key => $value)
		{
			//echo "Key: $key , Value: $value <br>";
			foreach($orgNewMembers as $key2 => $value2)
			{
				//echo "Comparing $value2 with $value ... <br>";
				if (strpos($value2,$orgNewAuditor1) !== false OR strpos($value2,$orgNewAuditor2) !== false) 
				{
	    		$errorID=628;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
				}
			}
			//echo "Comparing $orgNewChairperson , $orgNewTreasurer and $orgNewSecretary with $value ... <br>";
			if (strpos($orgNewChairperson,$orgNewAuditor1) !== false OR strpos($orgNewTreasurer,$orgNewAuditor1) !== false OR strpos($orgNewSecretary,$orgNewAuditor1) !== false) 
			{
	    		$errorID=628;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
			}
			if (strpos($orgNewChairperson,$orgNewAuditor2) !== false OR strpos($orgNewTreasurer,$orgNewAuditor2) !== false OR strpos($orgNewSecretary,$orgNewAuditor2) !== false) 
			{
	    		$errorID=628;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
			}
		}
	}

	//Is the board different persons?
		//Put everyone on board in array
		$boardArray = array($orgNewChairperson, $orgNewTreasurer, $orgNewSecretary);
		if(!empty($orgNewMembers))
		{
			foreach($orgNewMembers as $key => $value)
			{
				array_push($boardArray, $value);
			}
		}
		//Remove duplicates
		$boardArrayChecked = array_unique($boardArray);
		if(count($boardArrayChecked) !== count($boardArray)) 
		{
			$errorID=629;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
		}

		//Is somebody at the meeting twice?
		$presentArray = array();
		foreach($meetingPresentVoters as $key => $value)
		{
			//echo $value;
			array_push($presentArray, $value);
		}
		//Remove duplicates
		$presentArrayChecked = array_unique($presentArray);
		if(count($presentArrayChecked) !== count($presentArray)) 
		{
			$errorID=630;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
		}
	
	//:::::::::::::::::::::::::::::::::::::::::::::::
	//                   UPLOADS
	//:::::::::::::::::::::::::::::::::::::::::::::::
	//Parse Last years presentation
	//Check upload method, text or file
	if($lastYearPresentationFormat == "text")
	{ //if text, validate it
		//echo "VB är i textformat<br>";
		//echo mb_strtoupper($lastYearPresentationText) . "<br>";
		if(empty(trim($lastYearPresentationText))) 
		{ //Check if Presentation is empty
			$errorID=304;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops 
		}
		else 
		{ //Check for certain strings we don't like (UPPERCASE BECAUSE EZ, mb_strtoupper FTW)
			$thingsWeDontLike = array(
			"INGEN AKTIVITET",
			"INTE GJORT NÅGONTING",
			"INGEN VERKSAMHET",
			"HAR INTE BEDRIVIT NÅGON VERKSAMHET",
			"INGENTING",
			"INTE BEDRIVIT VERKSAMHET",
			"INTE ARRANGERAT NÅGONTING",
			"INTE ARRANGERAT NÅNTING",
			);
			foreach ($thingsWeDontLike as $key => $value)
			{
				if (strpos(mb_strtoupper($lastYearPresentationText),mb_strtoupper($value)) !== false)
				{
					//Don't do nothing pls
					$errorID=305;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
				}
				//let' check the length.
				if(strlen($lastYearPresentationText) <= 30)
				{ // Too short presentation
					$errorID=306;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
				}
			}
		}
	}
	elseif($lastYearPresentationFormat == "file")
	{ //if file, validate and upload it
		if (empty(basename($_FILES["lastYearPresentationFile"]["name"]))) 
		{ //Generate Error message
			$errorID=128;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
		}
	/*	else 
		{
			//Simple if files exists-check
			// Check if file already exists
			if (file_exists($target_file)) {
			
			}
			/*$attachmentName = "lastYearPresentationFile";
			$attachmentID = 1;
			include 'upload.php';
			$linkToPresentation = $linkToFile;
			$attachmentData[1] = $linkToPresentation;
		}*/
	}
	else 
	{ //This code should never execute, but if it does you've broken something
	$errorID=101;if(checkIfErrorSet($superErrors,$errorID)!==true){array_push($superErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
	}

//Parse Last years economy
	if (!empty(basename($_FILES["lastYearEconomyFile"]["name"]))) 
	{ //Upload file and generate link stored in $linkToLastYearPresentationFile
		//echo basename($_FILES["lastYearPresentationFile"]["name"]);
		//Declare Variables for upload script
/*		$attachmentName = "lastYearEconomyFile";
			$attachmentID = 2;
			include 'upload.php';
			$linkToEconomy = $linkToFile;
			$attachmentData[2] = $linkToEconomy;

		$theAttachment = basename($_FILES["lastYearEconomyFile"]["name"]);
		$lastYearPresentationFile = $theAttachment;
		$attachmentPrefix = "ekonomisk.berattelse." . ($currentYear - 1);
		$attachmentID++;
		$lastYearEconomyAttachment = $attachmentID;
		//Call for Upload Script
		
		$linkToLastYearEconomyFile = $linkToFile;*/
	}
	else 
	{ //Generate Error message
		$errorID=129;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
	}
	
/* Function for support of different formats of economy presentations - May be implemented later
if($lastYearEconomyFile == "text") 
{ //if text, validate it
	//echo "VB är i textformat<br>";
	//echo mb_strtoupper($lastYearPresentationText) . "<br>";
	if(empty(trim($lastYearPresentationText))) 
	{ //Check if Presentation is empty
		$errorID=304;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops 
	}
	else 
	{ //Check for certain strings we don't like (UPPERCASE BECAUSE EZ, mb_strtoupper FTW)
		$thingsWeDontLike = array(
		"INGEN AKTIVITET",
		"INTE GJORT NÅGONTING",
		"INGEN VERKSAMHET",
		"HAR INTE BEDRIVIT NÅGON VERKSAMHET",
		"INGENTING",
		"INTE BEDRIVIT VERKSAMHET",
		"INTE ARRANGERAT NÅGONTING",
		"INTE ARRANGERAT NÅNTING",
		);
		foreach ($thingsWeDontLike as $key => $value)
		{
			if (strpos(mb_strtoupper($lastYearPresentationText),mb_strtoupper($value)) !== false)
			{
				//Don't do nothing pls
				$errorID=305;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
			}
			//let' check the length.
			if(strlen($lastYearPresentationText) <= 30)
			{ // Too short presentation
				$errorID=999;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
			}
		}
	}
}
elseif($lastYearEconomyFile == "file")
{ //if file, validate and upload it
	if (!empty(basename($_FILES["lastYearPresentationFile"]["name"]))) 
	{ //Upload file and generate link stored in $linkToLastYearPresentationFile
		//echo basename($_FILES["lastYearPresentationFile"]["name"]);
		//Declare Variables for upload script
		$theUploadedFileToProcess = "lastYearPresentationFile";

		$theAttachment = basename($_FILES["lastYearPresentationFile"]["name"]);
		$lastYearPresentationFile = $theAttachment;
		$attachmentPrefix = "verksamhetsberattelse." . ($currentYear - 1);
		$attachmentID++;
		$lastYearPresentationAttachment = $attachmentID;
		//Call for Upload Script
		include 'upload.php';
		$linkToLastYearPresentationFile = $linkToFile;
	}
	else 
	{ //Generate Error message
		$errorID=128;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
	}
}
else 
{ //This code should never execute, but if it does you've broken something
$errorID=101;if(checkIfErrorSet($superErrors,$errorID)!==true){array_push($superErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
}
*/

	//Parse Last years auditory
	if (!empty(basename($_FILES["lastYearAuditoryFile"]["name"]))) 
	{ //Upload file and generate link stored in $linkToLastYearPresentationFile
		//echo basename($_FILES["lastYearPresentationFile"]["name"]);
		//Declare Variables for upload script
		/*$theUploadedFileToProcess = "lastYearAuditoryFile";

		$theAttachment = basename($_FILES["lastYearAuditoryFile"]["name"]);
		$lastYearAuditoryFile = $theAttachment;
		$attachmentPrefix = "revisionsberattelse." . ($currentYear - 1);
		$attachmentID++;
		$lastYearAuditoryAttachment = $attachmentID;
		//Call for Upload Script
		include 'upload.php';
		$linkToLastYearAuditoryFile = $linkToFile;
			$attachmentName = "lastYearAuditoryFile";
			$attachmentID = 3;
			include 'upload.php';
			$linkToAuditory = $linkToFile;
			$attachmentData[3] = $linkToAuditory;		*/
		
	}
	else 
	{ //Generate Error message
		$errorID=130;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
	}


	//Approval of documents(Antog/Lade till handlingarna)
	//Presentation from last year
	if(!empty($lastYearPresentationValid))
	{ //Presentation
		if($lastYearPresentationValid === "false") 
		{ // If not empty, check if presentation wasn't approved of
			$errorID=307;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
		}
		elseif($lastYearPresentationValid === "later") 
		{ //Check if presentation is for later
			$errorID=360;if(checkIfErrorSet($warningErrors,$errorID)!==true){array_push($warningErrors,$errorID);$errorID=0;}//Create Error
		}
	}
	else 
	{	//This code should never execute, but if it does you've broken something
		$errorID=101;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
	}
	
	//Economy from last year
	if(!empty($lastYearEconomyValid))
	{ //Economy
		if($lastYearEconomyValid === "false") 
		{ // If not empty, check if economy wasn't approved of
			$errorID=308;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
		}
		elseif($lastYearEconomyValid === "later") 
		{ //Check if economy is for later
			$errorID=361;if(checkIfErrorSet($warningErrors,$errorID)!==true){array_push($warningErrors,$errorID);$errorID=0;}//Create Error
		}
	}
	else 
	{	//This code should never execute, but if it does you've broken something
		$errorID=101;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
	}
	
	//Auditory of last year
	if(!empty($lastYearAuditoryValid))
	{ //Auditory
		if($lastYearAuditoryValid === "false") 
		{ // If not empty, check if auditory wasn't approved of
			$errorID=309;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
		}
		elseif($lastYearAuditoryValid === "later") 
		{ //Check if auditory is for later
			$errorID=362;if(checkIfErrorSet($warningErrors,$errorID)!==true){array_push($warningErrors,$errorID);$errorID=0;}//Create Error
		}
	}
	else 
	{	//This code should never execute, but if it does you've broken something
		$errorID=101;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
	}
	
	//Plan for next year
	if(!empty($nextYearPlanValid))
	{ //Plan
		if($nextYearPlanValid === "false") 
		{ // If not empty, check if plan wasn't approved of
			$errorID=312;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
		}
		elseif($nextYearPlanValid === "later") 
		{ //Check if plan is for later
			$errorID=364;if(checkIfErrorSet($warningErrors,$errorID)!==true){array_push($warningErrors,$errorID);$errorID=0;}//Create Error
		}
	}
	else 
	{	//This code should never execute, but if it does you've broken something
		$errorID=101;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
	}
	
	//Budget for next year
	if(!empty($nextYearBudgetValid))
	{ //Economy
		if($nextYearBudgetValid === "false") 
		{ // If not empty, check if budget wasn't approved of
			$errorID=313;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
		}
		elseif($nextYearBudgetValid === "later") 
		{ //Check if budget is for later
			$errorID=365;if(checkIfErrorSet($warningErrors,$errorID)!==true){array_push($warningErrors,$errorID);$errorID=0;}//Create Error
		}
	}
	else 
	{	//This code should never execute, but if it does you've broken something
		$errorID=101;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
	}
	
	//Responsibility for the old board
	if(!empty($boardResponsibility))
	{ //Check if Responsibility wasn't given
		if($boardResponsibility === "false") 
		{ // If not empty, check if responsibility wasn't approved of
			$errorID=310;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
		}
		elseif($boardResponsibility === "later") 
		{ //Check if Responsibility will be decided later
			$errorID=363;if(checkIfErrorSet($warningErrors,$errorID)!==true){array_push($warningErrors,$errorID);$errorID=0;}//Create Error
		}
		elseif($boardResponsibility !== "later" && $boardResponsibility !== "false" && $boardResponsibility !== "true") 
		{ //If it's not one of the predefined values, generate error
			$errorID=101;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
		}
	}
	else 
	{	//You might have forgotten to input this, since radio buttons, therefore regular error reminding to check it
		$errorID=624;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
	}
	
	//Next years plan
	if(!empty($nextYearPlanText)) 
	{ //Check length
		if(strlen($nextYearPlanText) <= 30)
		{ // Check if long enough. Throw error if too short
			$errorID=314;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
		}
	}
	else 
	{//Throw error about emptiness
		$errorID=314;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//This checks if the ErrorID is already set, this is to avoid multiple messages about the same thing. Useful in loops
	}
	
	
	
	//Validate the budget
	if(isset($nextYearBudgetValid)) 
	{ //Check if Budget is validated, don't load if not(It should always be unless haxx0rs is in da house)
		include 'validateBudget.php';
	}
	else
	{	//This code should never execute, but if it does you've broken something
		$errorID=101;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
	}
	
	//Last but not least!
	//Validation of Calling to the meeting!
	if(!empty($meetingValid))
	{ //Check if Responsibility wasn't given
		if($meetingValid === "false") 
		{ // If not empty, check if responsibility wasn't approved of
			$errorID=366;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
		}
		elseif($meetingValid !== "false" && $meetingValid !== "true") 
		{ //If it's not one of the predefined values, generate error
			$errorID=101;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
		}
	}
	else 
	{	//You might have forgotten to input this, since radio buttons, therefore regular error reminding to check it
		$errorID=625;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
	}




/* FOR LATER - Create function to deal with extra shit people might wanna add -
	That function here
*/




/* ALREADY DONE! -Check all required names for validation 
//Check all required names for validation
echo "Whitespacecheck for " . $meetingOpener . " returned " . whitespaceCheck($meetingOpener) . "<br>";
echo "Whitespacecheck for " . $meetingChairperson . " returned " . whitespaceCheck($meetingChairperson) . "<br>";
echo "Whitespacecheck for " . $meetingSecretary . " returned " . whitespaceCheck($meetingSecretary) . "<br>";
echo "Whitespacecheck for " . $meetingAdjustor1 . " returned " . whitespaceCheck($meetingAdjustor1) . "<br>";
//echo "Whitespacecheck for " . $meetingAdjustor2 . " returned " . whitespaceCheck($meetingAdjustor1) . "<br>";
echo "Whitespacecheck for " . $orgNewChairperson . " returned " . whitespaceCheck($orgNewChairperson) . "<br>";
echo "Whitespacecheck for " . $orgNewTreasurer . " returned " . whitespaceCheck($orgNewTreasurer) . "<br>";
echo "Whitespacecheck for " . $orgNewAuditor1 . " returned " . whitespaceCheck($orgNewAuditor1) . "<br>";
//echo "Whitespacecheck for " . $orgNewAuditor2 . " returned " . whitespaceCheck($orgNewAuditor2) . "<br>";

if(whitespaceCheck($meetingOpener) === false)
{
	
}
*/

	//::::::::::::::::::::::::::::::::::::::::::::::::::::
	//               DISPLAY RESULTS AND ERRORS
	//::::::::::::::::::::::::::::::::::::::::::::::::::::
	//Sort Warning arrays, because tidyness is phun :3
	if(!empty($superErrors)){sort($superErrors, SORT_NUMERIC);}
	//echo "SUPERFEL";print_r($superErrors);
	if(!empty($uploadErrors)){sort($uploadErrors, SORT_NUMERIC);}
	//echo "Uppladdningsfel";print_r($uploadErrors);
	if(!empty($parseErrors)){sort($parseErrors, SORT_NUMERIC);}
	//echo "Parse-fel";print_r($parseErrors);
	if(!empty($generalErrors)){sort($generalErrors, SORT_NUMERIC);}
	//echo "Allmäna fel";print_r($generalErrors);
	if(!empty($warningErrors)){sort($warningErrors, SORT_NUMERIC);}
	//echo "Varningar";print_r($warningErrors);
	
	if(empty($generalErrors) && empty($parseErrors) && empty($uploadErrors) && empty($superErrors)) 
	{ //Display Warnings and generate button if no errors are detected
		if(!empty($warningErrors)) 
		{ //Display Warnings, if there are any
		echo "<b>Varning! Kontakta förbundet om ni är osäkra på något här.</b> <br><br>";
		foreach ($warningErrors as $value) 
			{
				//Match Errors against the $errorIDs Array that contains translations for people that aren't me.
				echo "Varning: " . $value . " - " . $errorIDs[$value] . "<br>";
			}
			echo "<br>";
		}
		else 
		{	
		$progress++;
		}
	}
	else 
	{//If there is errors, display error messages
		//If there are errors, rearrange them to arrive in the correct order no matter where the functions are
		if(empty($superErrors)) 
		{ //If no super errors is detected, generate other error messages. 
			echo "<b>Något blev fel!</b><br>Ingen panik, ni har antingen glömt något eller fyllt i nåt lite galet.<br>Nedan följer en lista på saker som behöver åtgärdas:<br><br>";
			//PRINT ALL THE POTENTIAL ERRORS!
			//$uploadErrors
			if(!empty($uploadErrors)) 
			{ //Display Upload Errors, if there are any
				foreach ($uploadErrors as $value) 
				{//Match Errors against the $errorIDs Array that contains translations for people that aren't me.
		  		echo "Felkod " . $value . " - " . $errorIDs[$value] . "<br>";
				}
			echo "<br>";	
			}
			//$parseErrors
			if(!empty($parseErrors)) 
			{ //Display Parse Errors, if there are any
				echo "<b>Fel: Information saknas!</b><br>";
				echo "Antal saker som saknas: " . $missingResources . "<br><br>";
				echo "Lista över saknade resurser:<br>";
				//Generate List of Missing Resources
				foreach ($parseErrors as $value) 
				{
					echo "Resurs " . $value . " - ";
				  	//Match Errors against the $errorIDs Array that contains translations for people that aren't me.
				  	echo $errorIDs[$value] . "<br>";
				}
			echo "<br>";
			}
		//$generalErrors
			if(!empty($generalErrors)) 
			{ //Display General Errors, if there are any
			echo "<b>Felmeddelanden:</b> <br><br>";
			foreach ($generalErrors as $value) 
				{
					//Match Errors against the $errorIDs Array that contains translations for people that aren't me.
					echo "Felkod " . $value . " - " . $errorIDs[$value] . "<br>";
				}
				echo "<br>";
			}
		}
		elseif(!empty($superErrors))
		{ //If there is super errors, you've fucked up badly by trying to bypass the code, please stop
			echo "<h1>VAD I HELVETE!?!?!?</h1><br><b>Något gick riktigt snett, ring till " . $sysAdmin[0] . $sysAdmin[1] .  $sysAdmin[2] . "</b>";//THIS IS BAD PRACTICE AND I HATE MYSELF FOR DOING IT!
			//echo print_r($superErrors);
			//echo empty($superErrors);
			foreach ($superErrors as $value) 
				{ //Match Errors against the $errorIDs Array that contains translations for people that aren't me.
		  		echo "Felkod " . $value . " - " . $errorIDs[$value] . "<br>";
				}
			echo "<br>";	
		}
	}


//End of code where data is in $_POST
//Cleanup of tempDIR
}
else
{
	echo "Stop trying to do shit you don't understand.<br>" . $errorIDs[100];
}

?>