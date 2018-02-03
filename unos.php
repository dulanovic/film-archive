<?php 

session_start();

include "konekcija.php";
global $konekcija;

if (!isset($_POST["tip"]) || (!isset($_SESSION["ulogovan"]) && empty($_SESSION["ulogovan"]))) {
	prikaziPoruku("Nedozvoljen pristup stranici!", "index.php", "greska");
}

if ($_POST["tip"] == "reziser") {
	if (!isset($_POST["ime"]) || !isset($_POST["prezime"]) || !isset($_POST["datumRodjenja"]) || !isset($_POST["mestoRodjenja"]) || !isset($_POST["slika"]) || !isset($_POST["zemlja"])) {
		prikaziPoruku("Greška pri unosu podataka o režiseru,<br> nisu prosleđeni parametri.", "unosRezisera.php", "greska");
	} else {
		$ime = str_replace("'", "\'", trim($_POST["ime"]));
		$prezime = str_replace("'", "\'", trim($_POST["prezime"]));
		$datumRodjenja = trim($_POST["datumRodjenja"]);
		$mestoRodjenja = str_replace("'", "\'", trim($_POST["mestoRodjenja"]));
		$datumSmrti = NULL;
		$mestoSmrti = "";
		$slika = trim($_POST["slika"]);
		$zemlja = trim($_POST["zemlja"]);

		if ($_POST["datumSmrti"] != "" && $_POST["mestoSmrti"] != "") {
			$datumSmrti = trim($_POST["datumSmrti"]);
			$mestoSmrti = str_replace("'", "\'", trim($_POST["mestoSmrti"]));
		}

		$upit = "INSERT INTO reziser (ime, prezime, slika, datumrodjenja, mestorodjenja, datumsmrti, mestosmrti, zemlja) VALUES ('".$ime."', '".$prezime."', '".$slika."', '".$datumRodjenja."', '".$mestoRodjenja."', IF('$datumSmrti'='', NULL, '$datumSmrti'), '".$mestoSmrti."', '".$zemlja."')";
		if ($rezultat = $konekcija->query($upit)) {
			$reziserid = $konekcija->insert_id;
			prikaziPoruku("Podaci o režiseru pod imenom - <i>".str_replace("'", "\'", $ime)." ".str_replace("\'", "'", $prezime)."</i> su uspešno uneti u bazu.", "reziser.php?id=".$reziserid, "uspeh");
		} else {
			prikaziPoruku("Došlo je do greške pri izvršavanju upita, vrednosti nisu unete u bazu.".mysqli_error($konekcija), "unosRezisera.php", "greska");
		}
	}
} else if ($_POST["tip"] == "film") {
	if (!isset($_POST["naziv-filma"]) || !isset($_POST["godina"]) || !isset($_POST["zanr"]) || !isset($_POST["opis-filma"]) || !isset($_POST["reziser"]) || !isset($_POST["uloge"]) || !isset($_POST["trajanje"]) || !isset($_POST["imdb"]) || !isset($_POST["trejler"]) || !isset($_POST["poster"])) {
		prikaziPoruku("Greška pri unosu podataka o filmu,<br> nisu prosleđeni parametri.", "unosFilma.php", "greska");
	} else {
		$naziv = str_replace("'", "\'", trim($_POST["naziv-filma"]));
		$godina = trim($_POST["godina"]);
		$zanrNaziv = trim($_POST["zanr"]);
		$zanr = "";
		$poster = trim($_POST["poster"]);
		$opis = str_replace("'", "\'", trim($_POST["opis-filma"]));
		$reziserIme = str_replace("'", "\'", trim($_POST["reziser"]));
		$reziser = "";
		$uloge = str_replace("'", "\'", trim($_POST["uloge"]));
		$trajanje = trim($_POST["trajanje"]);
		$trejler = substr(trim($_POST["trejler"]), strlen(trim($_POST["trejler"])) - 11);
		$imdbLink = substr(trim($_POST["imdb"]), strlen(trim($_POST["imdb"])) - 9);

		$upitZanr = "SELECT zanrid FROM zanr WHERE nazivzanra = '".$zanrNaziv."'";
		if ($rezultat = $konekcija->query($upitZanr)) {
			if ($rezultat->num_rows == 1) {
				$red = mysqli_fetch_assoc($rezultat);
				$zanr = trim($red["zanrid"]);
			} else {
				prikaziPoruku("Došlo je do greške kod povezivanja sa spoljnim ključem iz tabele <i>'Žanr'</i>, vrednost koju ste uneli nije ispravna, molimo ponovite unos.", "unosFilma.php", "greska");
			}
		} else {
			prikaziPoruku("Došlo je do greške pri izvršavanju upita nad tabelom <i>'Žanr'</i>.<br>".mysqli_error($konekcija), "unosFilma.php", "greska");
		}

		$upitReziser = "SELECT reziserid FROM reziser WHERE CONCAT(ime, ' ', prezime) = '".$reziserIme."'";
		if ($rezultat = $konekcija->query($upitReziser)) {
			if ($rezultat->num_rows == 1) {
				$red = mysqli_fetch_assoc($rezultat);
				$reziser = trim($red["reziserid"]);
			} else {
				prikaziPoruku("Došlo je do greške kod povezivanja sa spoljnim ključem iz tabele <i>'Režiser'</i>, vrednost koju ste uneli nije ispravna, molimo ponovite unos.", "unosFilma.php", "greska");
			}
		} else {
			prikaziPoruku("Došlo je do greške pri izvršavanju upita nad tabelom <i>'Režiser'</i>.<br>".mysqli_error($konekcija), "unosFilma.php", "greska");
		}

		$upit = "INSERT INTO film (naziv, godina, zanrid, poster, opis, reziserid, uloge, trajanje, trejler, imdblink) VALUES ('".$naziv."', ".$godina.", ".$zanr.", '".$poster."', '".$opis."', ".$reziser.", '".$uloge."', ".$trajanje.", '".$trejler."', '".$imdbLink."')";
		if ($rezultat = $konekcija->query($upit)) {
			$filmid = $konekcija->insert_id;
			prikaziPoruku("Podaci o filmu pod nazivom - <i>".str_replace("\'", "'", $naziv)."</i> su uspešno uneti u bazu.", "film.php?id=".$filmid, "uspeh");
		} else {
			prikaziPoruku("Došlo je do greške pri izvršavanju upita, vrednosti nisu unete u bazu.<br>".mysqli_error($konekcija), "unosFilma.php", "greska");
		}
	}
}

$konekcija->close();

function prikaziPoruku($poruka, $stranica, $tip) {
	echo "<!DOCTYPE html>
	<html>
	<head>";
	if ($tip == "uspeh") {
		echo "<title>Uspešna izmena</title>";
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
	header("Refresh:5; url=".$stranica, true, 303);
	exit();
}

?>