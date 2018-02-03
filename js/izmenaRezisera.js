function postaviFormu() {

	var forma = document.createElement("form");
	forma.name = "forma-izmena";
	forma.method = "POST";
	forma.action = "izmena.php";
	var divTekst = document.getElementById("tekst");
	var divSadrzaj = document.getElementById("sadrzaj");

	var dugmeIzmeni = document.getElementsByTagName("button")[0];	
	var roditelj = document.getElementById("tekst");

	var imePrezime = document.getElementsByClassName("vrednost")[0];
	var imePrezimeIspis = imePrezime.innerHTML.split(" ");
	var imeIspis = imePrezimeIspis[0];
	var prezimeIspis = "";
	for (var i = 1; i < imePrezimeIspis.length; i++) {
		prezimeIspis += " " + imePrezimeIspis[i];
	}

	var ime = document.createElement("input");
	ime.id = "ime";
	ime.type = "text";
	ime.name = "ime";
	ime.value = imeIspis;
	ime.size = "20";
	ime.onkeyup = function() {
		if (ime.value != "" && prezime.value != "") {
			document.getElementsByClassName("ispis-validacija")[0].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[0].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[0].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[0].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[0].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[0].style.textDecoration = "line-through";
		}
	}

	var prezime = document.createElement("input");
	prezime.id = "prezime";
	prezime.type = "text";
	prezime.name = "prezime";
	prezime.value = prezimeIspis;
	prezime.size = "30";
	prezime.style.marginLeft = "5px";
	prezime.onkeyup = function() {
		if (prezime.value != "" && ime.value != "") {
			document.getElementsByClassName("ispis-validacija")[0].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[0].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[0].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[0].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[0].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[0].style.textDecoration = "line-through";
		}
	}

	var datumRodjenjaVrednost = document.getElementsByClassName("vrednost")[1];
	var datumRodjenjaNiz = datumRodjenjaVrednost.innerHTML.split("/");
	var datumRodjenjaIspis = datumRodjenjaNiz[2].substring(0, 4) + "-" + datumRodjenjaNiz[1] + "-" + datumRodjenjaNiz[0];

	var datumRodjenja = document.createElement("input");
	datumRodjenja.id = "datumRodjenja";
	datumRodjenja.type = "date";
	datumRodjenja.name = "datumRodjenja";
	datumRodjenja.value = datumRodjenjaIspis;
	datumRodjenja.oninput = function() {
		if (datumRodjenja.value != "" && mestoRodjenja.value != "") {
			document.getElementsByClassName("ispis-validacija")[1].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[1].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[1].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[1].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[1].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[1].style.textDecoration = "line-through";
		}
	}

	var mestoRodjenja = document.createElement("input");
	mestoRodjenja.id = "mestoRodjenja";
	mestoRodjenja.type = "text";
	mestoRodjenja.name = "mestoRodjenja";
	mestoRodjenja.value = datumRodjenjaNiz[2].substring(6);
	mestoRodjenja.size = "30";
	mestoRodjenja.style.marginLeft = "5px";
	mestoRodjenja.onkeyup = function() {
		if (mestoRodjenja.value != "" && datumRodjenja.value != "") {
			document.getElementsByClassName("ispis-validacija")[1].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[1].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[1].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[1].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[1].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[1].style.textDecoration = "line-through";
		}
	}

	var datumIMestoSmrtiP = document.createElement("p");
	var datumIMestoSmrtiText = document.createTextNode("Datum i mesto smrti:");
	datumIMestoSmrtiP.appendChild(datumIMestoSmrtiText);
	datumIMestoSmrtiP.className = "kljuc";

	var datumSmrtiVrednost = document.getElementsByClassName("vrednost")[2];
	var datumSmrtiNiz = datumSmrtiVrednost.innerHTML.split("/");
	var datumSmrtiIspis = datumSmrtiNiz[2].substring(0, 4) + "-" + datumSmrtiNiz[1] + "-" + datumSmrtiNiz[0];

	var datumSmrti = document.createElement("input");
	datumSmrti.id = "datumSmrti";
	datumSmrti.type = "date";
	datumSmrti.name = "datumSmrti";
	datumSmrti.value = datumSmrtiIspis;

	var mestoSmrti = document.createElement("input");
	mestoSmrti.id = "mestoSmrti";
	mestoSmrti.type = "text";
	mestoSmrti.name = "mestoSmrti";
	mestoSmrti.size = "30";
	mestoSmrti.style.marginLeft = "5px";

	var zemljaIspis = document.getElementsByClassName("vrednost")[document.getElementsByClassName("vrednost").length - 2];
	var zemljaNiz = zemljaIspis.innerHTML.split("/");
	var zemljaVrednostNiz = "";
	for (var i = 2; i < zemljaNiz.length; i = i + 2) {
		var zemljaVrednostNiz = zemljaVrednostNiz + zemljaNiz[i].split(".")[0] + "/";
	}

	var zemlja = document.createElement("input");
	zemlja.id = "zemlja";
	zemlja.type = "text";
	zemlja.name = "zemlja";
	zemlja.value = zemljaVrednostNiz.slice(0, -1);
	zemlja.size = "40";
	zemlja.onkeyup = function() {
		if (zemlja.value != "") {
			document.getElementsByClassName("ispis-validacija")[3].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[3].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[3].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[3].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[3].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[3].style.textDecoration = "line-through";
		}
	}

	var slikaParagraf = document.createElement("p");
	slikaParagraf.className = "kljuc";
	var slikaTekst = document.createTextNode("Link za sliku:");
	slikaParagraf.appendChild(slikaTekst);

	var slikaReziser = document.getElementsByTagName("img")[0];

	var slikaLink = document.createElement("input");
	slikaLink.type = "text";
	slikaLink.name = "slika";
	slikaLink.value = slikaReziser.src;
	slikaLink.size = "50";
	slikaLink.style.display = "inline";
	slikaLink.onkeyup = function() {
		var link = document.getElementsByName("slika")[0].value;
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

	var dugmeOdustani = document.createElement("button");
	var dugmeTekst = document.createTextNode("Odustani");
	dugmeOdustani.appendChild(dugmeTekst);
	dugmeOdustani.className = "button button2";
	dugmeOdustani.style.marginLeft = "4px";
	dugmeOdustani.onclick = function() {
		location.reload();
	}
	roditelj.appendChild(dugmeOdustani);

	var dugmeProveri = document.createElement("button");
	var dugmeProveriTekst = document.createTextNode("Proveri");
	dugmeProveri.appendChild(dugmeProveriTekst);
	dugmeProveri.className = "button button1";
	dugmeProveri.style.marginLeft = "4px";
	dugmeProveri.onclick = function() {
		var pValidacija = document.getElementsByClassName("ispis-validacija");
		for (var i = 0; i < pValidacija.length; i++) {
			if (pValidacija[i].innerHTML == "OK!") {
				alert("Jedno od polja ne zadovoljava kriterijume, molimo ponovite unos.");
				return false;
			}
		}
		var slikaPoster = document.getElementsByTagName("img")[0];
		if (slikaPoster.src == "http://localhost/iteh/slike/default.jpg") {
			alert("Slika nije u ispravnom formatu!");
			return false;
		}

		if ((datumSmrti.value != "" && mestoSmrti.value == "") || (datumSmrti.value == "" && mestoSmrti.value != "")) {
			alert("Polja datum smrti i mesto smrti moraju zajedno biti popunjena ili ostavljena prazna!");
			return false;
		}

		if (datumSmrti.value != "") {
			if (new Date(datumRodjenja.value) > new Date(datumSmrti.value)) {
				alert("Greška kod unosa datuma, datum smrti mora biti nakon datuma rođenja!");
				return false;
			}
		}

		var dugmePosalji = document.createElement("input");
		dugmePosalji.type = "submit";
		dugmePosalji.value = "Pošalji";
		dugmePosalji.className = "button button3";
		forma.appendChild(dugmePosalji);
		dugmeProveri.disabled = true;

		var dugmeVrati = document.createElement("button");
		var dugmeVratiTekst = document.createTextNode("Vrati");
		dugmeVrati.appendChild(dugmeVratiTekst);
		dugmeVrati.className = "button button2";
		dugmeVrati.style.marginLeft = "4px";
		dugmeVrati.onclick = function() {
			var inputi = document.getElementsByTagName("input");
			for (var i = 0; i < inputi.length; i++) {
				if (inputi[i].type != "submit") {
					inputi[i].readOnly = false;
				}
			}
			dugmePosalji.style.display = "none";
			dugmeVrati.style.display = "none";
			dugmeProveri.disabled = false;
		}
		roditelj.appendChild(dugmeVrati);

		var inputi = document.getElementsByTagName("input");
		for (var i = 0; i < inputi.length; i++) {
			if (inputi[i].type != "submit") {
				inputi[i].readOnly = true;
			}
		}
	}
	roditelj.appendChild(dugmeProveri);

	roditelj.replaceChild(ime, imePrezime);
	roditelj.replaceChild(datumRodjenja, datumRodjenjaVrednost);
	if (document.getElementsByClassName("kljuc").length == 5) {
		roditelj.replaceChild(datumSmrti, datumSmrtiVrednost);
	}
	roditelj.replaceChild(zemlja, zemljaIspis);

	roditelj.insertBefore(forma, dugmeIzmeni);

	var kljuc0 = document.getElementsByClassName("kljuc")[0];
	var ispis0 = document.getElementsByClassName("ispis-validacija")[0];
	forma.appendChild(kljuc0);
	forma.appendChild(ime);
	forma.appendChild(prezime);
	forma.appendChild(ispis0);

	var kljuc1 = document.getElementsByClassName("kljuc")[0];
	var ispis1 = document.getElementsByClassName("ispis-validacija")[0];
	forma.appendChild(kljuc1);
	forma.appendChild(datumRodjenja);
	forma.appendChild(mestoRodjenja);
	forma.appendChild(ispis1);

	if (document.getElementsByClassName("kljuc").length == 5) {
		var kljuc2 = document.getElementsByClassName("kljuc")[0];
		forma.appendChild(kljuc2);
		forma.appendChild(datumSmrti);
		mestoSmrti.value = datumSmrtiNiz[2].substring(6);
		forma.appendChild(mestoSmrti);
	} else {
		forma.appendChild(datumIMestoSmrtiP);
		forma.appendChild(datumSmrti);
		mestoSmrti.value = "";
		forma.appendChild(mestoSmrti);
	}

	var validacija1 = document.getElementsByClassName("ispis-validacija")[0];
	var validacija2 = "";
	if (document.getElementsByClassName("ispis-validacija").length != 3) {
		validacija2 = document.getElementsByClassName("ispis-validacija")[1];
	} else  {
		validacija2 = document.createElement("p");
		validacija2.className = "ispis-validacija";
	}

	forma.appendChild(slikaParagraf);
	forma.appendChild(slikaLink);
	forma.appendChild(validacija1);

	var kljuc4 = document.getElementsByClassName("kljuc")[0];
	forma.appendChild(kljuc4);
	forma.appendChild(zemlja);
	forma.appendChild(validacija2);

	var kljuc3 = document.getElementsByClassName("kljuc")[0];
	var ispis3= document.getElementsByClassName("vrednost")[0];
	forma.appendChild(kljuc3);
	forma.appendChild(ispis3);

	var hiddenTip = document.createElement("input");
	hiddenTip.type = "hidden";
	hiddenTip.name = "tip";
	hiddenTip.value = "reziser";

	forma.appendChild(hiddenTip);

	var hiddenId = document.createElement("input");
	hiddenId.type = "hidden";
	hiddenId.name = "reziserid";
	hiddenId.value = window.location.href.split("=")[1];

	forma.appendChild(hiddenId);

}