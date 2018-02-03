<?php 

class Zanr {

	private $zanrID;
	private $naziv;

	public function __construct($naziv) {
		$this->naziv = $naziv;
	}

	public function setNaziv($naziv) {
		$this->naziv = $naziv;
	}

	public function getNaziv() {
		return $this->naziv;
	}

}

class Reziser {

	private $reziserID;
	private $imePrezime;
	private $slika;
	private $datumRodjenja;
	private $mestoRodjenja;
	private $datumSmrti;
	private $mestoSmrti;
	private $zemlja;

	/*public function __construct($imePrezime, $slika, $datumRodjenja, $mestoRodjenja, $datumSmrti, $mestoSmrti, $zemlja) {
		$this->$imePrezime = $imePrezime;
		$this->$slika = $slika;
		$this->$datumRodjenja = $datumRodjenja;
		$this->$mestoRodjenja = $mestoRodjenja;
		$this->$datumSmrti = $datumSmrti;
		$this->$mestoSmrti = $mestoSmrti;
		$this->$zemlja = $zemlja;
	}*/

	public function __construct($imePrezime) {
		$this->imePrezime = $imePrezime;
	}

	public function setImePrezime($imePrezime) {
		$this->imePrezime = $imePrezime;
	}

	public function getImePrezime() {
		return $this->imePrezime;
	}

	public function setSlika($slika) {
		$this->slika = $slika;
	}

	public function getSlika() {
		return $this->slika;
	}

	public function setDatumRodjenja($datumRodjenja) {
		$this->datumRodjenja = $datumRodjenja;
	}

	public function getDatumRodjenja() {
		return $this->datumRodjenja;
	}

	public function setMestoRodjenja($mestoRodjenja) {
		$this->mestoRodjenja = $mestoRodjenja;
	}

	public function getMestoRodjenja() {
		return $this->mestoRodjenja;
	}

	public function setDatumSmrti($datumSmrti) {
		$this->datumSmrti = $datumSmrti;
	}

	public function getDatumSmrti() {
		return $this->datumSmrti;
	}

	public function setMestoSmrti($mestoSmrti) {
		$this->$mestoSmrti = $mestoSmrti;
	}

	public function getMestoSmrti() {
		return $this->$mestoSmrti;
	}

	public function setZemlja($zemlja) {
		$this->$zemlja = $zemlja;
	}

	public function getZemlja() {
		return $this->$zemlja;
	}

	public function vratiBrojGodina() {
		//$datum1 = this->datumRodjenja;
	}

}

class Film {

	private $filmID;
	private $naziv;
	private $godina;
	private $zanr;
	private $poster;
	private $opis;
	private $reziser;
	private $uloge;
	private $trajanje;
	private $trejler;
	private $imdbLink;

	/*public function __construct($naziv, $godina, $zanr, $poster, $opis, $reziser, $uloge, $trajanje, $trejler, $imdbLink) {
		$this->$naziv = $naziv;
		$this->$godina = $godina;
		$this->$zanr = $zanr;
		$this->$poster = $poster;
		$this->$opis = $opis;
		$this->$reziser = $reziser;
		$this->$uloge = $uloge;
		$this->$trajanje = $trajanje;
		$this->$trejler = $trejler;
		$this->$imdbLink = $imdbLink;
	}*/

	public function __construct($filmid, $poster, $naziv, $godina, $trajanje, $reziser, $zanr) {
		$this->filmid = $filmid;
		$this->poster = $poster;
		$this->naziv = $naziv;
		$this->godina = $godina;
		$this->trajanje = $trajanje;
		$this->reziser = $reziser;
		$this->zanr = $zanr;
	}

	public function setFilmID($filmid) {
		$this->filmid = $filmid;
	}

	public function getFilmID() {
		return $this->filmid;
	}

	public function setNaziv($naziv) {
		$this->naziv = $naziv;
	}

	public function getNaziv() {
		return $this->naziv;
	}

	public function setGodina($godina) {
		$this->godina = $godina;
	}

	public function getGodina() {
		return $this->godina;
	}

	public function setZanr($zanr) {
		$this->zanr = $zanr;
	}

	public function getZanr() {
		return $this->zanr;
	}

	public function setPoster($poster) {
		$this->poster = $poster;
	}

	public function getPoster() {
		return $this->poster;
	}

	public function setOpis($opis) {
		$this->opis = $opis;
	}

	public function getOpis() {
		return $this->opis;
	}

	public function setReziser($reziser) {
		$this->reziser = $reziser;
	}

	public function getReziser() {
		return $this->reziser;
	}

	public function setUloge($uloge) {
		$this->uloge = $uloge;
	}

	public function getUloge() {
		return $this->uloge;
	}

	public function setTrajanje($trajanje) {
		$this->trajanje = $trajanje;
	}

	public function getTrajanje() {
		return $this->trajanje;
	}

	public function setTrejler($trejler) {
		$this->trejler = $trejler;
	}

	public function getTrejler() {
		return $this->trejler;
	}

	public function setImdbLink($imdbLink) {
		$this->imdbLink = $imdbLink;
	}

	public function getImdbLink() {
		return $this->imdbLink;
	}
	
}

?>