<?php 

session_start();

echo "<!DOCTYPE html>
<html>
<head>
	<title>Početna strana</title>";
include("import/template-1.html");
include("import/template-2.html");
echo "<br><br><img src='slike/naslovna1.jpg' alt='2001: Odiseja u svemiru' title='2001: Odiseja u svemiru' class='slike-naslovna' /><h2>Dobrodošli na web prezentaciju našeg skromnog filmskog arhiva!<br><img src='slike/naslovna2.jpg' alt='Bulevar sumraka' title='Bulevar sumraka' class='slike-naslovna' />Ukoliko su (stari) filmovi vaša strast, nema sumnje da ćete uživati pretražujući našu arhivu.<img src='slike/naslovna3.jpg' alt='Konformista' title='Konformista' class='slike-naslovna' />Nadamo se da ćete pronaći neku interesantnu preporuku po svom ukusu i da ćete provesti nezaboravne trenutke gledajući filmove.<br><br>UŽIVAJTE!!!</h2>";
include("import/template-3.html");

 ?>