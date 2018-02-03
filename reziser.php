<?php 

session_start();

include "konekcija.php";
global $konekcija;

if (!isset($_GET["id"])) {
	echo "<!DOCTYPE html>
	<html>
	<head>
	<title>Greška!</title>";
	include("import/template-1.html");
	include("import/template-2.html");
	echo "<br><h2 style='color: #FF0000;'>Nije prosleđen parametar!</h2>";
	include("import/template-3.html");
	header("Refresh:3; url=reziseri.php", true, 303);
	exit();
}

$upit = "SELECT * FROM reziser WHERE reziserid = ".$_GET["id"];
$rezultat = $konekcija->query($upit);
$red = $rezultat->fetch_object();

$ispis = $red->Ime." ".$red->Prezime;

echo "<!DOCTYPE html>
<html>
<head>
<title>Režiser: ".$ispis."</title>";
include("import/template-1.html");
echo "<script type='text/javascript' src='js/izmenaRezisera.js'></script>
<script type='text/javascript' src='js/ajax.js'></script>";
include("import/template-2.html");

echo "<h1>".$ispis."</h1><div id='podaci-o-filmu'>
<div id='poster'><img src='".$red->Slika."' id='slika-poster'/>
</div>
<div id='tekst'>
<p class='kljuc'>Ime i prezime:</p><p class='vrednost'>".$red->Ime." ".$red->Prezime."</p><p class='ispis-validacija'></p>
<p class='kljuc'>Datum i mesto rođenja:</p><p class='vrednost'>".date_format(date_create($red->DatumRodjenja), 'd/m/Y').", ".$red->MestoRodjenja."</p><p class='ispis-validacija'></p>";
if (strtotime($red->DatumSmrti) != "") {
	echo "<p class='kljuc'>Datum i mesto smrti:</p><p class='vrednost'>".date('d/m/Y', strtotime($red->DatumSmrti)).", ".$red->MestoSmrti."</p><p class='ispis-validacija'></p>";
} echo "<p class='kljuc'>Zemlja:</p><p class='vrednost'>";
$nizZemlje = explode("/", $red->Zemlja);
for ($i = 0; $i < count($nizZemlje); $i++) {
	echo "<img src='slike/zastave/".$nizZemlje[$i].".png' class='reziser-zastava' alt='".$nizZemlje[$i]."' title='".$nizZemlje[$i]."' /> ";
}
echo "</p><p class='ispis-validacija'></p>
<p class='kljuc'>Broj filmova u arhivi:</p><p class='vrednost' style='display: block;'>";

$upitBroj = "SELECT COUNT(*) AS BrojFilmova FROM reziser r INNER JOIN film f ON (r.reziserid = f.reziserid) WHERE r.reziserid = ".$_GET["id"];
$rezultatBroj = $konekcija->query($upitBroj);
$redBroj = $rezultatBroj->fetch_object();

echo "<a href='#filmovi-rezisera'>".$redBroj->BrojFilmova."</a></p>";
if (isset($_SESSION["ulogovan"]) && !empty($_SESSION["ulogovan"])) {
	echo "<button class='button button1' style='display: inline;' onclick='postaviFormu()'>Izmeni vrednosti</button>";
}
echo "</div>
</div>";

$upitFilmovi = "SELECT f.filmid, f.naziv, f.godina, f.poster FROM film f INNER JOIN reziser r ON (f.reziserid = r.reziserid) WHERE f.reziserid = ".$_GET["id"]." ORDER BY f.godina ASC";
$rezultatFilmovi = $konekcija->query($upitFilmovi);

$brojRedova = ceil(mysqli_num_rows($rezultatFilmovi) / 3);
$brojFilmovaURedu = 0;

echo "<div id='filmovi-rezisera'><table id='filmovi-rezisera-tabela' style='margin-top: 30px;'>";
while ($redFilmovi = $rezultatFilmovi->fetch_object()) {
	if ($brojFilmovaURedu % 3 == 0) {
		echo "<tr>";
	}
	echo "<td width='33%'><a href='film.php?id=".$redFilmovi->filmid."' target='_blank'><img src='".$redFilmovi->poster."'>".$redFilmovi->naziv."<br>".$redFilmovi->godina."</a></td>";
	$brojFilmovaURedu++;
	if ($brojFilmovaURedu % 3 == 0) {
		echo "</tr>";
		$brojFilmovaURedu = 0;
	}
}

$ostatak = 3 - (mysqli_num_rows($rezultatFilmovi) % 3);
for ($i = 0; $i < $ostatak; $i++) {
	echo "<td width='33%'></td>";
}

if ($brojFilmovaURedu % 3 != 0) {
	echo "</tr>";
}

echo "</table></div>";

$konekcija->close();

include("import/template-3.html");

?>