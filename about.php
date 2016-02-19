 <!DOCTYPE html>
<html>
<head>
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="style.css" />

<meta charset="utf-8" />
<title></title>
</head>
<body>
Årsmötesguiden är ett internt projekt inom <a href="https://ungpirat.se" target="_blank">Ung Pirat</a>, byggt i syfte att underlätta för nya medlemmar att lättare hålla årsmöten.<br>
<br>
Utvecklare: <a href="http://enriz.se" target="_blank">Erik Einarsson</a><br>
Licens: <a href="http://opensource.org/licenses/GPL-3.0" target="_blank">GPL 3.0</a><br>





<h2>Changelog:</h2>
<?php
$file = file_get_contents('./changelog.txt', true);
echo nl2br($file);


?>

</body>
</html>