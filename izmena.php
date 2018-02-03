<?php 

session_start();

include "konekcija.php";
global $konekcija;

if (!isset($_POST["tip"]) || (!isset($_SESSION["ulogovan"]) && empty($_SESSION["ulogovan"]))) {
	prikaziPoruku("Nedozvoljen pristup stranici!", "index.php", "greska");
}

if ($_POST["tip"] == "reziser") {
	if (!isset($_POST["reziserid"]) || !isset($_POST["ime"]) || !isset($_POST["prezime"]) || !isset($_POST["datumRodjenja"]) || !isset($_POST["mestoRodjenja"]) || !isset($_POST["slika"]) || !isset($_POST["zemlja"])) {
		prikaziPoruku("Greška pri izmeni podataka o režiseru,<br> nisu prosleđeni parametri.", "reziseri.php", "greska");
	} else {
		$reziserid = trim($_POST["reziserid"]);
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

		$upit = "UPDATE reziser SET ime = '".$ime."', prezime = '".$prezime."', datumRodjenja = '".$datumRodjenja."', mestoRodjenja = '".$mestoRodjenja."', datumSmrti = IF('$datumSmrti'='', NULL, '$datumSmrti'), mestosmrti = '".$mestoSmrti."', slika = '".$slika."', zemlja = '".$zemlja."' WHERE reziserid = ".$reziserid;
		if ($rezultat = $konekcija->query($upit)) {
			if ($konekcija->affected_rows == 1) {
				prikaziPoruku("Izmena vrednosti režisera sa ID-jem - <i>".$reziserid."</i>, pod imenom - <i>".str_replace("\'", "'", $ime)." ".str_replace("\'", "'", $prezime)."</i> je uspešno izvršena.", "reziser.php?id=".$reziserid, "uspeh");
			} else if ($konekcija->affected_rows == 0) {
				prikaziPoruku("Poslali ste neizmenjene podatke.<br>", "reziser.php?id=".$reziserid, "uspeh");
			}
		} else {
			prikaziPoruku("Došlo je do greške pri izvršavanju upita izmene, vrednosti nisu izmenjene.".mysqli_error($konekcija), "reziser.php?id=".$reziserid, "greska");
		}
	}

} else if ($_POST["tip"] == "film") {
	if (!isset($_POST["filmid"]) || !isset($_POST["naziv-filma"]) || !isset($_POST["godina"]) || !isset($_POST["zanr"]) || !isset($_POST["opis-filma"]) || !isset($_POST["reziser"]) || !isset($_POST["uloge"]) || !isset($_POST["trajanje"]) || !isset($_POST["imdb"]) || !isset($_POST["trejler"]) || !isset($_POST["poster"])) {
		prikaziPoruku("Greška pri izmeni podataka o filmu,<br> nisu prosleđeni parametri.", "filmovi.php", "greska");
	} else {
		$filmid = trim($_POST["filmid"]);
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
				prikaziPoruku("Došlo je do greške kod povezivanja sa spoljnim ključem iz tabele <i>'Žanr'</i>, vrednost koju ste uneli nije ispravna, molimo ponovite unos.", "film.php?id=".$filmid, "greska");
			}
		} else {
			prikaziPoruku("Došlo je do greške pri izvršavanju upita nad tabelom <i>'Žanr'</i>.<br>".mysqli_error($konekcija), "film.php?id=".$filmid, "greska");
		}

		$upitReziser = "SELECT reziserid FROM reziser WHERE CONCAT(ime, ' ', prezime) = '".$reziserIme."'";
		if ($rezultat = $konekcija->query($upitReziser)) {
			if ($rezultat->num_rows == 1) {
				$red = mysqli_fetch_assoc($rezultat);
				$reziser = trim($red["reziserid"]);
			} else {
				prikaziPoruku("Došlo je do greške kod povezivanja sa spoljnim ključem iz tabele <i>'Režiser'</i>, vrednost koju ste uneli nije ispravna, molimo ponovite unos.", "film.php?id=".$filmid, "greska");
			}
		} else {
			prikaziPoruku("Došlo je do greške pri izvršavanju upita nad tabelom <i>'Režiser'</i>.<br>".mysqli_error($konekcija), "film.php?id=".$filmid, "greska");
		}

		$upit = "UPDATE film SET naziv = '".$naziv."', godina = ".$godina.", zanrid = ".$zanr.", poster = '".$poster."', opis = '".$opis."', reziserid = ".$reziser.", uloge = '".$uloge."', trajanje = ".$trajanje.", trejler = '".$trejler."', imdblink='".$imdbLink."' WHERE filmid = ".$filmid;
		if ($rezultat = $konekcija->query($upit)) {
			if ($konekcija->affected_rows == 1) {
				prikaziPoruku("Izmena vrednosti filma sa ID-jem - <i>".$filmid."</i>, pod nazivom - <i>".str_replace("\'", "'", $naziv)."</i> je uspešno izvršena.", "film.php?id=".$filmid, "uspeh");
			} else if ($konekcija->affected_rows == 0) {
				prikaziPoruku("Poslali ste neizmenjene podatke.<br>", "film.php?id=".$filmid, "uspeh");
			}
		} else {
			echo $upit;
			prikaziPoruku("Došlo je do greške pri izvršavanju upita izmene, vrednosti nisu izmenjene.<br>".mysqli_error($konekcija), "film.php?id=".$filmid, "greska");
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
	header("Refresh:3; url=".$stranica, true, 303);
	exit();
}

?>