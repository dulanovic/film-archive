var xmlHttp;

function getXmlHttpRequest() {
	var xmlHttp = null;
	try {
		xmlHttp = new XMLHttpRequest();
	} catch(e) {
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch(e) {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}

function sortiraj(kriterijum, smer, tip) {
	xmlHttp = getXmlHttpRequest();
	if (xmlHttp == null) {
		alert("Vaš browser ne podržava AJAX HTTP zahteve!");
		return;
	}

	if (tip == "film") {

		var adresa = "filmovi.php?sort=" + kriterijum + "&smer=" + smer + "&sid=" + Math.random();
		xmlHttp.open("GET", adresa, true);
		xmlHttp.send(null);
		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4) {
				var kolona = document.getElementsByClassName("kolona-brisanje")[0];
				if (kolona.style.display == "none") {
					document.getElementById("prikaz-filmovi").innerHTML = xmlHttp.responseText;
				} else if (kolona.style.display == "block") {
					var responseTextPreradjen = xmlHttp.responseText.replace(/style='display: none;'/g, "style='display: block;'");
					document.getElementById("prikaz-filmovi").innerHTML = responseTextPreradjen;
				}				
				document.getElementById("prikaz-filmovi").click();
			}
		}
	} else if (tip == "reziser") {

		var adresa = "reziseri.php?sort=" + kriterijum + "&smer=" + smer + "&sid=" + Math.random();
		xmlHttp.open("GET", adresa, true);
		xmlHttp.send(null);
		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4) {
				var kolona = document.getElementsByClassName("kolona-brisanje")[0];
				if (kolona.style.display == "none") {
					document.getElementById("prikaz-reziseri").innerHTML = xmlHttp.responseText;
				} else if (kolona.style.display == "block") {
					var responseTextPreradjen = xmlHttp.responseText.replace(/style='display: none;'/g, "style='display: block;'");
					document.getElementById("prikaz-reziseri").innerHTML = responseTextPreradjen;
				}				
				document.getElementById("prikaz-reziseri").click();
			}
		}
	}
}

function proveri(unos, tip) {
	xmlHttp = getXmlHttpRequest();
	if (xmlHttp == null) {
		alert("Vaš browser ne podržava AJAX HTTP zahteve!");
		return;
	}

	if (tip == "reziser") {

		if (unos == "") {
			document.getElementsByClassName("autosuggest")[1].style.display = "none";
		}

		var adresa = "provera.php?ime=" + unos + "&tip=reziser&sid=" +  Math.random();
		xmlHttp.open("GET", adresa, true);
		xmlHttp.send(null);
		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4) {
				if (xmlHttp.responseText == "1") {
					document.getElementsByClassName("ispis-validacija")[4].innerHTML = "OK";
					document.getElementsByClassName("ispis-validacija")[4].style.color = "#008000";
					document.getElementsByClassName("ispis-validacija")[4].style.textDecoration = "none";
				} else if (xmlHttp.responseText == "0") {
					document.getElementsByClassName("ispis-validacija")[4].innerHTML = "OK!";
					document.getElementsByClassName("ispis-validacija")[4].style.color = "#FF0000";
					document.getElementsByClassName("ispis-validacija")[4].style.textDecoration = "line-through";
				}
			}
		}
	} else if (tip == "zanr") {

		if (unos == "") {
			document.getElementsByClassName("autosuggest")[0].style.display = "none";
		}

		var adresa = "provera.php?zanr=" + unos + "&tip=zanr&sid=" +  Math.random();
		xmlHttp.open("GET", adresa, true);
		xmlHttp.send(null);
		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4) {
				if (xmlHttp.responseText == "1") {
					document.getElementsByClassName("ispis-validacija")[2].innerHTML = "OK";
					document.getElementsByClassName("ispis-validacija")[2].style.color = "#008000";
					document.getElementsByClassName("ispis-validacija")[2].style.textDecoration = "none";
				} else if (xmlHttp.responseText == "0") {
					document.getElementsByClassName("ispis-validacija")[2].innerHTML = "OK!";
					document.getElementsByClassName("ispis-validacija")[2].style.color = "#FF0000";
					document.getElementsByClassName("ispis-validacija")[2].style.textDecoration = "line-through";
				}
			}
		}
	}
}

function predlozi(unos, tip) {
	
	if (unos == 0) {
		document.getElementsByClassName("autosuggest")[1].style.display = "none";
		return;
	}

	xmlHttp = getXmlHttpRequest();
	if (xmlHttp == null) {
		alert("Vaš browser ne podržava AJAX HTTP zahteve!");
		return;
	}

	if (tip == "reziser") {

		var adresa = "predlog.php";
		var parametri = "unos=" + unos + "&mod=validacija&sid=" + Math.random();
		xmlHttp.open("POST", adresa, true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.send(parametri);
		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4) {
				document.getElementsByClassName("autosuggest")[1].style.display = "block";
				document.getElementsByClassName("autosuggest")[1].innerHTML = xmlHttp.responseText;
			}
		}
	} else if (tip == "zanr") {
		var adresa = "predlog.php";
		var parametri = "unos=" + unos + "&tip=zanr&sid=" + Math.random();
		xmlHttp.open("POST", adresa, true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.send(parametri);
		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4) {
				document.getElementsByClassName("autosuggest")[0].style.display = "block";
				document.getElementsByClassName("autosuggest")[0].innerHTML = xmlHttp.responseText;
			}
		}
	}
}

function postavi(predlog, tip) {
	if (tip == "reziser") {
		document.getElementsByTagName("input")[3].value = predlog;
		proveri(predlog, "reziser");
		document.getElementsByClassName("autosuggest")[1].style.display = "none";
	} else if (tip == "zanr") {
		document.getElementsByTagName("input")[2].value = predlog;
		proveri(predlog, "zanr");
		document.getElementsByClassName("autosuggest")[0].style.display = "none";
	}
}