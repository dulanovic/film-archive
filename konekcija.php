<?php 

$server = "localhost";
$user = "root";
$password = "";
$baza = "filmski_arhiv_iteh";

$konekcija = new mysqli($server, $user, $password, $baza);

if ($konekcija->connect_errno) {
	echo "<!DOCTYPE html>
	<html>
	<head>
	<title>Greška!</title>";
	include("import/template-1.html");
	include("import/template-2.html");
	echo "<div width='500px'><br><h2 style='color: #FF0000;'>Došlo je do greške pri uspostavljanju konekcije sa bazom podataka.<br>".$konekcija->connect_error."</h2></div>";
	include("import/template-3.html");
	header("Refresh:3; url=index.php", true, 303);
	exit();
}

$konekcija->set_charset("utf8");

?>