<?php 

include "konekcija.php";
echo "<!DOCTYPE html>
<html>
<head>
	<title>Pretraga</title>";
include("import/template-1.html");
include("import/template-2.html");

if (!isset($_GET["pretraga-film"]) && !isset($_GET["pretraga-reziser"])) {
	echo "<br><h2>Nije prosleđen parametar<h2>";
	include("import/template-3.html");
	exit();
}

echo "<br><h2>REZULTATI PRETRAGE</h2><br>";

if (isset($_GET["pretraga-film"])) {
	$kriterijum = $_GET["pretraga-film"];
	global $konekcija;
	$upit = "SELECT f.filmid, f.naziv, f.godina, z.nazivzanra, f.poster, f.opis, CONCAT(r.ime, ' ', r.prezime) AS 'Reziser', r.reziserid, f.uloge, f.trajanje FROM film f INNER JOIN reziser r ON (f.reziserid = r.reziserid) INNER JOIN zanr z ON (f.zanrid = z.zanrid) WHERE f.naziv LIKE '%".$kriterijum."%' OR f.godina LIKE '%".$kriterijum."%' OR z.nazivzanra LIKE '%".$kriterijum."%' OR CONCAT(r.ime, ' ', r.prezime) LIKE '%".$kriterijum."%' OR CONCAT(r.prezime, ' ', r.ime) LIKE '%".$kriterijum."%'";
	$rezultat = $konekcija->query($upit);

	echo "<p align='left' style='margin-left: 25px;margin-bottom: 5px;font-size: 17px;'>Uneta ključna reč: <b><i>'".$kriterijum."'</i></b><br>Broj nađenih filmova: <b>".$rezultat->num_rows."</b></p><br><table id='tabela-pretraga-filmovi' align='center'>";

	while ($red = $rezultat->fetch_object()) {
		echo "<tr><td><a href='film.php?id=".$red->filmid."' target='_blank'><img src='".$red->poster."' alt='".$red->naziv."' title='".$red->naziv."' /></a></td><td style='padding-left:15px;font-size:18px;'><b><a href='film.php?id=".$red->filmid."' target='_blank'>".$red->naziv." (".$red->godina.")</a></b><hr>Režiser: <a href='reziser.php?id=".$red->reziserid."' target='_blank'>".$red->Reziser."</a><br>Uloge: ".$red->uloge."<br>Žanr: ".$red->nazivzanra."<br><i>Opis: ".$red->opis."</i></td>";
	}
	echo "</table>";
	include("import/template-3.html");

} else if (isset($_GET["pretraga-reziser"])) {
	$kriterijum = $_GET["pretraga-reziser"];
	global $konekcija;
	$upit = "SELECT r.reziserid, r.slika, r.ime, r.prezime, r.datumrodjenja, r.datumsmrti, r.zemlja FROM reziser r WHERE r.ime LIKE '%".$kriterijum."%' OR r.prezime LIKE '%".$kriterijum."%'OR CONCAT(r.ime, ' ', r.prezime) LIKE '%".$kriterijum."%' OR CONCAT(r.ime, ' ', r.prezime) LIKE '%".$kriterijum."%' OR r.zemlja LIKE '%".$kriterijum."%'";
	$rezultat = $konekcija->query($upit);

	echo "<p align='left' style='margin-left: 25px;margin-bottom: 5px;font-size: 17px;'>Uneta ključna reč: <b><i>'".$kriterijum."'</i></b><br>Broj nađenih režisera: <b>".$rezultat->num_rows."</b></p><table id='tabela-pretraga-reziseri' align='center'>";

	while ($red = $rezultat->fetch_object()) {
		echo "<tr><td style='width: 150px;'><a href='reziser.php?id=".$red->reziserid."' target='_blank'><img src='".$red->slika."' alt='".$red->ime." ".$red->prezime."' title='".$red->ime." ".$red->prezime."' /></a></td><td align='center' style='padding-left:15px;font-size:18px;'><b><a href='reziser.php?id=".$red->reziserid."' target='_blank'>".$red->ime." ".$red->prezime."</a></b><br>(".date_format(date_create($red->datumrodjenja), 'Y')."-".(($red->datumsmrti != "") ? date('Y', strtotime($red->datumsmrti)) : "").")</td><td align='center' class='zastave' style='width:170px;'>";
		$nizDrzava = explode("/", $red->zemlja);
		for ($i = 0; $i < count($nizDrzava); $i++) {
			echo "<img src='slike/zastave/".$nizDrzava[$i].".png' alt='".$nizDrzava[$i]."' title='".$nizDrzava[$i]."' /> ";
		}
		echo "</td></tr>";
	}
	echo "</table>";
	include("import/template-3.html");
}

 ?>