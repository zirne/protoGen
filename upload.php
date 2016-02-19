<?php
$uploadOk = 1;
$uploadedFiles = array();
$uploadErrors = array();
foreach($_FILES as $key => $fileData)
{
	$uploadOk = 1;
	if(!empty($fileData['name'])) 
	{
		//Set shit up
		$fileToUpload = basename($_FILES[$key]["name"]);
		$fileData['fileType'] = pathinfo($fileToUpload,PATHINFO_EXTENSION);
		if($key == 'lastYearPresentationFile') 
		{
			$fileData['fileID'] = "VB";
		}
		elseif($key == 'lastYearEconomyFile') 
		{
			$fileData['fileID'] = "EkBer";
		}
		elseif($key == 'lastYearAuditoryFile') 
		{
			$fileData['fileID'] = "RevBer";
		}
		$newFileName = $fileData['fileID'] . "." . $fileData['fileType'];
		$tempStorage = $meetingFolder . $fileData['fileID'] . "." . $fileData['fileType'];
		$fileData['completeTemp'] = $tempStorage;
		array_push($uploadedFiles, $fileData);
		//Run upload
		// Check file size
		if ($_FILES[$key]["size"] > 10000000) 
		{
			array_push($uploadErrors,121);
		    $uploadOk = 0;
		}
		
		// Allow certain file formats
		if($key == "lastYearPresentationFile") 
		{
			if($fileData['fileType'] != "odt" && $fileData['fileType']!= "pdf" && $fileData['fileType'] != "txt" && $fileData['fileType'] != "rtf" ) 
			{
			    array_push($uploadErrors,122);
			    $uploadOk = 0;
			}
		}
		
		elseif($key == "lastYearEconomyFile") 
		{
			if($privDebug == 1){echo "Checking Filetype ODS/PDF<br>";}
			if($fileData['fileType'] != "ods" && $fileData['fileType'] != "pdf" ) 
			{
				array_push($uploadErrors,123);
			   $uploadOk = 0;
			}
		}
		elseif($key == "lastYearAuditoryFile") 
		{
			if($privDebug == 1){echo "Checking Filetype PDF<br>";}
			if($fileData['fileType'] != "pdf" ) 
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
		{  
			
		   if (move_uploaded_file($_FILES[$key]["tmp_name"],$tempStorage)) 
		   {

		   } 
		   else 
		   {
		       array_push($uploadErrors,126);
		   }
		}
		if($uploadOk == 0)
			foreach ($uploadErrors as $value) 
			{
		    	echo $value . " - ";
		    	//Match $parseErrors against the $errorIDs Array that contains translations for people that aren't me.
		    	echo $errorIDs[$value] . "<br>";
		   }
	}
	else 
	{
		$uploadOk = 1;
	}
}
if($uploadOk == 1) 
{
	$progress++;
}
?>