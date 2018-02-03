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
	<title>Unos filma</title>
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
			<h1>UNOS FILMA</h1>
			<div id="podaci-o-filmu">
				<div id="poster"><img src="slike/default.jpg" id="slika-poster" />
				</div>
				<div id="tekst">
					<form name="forma-izmena" method="POST" action="unos.php">
						<p class="kljuc">Naziv filma:</p>
						<input id="nazivFilma" type="text" name="naziv-filma" size="30" autofocus>
						<p class="ispis-validacija"></p>
						<p class="kljuc">Godina:</p>
						<input type="text" name="godina" size="10">
						<p class="ispis-validacija"></p>
						<p class="kljuc">Žanr:</p>
						<input type="text" name="zanr" size="20" style="margin-bottom: 0px;">
						<p class="ispis-validacija"></p>
						<div class="autosuggest" style="position: absolute; z-index: 1; width: 197px;">
						</div>
						<p class="kljuc">Opis:</p>
						<textarea name="opis-filma" cols="50" rows="5"></textarea>
						<p class="ispis-validacija"></p>
						<p class="kljuc">Režiser:</p>
						<input type="text" name="reziser" size="30" style="margin-bottom: 0px;">
						<p class="ispis-validacija"></p>
						<div class="autosuggest" style="position: absolute; z-index: 1; width: 291px;">
						</div>
						<p class="kljuc">Uloge:</p>
						<input type="text" name="uloge" size="50">
						<p class="ispis-validacija"></p>
						<p class="kljuc">Trajanje:</p>
						<input type="text" name="trajanje" size="10"> min
						<p class="ispis-validacija"></p>
						<p class="kljuc">IMDb link:</p>
						<input type="text" name="imdb" size="50" style="display: inline;">
						<p class="ispis-validacija" style="margin-top: 0px;"></p>
						<p class="kljuc">YouTube trejler link:</p>
						<input type="text" name="trejler" size="50">
						<p class="ispis-validacija" style="margin-top: 0px;"></p>
						<p class="kljuc">Link za poster:</p>
						<input type="text" name="poster" size="50" style="display: inline;">
						<p class="ispis-validacija" style="margin-top: 0px;"></p><br>
						<input type="hidden" name="tip" value="film">
						<input type="submit" value="Pošalji" class="button button3" style="display: none;">
						<input type="reset" value="Resetuj" class="button button2">
					</form>
					<button class="button button1" onclick="validacijaFilm()">Proveri</button>
				</div>
			</div>
		</div>
		<footer></footer>
	</div>
	<script type="text/javascript">
	document.getElementsByTagName("input")[0].onkeyup = function() {
		if (document.getElementsByTagName("input")[0].value != "") {
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
		if (parseInt(document.getElementsByTagName("input")[1].value) <= 2017 && parseInt(document.getElementsByTagName("input")[1].value) >= 1878) {
			document.getElementsByClassName("ispis-validacija")[1].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[1].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[1].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[1].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[1].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[1].style.textDecoration = "line-through";
		}
	}

	document.getElementsByTagName("input")[2].oninput = function() {
		proveri(document.getElementsByTagName("input")[2].value, "zanr");
	}
	document.getElementsByTagName("input")[2].onkeyup = function() {
		predlozi(document.getElementsByTagName("input")[2].value, "zanr");
	}

	document.getElementsByTagName("input")[8].onkeyup = function() {
		var link = document.getElementsByTagName("input")[8].value;
		var slika = document.getElementById("slika-poster");
		slika.src = link;
		slika.onerror = function() {
			document.getElementsByClassName("ispis-validacija")[9].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[9].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[9].style.textDecoration = "line-through";
		}
		slika.onload = function() {
			document.getElementsByClassName("ispis-validacija")[9].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[9].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[9].style.textDecoration = "none";
		}
	}

	document.getElementsByTagName("textarea")[0].onkeyup = function() {
		if (document.getElementsByTagName("textarea")[0].value != "") {
			document.getElementsByClassName("ispis-validacija")[3].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[3].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[3].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[3].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[3].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[3].style.textDecoration = "line-through";
		}
	}

	document.getElementsByTagName("input")[3].oninput = function() {
		proveri(document.getElementsByTagName("input")[3].value, "reziser");
	}
	document.getElementsByTagName("input")[3].onkeyup = function() {
		predlozi(document.getElementsByTagName("input")[3].value, "reziser");
	}

	document.getElementsByTagName("input")[4].onkeyup = function() {
		if (document.getElementsByTagName("input")[4].value != "") {
			document.getElementsByClassName("ispis-validacija")[5].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[5].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[5].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[5].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[5].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[5].style.textDecoration = "line-through";
		}
	}

	document.getElementsByTagName("input")[5].onkeyup = function() {
		if (parseInt(document.getElementsByTagName("input")[5].value) <= 773 && parseInt(document.getElementsByTagName("input")[5].value) >= 1) {
			document.getElementsByClassName("ispis-validacija")[6].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[6].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[6].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[6].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[6].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[6].style.textDecoration = "line-through";
		}
	}

	document.getElementsByTagName("input")[6].onkeyup = function() {
		if (document.getElementsByTagName("input")[6].value.substring(0, 28) == "http://www.imdb.com/title/tt" && document.getElementsByTagName("input")[6].value.substring(28).length == 7) {
			document.getElementsByClassName("ispis-validacija")[7].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[7].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[7].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[7].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[7].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[7].style.textDecoration = "line-through";
		}
	}

	document.getElementsByTagName("input")[7].onkeyup = function() {
		if ((document.getElementsByTagName("input")[7].value.substring(0, 30) == "https://www.youtube.com/embed/" || document.getElementsByTagName("input")[7].value.substring(0, 32) == "https://www.youtube.com/watch?v=") && (document.getElementsByTagName("input")[7].value.substring(30).length == 11 || document.getElementsByTagName("input")[7].value.substring(32).length == 11)) {
			document.getElementsByClassName("ispis-validacija")[8].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[8].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[8].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[8].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[8].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[8].style.textDecoration = "line-through";
		}
	}
	</script>
</body>
</html>