<?php
// :::::::::::::
// FUNCTIONS.PHP
// :::::::::::::
// Description: Functions go here!

function createLink($url,$text)
{
return "<a href='" . $url . "' target='_blank'>$text</a><br>";
}




//Declare Counter
$funcCounter = 0;
//FILENAME SANITIZER
//Declare Final Filename
    function sanitizeFilename($f) {
     // a combination of various methods
     // we don't want to convert html entities, or do any url encoding
     // we want to retain the "essence" of the original file name, if possible
     // char replace table found at:
     // http://www.php.net/manual/en/function.strtr.php#98669
     $replace_chars = array(
         'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
         'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
         'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
         'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
         'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
         'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
         'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
     );
     $f = strtr($f, $replace_chars);
     // convert & to "and", @ to "at", and # to "number"
     $f = preg_replace(array('/[\&]/', '/[\@]/', '/[\#]/'), array('-and-', '-at-', '-number-'), $f);
     $f = preg_replace('/[^(\x20-\x7F)]*/','', $f); // removes any special chars we missed
     $f = str_replace(' ', '-', $f); // convert space to hyphen 
     $f = str_replace('\'', '', $f); // removes apostrophes
     $f = preg_replace('/[^\w\-\.]+/', '', $f); // remove non-word chars (leaving hyphens and periods)
     $f = preg_replace('/[\-]+/', '-', $f); // converts groups of hyphens into one
     return strtolower($f);
    }
// END OF FILENAME SANITIZER

//INPUT VALIDATOR
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//END OF INPUT VALIDATOR

/*
//VALIDATION OF DATA
function validata($data, $canBeNull) 
{
	//Check if data is set
	if (isset($_POST[$data])) 
	{
		if(empty($_POST[$data])) 
		{
			if($canBeNull == 1) 
			{
				$data = "NULL";
				return $data;
			}
			else 
			{
				return "Error: String Empty";
			}
		}
		else 
		{
			$data = $_POST[$data];
			return $data;
		}
	}
	else 
	{ 
		return "Error: Something went wrong.";
	}
}
//END OF VALIDATION OF DATA
*/
//CAN THE FORM DATA BE NULL?
function canBeNull($data, $array) 
{
	echo "Data: " . $data . "<br>Output: " . serialize((array_keys($array, $data))) . "<br>";
	foreach ($array as $value) 
	{
	
	} 
//return 1;
}
//END OF CAN THE FORM DATA BE NULL?

//Text-rows to array
	function textRowsToArray($text)
	{
		$arrayedText = preg_split('/(<br \/>)/', nl2br($text));
		//Clean Out Empty lines
		foreach ($arrayedText as $key => $value)
		{
			if(trim($value) == "") //Credits to ceve who reminded me of trim()
			{
				unset($arrayedText[$key]);
			}
				
		}
		//Outputs the same array
		return $arrayedText;
	}	
	
//Check if string contains whitespace (for first name and last name)
function whitespaceCheck($string) {
	//echo "Checking for whitespace in "  . $string . "<br>";
	$string = trim($string);
	if (preg_match('/\s/',trim($string))) 
	{
		return true;
	}
	else 
	{
		return false;
	}		
}

//Check if string contains link 
function linkCheck($string) {
	//echo "Checking for whitespace in "  . $string . "<br>";
	$string = trim($string);
	if (preg_match('<LINK>',trim($string))) 
	{
		return true;
	}
	else 
	{
		return false;
	}		
}


function checkIfErrorSet($array, $errorID) {
	//OMG, returning something breaks the function and therefore the foreach loop I'm a moron
	$errorExists = false;
	if(empty($array)) 
	{
		//echo "Array Empty, returning false<br>";
		//echo "Function ended!<br><br>";
		return false;
	}
	else 
	{
		//echo "Array is not empty<br>";
		foreach ($array as $key => $value)
		{
			//echo "For each ''Array'' as $key => $value<br>";
			//echo "Comparing $value with $errorID<br>";
			if(trim($value) === trim($errorID)) 
			{
				return true;
				//echo "Returning <b>True!</b><br>";
				//echo "Function ended!<br><br>";
			}
		}
		return false;	
	}
}

//Time validator
function validateMilTime($time)
{
	$bits = array(99,99);
	//echo "Start of function with input: $time (string)<br>";
	//Check if string(containing separator of some kind) or int
	$time = preg_replace("/[^0-9]/","",$time);
	//echo $time;
	if(strlen($time) === 4)
	{
		$bits = str_split($time, 2);
	}
	else
	{
		echo strlen(trim($time));
		//return false;
	}
	//print_r($bits);
	//echo "<br>";
	if ($bits[0] > 24 ||$bits[1] > 59|| ($bits[0] == 24 && $bits[1] > 0) || count($bits) != 2 || !is_numeric($bits[0]) || !is_numeric($bits[1]))
	{
	//echo "Time invalid!<br><br>";
	return false;
	}
	//echo "Time valid!<br><br>";
	return true;
}

//
function convertToTime($time)
{
	$bits = array(99,99);
	$time = preg_replace("/[^0-9]/","",$time);
	if(strlen($time) === 4)
	{
		$bits = str_split($time, 2);
		if ($bits[0] > 24 ||$bits[1] > 59|| ($bits[0] == 24 && $bits[1] > 0) || count($bits) != 2 || !is_numeric($bits[0]) || !is_numeric($bits[1]))
		{
		return "99:99";
		}
		else
		{
			return $bits[0] . ":" . $bits[1];
		}
	}
	else
	{
		echo strlen(trim($time));
	}
}

function validateDate($date)
{		
	if (($timestamp = strtotime($date)) === false) 
	{
		return false;
	} 
	else
	{
		return true;
	}
}

function generateMetaData($array) {
$meetingID = 0;
$hostIP = "";
$meetingLength = 0;
//Do if I care later on

}

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}
function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

function sweDate($dateString){
	$dateStringOld = $dateString; 
	
	$months =array(
	0 => "null",
	1 => "januari",
	2 => "februari",
	3 => "mars",
	4 => "april",
	5 => "maj",
	6 => "juni",
	7 => "juli",
	8 => "augusti",
	9 => "september",
	10 => "oktober",
	11 => "november",
	12 => "december",
	);
	
	$dateString = date("Y-m-d", strtotime($dateString));
	
	if(preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $dateString, $matches))
	{
		if(checkdate($matches[2], $matches[3], $matches[1]))
		{
			//echo "1=" . $matches[1] . " 2=" . intval($matches[2]) . " 3=" . intval($matches[3]) . "<br>";
			foreach($months as $key => $value)
			{
				//echo "Key: $key Value: $value<br>";
				if($key === intval($matches[2])) 
				{
					$dateString = intval($matches[3]) . " " . $value . " " . $matches[1];
					//echo $dateString;
					return $dateString;
				}
			}
		}
		else 
		{
			return $dateStringOld;
		}
	}	
}


function delete_all_between($beginning, $end, $string) {
  $beginningPos = strpos($string, $beginning);
  $endPos = strpos($string, $end);
  if ($beginningPos === false || $endPos === false) {
    return $string;
  }

  $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);

  return str_replace($textToDelete, '', $string);
}




//Create Functions related to writing Text

function wrapText($input) {
//Code for replacing multiline textboxes with ODT-XML
$newLineCode = "<text:line-break/>"; //This might be wrong, might require </text:p> before current string
$modifiedInput = ereg_replace( "\n", $newLineCode, $input);



return $modifiedInput;
}




function stripLinks($string) {
	
	
	//Remove links since we don't want that in our Document
	$beginning = "<a href";
   $end = "target='_blank'>";
  $beginningPos = strpos($string, $beginning);
  $endPos = strpos($string, $end);
  if ($beginningPos === false || $endPos === false) 
  {
    return $string;
  }

  $textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);
  $string = str_replace($textToDelete, '', $string);
	$string = str_replace("</a>", "", $string);

  return $string;
}

//::::::::::::::::::::::::::::::
//FUNCTIONS RELATED TO DOCUMENTS
//::::::::::::::::::::::::::::::





function textToOdt($string){//
//Trim that string
$string = trim($string);
$originalString = $string;
$processedString = "";

//Stuff we substitute other stuff with
$odtTextStart = '<text:p text:style-name="P3">';//Regular Text - Tag is <TEXT>
$odtTextEnd = '</text:p>';//RegularText End - Tag is </TEXT>
$odtTextNewlineHard = '<text:p text:style-name="P3"/>'; //Tag is <NL>
$odtNewLine = '</text:p><text:p text:style-name="P3">'; // Tag is <NL> -WROOOOOOOOONG CODE!!!!!!
$odtWeirdLine = '</text:p><text:line-break/><text:p text:style-name="P3">'; // Tag is <NL> -WROOOOOOOOONG CODE!!!!!!

$odtTitleStart = '<text:p text:style-name="P4">'; //Tag is <TITLE> 
$odtTitleEnd = '</text:p>';//Tag is </TITLE> 

$odtSubtitleStart = '<text:p text:style-name="P5">';
$odtSubtitleEnd = '</text:p>';

$odtH1Start = '<text:p text:style-name="P8">';
$odtH1End = '</text:p>';

$odtH2Start = '<text:p text:style-name="P9">';
$odtH2End = '</text:p>';

$odtH3Start = '<text:p text:style-name="P9">';
$odtH3End = '</text:p>';

$odtTripleLine = $odtTextEnd . $odtTextNewlineHard . $odtTextNewlineHard . $odtTextNewlineHard . $odtTextStart;




	//Remove links since we don't want that in our Document
	/*if(strpos($string, '</a>') !== false)
	{
		echo "</a> exists!";
		
	}*/
	
	
	if(strpos($string,"</a>") !== false){	
		$beginning = "<a href";
		$end = "target='_blank'>";
		$beginningPos = strpos($string, $beginning);
		$endPos = strpos($string, $end);
		//echo "Beginning:" . $beginningPos . "<br>";
		//echo "End:" . $endPos . "<br>";
		if ($beginningPos === false || $endPos === false) 
		{
		  echo $string;
		}
		$textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);
		$string = str_replace($textToDelete, '', $string);
		$string = str_replace("</a>", "", $string); 
	}
	
	//Convert newlines to <br />
	//$string = nl2br($string);
	
	$arrayedString = preg_split('/(<br \/>)/', nl2br($string));
		//Clean Out Empty lines
	foreach ($arrayedString as $key => $value)
	{
		//echo "Starting to parse stuff: $value<br>";
		//$int = 1;
		if(trim($value) == "") //Credits to ceve who reminded me of trim()
		{
			$arrayedString[$key] = $odtTextNewlineHard;
			//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		}

		$arrayedString[$key] = str_replace( "<br />", $odtNewLine, $arrayedString[$key]);
		$arrayedString[$key] = str_replace( "<NL>", $odtTextNewlineHard, $arrayedString[$key]);
		//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		// - text wrappers -regular text
		$arrayedString[$key] = str_replace( "<TEXT>", $odtTextStart, $arrayedString[$key]);
		$arrayedString[$key] = str_replace( "</TEXT>", $odtTextEnd, $arrayedString[$key]);
		//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		// - text wrappers - Title
		$arrayedString[$key] = str_replace( "<TITLE>", $odtTitleStart, $arrayedString[$key]);
		$arrayedString[$key] = str_replace( "</TITLE>", $odtTitleEnd, $arrayedString[$key]);
		//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		// - text wrappers - header1
		$arrayedString[$key] = str_replace( "<HEAD1>", $odtH1Start, $arrayedString[$key]);
		$arrayedString[$key] = str_replace( "</HEAD1>", $odtH1End, $arrayedString[$key]);
		//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		// - text wrappers - header2
		$arrayedString[$key] = str_replace( "<HEAD2>", $odtH2Start, $arrayedString[$key]);
		$arrayedString[$key] = str_replace( "</HEAD2>", $odtH2End, $arrayedString[$key]);
		//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		if(startsWith($arrayedString[$key], "<") == false) 
		{
			//echo "Doesnt start with <<br>";
			$arrayedString[$key] = $odtTextStart . $arrayedString[$key];
			//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		}
		if(endsWith($arrayedString[$key], ">") == false) 
		{
			//echo "Doesnt end with ><br>";
			$arrayedString[$key] = $arrayedString[$key] . $odtTextEnd;
			//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		}		
		//echo "End result: " . $arrayedString[$key] . "<br><br>";
		//Output stuff
		$processedString = $processedString . $arrayedString[$key];	
		//echo $processedString . "<br>";
	}
	//echo "<br><br><br><br><br>";
	
	
	/*
	$string = str_replace( "<br /><br /><br /><br /><br /><br /><br /><br />", $odtTripleLine, $string);
	$string = str_replace( "<br /><br /><br /><br /><br /><br /><br />", $odtTripleLine, $string);
	$string = str_replace( "<br /><br /><br /><br /><br /><br />", $odtTripleLine, $string);
	$string = str_replace( "<br /><br /><br /><br /><br />", $odtTripleLine, $string);
	$string = str_replace( "<br /><br /><br /><br />", $odtTripleLine, $string);
	$string = str_replace( "<br /><br /><br />", $odtTripleLine, $string);
	$string = str_replace( "<br /><br />", $odtWeirdLine, $string);	
	//Rewrite TAGS to ODT-format
	// - all the stuff in text from form input
	//nl2br because reasons.
	
	//$newLineCode = '</text:p><text:p text:style-name="P3">'; //This might be wrong, might require </text:p> before current string
	$string = str_replace( "\n", $odtNewLine, $string);
	// - and just in case someone put HTML somewhere
	$string = str_replace( "<br>", $odtNewLine, $string);
	$string = str_replace( "<br/>", $odtNewLine, $string);
	$string = str_replace( "</br>", $odtNewLine, $string);
	$string = str_replace( "<br />", $odtNewLine, $string);
	
	// - all newlines that I've added manually that looks like this <NL>
	$newLineCode = "<text:line-break/>"; //This might be wrong, might require </text:p> before current string
	$string = str_replace( "<NL>", $odtTextNewlineHard, $string);
	
	// - text wrappers -regular text
	$string = str_replace( "<TEXT>", $odtTextStart, $string);
	$string = str_replace( "</TEXT>", $odtTextEnd, $string);
	
	// - text wrappers - Title
	$string = str_replace( "<TITLE>", $odtTitleStart, $string);
	$string = str_replace( "</TITLE>", $odtTitleEnd, $string);
	
	// - text wrappers - header1
	$string = str_replace( "<HEAD1>", $odtH1Start, $string);
	$string = str_replace( "</HEAD1>", $odtH1End, $string);
	
	// - text wrappers - header2
	$string = str_replace( "<HEAD2>", $odtH2Start, $string);
	$string = str_replace( "</HEAD2>", $odtH2End, $string);*/
	
	return $processedString;
}

function odtTitleWrap($string) {
$odtTitleStart = '<text:p text:style-name="P4">'; //Tag is <TITLE> 
$odtTitleEnd = '</text:p>';//Tag is </TITLE> 

return $odtTitleStart . $string . $odtTitleEnd;
}

function odsPrint($input){
if(empty($input)) 
{
	$input = " ";
}
return $input;
}

function odsComments($string) {
	$arrayedString = preg_split('/(<br \/>)/', nl2br($string));
	foreach ($arrayedString as $key => $value)
	{
		if(trim($value) == "") //Credits to ceve who reminded me of trim()
		{
			unset($arrayedString[$key]);
		}
		$outPut = '<table:table-row table:style-name="ro3"><table:table-cell/><table:table-cell table:style-name="ce3" office:value-type="string" calcext:value-type="string" table:number-columns-spanned="4" table:number-rows-spanned="1"><text:p>' . $value . '</text:p></table:table-cell><table:covered-table-cell table:number-columns-repeated="3"/><table:table-cell/></table:table-row>';
		$string = $string . $outPut;
	}
return $string;
}








function textToHtml($string){//
//Trim that string
$string = trim($string);
$originalString = $string;
$processedString = "";

//Stuff we substitute other stuff with
$htmlTextStart = '';//Regular Text - Tag is <TEXT>
$htmlTextEnd = '<br>';//RegularText End - Tag is </TEXT>
$htmlTextNewlineHard = '<br>'; //Tag is <NL>
$htmlNewLine = '</text:p><text:p text:style-name="P3">'; // Tag is <NL> -WROOOOOOOOONG CODE!!!!!!
$htmlWeirdLine = '</text:p><text:line-break/><text:p text:style-name="P3">'; // Tag is <NL> -WROOOOOOOOONG CODE!!!!!!

$htmlTitleStart = '<h1>'; //Tag is <TITLE> 
$htmlTitleEnd = '</h1>';//Tag is </TITLE> 

$htmlSubtitleStart = '<text:p text:style-name="P5">';
$htmlSubtitleEnd = '</text:p>';

$htmlH1Start = '<h2>';
$htmlH1End = '</h2>';

$htmlH2Start = '<h3>';
$htmlH2End = '</h3>';

$htmlH3Start = '<h4>';
$htmlH3End = '<h4>';

$htmlTripleLine = $htmlTextEnd . $htmlTextNewlineHard . $htmlTextNewlineHard . $htmlTextNewlineHard . $htmlTextStart;




	//Remove links since we don't want that in our Document
	/*if(strpos($string, '</a>') !== false)
	{
		echo "</a> exists!";
		
	}*/
	
	/*
	if(strpos($string,"</a>") !== false){	
		$beginning = "<a href";
		$end = "target='_blank'>";
		$beginningPos = strpos($string, $beginning);
		$endPos = strpos($string, $end);
		//echo "Beginning:" . $beginningPos . "<br>";
		//echo "End:" . $endPos . "<br>";
		if ($beginningPos === false || $endPos === false) 
		{
		  echo $string;
		}
		$textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);
		$string = str_replace($textToDelete, '', $string);
		$string = str_replace("</a>", "", $string); 
	}*/
	
	//Convert newlines to <br />
	//$string = nl2br($string);
	
	$arrayedString = preg_split('/(<br \/>)/', nl2br($string));
		//Clean Out Empty lines
	foreach ($arrayedString as $key => $value)
	{
		//echo "Starting to parse stuff: $value<br>";
		//$int = 1;
		if(trim($value) == "") //Credits to ceve who reminded me of trim()
		{
			$arrayedString[$key] = $htmlTextNewlineHard;
			//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		}

		$arrayedString[$key] = str_replace( "<br />", $htmlNewLine, $arrayedString[$key]);
		$arrayedString[$key] = str_replace( "<NL>", $htmlTextNewlineHard, $arrayedString[$key]);
		//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		// - text wrappers -regular text
		$arrayedString[$key] = str_replace( "<TEXT>", $htmlTextStart, $arrayedString[$key]);
		$arrayedString[$key] = str_replace( "</TEXT>", $htmlTextEnd, $arrayedString[$key]);
		//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		// - text wrappers - Title
		$arrayedString[$key] = str_replace( "<TITLE>", $htmlTitleStart, $arrayedString[$key]);
		$arrayedString[$key] = str_replace( "</TITLE>", $htmlTitleEnd, $arrayedString[$key]);
		//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		// - text wrappers - header1
		$arrayedString[$key] = str_replace( "<HEAD1>", $htmlH1Start, $arrayedString[$key]);
		$arrayedString[$key] = str_replace( "</HEAD1>", $htmlH1End, $arrayedString[$key]);
		//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		// - text wrappers - header2
		$arrayedString[$key] = str_replace( "<HEAD2>", $htmlH2Start, $arrayedString[$key]);
		$arrayedString[$key] = str_replace( "</HEAD2>", $htmlH2End, $arrayedString[$key]);
		//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		if(startsWith($arrayedString[$key], "<") == false) 
		{
			//echo "Doesnt start with <<br>";
			$arrayedString[$key] = $htmlTextStart . $arrayedString[$key];
			//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		}
		if(endsWith($arrayedString[$key], ">") == false) 
		{
			//echo "Doesnt end with ><br>";
			$arrayedString[$key] = $arrayedString[$key] . $htmlTextEnd;
			//echo $int++ . ":" . $arrayedString[$key] . "<br>";
		}		
		//echo "End result: " . $arrayedString[$key] . "<br><br>";
		//Output stuff
		$processedString = $processedString . $arrayedString[$key];	
		//echo $processedString . "<br>";
	}
	//echo "<br><br><br><br><br>";
	
	
	/*
	$string = str_replace( "<br /><br /><br /><br /><br /><br /><br /><br />", $htmlTripleLine, $string);
	$string = str_replace( "<br /><br /><br /><br /><br /><br /><br />", $htmlTripleLine, $string);
	$string = str_replace( "<br /><br /><br /><br /><br /><br />", $htmlTripleLine, $string);
	$string = str_replace( "<br /><br /><br /><br /><br />", $htmlTripleLine, $string);
	$string = str_replace( "<br /><br /><br /><br />", $htmlTripleLine, $string);
	$string = str_replace( "<br /><br /><br />", $htmlTripleLine, $string);
	$string = str_replace( "<br /><br />", $htmlWeirdLine, $string);	
	//Rewrite TAGS to html-format
	// - all the stuff in text from form input
	//nl2br because reasons.
	
	//$newLineCode = '</text:p><text:p text:style-name="P3">'; //This might be wrong, might require </text:p> before current string
	$string = str_replace( "\n", $htmlNewLine, $string);
	// - and just in case someone put HTML somewhere
	$string = str_replace( "<br>", $htmlNewLine, $string);
	$string = str_replace( "<br/>", $htmlNewLine, $string);
	$string = str_replace( "</br>", $htmlNewLine, $string);
	$string = str_replace( "<br />", $htmlNewLine, $string);
	
	// - all newlines that I've added manually that looks like this <NL>
	$newLineCode = "<text:line-break/>"; //This might be wrong, might require </text:p> before current string
	$string = str_replace( "<NL>", $htmlTextNewlineHard, $string);
	
	// - text wrappers -regular text
	$string = str_replace( "<TEXT>", $htmlTextStart, $string);
	$string = str_replace( "</TEXT>", $htmlTextEnd, $string);
	
	// - text wrappers - Title
	$string = str_replace( "<TITLE>", $htmlTitleStart, $string);
	$string = str_replace( "</TITLE>", $htmlTitleEnd, $string);
	
	// - text wrappers - header1
	$string = str_replace( "<HEAD1>", $htmlH1Start, $string);
	$string = str_replace( "</HEAD1>", $htmlH1End, $string);
	
	// - text wrappers - header2
	$string = str_replace( "<HEAD2>", $htmlH2Start, $string);
	$string = str_replace( "</HEAD2>", $odtH2End, $string);*/
	
	return $processedString;
}

//Cool Topmenu-functions




?>