<?php

$rawDataArray = array();
$linkDataArray = array();
$attachmentID = 0;
$scriptCounter = 0;


//Titel
$str = "<TITLE>Mötesprotokoll</TITLE><TITLE>Årsmöte för " . $orgName . ", $meetingPlace </TITLE><TITLE>" . sweDate($meetingTime) . "</TITLE><NL><NL>";
array_push($rawDataArray, $str);

// Mötets öppnande
$str = "<HEAD1>1. Mötets öppnande.</HEAD1><NL><TEXT>$meetingOpener förklarade mötet öppnat " . convertToTime($meetingOpenTime) . " den " . sweDate($meetingTime) . ".</TEXT><NL>";
array_push($rawDataArray, $str);

// Mötets behörighet
$str = "<HEAD1>2. Mötets behörighet.</HEAD1><NL><TEXT>Mötet beslutade</TEXT><TEXT>att anse mötet behörigt utlyst.</TEXT><NL>";
array_push($rawDataArray, $str);

// Justering av röstlängd
$str = "<HEAD1>3. Justering av röstlängd och eventuella adjungeringar.</HEAD1><NL><TEXT>Närvarande med rösträtt:</TEXT>";
foreach (textRowsToArray($meetingPresentVoters) as $key => $value)
{
	$str = $str . "<TEXT>" . trim($value) . "</TEXT>";
}
$str = $str . "<NL>";
if(!empty($meetingPresentOthers)) 
{
	$str = $str . "<TEXT>Övriga närvarande:</TEXT>";
	foreach (textRowsToArray($meetingPresentOthers) as $key => $value)
	{
		$str = $str . "<TEXT>" . trim($value) . "</TEXT>";
		//$str = $str . $value . "<NL>";
	}
	$str = $str . "<NL>";
}

$str = $str . "<TEXT>Mötet fastställde röstlängden till " . $meetingPresentVotersNumber . " personer.</TEXT><NL>";
array_push($rawDataArray, $str);

//Val av mötesordförande
$str = "<HEAD1>4. Val av mötesordförande.</HEAD1><NL><TEXT>Mötet valde</TEXT><TEXT>" . trim($meetingChairperson) . " till mötesordförande.</TEXT><NL>";
array_push($rawDataArray, $str);

//Val av mötessekreterare
$str = "<HEAD1>5. Val av mötessekreterare.</HEAD1><NL><TEXT>Mötet valde</TEXT><TEXT>" . trim($meetingSecretary) . " till mötessekreterare.</TEXT><NL>";
array_push($rawDataArray, $str);

//Val av justerare
if(trim($meetingAdjustor2) == "")
{
	$str = "<HEAD1>6. Val av justeringspersoner.</HEAD1><NL><TEXT>Mötet valde</TEXT><TEXT>" . trim($meetingAdjustor1) . " till justerare av protokollet.</TEXT><NL>";
}
elseif(trim($meetingAdjustor2) !== "") 
{
	$str = "<HEAD1>6. Val av justeringspersoner.</HEAD1><NL><TEXT>Mötet valde</TEXT><TEXT>" . trim($meetingAdjustor1) . " och " . trim($meetingAdjustor2) . " till justerare av protokollet.</TEXT><NL>";
}
array_push($rawDataArray, $str);




//Verksamhetsberättelse
$str = "<HEAD1>7. Verksamhetsberättelse.</HEAD1><NL><TEXT>Mötet beslutade</TEXT>";
$attachmentID++;
$attachmentPrefix = "verksamhetsberattelse." . ($currentYear - 1);
if($lastYearPresentationFormat == "text") 
{
	//Create document
	//$ODTCreate = "VB";
	//include 'writeTXT.php';
	//Add text to array
	$str = $str . "<TEXT>att lägga verksamhetsberättelsen till handlingarna. <a href='" . $documentFilePaths['VB'] . "' target='_blank'>Se bilaga 1</a>.</TEXT><NL>";
	array_push($rawDataArray, $str);
}
elseif($lastYearPresentationFormat == "file") 
{
	//Create Document	
	//$fileID = "VB";
	//include 'upload.php';
	//Add text to array
	
	//Provide with link
	
	$str = $str . "<TEXT>att lägga verksamhetsberättelsen till handlingarna. <a href='" . $documentFilePaths['VB'] . "' target='_blank'>Se bilaga 1</a>.</TEXT><NL>";
	array_push($rawDataArray, $str);
}
elseif($lastYearPresentationValid == "later") 
{
	$str = $str . "<TEXT>att bordlägga frågan om verksamhetsberättelse.</TEXT><NL>";
	array_push($rawDataArray, $str);
}


//Ekonomisk berättelse
$str = "<HEAD1>8. Ekonomisk berättelse.</HEAD1><NL><TEXT>Mötet beslutade</TEXT>";
$attachmentID++;
if($lastYearEconomyValid == "true")
{
	$str = $str . "<TEXT>att lägga den ekonomiska berättelsen till handlingarna. <a href='" . $documentFilePaths['EkBer'] . "' target='_blank'>Se bilaga 2</a>.</TEXT><NL>";
	array_push($rawDataArray, $str);
}
elseif($lastYearEconomyValid == "later") 
{
	$str = $str . "<TEXT>att bordlägga frågan om ekonomisk berättelse.</TEXT><NL>";
	array_push($rawDataArray, $str);
}

//Revisionsberättelse
$str = "<HEAD1>9. Revisionsberättelse.</HEAD1><NL><TEXT>Mötet beslutade</TEXT>";
$attachmentID++;
if($lastYearAuditoryValid == "true")
{
	$str = $str . "<TEXT>att lägga revisionsberättelsen till handlingarna. <a href='" . $documentFilePaths['RevBer'] . "' target='_blank'>Se bilaga 3</a>.</TEXT><NL>";
	array_push($rawDataArray, $str);
}
elseif($lastYearAuditoryValid == "later") 
{
	$str = $str . "<TEXT>att bordlägga frågan om revisionsberättelse.</TEXT><NL>";
	array_push($rawDataArray, $str);
}

//Ansvarsfrihet
$str = "<HEAD1>10. Ansvarsfrihet för avgående styrelsen.</HEAD1><NL><TEXT>Mötet beslutade</TEXT>";
if($boardResponsibility == "true")
{
	$str = $str . "<TEXT>att bevilja ansvarsfrihet för den avgående styrelsen.</TEXT><NL>";
	array_push($rawDataArray, $str);
}
elseif($boardResponsibility == "false")
{
	$str = $str . "<TEXT>att inte bevilja ansvarsfrihet för den avgående styrelsen.</TEXT><NL>";
	array_push($rawDataArray, $str);
}
elseif($boardResponsibility == "later") 
{
	$str = $str . "<TEXT>att bordlägga frågan om ansvarsfrihet för den avgående styrelsen.</TEXT><NL>";
	array_push($rawDataArray, $str);
}

//Verksamhetsplan
$str = "<HEAD1>11. Verksamhetsplan.</HEAD1><NL><TEXT>Mötet beslutade</TEXT>";
//$attachmentID++;
//$attachmentPrefix = "verksamhetsplan." . $currentYear;
if($nextYearPlanValid == "true")
{
	//Create document
	//$ODTCreate = "VP";
	//include 'writeTXT.php';
	//Add text to array
	$str = $str . "<TEXT>att anta verksamhetsplanen. <a href='" . $documentFilePaths['VP'] . "' target='_blank'>Se bilaga 4</a>.</TEXT><NL>";
	array_push($rawDataArray, $str);
}
elseif($nextYearPlanValid == "false")
{
	$str = $str . "<TEXT>att inte anta någon verksamhetsplan.</TEXT><NL>";
	array_push($rawDataArray, $str);
}
elseif($nextYearPlanValid == "later") 
{
	$str = $str . "<TEXT>att bordlägga frågan om verksamhetsplan.</TEXT><NL>";
	array_push($rawDataArray, $str);
}

//Budget
$str = "<HEAD1>12. Budget.</HEAD1><NL><TEXT>Mötet beslutade</TEXT>";
$attachmentID++;
$attachmentPrefix = "budget." . $currentYear;
if($nextYearPlanValid == "true")
{
	//Create document
	//$ODSCreate = "budget";
	//include 'writeODS.php';
	//Add text to array
	$str = $str . "<TEXT>att anta budgeten. <a href='" . $documentFilePaths['Budget'] . "' target='_blank'>Se bilaga 5</a>.</TEXT><NL>";
	array_push($rawDataArray, $str);
}
elseif($nextYearPlanValid == "false")
{
	$str = $str . "<TEXT>att inte anta någon budget.</TEXT><NL>";
	array_push($rawDataArray, $str);
}
elseif($nextYearPlanValid == "later") 
{
	$str = $str . "<TEXT>att bordlägga frågan om budget.</TEXT><NL>";
	array_push($rawDataArray, $str);
}

//Val av styrelse
$str = "<HEAD1>13. Val av styrelse.</HEAD1><NL><TEXT>Mötet valde</TEXT>";

$str = $str . "<TEXT>" . $orgNewChairperson . " till ordförande.</TEXT>";
$str = $str . "<TEXT>" . $orgNewTreasurer . " till kassör.</TEXT>";
if(!empty($orgNewSecretary))
{
$str = $str . "<TEXT>" . $orgNewSecretary . " till sekreterare.</TEXT>";
}
if(!empty($orgNewMembers))
{
	$counter = 0;
	$numEntries = count(textRowsToArray($orgNewMembers));
	//echo count(textRowsToArray($orgNewMembers)) . "<-Numbers Two lol.";
	if(count(textRowsToArray($orgNewMembers)) > 1) 
	{
		$orgNewMembersArray = textRowsToArray($orgNewMembers);
		//Create string
		$orgNewMembers = "";
		foreach($orgNewMembersArray as $key => $value)
		{
			//echo $counter . "<-Numbers lol.";
			$counter++;
			if($value === $orgNewMembersArray[0])
			{
			$orgNewMembers = $orgNewMembers . $value;// . "(<-FIRST!)";
			}	
			elseif($numEntries === $counter)
			{
			$orgNewMembers = $orgNewMembers . " och " . $value;// . "(<-LAST!)";
			}
			else 
			{
			$orgNewMembers = $orgNewMembers . ", " . $value;
			}

		}
			
		$str = $str . "<NL><TEXT>Samt " . test_input($orgNewMembers) . " till ledamöter.</TEXT><NL>";
	}
	else 
	{
		$str = $str . "<TEXT>Samt " . trim($orgNewMembers) . " till ledamot.</TEXT><NL>";
	}
		
}
array_push($rawDataArray, $str);


//Val av revisor
$str = "<HEAD1>14. Val av revisor.</HEAD1><NL><TEXT>Mötet valde</TEXT>";
if(empty($orgNewAuditor2))
{
$str = $str . "<TEXT>" . $orgNewAuditor1 . " till revisor.</TEXT><NL>";
}
else
{
$str = $str . "<TEXT>" . $orgNewAuditor1 . " och " . $orgNewAuditor2 . " till revisorer.</TEXT><NL>";
}
array_push($rawDataArray, $str);



//Val av valberedning
$str = "<HEAD1>15. Val av valberedning.</HEAD1><NL><TEXT>Mötet valde</TEXT>";
if(!empty($orgNewElectioners))
{
	$counter = 0;
	$numEntries = count(textRowsToArray($orgNewElectioners));
	if(count(textRowsToArray($orgNewElectioners)) > 1) 
	{
		$orgNewElectionersArray = textRowsToArray($orgNewElectioners);
		//Create string
		$orgNewElectioners = "";
		foreach ($orgNewElectionersArray as $key => $value){
			$counter++;
			if($value === $orgNewElectionersArray[0])
			{
			$orgNewElectioners = $orgNewElectioners . $value;// . "(<-FIRST!)";
			}	
			elseif($numEntries === $counter)
			{
			$orgNewElectioners = $orgNewElectioners . " och " . $value;
			}
			else 
			{
			$orgNewElectioners = $orgNewElectioners . "," . $value;
			}
		}
		$str = $str . "<TEXT>" . $orgNewElectioners . " till valberedning.</TEXT><NL>";
	}
	else 
	{
		$str = $str . "<TEXT>" . $orgNewElectioners . " till valberedning.</TEXT><NL>";
	}
}
else 
{
	$str = $str . "<TEXT>Att vakantsätta valberedningsposterna.</TEXT><NL>";
}
array_push($rawDataArray, $str);

//Övriga frågor
$str = "<HEAD1>16. Övriga frågor.</HEAD1><NL>";
if(!empty($meetingOtherQuestions))
{
$str = $str . "<TEXT>" . $meetingOtherQuestions . "</TEXT><NL>";
}
else 
{
$str = $str . "<TEXT>Inga övriga frågor har inkommit.</TEXT><NL>";
}
array_push($rawDataArray, $str);



$str = "<HEAD1>17. Mötets avslutande.</HEAD1><NL><TEXT>Mötesordförande " . $meetingChairperson . " förklarade mötet avslutat " . convertToTime($meetingEndTime) . " den " . sweDate($meetingTime) . ".</TEXT><NL>";
array_push($rawDataArray, $str);


$rawDataString = "";
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
		$rawDataString = $rawDataString . $value;
	}
}


/*
//GENERATE THAT SHIT!
$ODTCreate = "minutes";
include 'writeTXT.php';
$linkToMinutes = $linkToFile;
*/

$progress++;
//For shits n giggles
/*foreach($rawDataArray as $key => $value)
{
echo htmlspecialchars($value) . "<br>";


}*/
$rawDataString = "";
foreach ($rawDataArray as $key => $value)
{
	//echo $value . "<br>";
	$rawDataString = $rawDataString . $value;
}

//echo $rawDataString;

//Print Result to logDetailed.txt
$logDetFile = fopen($meetingFolder . "logDetailed.txt", "w") or die("Error creating file!");
fwrite($logDetFile, $rawDataString);
fclose($logDetFile);


//print_r($rawDataArray);
?>