 <!DOCTYPE html>
<html>
<head>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />

<meta charset="utf-8" />
<title></title>
</head>
<?php 
//LOAD SETUP VALUES AND FUNCTIONS
include 'setup.php';
include 'functions.php';

//Generate Seed for saving data and creating folders for stuff
$currentSeedDecrypted = $_SERVER['REMOTE_ADDR'] . time();
$currentSeed = md5($currentSeedDecrypted);

if(isset($_GET['debug'])) 
{
	echo $currentSeed . "<br>";
}

?>
<script>
//Set JS Variables
var sumTotal = 0;
var sumOutPlus = 0;
var sumOutMinus = 0;
</script>

<body>
<!-- Render a nice Index Bar with contact info, menu and other static content, either HTML or PHP -->

<?php
//Render the correct page depending on value of $page
if (isset($_GET['page']))
{


}
else 
{
//Display front page
?>
<h1>Hej och välkommen till årsmötessguiden! <a href='https://ungpirat.piratenpad.de/arsmotesguiden' target='_blank'>(Intern Alpha 2.1)</a></h1><a href="about.php" target="_blank">(Om projektet)</a><br><br>
Årsmötesguiden finns till för att underlätta vid de årsmöten som varje lokalavdelning måste hålla varje år, och om en inte är van vid att hålla i dessa så kan detta vara till hjälp.<br>
Dessutom kommer Årsmötesguiden att generera protokollet som sedan kan skickas in för godkännande.<br><br>
<br>
Först och främst behöver vi veta lite praktiska saker om själva mötet.<br>



<form method="post" action="create.php" enctype="multipart/form-data">
<input type="hidden" name="currentSeed" value="<?php echo $currentSeed;?>">
<?php

}
?>
Vilken lokalavdelning är det som håller möte? <button type="button" onclick="alert('Vad heter er förening? \nSkriv in lokalavdelningens fullständiga namn. \n\nExempelvis Ung Pirat Linköping, Tänk UP, Piratstudenterna Uppsala, eller Piratpartiet Örebro\nGäller årsmötet en förening inom Piratpartiet, Ung Pirat eller Piratstudenterna?')">Mer info</button><br><br>

<input type="text" name="orgName" placeholder="<?php if (isset($_POST['orgName'])) { echo $orgName; } else { echo 'Ung Pirat Lokalavdelning'; } ?>">, en förening inom <select required name="orgType">
	<option value="UP">Ung Pirat</option>
	<option value="PS">Piratstudenterna</option>
	<option value="PP">Piratpartiet</option>
</select>
<br><br>
När ska mötet vara?<br>
<input type="date" name="meetingTime" placeholder='<?php echo date("Y-m-d"); ?>'><br>
<br>
Var ska mötet vara?<br>
<input type="text" name="meetingPlace" size="35" placeholder="Exempelgatan 15, Exempelstad"><br>
<br>
<br>
<h2>1. Mötets öppnande <button type="button" onclick="alert('Här skriver du in vem som förklarade mötet öppnat och vad klockan var då. \n Exempeltiden utgår från det klockslag då du öppnade den här sidan.')">Mer info</button><br></h2>
<input type="text" name="meetingOpener" placeholder="Förnamn Efternamn"> förklarade mötet öppnat <input type="time" name="meetingOpenTime" placeholder='<?php echo date("H:i")?>'>. <br>
<br>
<h2>2. Mötets behörighet <button type="button" onclick="alert('För att ni ska kunna hålla ett giltigt möte måste det vara kallat enligt stadgarna, till exempel måste mötet vara kallat i tillräckligt god tid för att alla medlemmar ska kunna ha möjlighet att skicka in motioner och liknande. \nVad som krävs för att mötet ska kunna anses behörigt hittar ni i era stadgar. \nUng Pirats dokumentarkiv: <?php echo $documentArchiveURL ?>')">Mer info</button></h2>
Är mötet behörigt utlyst? Gick kallelsen ut i tid och är alla dokument utskickade på det sätt som stadgarna bestämmer?<br>
<input type="radio" name="meetingValid" value="true"> Ja, mötet är behörigt utlyst.<br>
<input type="radio" name="meetingValid" value="false"> Nej, mötet är inte behörigt utlyst. (Behöver ni svara nej på denna, ring förbundet!)<br>
<br>
När gick kallelsen ut?<br>
Datum:<input type="date" name="meetingCallDate" placeholder="YYYY-MM-DD" size="10" onfocus=""><br>Tid:<input type="time" name="meetingCallTime" size="10" placeholder="HH:MM"><br> 
<br>
<h2>3. Justering av röstlängd och eventuella adjungeringar<button type="button" onclick="alert('Medlemmar i lokalavdelningen har rätt att närvara, yttra sig och rösta. \n Är du osäker på om någon är medlem eller ej? Kolla i PirateWeb (http://pirateweb.net)')">Mer info</button></h2>
Vilka deltar på mötet? De som är närvarande och får rösta skriver du in här.<br>
Förnamn och efternamn.<br>
<textarea name="meetingPresentVoters" rows="5" cols="25" placeholder="En person per rad. Kom ihåg både för-, och efternamn!"></textarea><br>
<br>
Hur många personer var det som fick rösta?<br>
<input type="number" size="10" placeholder="Antal personer" name="meetingPresentVotersNumber"><br>
<br>
Är det några där som inte är medlemmar? Skriv in deras för-, och efternamn här.<br>
<textarea placeholder="Övriga närvarande" name="meetingPresentOthers"></textarea><br>
<br>
<h2>4. Val av mötesordförande<button type="button" onclick="alert('Ni måste välja någon som leder mötet, helst någon som har deltagit på möten tidigare och vet hur det går till.')">Mer info</button></h2>
Vem leder mötet?<br>
<input type="text" name="meetingChairperson" placeholder="Förnamn Efternamn"><br>
<br>
<h2>5. Val av mötessekreterare<button type="button" onclick="alert('Någon måste agera sekreterare, och dokumentera allt som beslutas i ett mötesprotokoll. Den här guiden är främst till för att hjälpa dig, och det enda du behöver göra är att fylla i saker i rätt fält så kommer protokollet skapas automatiskt när du klickar på Skicka längst ner, förutsatt att alla saker finns och är ifyllda korrekt.')">Mer info</button></h2>
Vem skriver protokollet?
<input type="text" name="meetingSecretary" placeholder="Förnamn Efternamn"><br>
<br>
<h2>6. Val av justerare<button type="button" onclick="alert('Justerare väljs för att kontrollera att protokollet är korrekt och att det som står faktiskt är vad mötet bestämde. Välj minst en men helst två. Mötessekreteraren kan inte vara justerare också.')">Mer info</button></h2>
Vem/vilka justerar protokollet?<br>
<input type="text" name="meetingAdjustor1" placeholder="Förnamn Efternamn"> <input type="text" name="meetingAdjustor2" placeholder="Justerik Justeriksson"><br>
<br>
<h2>7. Verksamhetsberättelse<button type="button" onclick="alert('Här presenteras vad styrelsen gjorde föregående verksamhetsår.')">Mer info</button></h2>
Här kan ni välja mellan två alternativ:<br>
<select required name="lastYearPresentationFormat">
	<option value="text">(A) Ladda upp som Text</option>
	<option value="file">(B) Ladda upp som bifogad fil</option>
</select><br><br>
<b>A: Skriv eran verksamhetsberättelse i textfältet nedan.</b><br>
<textarea name="lastYearPresentationText" cols="55" rows="10" placeholder="Skriv er verksamhetsberättelse här."></textarea><br>
<br>
<b>B: Ladda upp den som bilaga (ODT/PDF/TXT/RTF).</b><br>
<input type="file" name="lastYearPresentationFile" value="Bifoga Verksamhetsberättelse"><br>
<br>
Lade ni verksamhetsberättelsen till handlingarna? (Godkände mötet den?)<br>
<select required name="lastYearPresentationValid">
	<option value="true">Ja</option>
	<option value="false">Nej (Ring förbundet)</option>
	<option value="later">Frågan bordlades (Ring förbundet)</option>
</select><br>
<br><br>
<h2>8. Ekonomisk berättelse <button type="button" onclick="alert('Här presenteras hur styrelsen skötte ekonomin föregående år.')">Mer info</button></h2>
Ladda upp den som bilaga (ODS/PDF).<br>
<input type="file" name="lastYearEconomyFile" value="Bifoga Ekonomisk berättelse"><br>
<br>
Lade ni den ekonomiska berättelsen till handlingarna? (Godkände mötet den?)<br>
<select required name="lastYearEconomyValid">
	<option value="true">Ja</option>
	<option value="false">Nej (Ring förbundet)</option>
	<option value="later">Frågan bordlades (Ring förbundet)</option>
</select><br>
<br>
<h2>9. Revisionsberättelse <button type="button" onclick="alert('Revisionsberättelsen är revisorns granskning av ekonomi och verksamhet.')">Mer info</button></h2>
Ladda upp den som bilaga (PDF).<br>
<input type="file" name="lastYearAuditoryFile" value="Bifoga Revisionsberättelse"><br>
<br>
Lade ni revisionsberättelsen till handlingarna? (Godkände mötet den?)<br>
<select required name="lastYearAuditoryValid">
	<option value="true">Ja</option>
	<option value="false">Nej (Ring förbundet)</option>
	<option value="later">Frågan bordlades (Ring förbundet)</option>
</select><br>
<h2>10. Ansvarsfrihet för avgående styrelse <button type="button" onclick="alert('Om styrelsen skött sitt uppdrag så beviljar man den ansvarsfrihet. Revisorn har i de allra flesta fall en rekommendation med i sin revisionsberättelse.')">Mer info</button></h2>
Har styrelsen skött sig? Vad rekommenderade revisorn?<br>
<input type="radio" name="boardResponsibility" value="true"> Ja, vi ger dom ansvarsfrihet.<br>
<input type="radio" name="boardResponsibility" value="false"> Nej, styrelsen har misskött sitt mandat och vi kommer ta ärendet vidare.<br>
<input type="radio" name="boardResponsibility" value="later"> Vi vet inte, och vill därför bordlägga(vänta med) frågan.<br>
<br>
<h2>11. Årets verksamhetsplan <button type="button" onclick="alert('Här skriver ni vad ni planerar att göra under året.')">Mer info</button></h2>
Skriv eran verksamhetsplan i textfältet nedan. Har ni förberett ett dokument kan ni klistra in innehållet här.<br>
<textarea name="nextYearPlanText" cols="55" rows="10" placeholder="Skriv er verksamhetsplan här."></textarea><br>
Antog ni årets verksamhetsplan? (Godkände mötet den?)<br>
<select required name="nextYearPlanValid">
	<option value="true">Ja</option>
	<option value="false">Nej (Ring förbundet)</option>
	<option value="later">Frågan bordlades (Ring förbundet)</option>
</select><br><br>
<h2>12. Årets budget <button type="button" onclick="alert('Här matar ni in hur ni planerar att spendera pengar under året.')">Mer info</button></h2>
Mata in eran budget i kalkylmallen nedan. Mallen räknar automatiskt ut delsummor och resultat åt er.<br>
<br>
<table border="1" style="700px">
  <tr>
    <td><b>Intäkter</b></td>
    <td></td>
  </tr>
  <tr>
    <td><input type="text" width="35px" name="plusA1" value="Lokalavdelningsbidrag"></td>
    <td><input class="budgetPlus" type="number" width="35px" name="plusA2"></td>
  </tr>
  <tr>
    <td><input type="text" width="35px" name="plusB1"></td>
    <td><input class="budgetPlus" type="number" width="35px" name="plusB2"></td>
  </tr>
  <tr>
    <td><input type="text" width="35px" name="plusC1"></td>
    <td><input class="budgetPlus" type="number" width="35px" name="plusC2"></td>
  </tr>
  <tr>
    <td><input type="text" width="35px" name="plusD1"></td>
    <td><input class="budgetPlus" type="number" width="35px" name="plusD2"></td>
  </tr>
  <tr>
    <td><b>Summa Intäkter:</b></td>
    <td><span id="sumPlus">0</span></td>
  </tr>
  <tr style="height:20px">
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td><b>Utgifter</b></td>
    <td></td>
  </tr>
  <tr>
    <td><input type="text" width="35px" name="minusA1" value="Bankavgifter"></td>
    <td><input class="budgetMinus" type="number" width="35px" name="minusA2"></td>
  </tr>
  <tr>
    <td><input type="text" width="35px" name="minusB1" placeholder="Fler budgetposter"></td>
    <td><input class="budgetMinus" type="number" width="35px" name="minusB2"></td>
  </tr>
  <tr>
    <td><input type="text" width="35px" name="minusC1" placeholder="Fler budgetposter"></td>
    <td><input class="budgetMinus" type="number" width="35px" name="minusC2"></td>
  </tr>
  <tr>
    <td><input type="text" width="35px" name="minusD1" placeholder="Fler budgetposter"></td>
    <td><input class="budgetMinus" type="number" width="35px" name="minusD2"></td>
  </tr>
  <tr>
    <td><input type="text" width="35px" name="minusE1" placeholder="Fler budgetposter"></td>
    <td><input class="budgetMinus" type="number" width="35px" name="minusE2"></td>
  </tr>
    <tr>
    <td><input type="text" width="35px" name="minusF1" placeholder="Fler budgetposter"></td>
    <td><input class="budgetMinus" type="number" width="35px" name="minusF2"></td>
  </tr>
  <tr>
    <td><input type="text" width="35px" name="minusG1" placeholder="Fler budgetposter"></td>
    <td><input class="budgetMinus" type="number" width="35px" name="minusG2"></td>
  </tr>
  <tr>
    <td><input type="text" width="35px" name="minusH1" placeholder="Fler budgetposter"></td>
    <td><input class="budgetMinus" type="number" width="35px" name="minusH2"></td>
  </tr>
    <tr>
    <td><input type="text" width="35px" name="minusI1" placeholder="Fler budgetposter"></td>
    <td><input class="budgetMinus" type="number" width="35px" name="minusI2"></td>
  </tr>
  <tr>
    <td><input type="text" width="35px" name="minusJ1" placeholder="Fler budgetposter"></td>
    <td><input class="budgetPlus" type="number" width="35px" name="minusJ2"></td>
  </tr>
  <tr>
    <td><b>Summa Utgifter:</b></td>
    <td><span id="sumMinus">0</span></td>
  </tr>
  <tr style="height:20px">
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td><b>Beräknat resultat:</b></td>
    <td><span id="sumTotal">0</span></td>
  </tr>
</table> 
<!--<input type="hidden" name="sumTotalForm" id="sumTotalForm" value="sumTotal">
<input type="hidden" name="sumMinusForm" id="sumMinusForm">
<input type="hidden" name="sumPlusForm" id="sumPlusForm"-->

<script>
	$(document).ready(function()
	{
		//iterate through each textboxes and add keyup
		//handler to trigger sum event
		$(".budgetPlus").each(function() 
		{

			$(this).keyup(function()
			{
				calculateSumPlus();
				//calculateSumTotal();
				sumTotal = sumOutPlus - sumOutMinus;
				document.getElementById("sumTotal").textContent= sumTotal;
			});
		});
		$(".budgetMinus").each(function() 
		{

			$(this).keyup(function()
			{
				//sumOutMinus = 0;
				calculateSumMinus();
				//window.alert(sumOutMinus);
				//document.getElementById("sumTotal").textContent= sumTotal +=1;
				sumTotal = sumOutPlus - sumOutMinus;
				document.getElementById("sumTotal").textContent= sumTotal;//document.getElementById("#sumPlus") -= document.getElementById("#sumMinus");
			});
		});

	});

	function calculateSumPlus() 
	{
		var sumPlus = 0;
		//iterate through each textboxes and add the values
		$(".budgetPlus").each(function() 
		{
			//add only if the value is number
			if(!isNaN(this.value) && this.value.length!=0) 
			{
				sumPlus += parseFloat(this.value);
			}

		});
		//.toFixed() method will roundoff the final sum to 0 decimal places
		$("#sumPlus").html(sumPlus.toFixed(0));
		sumOutPlus = sumPlus;
	}

	function calculateSumMinus() 
	{
		var sumMinus = 0;
		//iterate through each textboxes and add the values
		$(".budgetMinus").each(function() 
		{
			//add only if the value is number
			if(!isNaN(this.value) && this.value.length!=0) 
			{
				sumMinus += parseFloat(this.value);
			}

		});
		//.toFixed() method will roundoff the final sum to 0 decimal places
		$("#sumMinus").html(sumMinus.toFixed(0));
		sumOutMinus = sumMinus;
	}
</script>
<br>Eventuella budgetkommentarer kan skrivas in nedan:<br>
<textarea name="nextYearBudgetText" rows="5" cols="55"></textarea><br>

<br>Antog ni årets budget? (Godkände mötet den?)<br>
<select required name="nextYearBudgetValid">
	<option value="true">Ja</option>
	<option value="false">Nej (Ring förbundet)</option>
	<option value="later">Frågan bordlades (Ring förbundet)</option>
</select><br>









<br>
<h2>13. Val av årets styrelse <button type="button" onclick="alert('Nu är det dags att välja årets styrelse. Kolla i era stadgar vilka poster som måste tillsättas. Vanligast är ordförande, kassör och sekreterare. Minst tre personer måste väljas och samma person kan inte inneha flera poster.')">Mer info</button></h2>
Ni kan bara välja medlemmar i lokalavdelningen till dessa poster.<br>
Ordförande: <input type="text" name="orgNewChairperson" placeholder="Ordförande Ordförandesson"><br>
Kassör: <input type="text" name="orgNewTreasurer" placeholder="Kassör Kassörsson"><br>
Sekreterare: <input type="text" name="orgNewSecretary" placeholder="Sekreterik Sekreterarsson"><br>
<br>
Ledamöter:(En person per rad!)<br><textarea name="orgNewMembers" rows="3" cols="35"></textarea><br>
<br>
<h2>14. Val av årets revisor <button type="button" onclick="alert('För att bli godkända av förbundet måste ni välja en revisor som får i uppdrag att granska den nyvalda styrelsens arbete. Revisorn kan inte sitta i styrelsen.')">Mer info</button></h2>
Ni måste välja minst en revisor. Hen behöver inte vara medlem i lokalavdelningen. Har ni ingen så kontakta förbundet asap så kanske vi kan hjälpa er.<br>
Revisor:<input type="text" name="orgNewAuditor1" placeholder="Revisor Revisorsson"><br>
Revisorsersättare:<input type="text" name="orgNewAuditor2" value=""><br>
<br>
<h2>15. Val av årets valberedning <button type="button" onclick="alert('Valberedningen lämnar förslag på vilka som ska sitta i styrelsen nästa år. Att vakantsätta valberedningen innebär att ni inte väljer någon just nu, men försöker hitta folk till den framöver.')">Mer info</button></h2>
Vilka blev valda till valberedning? Ingen i den nyvalda styrelsen kan bli vald till denna post. För att vakantsätta valberedningen, lämna fältet tomt.<br>
<textarea name="orgNewElectioners"></textarea><br>
<br>
<h2>16. Övriga frågor <button type="button" onclick="alert('Övriga frågor är sådant som kommit upp under mötet och inte stod med i kallelsen.')">Mer info</button></h2>
Kom det upp några övriga frågor under mötet?<br>
I så fall är det här de ska skrivas in. Lämna annars fältet tomt.<br>
<textarea name="meetingOtherQuestions"></textarea><br>
<br>
<h2>17. Mötets avslutande  <button type="button" onclick="alert('När mötet är klart fyller ni i avslutningsdatum och avslutningstid.')">Mer info</button></h2>
När avslutades mötet?<br>
Tid:<input type="time" name="meetingEndTime" placeholder="13:37"><br>Datum:<input type="date" name="meetingEndDate" placeholder='<?php echo date("Y-m-d"); ?>'>
<!-- THE SUBMIT BUTTON! -->
        <script type="text/javascript"> name="meetingEndDate" placeholder='<?php echo date("Y-m-d"); ?>'><br>
<br>
            $(document).ready(function() {
                $("button").click(function() {
                    $("#sumTotalForm").val("sumTotal");
                });
            });
        </script>
<button name="Skicka in" formtarget="_blank">Skicka in!</button>
<!-- OLD SUBMIT BUTTON! -->
<!-- <button name="Skicka in" type="submit" formtarget="_blank">Skicka in!</button> -->
<?php
if(isset($_GET['debug'])) 
{
	echo '<input type="hidden" name="debugvalue" value="1">';
}
else 
{
	echo '<input type="hidden" name="debugvalue" value="0">';
}

?>

</form>

</body>
</html>