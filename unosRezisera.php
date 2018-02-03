<?php 

session_start();

if (!isset($_SESSION["ulogovan"]) && empty($_SESSION["ulogovan"])) {
	echo "<!DOCTYPE html>
	<html>
	<head><title>Nedozvoljen pristup</title>";
	include("import/template-1.html");
	include("import/template-2.html");
	echo "<div width='400px'><br><h2 style='color: #FF0000;'>Nedozvoljen pristup stranici!</h2></div>";
	include("import/template-3.html");
	header("Refresh:3; url=login.php", true, 303);
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Unos režisera</title>
	<meta http-equiv="Content-Language" content="sr" />
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/tema1.css" id="tema">

	<link rel="icon" type="image/png" href="slike/favicon.png">

	<script type="text/javascript" src="js/menu.js"></script>
	<script type="text/javascript" src="js/cookies.js"></script>
	<script type="text/javascript" src="js/validacijaUnos.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$("#menu").load("import/menu.php");
		$("footer").load("import/footer.html");

		var broj = Math.floor(Math.random() * 12 + 1);
		$("body").css("background-image", "url(slike/bg_slike/bg" + broj + ".jpg)");
		$("body").css("background-repeat", "no-repeat");
		$("body").css("background-attachment", "fixed");
	});
	</script>
</head>
<body onload="proveriCookie()">
	<div id="strana">
		<div id="header"></div>
		<div id="menu"></div>
		<div id="sadrzaj">
			<h1>UNOS REŽISERA</h1>
			<div id="podaci-o-filmu">
				<div id="poster"><img src="slike/default.jpg" id="slika-poster" />
				</div>
				<div id="tekst">
					<form name="forma-izmena" method="POST" action="unos.php">
						<p class="kljuc">Ime i prezime:</p>
						<input id="ime" type="text" name="ime" size="20" autofocus>
						<input id="prezime" type="text" name="prezime" size="30">
						<p class="ispis-validacija"></p>
						<p class="kljuc">Datum i mesto rođenja:</p>
						<input id="datumRodjenja" type="date" name="datumRodjenja">
						<input id="mestoRodjenja" type="text" name="mestoRodjenja" size="30">
						<p class="ispis-validacija"></p>
						<p class="kljuc">Datum i mesto smrti:</p>
						<input id="datumSmrti" type="date" name="datumSmrti">
						<input id="mestoSmrti" type="text" name="mestoSmrti" size="30">
						<p class="kljuc">Link za sliku:</p>
						<input type="text" name="slika" size="50" style="display: inline;">
						<p class="ispis-validacija"></p>
						<p class="kljuc">Zemlja:</p>
						<input id="zemlja" type="text" name="zemlja" size="40">
						<p class="ispis-validacija"></p><br>
						<input type="hidden" name="tip" value="reziser">
						<input type="submit" value="Pošalji" class="button button3" style="display: none;">
						<input type="reset" value="Resetuj" class="button button2">
					</form>
					<button class="button button1" onclick="validacijaReziser()">Proveri</button>
				</div>
			</div>
		</div>
		<footer></footer>
	</div>
	<script type="text/javascript">
	document.getElementsByTagName("input")[0].onkeyup = function() {
		if (document.getElementsByTagName("input")[0].value != "" && document.getElementsByTagName("input")[1].value != "") {
			document.getElementsByClassName("ispis-validacija")[0].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[0].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[0].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[0].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[0].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[0].style.textDecoration = "line-through";
		}
	}

	document.getElementsByTagName("input")[1].onkeyup = function() {
		if (document.getElementsByTagName("input")[1].value != "" && document.getElementsByTagName("input")[0].value != "") {
			document.getElementsByClassName("ispis-validacija")[0].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[0].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[0].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[0].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[0].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[0].style.textDecoration = "line-through";
		}
	}

	document.getElementsByTagName("input")[2].oninput = function() {
		if (document.getElementsByTagName("input")[2].value != "" && document.getElementsByTagName("input")[3].value != "") {
			document.getElementsByClassName("ispis-validacija")[1].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[1].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[1].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[1].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[1].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[1].style.textDecoration = "line-through";
		}
	}

	document.getElementsByTagName("input")[3].onkeyup = function() {
		if (document.getElementsByTagName("input")[3].value != "" && document.getElementsByTagName("input")[2].value != "") {
			document.getElementsByClassName("ispis-validacija")[1].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[1].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[1].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[1].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[1].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[1].style.textDecoration = "line-through";
		}
	}

	document.getElementsByTagName("input")[7].onkeyup = function() {
		if (document.getElementsByTagName("input")[7].value != "") {
			document.getElementsByClassName("ispis-validacija")[3].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[3].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[3].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[3].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[3].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[3].style.textDecoration = "line-through";
		}
	}

	document.getElementsByTagName("input")[6].onkeyup = function() {
		var link = document.getElementsByName("slika")[0].value;
		var slikaReziser = document.getElementsByTagName("img")[0];
		slikaReziser.src = link;
		slikaReziser.onerror = function() {
			document.getElementsByClassName("ispis-validacija")[2].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[2].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[2].style.textDecoration = "line-through";
		}
		slikaReziser.onload = function() {
			document.getElementsByClassName("ispis-validacija")[2].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[2].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[2].style.textDecoration = "none";
		}
	}
	</script>
</body>
</html>