function dodajKolonuBrisanje() {
	var redovi = document.getElementsByClassName("kolona-brisanje");

	for (var i = 0; i < redovi.length; i++) {
		if (redovi[i].style.display == "none") {
			redovi[i].style.display = "block";
		} else if (redovi[i].style.display == "block") {
			redovi[i].style.display = "none";
		}
	}
}

function dodajTextFieldPretraga() {
	var divPretraga = document.getElementById("textfield-pretraga");
	
	if (divPretraga.style.display == "none") {
		divPretraga.style.display = "block";
		document.getElementById("textfieldPretraga").focus();
	} else if (divPretraga.style.display == "block") {
		divPretraga.style.display = "none";
	}
	
}

function daLiJePraznoPolje() {
	if (document.getElementById("textfieldPretraga").value == "") {
		alert("Morate uneti ključnu reč!");
		return false;
	} else {
		return true;
	}
}