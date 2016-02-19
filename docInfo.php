<?php

//Create array for file data - default stuff
$documentFilePaths = array();
$documentFilePaths['VB'] = $meetingFolder . "bilaga.1.verksamhetsberattelse.odt";
$documentFilePaths['EkBer'] = $meetingFolder . "bilaga.2.ekonomisk.berattelse.ods";
$documentFilePaths['RevBer'] = $meetingFolder . "bilaga.3.revisionsberattelse.pdf";
$documentFilePaths['VP'] = $meetingFolder . "bilaga.4.verksamhetsplan.odt";
$documentFilePaths['Budget'] = $meetingFolder . "bilaga.5.budget.ods";
$documentFilePaths['Protokoll'] = $meetingFolder . "protokoll.odt";


$generateDocumentsDocumentInfo = array();
//$linkToFiles = array();
//$attachmentCounter = 0;
//$createdLink = "";

//$documentFilePaths = array();

//print_r($uploadedFiles);




//EkBer
$generateDocumentsDocumentInfo['EkBer'] = "file";

//RevBer
$generateDocumentsDocumentInfo['RevBer'] = "file";

//VP
$generateDocumentsDocumentInfo['VP'] = "gen";

//Budget
$generateDocumentsDocumentInfo['Budget'] = "gen";

//Protokoll
$generateDocumentsDocumentInfo['Protokoll'] = "gen";

//VB
if($lastYearPresentationFormat == "text")
{
	$generateDocumentsDocumentInfo['VB'] = "gen";
}
elseif($lastYearPresentationFormat == "file")
{
	if(file_exists($meetingFolder ))
	{
		$generateDocumentsDocumentInfo['VB'] = "file";
	}
	else 
	{
		echo "Script Error: Could not find file!";
	}
}

/* //What am I even doing lol?
foreach($uploadedFiles as $key => $value)
{
	$checkUploadedFiles[($value['fileID'])] = $value['completeTemp'];
}
//[fileType] => ods [fileID] => EkBer [completeTemp] => 0c314e5bf7b599a8fad240767d2db564/EkBer.ods


*/

/*
if($lastYearPresentationFormat == "text") 
{
	$createdLink =
	$attachmentInfo = array(++$attachmentCounter, "text", $lastYearPresentationText);
	$linkToFiles['VB'] = $attachmentInfo;
}
elseif($lastYearPresentationFormat == "file") 
{
	$attachmentInfo = array(++$attachmentCounter, "text", $lastYearPresentationText);
	$linkToFiles['VB'] = $attachmentInfo;
}
*/


?>