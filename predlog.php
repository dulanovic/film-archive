<?php 

include "konekcija.php";

if (!isset($_POST["unos"]) && (!isset($_POST["mod"]) || !isset($_POST["tip"]))) {
	echo "Nije prosleđen parametar!";
	exit();
}

if ($_POST["unos"] == "") {
	echo "";
	exit();
}

$unos = str_replace("'", "\'", $_POST["unos"]);

if (isset($_POST["mod"])) {

	$upit = "SELECT r.slika, r.reziserid, r.ime, r.prezime, r.datumrodjenja, r.datumsmrti FROM reziser r WHERE r.ime LIKE '%".$unos."%' OR r.prezime LIKE '%".$unos."%'OR CONCAT(r.ime, ' ', r.prezime) LIKE '%".$unos."%' OR CONCAT(r.prezime, ' ', r.ime) LIKE '%".$unos."%'";
	$rezultat = $konekcija->query($upit);

	if ($_POST["mod"] == "validacija") {
		echo "<table style='width: 291px;'>";

		if ($rezultat->num_rows == 0) {
			echo "<tr><td>---Nema rezultata---</tr></td></table>";
			exit();
		}

		while($red = $rezultat->fetch_object()) {
			echo "<tr><td><a href='javascript:void(0)' onclick='postavi(this.innerHTML, \"reziser\")'>".$red->ime." ".$red->prezime."</a></td></tr>";
		}
	} else if ($_POST["mod"] == "pretraga") {
		echo "<table style='width: 340px;'>";

		if ($rezultat->num_rows == 0) {
			echo "<tr><td>Nije pronađen nijedan režiser</tr></td></table>";
			exit();
		}

		while($red = $rezultat->fetch_object()) {
			echo "<tr><td width='50px'><a href='reziser.php?id=".$red->reziserid."'><img src='".$red->slika."' alt='".$red->ime." ".$red->prezime."' title='".$red->ime." ".$red->prezime."' /></a></td><td style='padding-left: 10px;'><a href='reziser.php?id=".$red->reziserid."'>".$red->ime." ".$red->prezime."<br>(".date('Y', strtotime($red->datumrodjenja))."-".(($red->datumsmrti != "") ? date('Y', strtotime($red->datumsmrti)) : "").")</a></td></tr>";
		}
	}
} else if ($_POST["tip"] == "film") {

	$upit = "SELECT f.filmid, f.poster, f.naziv, f.godina, z.nazivzanra, CONCAT(r.ime, ' ', r.prezime) AS 'imeprezime' FROM film f INNER JOIN reziser r ON (f.reziserid = r.reziserid) INNER JOIN zanr z ON (f.zanrid = z.zanrid) WHERE f.naziv LIKE '%".$unos."%'";
	$rezultat = $konekcija->query($upit);

	echo "<table style='width: 340px;'>";

	if ($rezultat->num_rows == 0) {
		echo "<tr><td>Nije pronađen nijedan film</td></tr></table>";
		exit();
	}
	echo "<table style='width:340px;'>";
	while($red = $rezultat->fetch_object()) {
		echo "<tr><td width='50px'><a href='film.php?id=".$red->filmid."'><img src='".$red->poster."' alt='".$red->naziv."' title='".$red->naziv."' /></a></td><td style='padding-left: 10px;'><a href='film.php?id=".$red->filmid."'><b>".$red->naziv."<br>(".$red->godina.")</b></a><br>Žanr: <i>".$red->nazivzanra."</i><br>Režiser: <i>".$red->imeprezime."</i></td></tr>";
	}
} else if ($_POST["tip"] == "zanr") {
	$upit = "SELECT nazivzanra FROM zanr WHERE nazivzanra LIKE '%".$unos."%'";
	$rezultat = $konekcija->query($upit);

	if ($rezultat->num_rows == 0) {
		echo "<table style='width: 197px;'><tr><td>---Nema rezultata---</td></tr></table>";
		exit();
	}
	echo "<table style='width: 197px;'>";
	while($red = $rezultat->fetch_object()) {
		echo "<tr><td><a href='javascript:void(0)' onclick='postavi(this.innerHTML, \"zanr\")'>".$red->nazivzanra."</a></td></tr>";
	}
}

echo "</table>";

$konekcija->close();

?>