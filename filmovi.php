<?php 

session_start();

include "klase.php";
include "konekcija.php";

$upit = "SELECT f.filmid AS 'ID', f.poster AS 'Slika', f.naziv AS 'Naslov', f.godina AS 'Godina', f.trajanje AS 'Trajanje', r.reziserid AS 'ReziserID', r.ime AS 'Ime', r.prezime AS 'Prezime', z.nazivzanra AS 'Zanr' FROM film f INNER JOIN zanr z ON (f.zanrid = z.zanrid) INNER JOIN reziser r ON (f.reziserid = r.reziserid)";

if (isset($_GET['sort'])) {

	switch ($_GET['sort']) {
		case 'naslov':
		if ($_GET['smer'] == 'asc') {
			$upit .= " ORDER BY Naslov ASC";
		} else if ($_GET['smer'] == 'desc') {
			$upit .= " ORDER BY Naslov DESC";
		} break;
		case 'godina':
		if ($_GET['smer'] == 'asc') {
			$upit .= " ORDER BY Godina ASC";
		} else if ($_GET['smer'] == 'desc') {
			$upit .= " ORDER BY Godina DESC";
		} break;
		case 'trajanje':
		if ($_GET['smer'] == 'asc') {
			$upit .= " ORDER BY Trajanje ASC";
		} else if ($_GET['smer'] == 'desc') {
			$upit .= " ORDER BY Trajanje DESC";
		} break;
		case 'reziser':
		if ($_GET['smer'] == 'asc') {
			$upit .= " ORDER BY Ime ASC";
		} else if ($_GET['smer'] == 'desc') {
			$upit .= " ORDER BY Ime DESC";
		} break;
		case 'zanr':
		if ($_GET['smer'] == 'asc') {
			$upit .= " ORDER BY Zanr ASC";
		} else if ($_GET['smer'] == 'desc') {
			$upit .= " ORDER BY Zanr DESC";
		} break;
		default: echo "Nije urađeno sortiranje po tom kriterijumu!";
	}

	vratiFilmove();

} else {
	echo "<!DOCTYPE html>
	<html>
	<head>
	<title>Filmovi</title>";
	include("import/template-1.html");
	echo "<script type='text/javascript' src='js/ajax.js'></script><script type='text/javascript' src='js/tabela.js'></script>
	<script type='text/javascript'>
	$(document).ready(function() {
		$('#textfieldPretraga').keyup(function() {
			var unos = $('#textfieldPretraga').val();
			$.post('predlog.php', {unos: unos, tip: 'film'}, function(data) {
				$('#autosuggest-pretraga').show();
				$('#autosuggest-pretraga').html(data);
			});
});
$('.brisanje-link').click(function() {
	if (confirm('Da li ste sigurni da želite da obrišete film?') != true) {
		return;
	}
	var id = $(this).attr('id').substring(3);
	var red = $(this);
	$.ajax({
		method: 'POST',
		url: 'brisanje.php',
		data: { id: id, tip: 'film' }
	})
.done(function(data) {
	if (data[0] == '1') {
		$(red).parent().parent().remove();
		alert(data.substring(1));
	} else if (data[0] == '0') {
		alert(data.substring(1));
	}
});
});
$('#prikaz-filmovi').click(function() {
	$('.brisanje-link').off('click');

	$('.brisanje-link').on('click', function() {
		if (confirm('Da li ste sigurni da želite da obrišete film?') != true) {
			return;
		}
		var id = $(this).attr('id').substring(3);
		var red = $(this);
		$.ajax({
			method: 'POST',
			url: 'brisanje.php',
			data: { id: id, tip: 'film' }
		})
.done(function(data) {
	if (data[0] == '1') {
		$(red).parent().parent().remove();
		alert(data.substring(1));
	} else if (data[0] == '0') {
		alert(data.substring(1));
	}
});
});
});
});
</script>";
include("import/template-2.html");
echo "<br><h2>SPISAK SVIH FILMOVA</h2><br>
<button class='button button1' onclick='dodajTextFieldPretraga()' style='float: left; margin-left: 25px;margin-bottom: 10px;'>Pretraga</button>";
if (isset($_SESSION["ulogovan"]) && !empty($_SESSION["ulogovan"])) {
	echo "<button class='button button3' onclick='window.location=\"unosFilma.php\"' style='float: left; margin-left: 10px;margin-bottom: 10px;'>Unos</button>
	<button class='button button2' onclick='dodajKolonuBrisanje()' style='float: left; margin-left: 10px;margin-bottom: 10px;'>Brisanje</button><br>";
}
echo "<div id='textfield-pretraga' style='float: left; display: none;'>
<form name='forma-pretraga' method='GET' action='pretraga.php' onsubmit='return daLiJePraznoPolje()'>
<input type='text' id='textfieldPretraga' name='pretraga-film' size='35'>
<input type='submit' class='button button3' value='Pretraži' style='margin-left: 0;'>
</form>
<div id='autosuggest-pretraga' class='autosuggest' style='position: absolute; z-index: 1; width: 291px; display: none;'>
</div>
</div>";
echo "<table id='prikaz-filmovi' align='center' style='text-align: center;'>";
vratiFilmove();
echo "</table>";
include("import/template-3.html");
}

function vratiFilmove() {

	global $konekcija;
	global $upit;
	$rezultat = $konekcija->query($upit);

	echo "<tr>
	<th></th>
	<th>Naslov<a href='javascript:void(0)' onclick='sortiraj(\"naslov\", \"asc\", \"film\")'><img src='slike/asc.png' title='Po naslovu A->Z' /></a><a href='javascript:void(0)' onclick='sortiraj(\"naslov\", \"desc\", \"film\")'><img src='slike/desc.png' title='Po naslovu Z->A' /></a></th>
	<th>Godina<a href='javascript:void(0)' onclick='sortiraj(\"godina\", \"asc\", \"film\")'><img src='slike/asc.png' title='Po godini 0->9' /></a><a href='javascript:void(0)' onclick='sortiraj(\"godina\", \"desc\", \"film\")'><img src='slike/desc.png' title='Po godini 9->0' /></a></th>
	<th>Trajanje<a href='javascript:void(0)' onclick='sortiraj(\"trajanje\", \"asc\", \"film\")'><img src='slike/asc.png' title='Po trajanju 0->9' /></a><a href='javascript:void(0)' onclick='sortiraj(\"trajanje\", \"desc\", \"film\")'><img src='slike/desc.png' title='Po trajanju 9->0' /></a></th>
	<th>Režiser<a href='javascript:void(0)' onclick='sortiraj(\"reziser\", \"asc\", \"film\")'><img src='slike/asc.png' title='Po režiseru A->Z' /></a><a href='javascript:void(0)' onclick='sortiraj(\"reziser\", \"desc\", \"film\")'><img src='slike/desc.png' title='Po režiseru Z->A' /></a></th>
	<th>Žanr<a href='javascript:void(0)' onclick='sortiraj(\"zanr\", \"asc\", \"film\")'><img src='slike/asc.png' title='Po žanru A->Z' /></a><a href='javascript:void(0)' onclick='sortiraj(\"zanr\", \"desc\", \"film\")'><img src='slike/desc.png' title='Po žanru Z->A' /></a></th>
	<th class='kolona-brisanje' style='display: none;'>Brisanje</th>
	</tr>";
	while ($red = $rezultat->fetch_object()) {
		$r = new Reziser($red->Ime." ".$red->Prezime);
		$z = new Zanr($red->Zanr);
		$f = new Film($red->ID, $red->Slika, $red->Naslov, $red->Godina, $red->Trajanje, $r, $z);
		echo "<tr>
		<td class='poster-male'><a href='film.php?id=".$f->getFilmID()."' target='_blank'><img src='".$f->getPoster()."' alt='".$f->getNaziv()."' title='".$f->getNaziv()."' /></a></td>
		<td style='text-align: left;padding-left: 5px;'><a href='film.php?id=".$f->getFilmID()."' target='_blank'>".$f->getNaziv()."</a></td>
		<td>".$f->getGodina()."</td>
		<td>".((floor($f->getTrajanje() / 60) != 0) ? floor($f->getTrajanje() / 60)."h ".fmod($f->getTrajanje(), 60) : fmod($f->getTrajanje(), 60))."min</td>
		<td><a href='reziser.php?id=".$red->ReziserID."' target='_blank'>".$f->getReziser()->getImePrezime()."</a></td>
		<td><a href='pretraga.php?pretraga-film=".strtolower($f->getZanr()->getNaziv())."' target='_blank'>".$f->getZanr()->getNaziv()."</a></td>
		<td class='kolona-brisanje' style='display: none;'><a href='javascript:void(0)' target='_blank' class='brisanje-link' id='red".$f->getFilmID()."'>Obriši</a></td>
		</tr>";
	}

	$konekcija->close();
}

?>