<?php 

session_start();

include "konekcija.php";
global $konekcija;

if (isset($_SESSION["ulogovan"]) && !empty($_SESSION["ulogovan"])) {
	//unset($_SESSION["ulogovan"]);
	//unset($_SESSION["podaci"]);
	//unset($_SESSION["korisnicko-ime"]);
	session_destroy();

	echo "<!DOCTYPE html>
	<html>
	<head><title>Logout</title>";
	include("import/template-1.html");
	include("import/template-2.html");
	echo "<div width='400px'><br><h2 style='color: #4BB543;'>Uspešno ste odjavljeni iz sistema</h2></div>";
	include("import/template-3.html");
	header("Refresh:3; url=login.php", true, 303);
	exit();
}

if (!isset($_POST["korisnicko-ime"]) || !isset($_POST["korisnicka-sifra"])) {
	echo "<!DOCTYPE html>
	<html>
	<head>
	<title>Login</title>";
	include("import/template-1.html");
	include("import/template-2.html");
	echo "<form method='POST' action='".$_SERVER['PHP_SELF']."' name='forma-login'><br>
	<table id='login-tabela' align='center'>
	<tr>
	<td>Korisničko ime: </td>
	<td><input type='text' name='korisnicko-ime' size='20' autofocus></td>
	</tr>
	<tr>
	<td>Korisnička šifra: </td>
	<td><input type='password' name='korisnicka-sifra' size='20'></td>
	</tr>
	<tr>
	<td></td>
	<td><input type='submit' class='button button3' value='Uloguj se'></td>
	</tr></table>";
	include("import/template-3.html");
} else {

	$korisnickoIme = $_POST["korisnicko-ime"];
	$korisnickaSifra = $_POST["korisnicka-sifra"];

	global $konekcija;
	$upit = "SELECT ime, prezime, korisnickoime FROM administrator WHERE korisnickoime = '".$korisnickoIme."' AND korisnickasifra = '".$korisnickaSifra."'";
	$rezultat = $konekcija->query($upit);
	$red = mysqli_fetch_assoc($rezultat);

	if ($rezultat->num_rows == 1) {
		
		$_SESSION["ulogovan"] = "administrator";
		$_SESSION["podaci"] = $red["ime"]." ".$red["prezime"];
		$_SESSION["korisnicko-ime"] = $red["korisnickoime"];

		echo "<!DOCTYPE html>
		<html>
		<head><title>Uspešan login</title>";
		include("import/template-1.html");
		include("import/template-2.html");
		echo "<div width='400px'><br><h2 style='color: #4BB543;'>Uspešno ste se prijavili na sistem</h2></div>";
		include("import/template-3.html");
		header("Refresh:3; url=index.php", true, 303);
		exit();
	} else {
		echo "<!DOCTYPE html>
		<html>
		<head>
		<title>Login</title>";
		include("import/template-1.html");
		include("import/template-2.html");
		echo "<div width='400px'><br><h2 style='color: #FF0000;'>Uneti podaci su neispravni,<br> molimo pokušajte ponovo.</h2></div>";
		include("import/template-3.html");
		header("Refresh:5; url=login.php", true, 303);
	}
}

?>