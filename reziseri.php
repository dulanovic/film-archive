<?php 

session_start();

include "klase.php";
include "konekcija.php";

$upit = "SELECT r.reziserid, CONCAT(r.ime, ' ', r.prezime) AS imeprezime, r.slika, r.datumrodjenja, r.mestorodjenja, r.datumsmrti, r.mestosmrti, r.zemlja FROM reziser r";

if (isset($_GET['sort'])) {

	switch ($_GET['sort']) {
		case 'ime':
		if ($_GET['smer'] == 'asc') {
			$upit .= " ORDER BY imeprezime ASC";
		} else if ($_GET['smer'] == 'desc') {
			$upit .= " ORDER BY imeprezime DESC";
		} break;
		case 'datumr':
		if ($_GET['smer'] == 'asc') {
			$upit .= " ORDER BY r.datumrodjenja ASC";
		} else if ($_GET['smer'] == 'desc') {
			$upit .= " ORDER BY r.datumrodjenja DESC";
		} break;
		case 'datums':
		if ($_GET['smer'] == 'asc') {
			$upit .= " ORDER BY r.datumsmrti ASC";
		} else if ($_GET['smer'] == 'desc') {
			$upit .= " ORDER BY r.datumsmrti DESC";
		} break;
		case 'zemlja':
		if ($_GET['smer'] == 'asc') {
			$upit .= " ORDER BY r.zemlja ASC";
		} else if ($_GET['smer'] == 'desc') {
			$upit .= " ORDER BY r.zemlja DESC";
		} break;
		default: echo "Nije urađeno sortiranje po tom kriterijumu!";
	}

	vratiRezisere();

} else {
	echo "<!DOCTYPE html>
	<html>
	<head>
	<title>Režiseri</title>";
	include("import/template-1.html");
	echo "<script type='text/javascript' src='js/ajax.js'></script><script type='text/javascript' src='js/tabela.js'></script><script type='text/javascript'>
	$(document).ready(function() {
		$('#textfieldPretraga').keyup(function() {
			var unos = $('#textfieldPretraga').val();
			$.post('predlog.php', {unos: unos, mod: 'pretraga'}, function(data) {
				$('#autosuggest-pretraga').show();
				$('#autosuggest-pretraga').html(data);
			});
});
$('.brisanje-link').click(function() {
	if (confirm('Da li ste sigurni da želite da obrišete režisera?') != true) {
		return;
	}
	var id = $(this).attr('id').substring(3);
	var red = $(this);
	$.ajax({
		method: 'POST',
		url: 'brisanje.php',
		data: { id: id, tip: 'reziser' }
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
$('#prikaz-reziseri').click(function() {
	$('.brisanje-link').off('click');

	$('.brisanje-link').on('click', function() {
		if (confirm('Da li ste sigurni da želite da obrišete režisera?') != true) {
			return;
		}
		var id = $(this).attr('id').substring(3);
		var red = $(this);
		$.ajax({
			method: 'POST',
			url: 'brisanje.php',
			data: { id: id, tip: 'reziser' }
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
echo "<br><h2>SPISAK SVIH REŽISERA</h2><br>
<button class='button button1' onclick='dodajTextFieldPretraga()' style='float: left; margin-left: 25px;margin-bottom: 10px;'>Pretraga</button>";
if (isset($_SESSION["ulogovan"]) && !empty($_SESSION["ulogovan"])) {
	echo "<button class='button button3' onclick='window.location=\"unosRezisera.php\"' style='float: left; margin-left: 10px;margin-bottom: 10px;'>Unos</button>
	<button class='button button2' onclick='dodajKolonuBrisanje()' style='float: left; margin-left: 10px;margin-bottom: 10px;'>Brisanje</button><br>";
}
echo "<div id='textfield-pretraga' style='float: left; display: none;'>
<form name='forma-pretraga' method='GET' action='pretraga.php' onsubmit='return daLiJePraznoPolje()'>
<input type='text' id='textfieldPretraga' name='pretraga-reziser' size='35'>
<input type='submit' class='button button3' value='Pretraži' style='margin-left: 0;'>
</form>
<div id='autosuggest-pretraga' class='autosuggest' style='position: absolute; z-index: 1; width: 291px; display: none;'>
</div>
</div>";
echo "<table id='prikaz-reziseri' align='center'>";
vratiRezisere();
echo "</table>";
include("import/template-3.html");
}

function vratiRezisere() {

	global $konekcija;
	global $upit;
	$rezultat = $konekcija->query($upit);

	echo "<tr>
	<th></th>
	<th>Ime i prezime<a href='javascript:void(0)' onclick='sortiraj(\"ime\", \"asc\", \"reziser\")'><img src='slike/asc.png' title='Po imenu A->Z' /></a><a href='javascript:void(0)' onclick='sortiraj(\"ime\", \"desc\", \"reziser\")'><img src='slike/desc.png' title='Po imenu Z->A' /></a></th>
	<th>Dat. i mes. rođ.<a href='javascript:void(0)' onclick='sortiraj(\"datumr\", \"asc\", \"reziser\")'><img src='slike/asc.png' title='Po datumu rođenja 0->9' /></a><a href='javascript:void(0)' onclick='sortiraj(\"datumr\", \"desc\", \"reziser\")'><img src='slike/desc.png' title='Po datumu rođenja 9->0' /></a></th>
	<th>Dat. i mes. smrti<a href='javascript:void(0)' onclick='sortiraj(\"datums\", \"asc\", \"reziser\")'><img src='slike/asc.png' title='Po datumu smrti 0->9' /></a><a href='javascript:void(0)' onclick='sortiraj(\"datums\", \"desc\", \"reziser\")'><img src='slike/desc.png' title='Po datumu smrti 9->0' /></a></th>
	<th>Zemlja<a href='javascript:void(0)' onclick='sortiraj(\"zemlja\", \"asc\", \"reziser\")'><img src='slike/asc.png' title='Po zemlji A->Z' /></a><a href='javascript:void(0)' onclick='sortiraj(\"zemlja\", \"desc\", \"reziser\")'><img src='slike/desc.png' title='Po zemlji Z->A' /></a></th>
	<th class='kolona-brisanje' id='header-brisanje' style='display: none;'>Brisanje</th>
	</tr>";
	while ($red = $rezultat->fetch_object()) {
		echo "<tr>
		<td class='slike-male' width='5%'><a href='reziser.php?id=".$red->reziserid."' target='_blank'><img src='".$red->slika."' alt='".$red->imeprezime."' title='".$red->imeprezime."' /></a></td>
		<td width='25%'><a href='reziser.php?id=".$red->reziserid."' target='_blank'>".$red->imeprezime."</a></td>";
		echo "<td width='25%'>".date_format(date_create($red->datumrodjenja), 'd/m/Y').", ".$red->mestorodjenja."</td>
		<td width='25%'>".((strtotime($red->datumsmrti) != "") ? date('d/m/Y', strtotime($red->datumsmrti)).", ".$red->mestosmrti : '')."</td>
		<td width='15%' align='center' class='zastave'>";
		$nizDrzava = explode("/", $red->zemlja);
		for ($i = 0; $i < count($nizDrzava); $i++) {
			echo "<img src='slike/zastave/".$nizDrzava[$i].".png' alt='".$nizDrzava[$i]."' title='".$nizDrzava[$i]."' /> ";
		}
		
		echo "</td><td class='kolona-brisanje' align='center' valign='middle' style='display: none;'><a href='javascript:void(0)' target='_blank' class='brisanje-link' id='red".$red->reziserid."'>Obriši</a></td></tr>";	
	}

	$konekcija->close();
}

?>