function validacijaFilm() {
	for (var i = 0; i < document.getElementsByTagName("input").length; i++) {
		if (document.getElementsByTagName("input")[i].type != "submit") {
			if (document.getElementsByTagName("input")[i].value == "") {
				alert("Ostavili ste nepopunjeno polje u formi, molimo ispravite grešku.");
				return;
			}
		}
	}
	if (document.getElementsByTagName("textarea")[0].value == "") {
		alert("Ostavili ste nepopunjeno polje u formi, molimo ispravite grešku.");
		return;
	}

	var pValidacija = document.getElementsByClassName("ispis-validacija");
	for (var i = 0; i < pValidacija.length; i++) {
		if (pValidacija[i].innerHTML == "OK!") {
			alert("Jedno od polja ne zadovoljava kriterijume, molimo ponovite unos.");
			return false;
		}
	}

	var slikaPoster = document.getElementsByTagName("img")[0];
	if (slikaPoster.src == "http://localhost/iteh/slike/default.jpg") {
		return false;
	}

	document.getElementsByTagName("input")[10].style.display = "inline";
	document.getElementsByClassName("button1")[0].disabled = true;

	var divTekst = document.getElementById("tekst");

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
		document.getElementsByTagName("textarea")[0].readOnly = false;
		document.getElementsByTagName("input")[10].style.display = "none";
		dugmeVrati.style.display = "none";
		document.getElementsByClassName("button1")[0].disabled = false;
	}
	divTekst.appendChild(dugmeVrati);

	var inputi = document.getElementsByTagName("input");
	for (var i = 0; i < inputi.length; i++) {
		if (inputi[i].type != "submit") {
			inputi[i].readOnly = true;
		}
	}
	document.getElementsByTagName("textarea")[0].readOnly = true;

}

function validacijaReziser() {
	for (var i = 0; i < document.getElementsByTagName("input").length; i++) {
		if (document.getElementsByTagName("input")[i].type != "submit") {
			if (i === 4 || i === 5) { continue; }
			if (document.getElementsByTagName("input")[i].value == "") {
				alert("Ostavili ste nepopunjeno polje u formi, molimo ispravite grešku.");
				return;
			}
		}
	}

	var pValidacija = document.getElementsByClassName("ispis-validacija");
	for (var i = 0; i < pValidacija.length; i++) {
		if (pValidacija[i].innerHTML == "OK!") {
			alert("Jedno od polja ne zadovoljava kriterijume, molimo ponovite unos.");
			return false;
		}
	}

	var slikaPoster = document.getElementsByTagName("img")[0];
	if (slikaPoster.src == "http://localhost/iteh/slike/default.jpg") {
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

	document.getElementsByTagName("input")[9].style.display = "inline";
	document.getElementsByClassName("button1")[0].disabled = true;

	var divTekst = document.getElementById("tekst");

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
		document.getElementsByTagName("input")[9].style.display = "none";
		dugmeVrati.style.display = "none";
		document.getElementsByClassName("button1")[0].disabled = false;
	}
	divTekst.appendChild(dugmeVrati);

	var inputi = document.getElementsByTagName("input");
	for (var i = 0; i < inputi.length; i++) {
		if (inputi[i].type != "submit") {
			inputi[i].readOnly = true;
		}
	}
}