function proveriCookie() {
	var index = document.cookie.indexOf("tema=");
	if (index != -1) {
		var tema = document.cookie.substring(5,6);
		postaviTemu(tema);
	} else {
		var istek = new Date();
		istek.setMinutes(istek.getMinutes() + 60);
		document.cookie = "tema=1;expires=" + istek.toUTCString();
		postaviTemu(1);
	}
}

function postaviTemu(tema) {
	document.styleSheets[1].disabled = true;

	var head = document.getElementsByTagName("head")[0];
	var css = document.createElement("link");
	css.rel = "stylesheet";
	css.type = "text/css";
	css.href = "css/tema" + tema + ".css";
	head.appendChild(css);
}

function promeniTemu() {
	var tema = document.cookie.substring(5,6);
	if (tema == 1) {
		tema++;
		azurirajCookie(tema);
	} else if (tema == 2) {
		tema--;
		azurirajCookie(tema);
	}
	postaviTemu(tema);
}

function azurirajCookie(tema) {
	var istek = new Date();
	istek.setMinutes(istek.getMinutes() + 60);
	document.cookie = "tema=" + tema + ";expires=" + istek.toUTCString();
}