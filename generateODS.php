<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

//Create Array to hold all the data
$documentToPrint = array(
'<?xml version="1.0" encoding="UTF-8"?>',
'<office:document-content xmlns:office="urn:oasis:names:tc:opendocument:xmlns:office:1.0" xmlns:style="urn:oasis:names:tc:opendocument:xmlns:style:1.0" xmlns:text="urn:oasis:names:tc:opendocument:xmlns:text:1.0" xmlns:table="urn:oasis:names:tc:opendocument:xmlns:table:1.0" xmlns:draw="urn:oasis:names:tc:opendocument:xmlns:drawing:1.0" xmlns:fo="urn:oasis:names:tc:opendocument:xmlns:xsl-fo-compatible:1.0" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:meta="urn:oasis:names:tc:opendocument:xmlns:meta:1.0" xmlns:number="urn:oasis:names:tc:opendocument:xmlns:datastyle:1.0" xmlns:presentation="urn:oasis:names:tc:opendocument:xmlns:presentation:1.0" xmlns:svg="urn:oasis:names:tc:opendocument:xmlns:svg-compatible:1.0" xmlns:chart="urn:oasis:names:tc:opendocument:xmlns:chart:1.0" xmlns:dr3d="urn:oasis:names:tc:opendocument:xmlns:dr3d:1.0" xmlns:math="http://www.w3.org/1998/Math/MathML" xmlns:form="urn:oasis:names:tc:opendocument:xmlns:form:1.0" xmlns:script="urn:oasis:names:tc:opendocument:xmlns:script:1.0" xmlns:ooo="http://openoffice.org/2004/office" xmlns:ooow="http://openoffice.org/2004/writer" xmlns:oooc="http://openoffice.org/2004/calc" xmlns:dom="http://www.w3.org/2001/xml-events" xmlns:xforms="http://www.w3.org/2002/xforms" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:rpt="http://openoffice.org/2005/report" xmlns:of="urn:oasis:names:tc:opendocument:xmlns:of:1.2" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:grddl="http://www.w3.org/2003/g/data-view#" xmlns:tableooo="http://openoffice.org/2009/table" xmlns:drawooo="http://openoffice.org/2010/draw" xmlns:calcext="urn:org:documentfoundation:names:experimental:calc:xmlns:calcext:1.0" xmlns:loext="urn:org:documentfoundation:names:experimental:office:xmlns:loext:1.0" xmlns:field="urn:openoffice:names:experimental:ooo-ms-interop:xmlns:field:1.0" xmlns:formx="urn:openoffice:names:experimental:ooxml-odf-interop:xmlns:form:1.0" xmlns:css3t="http://www.w3.org/TR/css3-text/" office:version="1.2">',
'<office:scripts/>',
'<office:font-face-decls>',
'<style:font-face style:name="BorisBlackBloxx" svg:font-family="BorisBlackBloxx" style:font-pitch="variable"/>',
'<style:font-face style:name="Liberation Sans" svg:font-family="Liberation Sans" style:font-family-generic="swiss" style:font-pitch="variable"/>',//'<style:font-face style:name="Liberation Sans" svg:font-family="'Liberation Sans'" style:font-family-generic="swiss" style:font-pitch="variable"/>'
'<style:font-face style:name="DejaVu Sans" svg:font-family="DejaVu Sans" style:font-family-generic="system" style:font-pitch="variable"/>',//<style:font-face style:name="DejaVu Sans" svg:font-family="'DejaVu Sans'" style:font-family-generic="system" style:font-pitch="variable"/>
'<style:font-face style:name="Droid Sans Fallback" svg:font-family="Droid Sans Fallback" style:font-family-generic="system" style:font-pitch="variable"/>',
'<style:font-face style:name="FreeSans" svg:font-family="FreeSans" style:font-family-generic="system" style:font-pitch="variable"/>',
'</office:font-face-decls>',
'<office:automatic-styles>',
'<style:style style:name="co1" style:family="table-column">',
'<style:table-column-properties fo:break-before="auto" style:column-width="2.258cm"/>',
'</style:style>',
'<style:style style:name="co2" style:family="table-column">',
'<style:table-column-properties fo:break-before="auto" style:column-width="5.636cm"/>',
'</style:style>',
'<style:style style:name="ro1" style:family="table-row">',
'<style:table-row-properties style:row-height="0.894cm" fo:break-before="auto" style:use-optimal-row-height="false"/>',
'</style:style>',
'<style:style style:name="ro2" style:family="table-row">',
'<style:table-row-properties style:row-height="0.452cm" fo:break-before="auto" style:use-optimal-row-height="true"/>',
'</style:style>',
'<style:style style:name="ro3" style:family="table-row">',
'<style:table-row-properties style:row-height="0.841cm" fo:break-before="auto" style:use-optimal-row-height="true"/>',
'</style:style>',
'<style:style style:name="ta1" style:family="table" style:master-page-name="Default">',
'<style:table-properties table:display="true" style:writing-mode="lr-tb"/>',
'</style:style>',
'<style:style style:name="ce1" style:family="table-cell" style:parent-style-name="Default">',
'<style:table-cell-properties style:text-align-source="fix" style:repeat-content="false" style:vertical-align="middle"/>',
'<style:paragraph-properties fo:text-align="center"/>',
'<style:text-properties style:font-name="BorisBlackBloxx" fo:font-size="16pt" style:font-size-asian="16pt" style:font-size-complex="16pt"/>',
'</style:style>',
'<style:style style:name="ce2" style:family="table-cell" style:parent-style-name="Default">',
'<style:text-properties fo:font-weight="bold" style:font-weight-asian="bold" style:font-weight-complex="bold"/>',
'</style:style>',
'<style:style style:name="ce3" style:family="table-cell" style:parent-style-name="Default">',
'<style:table-cell-properties style:text-align-source="fix" style:repeat-content="false" fo:wrap-option="wrap" style:vertical-align="top"/>',
'<style:paragraph-properties fo:text-align="start"/>',
'</style:style>',
'</office:automatic-styles>',
'<office:body>',
'<office:spreadsheet>',
'<table:table table:name="Budget" table:style-name="ta1">',
'<table:table-column table:style-name="co1" table:default-cell-style-name="Default"/>',
'<table:table-column table:style-name="co2" table:default-cell-style-name="Default"/>',
'<table:table-column table:style-name="co1" table:number-columns-repeated="4" table:default-cell-style-name="Default"/>',
//Start writing Title Row
'<table:table-row table:style-name="ro1">',
'<table:table-cell table:style-name="ce1" office:value-type="string" calcext:value-type="string" table:number-columns-spanned="6" table:number-rows-spanned="1">',
);

//Create TextFile because I fucking hate XML
$tempFile = fopen("coolXML.txt", "w") or die("Error creating file!");//YES I KNOW THAT I CAN WRITE TO AN XML FROM THE BEGINNING BUT WON'T BECAUSE FUCK YOU THAT'S WHY!



//Skriv titelrad
	$txt = "<text:p>" . "Budget för $orgName " . date('Y') . '</text:p></table:table-cell><table:covered-table-cell table:number-columns-repeated="5"/></table:table-row>';
	array_push($documentToPrint, $txt);
	
//Write 4 Blank rows
	$txt = '<table:table-row table:style-name="ro2" table:number-rows-repeated="4"><table:table-cell table:number-columns-repeated="6"/></table:table-row>';	
	array_push($documentToPrint, $txt);

	//Write row for profits
	$txt = '<table:table-row table:style-name="ro2"><table:table-cell/><table:table-cell table:style-name="ce2" office:value-type="string" calcext:value-type="string"><text:p>Intäkter</text:p></table:table-cell><table:table-cell table:number-columns-repeated="4"/></table:table-row>';
	array_push($documentToPrint, $txt);
	

	//From here on, It's just about writing each row by itself
	//Write plus-posts
	$plusValue = 0;
	foreach($_POST as $key => $value)	
	{ //Loop through all variables in POST 
		if(startsWith($key, 'plus') === true)
		{ //Find POST-data with keyname of "plus" or "minus"
			if(endsWith($key, '1')) 
			{ //If it's a name field, compare to sibling
				$pairString = substr($key, 0, -1);
				$pairString = $pairString . "2";
				//echo "Kollar om ''$value'' och ''" . intval(test_input($_POST[$pairString])) . "'' är tomma.<br>";
				if(!empty(test_input($value)) AND !empty(test_input($_POST[$pairString]))) 
				{ //Check if both fields have something in them
					if(startsWith($key, 'plus') === true) 
					{ //If it's a plus field, add to plus array	
						//$sumOfPlusArray[test_input($value)] = intval(test_input($_POST[$pairString]));
						$pairValue = test_input($_POST[$pairString]);
						$plusValue = $plusValue + $pairValue;
						//Write string with correct data to $txt and then to
						$txt = '<table:table-row table:style-name="ro2"><table:table-cell/><table:table-cell office:value-type="string" calcext:value-type="string"><text:p>' . $value . '</text:p></table:table-cell><table:table-cell/><table:table-cell office:value-type="float" office:value="' . $pairValue . '" calcext:value-type="float"><text:p>' . $pairValue . '</text:p></table:table-cell><table:table-cell table:number-columns-repeated="2"/></table:table-row>';
						array_push($documentToPrint, $txt);
					}
				}
				else 
				{//Write an empty row
					$txt = '<table:table-row table:style-name="ro2"><table:table-cell table:number-columns-repeated="6"/></table:table-row>';
					array_push($documentToPrint, $txt);
				}
			}
		}
	}
	//Write an empty row
	$txt = '<table:table-row table:style-name="ro2"><table:table-cell table:number-columns-repeated="6"/></table:table-row>';
	array_push($documentToPrint, $txt);
	//Write Summary row
	$txt = '<table:table-row table:style-name="ro2"><table:table-cell/><table:table-cell table:style-name="ce2" office:value-type="string" calcext:value-type="string"><text:p>Summa</text:p></table:table-cell><table:table-cell/><table:table-cell table:formula="of:=SUM([.D7:.D11])" office:value-type="float" office:value="' . $plusValue . '" calcext:value-type="float"><text:p>' . $plusValue . '</text:p></table:table-cell><table:table-cell table:number-columns-repeated="2"/></table:table-row>';
	array_push($documentToPrint, $txt);
	//Write TWO! empty rows
	$txt = '<table:table-row table:style-name="ro2" table:number-rows-repeated="2"><table:table-cell table:number-columns-repeated="6"/></table:table-row>';
	array_push($documentToPrint, $txt);
	
	//Minus Titles
	$txt = '<table:table-row table:style-name="ro2"><table:table-cell/><table:table-cell table:style-name="ce2" office:value-type="string" calcext:value-type="string"><text:p>Utgifter</text:p></table:table-cell><table:table-cell table:number-columns-repeated="4"/></table:table-row>';
	array_push($documentToPrint, $txt);
	//Dem Minusvalues
	$minusValue = 0;
	foreach($_POST as $key => $value)	
	{ //Loop through all variables in POST 
		if(startsWith($key, 'minus') === true)
		{ //Find POST-data with keyname of "minus"
			if(endsWith($key, '1')) 
			{ //If it's a name field, compare to sibling
				$pairString = substr($key, 0, -1);
				$pairString = $pairString . "2";
				//echo "Kollar om ''$value'' och ''" . intval(test_input($_POST[$pairString])) . "'' är tomma.<br>";
				if(!empty(test_input($value)) AND !empty(test_input($_POST[$pairString]))) 
				{ //Check if both fields have something in them
					if(startsWith($key, 'minus') === true) 
					{ //If it's a plus field, add to plus array	
						//$sumOfPlusArray[test_input($value)] = intval(test_input($_POST[$pairString]));
						$pairValue = test_input($_POST[$pairString]);
						$minusValue = $plusValue + $pairValue;
						//Write string with correct data to $txt and then to
						$txt = '<table:table-row table:style-name="ro2"><table:table-cell/><table:table-cell office:value-type="string" calcext:value-type="string"><text:p>' . $value . '</text:p></table:table-cell><table:table-cell/><table:table-cell office:value-type="float" office:value="' . $pairValue . '" calcext:value-type="float"><text:p>' . $pairValue . '</text:p></table:table-cell><table:table-cell table:number-columns-repeated="2"/></table:table-row>';
						array_push($documentToPrint, $txt);
					}
				}
				else 
				{//Write an empty row
					$txt = '<table:table-row table:style-name="ro2"><table:table-cell table:number-columns-repeated="6"/></table:table-row>';
					array_push($documentToPrint, $txt);
				}
			}
		}
	}
	//Write an empty row
	$txt = '<table:table-row table:style-name="ro2"><table:table-cell table:number-columns-repeated="6"/></table:table-row>';
	array_push($documentToPrint, $txt);
	//Row of minusSum
	$txt = '<table:table-row table:style-name="ro2"><table:table-cell/><table:table-cell table:style-name="ce2" office:value-type="string" calcext:value-type="string"><text:p>Summa</text:p></table:table-cell><table:table-cell/><table:table-cell table:formula="of:=SUM([.D16:.D26])" office:value-type="float" office:value="' . $minusValue . '" calcext:value-type="float"><text:p>' . $minusValue . '</text:p></table:table-cell><table:table-cell table:number-columns-repeated="2"/></table:table-row>';
	array_push($documentToPrint, $txt);
	//Write TWO! empty rows
	$txt = '<table:table-row table:style-name="ro2" table:number-rows-repeated="2"><table:table-cell table:number-columns-repeated="6"/></table:table-row>';
	array_push($documentToPrint, $txt);
	
	//Write Result row
	$txt = '<table:table-row table:style-name="ro2"><table:table-cell/><table:table-cell table:style-name="ce2" office:value-type="string" calcext:value-type="string"><text:p>Beräknat resultat</text:p></table:table-cell><table:table-cell/><table:table-cell table:formula="of:=[.D12]-[.D27]" office:value-type="float" office:value="' . ($plusValue - $plusValue) . '" calcext:value-type="float"><text:p>' . ($plusValue - $plusValue) . '</text:p></table:table-cell><table:table-cell table:number-columns-repeated="2"/></table:table-row>';
	array_push($documentToPrint, $txt);
	
	
//Write FOUR! empty rows
	$txt = '<table:table-row table:style-name="ro2" table:number-rows-repeated="4"><table:table-cell table:number-columns-repeated="6"/></table:table-row>';
	array_push($documentToPrint, $txt);
	
	//Dat function <3
	$txt = odsComments($nextYearBudgetText);
	array_push($documentToPrint, $txt);
	
	
	//Ending of the file
	$txt = '</table:table><table:named-expressions/></office:spreadsheet></office:body></office:document-content>';
	array_push($documentToPrint, $txt);

	foreach($documentToPrint as $key => $value)
	{
		//echo $key . ": " . htmlspecialchars($value) . "<br>" ;
		fwrite($tempFile, $value);
	}



	
	
	//echo $txt;	
	
	
	//File Writing complete



	//Declare complete filename $filename_complete = "bilaga." . $attachmentID . "." . $attachmentNameFixed . "." . $documentNameTemplate . "." . $imageFileType;
	//$filename_complete = "bilaga." . $attachmentID . ".budget." . date('Y') . "." . $documentFilePaths['Budget'] . ".ods";























// Slut på generatorn

//Write end of XML
//fwrite($tempFile, $closeDocument);
//Close file
fclose($tempFile);
//Empty Variable
$txt = "";
//Rename file (Which probably is unnecessary and could be avoided by just naming it movedContent.xml from the start)
rename("coolXML.txt","movedContent.xml");
//chmod('movedContent.xml', 0777);

//Moves it into zip-archive
$zip = new ZipArchive;
if ($zip->open('templated.ods') === TRUE) {
    $zip->addFile('movedContent.xml', 'content.xml') or die('Fick inte flytta!');
    $zip->close();
    //echo 'ok';
} else {
    echo 'Något gick fel vid skapandet av ODS!';
}


//Create complete filename
//$linkToFile = $meetingFolder . $filename_complete;
//Copy file to proper directory
copy('templated.ods', $documentFilePaths['Budget']);

//Remove old file.


//Return $linkToFile
//echo $linkToFile;
}
else 
{
	echo "No data in POST!";
}
?>