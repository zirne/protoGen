<?php
/*
"plusA1",
"plusA2",
"plusB1",
"plusB2",
"plusC1",
"plusC2",
"plusD1",
"plusD2",
"minusA1",
"minusA2",
"minusB1",
"minusB2",
"minusC1",
"minusC2",
"minusD1",
"minusD2",
"minusE1",
"minusE2",
"minusF1",
"minusF2",
"minusG1",
"minusG2",
"minusH1",
"minusH2",
"minusI1",
"minusI2",
"minusJ1",
"minusJ2",
*/


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{ //This file should always be called by validator.php and nothing else but just for the heck of it, we check if $_POST is set and then execute code.
	//Declare stuff
	$sumOfPlusArray = array();
	$sumOfMinusArray = array();
	$sumOfPlus = 0;
	$sumOfMinus = 0;
	
	foreach($_POST as $key => $value)
	{ //Loop through all values in POST
		if(startsWith($key, 'plus') === true AND !empty($value) AND endsWith($key, '2')) 
		{ // Check if key starts with ''plus'' AND if value actually contains something
			if(intval($value)) 
			{ //Push into array if actually an integer-value
				array_push($sumOfPlusArray,intval($value));
			}
			else 
			{ //Create error
				$errorID=801;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error	
			}
		}
		elseif(startsWith($key, 'minus') === true AND !empty($value) AND endsWith($key, '2')) 
		{ // Check if key starts with ''plus'' AND if value actually contains something
			if(intval($value))
			{ //Push into array if actually an integer-value
				array_push($sumOfMinusArray,intval($value));
			}
			else 
			{ //Create error
				$errorID=801;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error	
			}
			//echo "$key<br>";
		}
	}
	foreach($sumOfPlusArray as $value)
	{ //Create Variable for sum of plus
		$sumOfPlus = $sumOfPlus + $value;
	}
	foreach($sumOfMinusArray as $value)
	{ //Create Variable for sum of minus
		$sumOfMinus = $sumOfMinus + $value;
	}
	//End of validation for all numbers	
	
	//Reset values for use in other validation (Finalizing the arrays)	
	$sumOfPlusArray = array();
	$sumOfMinusArray = array();
	//Validate that posts have both name and a value (Pair them up!)
	foreach($_POST as $key => $value)	
	{ //Loop through all variables in POST 
		if(startsWith($key, 'plus') === true OR startsWith($key, 'minus') === true)
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
						$sumOfPlusArray[test_input($value)] = intval(test_input($_POST[$pairString]));
						//echo "Writing to Array: $value + " . $_POST[$pairString];
					}
					else 
					{ //If it's a minus field, add to minus array	
						$sumOfMinusArray[test_input($value)] = intval(test_input($_POST[$pairString]));
					}
				}
				elseif(!empty(test_input($value)) OR !empty(test_input($_POST[$pairString])))
				{ //If any of the two fields contain something, display error
					$errorID=800;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
				}
			}
		}
	}
	//Validation of numbers through reason :DDDDD
	if($sumOfPlus <= 1750) 
	{
		$errorID=802;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
	}
	if($sumOfMinus < 300) 
	{
		$errorID=803;if(checkIfErrorSet($generalErrors,$errorID)!==true){array_push($generalErrors,$errorID);$errorID=0;}//Create Error
	}
	
	
/*
	// Just an echoscript to make sure that stuff will be generated the way I want.
	// May come useful in Generator later
	echo "<b>Intäkter</b><br>";
	//echo print_r($sumOfPlusArray) . "<br>";
	foreach($sumOfPlusArray as $key => $value)
	{
		echo $key . ": $value<br>";	
	}
	
	echo "<b>Summa:</b> $sumOfPlus<br><br>";
	echo "<b>Utgifter</b><br>";
	//echo print_r($sumOfMinusArray) . "<br>";
	foreach($sumOfMinusArray as $key => $value)
	{
		echo $key . ": $value<br>";	
	}
	echo "<b>Summa:</b> $sumOfMinus<br>";
	echo "<br><b>Beräknat resultat: ". ($sumOfPlus - $sumOfMinus) . "</b><br><br>";
*/

}
else
{
	echo "Stop trying to do shit you don't understand.<br>" . $errorIDs[100];
}

?>