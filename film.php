<?php 

session_start();

include "konekcija.php";
global $konekcija;

if (!isset($_GET["id"])) {
	echo "<!DOCTYPE html>
	<html>
	<head>
	<title>Greška</title>";
	include("import/template-1.html");
	include("import/template-2.html");
	echo "<br><h2 style='color: #FF0000;'>Nije prosleđen parametar!</h2>";
	include("import/template-3.html");
	header("Refresh:3; url=filmovi.php", true, 303);
	exit();
}

$upit = "SELECT f.*, r.reziserid, r.ime, r.prezime, z.* FROM film f INNER JOIN reziser r ON (f.reziserid = r.reziserid) INNER JOIN zanr z ON (f.zanrid = z.zanrid) WHERE f.filmid = ".$_GET["id"];
$rezultat = $konekcija->query($upit);
$red = $rezultat->fetch_object();

$ispis = $red->Naziv." (".$red->Godina.")";

echo "<!DOCTYPE html>
<html>
<head>
<title>Film: ".$ispis."</title>";
include("import/template-1.html");
echo "<script type='text/javascript' src='js/izmenaFilma.js'></script>
<script type='text/javascript' src='js/ajax.js'></script>";
include("import/template-2.html");

echo "<h1>".$ispis."</h1><div id='podaci-o-filmu'>
<div id='poster'><img src='".$red->Poster."' id='slika-poster' alt='".$red->Naziv."' title='".$red->Naziv."' />
</div>
<div id='tekst'>
<p class='kljuc'>Naziv filma:</p><p class='vrednost'>".$red->Naziv."</p><p class='ispis-validacija'></p>
<p class='kljuc'>Godina:</p><p class='vrednost'><a href='pretraga.php?pretraga-film=".$red->Godina."' target='_blank'>".$red->Godina."</a></p><p class='ispis-validacija'></p>
<p class='kljuc'>Žanr:</p><p class='vrednost'><a href='pretraga.php?pretraga-film=".strtolower($red->NazivZanra)."' target='_blank'>".$red->NazivZanra."</a></p><p class='ispis-validacija'></p>
<p class='kljuc'>Opis:</p><p class='vrednost'>".$red->Opis."</p><p class='ispis-validacija'></p>
<p class='kljuc'>Režiser:</p><p class='vrednost'><a href='reziser.php?id=".$red->reziserid."' target='_blank'>".$red->ime." ".$red->prezime."</a></p><p class='ispis-validacija'></p>
<p class='kljuc'>Uloge:</p><p class='vrednost'>".$red->Uloge."</p><p class='ispis-validacija'></p>
<p class='kljuc'>Trajanje:</p><p class='vrednost'>".floor($red->Trajanje / 60)."h ".fmod($red->Trajanje, 60)." min (".$red->Trajanje."min)</p><p class='ispis-validacija'></p>
<a href='http://www.imdb.com/title/".$red->IMDbLink."' id='imdb-link' target='_blank'><img src='slike/imdb-logo.png' class='img-link' title='IMDb stranica' /></a>";
if (isset($_SESSION["ulogovan"]) && !empty($_SESSION["ulogovan"])) {
	echo "<button class='button button1' onclick='postaviFormu()'>Izmeni vrednosti</button>";
}
echo "</div>
</div>
<div id='accordion-omotac'>
<button class='accordion'>TREJLER</button>
<div class='accordion-sadrzaj'>
<iframe width='720' height='404' src='https://www.youtube.com/embed/".$red->Trejler."?autoplay=0' frameborder='0' allowfullscreen class='trejler'></iframe>
</div></div>";

echo "</div>
<footer></footer>
</div>
<script type='text/javascript'>
var accord = document.getElementsByClassName('accordion');
var i;

for (i = 0; i < accord.length; i++) {
	accord[i].onclick = function() {
		this.classList.toggle('aktivan');
		this.nextElementSibling.classList.toggle('prikazi-accordion');
	}
}
</script>
</body>
</html>";

$konekcija->close();

?>