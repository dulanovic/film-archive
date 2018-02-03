<?php 

include "konekcija.php";

if ((!isset($_GET["ime"]) || !isset($_GET["zanr"])) && !isset($_GET["tip"])) {
	exit();
}

if ($_GET["tip"] == "reziser") {

	$reziser = str_replace("'", "\'", $_GET["ime"]);

	$upit = "SELECT CONCAT(ime, ' ', prezime) AS 'imeprezime', CONCAT(prezime, ' ', ime) AS 'prezimeime' FROM reziser WHERE CONCAT(ime, ' ', prezime) = '".$reziser."' OR CONCAT(prezime, ' ', ime) = '".$reziser."'";
	$rezultat = $konekcija->query($upit);

	if ($rezultat->num_rows == 1) {
		echo "1";
	} else {
		echo "0";
	}
	
} else if ($_GET["tip"] == "zanr") {

	$zanr = $_GET["zanr"];

	$upit = "SELECT nazivzanra FROM zanr WHERE nazivzanra = '".$zanr."'";
	$rezultat = $konekcija->query($upit);

	if ($rezultat->num_rows == 1) {
		echo "1";
	} else {
		echo "0";
	}
}

$konekcija->close();

?>