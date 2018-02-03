<?php 

session_start();

include "konekcija.php";
global $konekcija;

if (!isset($_POST["tip"]) || (!isset($_SESSION["ulogovan"]) && empty($_SESSION["ulogovan"]))) {
	prikaziPoruku("Nedozvoljen pristup stranici!", "login.php", "greska");
}

if ($_POST["tip"] == "reziser") {
	if (!isset($_POST["id"])) {
		prikaziPoruku("Greška pri brisanju podataka o režiseru,<br> nije prosleđen parametar.", "reziseri.php", "greska");
	} else {
		$reziserid = $_POST["id"];

		$upit = "DELETE FROM reziser WHERE reziserid = ".$reziserid;
		if ($rezultat = $konekcija->query($upit)) {
			if ($konekcija->affected_rows == 1) {
				echo "1Brisanje podataka o režiseru sa ID-jem - ".$reziserid." je uspešno izvršeno.";
			} else {
				echo "0Došlo je do greške pri izvršavanju upita za brisanje, podaci nisu obrisani.<br>".mysqli_error($konekcija);
			}
		} else {
			echo "0Došlo je do greške pri izvršavanju upita za brisanje, podaci nisu obrisani.<br>".mysqli_error($konekcija);
		}
	}
} else if ($_POST["tip"] == "film") {
	if (!isset($_POST["id"])) {
		prikaziPoruku("Greška pri brisanju podataka o filmu,<br> nije prosleđen parametar.", "filmovi.php", "greska");
	} else {
		$filmid = $_POST["id"];

		$upit = "DELETE FROM film WHERE filmid = ".$filmid;
		if ($rezultat = $konekcija->query($upit)) {
			if ($konekcija->affected_rows == 1) {
				echo "1Brisanje podataka o filmu sa ID-jem - ".$filmid." je uspešno izvršeno.";
			} else {
				echo "0Došlo je do greške pri izvršavanju upita za brisanje, podaci nisu obrisani.<br>".mysqli_error($konekcija);
			}
		} else {
			echo "0Došlo je do greške pri izvršavanju upita za brisanje, podaci nisu obrisani.<br>".mysqli_error($konekcija);
		}
	}
}

$konekcija->close();

function prikaziPoruku($poruka, $stranica, $tip) {
	echo "<!DOCTYPE html>
	<html>
	<head>";
	if ($tip == "uspeh") {
		echo "<title>Uspešno brisanje</title>";
	} else if ($tip == "greska") {
		echo "<title>Greška!</title>";
	}	
	include("import/template-1.html");
	include("import/template-2.html");
	if ($tip == "uspeh") {
		echo "<div width='400px'><br><h2 style='color: #4BB543;'>".$poruka."</h2></div>";
	} else if ($tip == "greska") {
		echo "<div width='400px'><br><h2 style='color: #FF0000;'>".$poruka."</h2></div>";
	}
	include("import/template-3.html");
	header("Refresh:3; url=".$stranica, true, 303);
	exit();
}

 ?>