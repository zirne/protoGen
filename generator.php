<?php
//Copy template files
//copy('templated.odt', $meetingFolder . "templated.odt");
//chmod($meetingFolder . "templated.odt", 0777);
//copy('templated.ods', $meetingFolder . "templated.ods");
//chmod($meetingFolder . "templated.ods", 0777);

//echo "<br>";
//print_r($documentFilePaths);
//echo "<br><br>";

//Generate documents

	//Minutes text
	include 'generateminutes.php';

	//ODT-files
	include 'generateODT.php';

	//ODT-files
	include 'generateODS.php';


//Rename files

foreach($uploadedFiles as $key => $value)
{
	//echo "LOL<br>";
	//echo $documentFilePaths[$value['fileID']];
	//echo "<br><br>";
	
	rename($value['completeTemp'], $documentFilePaths[$value['fileID']]);
	
	/*if($value['fileID'] === "EkBer") 
	{
		$value['completeTemp']
	}*/
	
//rename(,"movedContent.xml");


}
//Cleanup
unlink('movedContent.xml');



//Create zip
$zip = new ZipArchive;
$zip->open('createdZIP.zip', ZipArchive::CREATE);
foreach ($documentFilePaths as $file) {
  $zip->addFile($file);
}
$zip->close();
//Move zip-archive
$documentFilePaths['zip'] = $meetingFolder . "arsmote." . sanitizeFilename($orgName) . "." . date('Y') . ".zip";
rename('createdZIP.zip', $documentFilePaths['zip']);



/*
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
	}

*/



		//Generate ODT
	//include 'generateminutes.php';
		//Minutes text
	//include 'generateminutes.php';

	

	
$progress++;


?>