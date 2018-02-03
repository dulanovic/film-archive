function vreme() {
	var daniunedelji = new Array("Nedelja", "Ponedeljak", "Utorak", "Sreda", "Četvrtak", "Petak", "Subota");
	var danas = new Date();

	var dan = daniunedelji[danas.getDay()];
	var danbroj = danas.getDate();
	var mesec = danas.getMonth()+1;
	var godina = danas.getFullYear();

	var sat = danas.getHours();
	var minut = danas.getMinutes();
	var sekund = danas.getSeconds();

	var trenutno_vreme = ((sat < 10) ? "0" : "") + sat;
	trenutno_vreme += ((minut < 10) ? ":0" : ":") + minut;
	trenutno_vreme += ((sekund < 10) ? ":0" : ":") + sekund;

	document.getElementById("sat").innerHTML = dan + ", " + danbroj + "." + mesec + "." + godina + "." + "<br>" + trenutno_vreme;
}
setInterval(vreme, 1000);

function logout() {
	if (confirm("Da li ste sigurni da želite da se odjavite?") == true) {
		window.location.href = "login.php";
	}
}