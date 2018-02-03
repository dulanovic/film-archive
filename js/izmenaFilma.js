function postaviFormu() {

	var forma = document.createElement("form");
	forma.name = "forma-izmena";
	forma.method = "POST";
	forma.action = "izmena.php";
	var divTekst = document.getElementById("tekst");
	var divSadrzaj = document.getElementById("sadrzaj");

	var dugmeIzmeni = document.getElementsByTagName("button")[0];	
	var roditelj = document.getElementById("tekst");

	var nazivFilmaVrednost = document.getElementsByClassName("vrednost")[0];
	var nazivFilma = document.createElement("input");
	nazivFilma.id = "nazivFilma";
	nazivFilma.type = "text";
	nazivFilma.name = "naziv-filma";
	nazivFilma.value = nazivFilmaVrednost.innerHTML;
	nazivFilma.size = "30";
	nazivFilma.onkeyup = function() {
		if (nazivFilma.value != "") {
			document.getElementsByClassName("ispis-validacija")[0].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[0].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[0].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[0].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[0].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[0].style.textDecoration = "line-through";
		}
	}

	roditelj.replaceChild(nazivFilma, nazivFilmaVrednost);

	var godinaVrednost = document.getElementsByClassName("vrednost")[0];
	var godina = document.createElement("input");
	godina.type = "text";
	godina.name = "godina";
	godina.value = godinaVrednost.innerHTML.substring(godinaVrednost.innerHTML.lastIndexOf("\"") + 2, godinaVrednost.innerHTML.lastIndexOf("<"));
	godina.size = "10";
	godina.onkeyup = function() {
		if (parseInt(godina.value) <= 2017 && parseInt(godina.value) >= 1878) {
			document.getElementsByClassName("ispis-validacija")[1].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[1].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[1].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[1].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[1].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[1].style.textDecoration = "line-through";
		}
	}

	roditelj.replaceChild(godina, godinaVrednost);

	var zanrVrednost = document.getElementsByClassName("vrednost")[0];
	var zanr = document.createElement("input");
	zanr.type = "text";
	zanr.name = "zanr";
	zanr.value = zanrVrednost.innerHTML.substring(zanrVrednost.innerHTML.lastIndexOf("\"") + 2, zanrVrednost.innerHTML.lastIndexOf("<"));
	zanr.size = "20";
	zanr.style.marginBottom = 0;
	zanr.oninput = function() {
		proveri(zanr.value, "zanr");
	}
	zanr.onkeyup = function() {
		predlozi(zanr.value, "zanr");
	}

	roditelj.replaceChild(zanr, zanrVrednost);

	var slika = document.getElementsByTagName("img")[0];

	var posterParagraf = document.createElement("p");
	posterParagraf.className = "kljuc";
	var posterTekst = document.createTextNode("Link za poster:");
	posterParagraf.appendChild(posterTekst);

	var posterLink = document.createElement("input");
	posterLink.type = "text";
	posterLink.name = "poster";
	posterLink.value = slika.src;
	posterLink.size = "50";
	posterLink.style.display = "inline";
	posterLink.onkeyup = function() {
		var link = document.getElementsByName("poster")[0].value;
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

	var opisFilmaVrednost = document.getElementsByClassName("vrednost")[0];
	var opisFilma = document.createElement("textarea");
	opisFilma.name = "opis-filma";
	opisFilma.cols = "50";
	opisFilma.rows = "5";
	opisFilma.value = opisFilmaVrednost.innerHTML;
	opisFilma.onkeyup = function() {
		if (opisFilma.value != "") {
			document.getElementsByClassName("ispis-validacija")[3].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[3].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[3].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[3].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[3].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[3].style.textDecoration = "line-through";
		}
	}

	roditelj.replaceChild(opisFilma, opisFilmaVrednost);

	var reziserVrednost = document.getElementsByClassName("vrednost")[0];
	var reziser = document.createElement("input");
	reziser.type = "text";
	reziser.name = "reziser";
	reziser.value = reziserVrednost.innerHTML.substring(reziserVrednost.innerHTML.lastIndexOf("\"") + 2, reziserVrednost.innerHTML.lastIndexOf("<"));
	reziser.size = "30";
	reziser.style.marginBottom = 0;
	reziser.oninput = function() {
		proveri(reziser.value, "reziser");
	}
	reziser.onkeyup = function() {
		predlozi(reziser.value, "reziser");
	}

	roditelj.replaceChild(reziser, reziserVrednost);

	var ulogeVrednost = document.getElementsByClassName("vrednost")[0];
	var uloge = document.createElement("input");
	uloge.type = "text";
	uloge.name = "uloge";
	uloge.value = ulogeVrednost.innerHTML;
	uloge.size = "50";
	uloge.onkeyup = function() {
		if (uloge.value != "") {
			document.getElementsByClassName("ispis-validacija")[5].innerHTML = "OK";
			document.getElementsByClassName("ispis-validacija")[5].style.color = "#008000";
			document.getElementsByClassName("ispis-validacija")[5].style.textDecoration = "none";
		} else {
			document.getElementsByClassName("ispis-validacija")[5].innerHTML = "OK!";
			document.getElementsByClassName("ispis-validacija")[5].style.color = "#FF0000";
			document.getElementsByClassName("ispis-validacija")[5].style.textDecoration = "line-through";
		}
	}

	roditelj.replaceChild(uloge, ulogeVrednost);

	var trajanjeVrednost = document.getElementsByClassName("vrednost")[0];
	var trajanje = document.createElement("input");
	trajanje.type = "text";
	trajanje.name = "trajanje";
	trajanje.value = trajanjeVrednost.innerHTML.substring(trajanjeVrednost.innerHTML.indexOf("(") + 1, trajanjeVrednost.innerHTML.lastIndexOf("m"));
		trajanje.size = "10";
		trajanje.onkeyup = function() {
			if (parseInt(trajanje.value) <= 773 && parseInt(trajanje.value) >= 1) {
				document.getElementsByClassName("ispis-validacija")[6].innerHTML = "OK";
				document.getElementsByClassName("ispis-validacija")[6].style.color = "#008000";
				document.getElementsByClassName("ispis-validacija")[6].style.textDecoration = "none";
			} else {
				document.getElementsByClassName("ispis-validacija")[6].innerHTML = "OK!";
				document.getElementsByClassName("ispis-validacija")[6].style.color = "#FF0000";
				document.getElementsByClassName("ispis-validacija")[6].style.textDecoration = "line-through";
			}
		}

		roditelj.replaceChild(trajanje, trajanjeVrednost);

		var imdbParagraf = document.createElement("p");
		imdbParagraf.className = "kljuc";
		var imdbTekst = document.createTextNode("IMDb link:");
		imdbParagraf.appendChild(imdbTekst);
		var imdbVrednost = document.getElementById("imdb-link");
		roditelj.insertBefore(imdbParagraf, imdbVrednost);

		var imdb = document.createElement("input");
		imdb.type = "text";
		imdb.name = "imdb";
		var link = imdbVrednost.href;
		imdb.value = link;
		imdb.size = "50";
		imdb.style.display = "inline";
		imdb.onkeyup = function() {
			if (imdb.value.substring(0, 28) == "http://www.imdb.com/title/tt" && imdb.value.substring(28).length == 7) {
				document.getElementsByClassName("ispis-validacija")[7].innerHTML = "OK";
				document.getElementsByClassName("ispis-validacija")[7].style.color = "#008000";
				document.getElementsByClassName("ispis-validacija")[7].style.textDecoration = "none";
			} else {
				document.getElementsByClassName("ispis-validacija")[7].innerHTML = "OK!";
				document.getElementsByClassName("ispis-validacija")[7].style.color = "#FF0000";
				document.getElementsByClassName("ispis-validacija")[7].style.textDecoration = "line-through";
			}
		}

		roditelj.replaceChild(imdb, imdbVrednost);

		var validacijaParagraf = document.createElement("p");
		validacijaParagraf.className = "ispis-validacija";
		validacijaParagraf.innerHTML = "";
		validacijaParagraf.style.marginTop = "0";
		var validacijaParagraf2 = document.createElement("p");
		validacijaParagraf2.className = "ispis-validacija";
		validacijaParagraf2.innerHTML = "";
		validacijaParagraf2.style.marginTop = "0";
		var validacijaParagraf3 = document.createElement("p");
		validacijaParagraf3.className = "ispis-validacija";
		validacijaParagraf3.innerHTML = "";
		validacijaParagraf3.style.marginTop = "0";

		var trejlerParagraf = document.createElement("p");
		trejlerParagraf.className = "kljuc";
		var trejlerTekst = document.createTextNode("YouTube trejler link:");
		trejlerParagraf.appendChild(trejlerTekst);
		var dugme = document.getElementsByClassName("button button1")[0];

		roditelj.insertBefore(trejlerParagraf, dugme);

		var trejlerVrednost = document.getElementsByClassName("trejler")[0];
		var trejler = document.createElement("input");
		trejler.type = "text";
		trejler.name = "trejler";
		var linkYT = trejlerVrednost.src.substring(0, 41);
		trejler.value = linkYT;
		trejler.size = "50";
		trejler.onkeyup = function() {
			if ((trejler.value.substring(0, 30) == "https://www.youtube.com/embed/" || trejler.value.substring(0, 32) == "https://www.youtube.com/watch?v=") && (trejler.value.substring(30).length == 11 || trejler.value.substring(32).length == 11)) {
				document.getElementsByClassName("ispis-validacija")[8].innerHTML = "OK";
				document.getElementsByClassName("ispis-validacija")[8].style.color = "#008000";
				document.getElementsByClassName("ispis-validacija")[8].style.textDecoration = "none";
			} else {
				document.getElementsByClassName("ispis-validacija")[8].innerHTML = "OK!";
				document.getElementsByClassName("ispis-validacija")[8].style.color = "#FF0000";
				document.getElementsByClassName("ispis-validacija")[8].style.textDecoration = "line-through";
			}
		}

		var roditeljIznad = document.getElementById("sadrzaj");
		var divTrejler = document.getElementById("accordion-omotac");
		roditeljIznad.removeChild(divTrejler);

		roditelj.insertBefore(trejler, dugme);

		var dugmeOdustani = document.createElement("button");
		var dugmeTekst = document.createTextNode("Odustani");
		dugmeOdustani.appendChild(dugmeTekst);
		dugmeOdustani.className = "button button2";
		dugmeOdustani.style.marginLeft = "4px";
		dugmeOdustani.onclick = function() {
			location.reload();
		}
		roditelj.appendChild(dugmeOdustani);

		roditelj.insertBefore(validacijaParagraf, dugme);
		roditelj.insertBefore(validacijaParagraf2, dugme);

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

			var dugmePosalji = document.createElement("input");
			dugmePosalji.type = "submit";
			dugmePosalji.value = "Pošalji";
			dugmePosalji.className = "button button3";
			dugmePosalji.style.display = "block";
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
				document.getElementsByTagName("textarea")[0].readOnly = false;
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
			document.getElementsByTagName("textarea")[0].readOnly = true;
		}
		roditelj.appendChild(dugmeProveri);

		divTekst.insertBefore(forma, dugmeIzmeni);

		var kljuc0 = document.getElementsByClassName("kljuc")[0];
		var ispis0 = document.getElementsByClassName("ispis-validacija")[0];
		forma.appendChild(kljuc0);
		forma.appendChild(nazivFilma);
		forma.appendChild(ispis0);

		var kljuc1 = document.getElementsByClassName("kljuc")[0];
		var ispis1 = document.getElementsByClassName("ispis-validacija")[0];
		forma.appendChild(kljuc1);
		forma.appendChild(godina);
		forma.appendChild(ispis1);

		var kljuc2 = document.getElementsByClassName("kljuc")[0];
		var ispis2 = document.getElementsByClassName("ispis-validacija")[0];
		forma.appendChild(kljuc2);
		forma.appendChild(zanr);
		forma.appendChild(ispis2);

		var autosuggestZanr = document.createElement("div");
		autosuggestZanr.className = "autosuggest";
		autosuggestZanr.style.position = "absolute";
		autosuggestZanr.style.zIndex = "1";
		autosuggestZanr.style.width = "197px";
		forma.appendChild(autosuggestZanr);

		var kljuc3 = document.getElementsByClassName("kljuc")[0];
		var ispis3 = document.getElementsByClassName("ispis-validacija")[0];
		forma.appendChild(kljuc3);
		forma.appendChild(opisFilma);
		forma.appendChild(ispis3);

		var kljuc4 = document.getElementsByClassName("kljuc")[0];
		var ispis4 = document.getElementsByClassName("ispis-validacija")[0];
		forma.appendChild(kljuc4);
		forma.appendChild(reziser);
		forma.appendChild(ispis4);

		var autosuggestReziser = document.createElement("div");
		autosuggestReziser.className = "autosuggest";
		autosuggestReziser.style.position = "absolute";
		autosuggestReziser.style.zIndex = "1";
		autosuggestReziser.style.width = "291px";
		forma.appendChild(autosuggestReziser);

		var kljuc5 = document.getElementsByClassName("kljuc")[0];
		var ispis5 = document.getElementsByClassName("ispis-validacija")[0];
		forma.appendChild(kljuc5);
		forma.appendChild(uloge);
		forma.appendChild(ispis5);

		var kljuc6 = document.getElementsByClassName("kljuc")[0];
		var ispis6 = document.getElementsByClassName("ispis-validacija")[0];
		var minIspis = document.createTextNode(" min");
		forma.appendChild(kljuc6);
		forma.appendChild(trajanje);
		forma.appendChild(minIspis);
		forma.appendChild(ispis6);

		var kljuc7 = document.getElementsByClassName("kljuc")[0];
		var ispis7 = document.getElementsByClassName("ispis-validacija")[0];
		forma.appendChild(kljuc7);
		forma.appendChild(imdb);
		forma.appendChild(ispis7);

		var kljuc8 = document.getElementsByClassName("kljuc")[0];
		var ispis8 = document.getElementsByClassName("ispis-validacija")[0];
		forma.appendChild(kljuc8);
		forma.appendChild(trejler);
		forma.appendChild(ispis8);

		var kljuc9 = document.getElementsByClassName("kljuc")[0];
		var ispis9 = document.getElementsByClassName("ispis-validacija")[0];
		forma.appendChild(posterParagraf);
		forma.appendChild(posterLink);
		forma.appendChild(validacijaParagraf3);

		var hiddenTip = document.createElement("input");
		hiddenTip.type = "hidden";
		hiddenTip.name = "tip";
		hiddenTip.value = "film";

		forma.appendChild(hiddenTip);

		var hiddenId = document.createElement("input");
		hiddenId.type = "hidden";
		hiddenId.name = "filmid";
		hiddenId.value = window.location.href.split("=")[1];

		forma.appendChild(hiddenId);

	}