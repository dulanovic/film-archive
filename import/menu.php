<?php 

session_start();

echo "<ul id='stavkemeni'>
	<li class='no-dropdown'><a href='index.php'>Glavna</a></li>
	<li class='no-dropdown'><a href='filmovi.php'>Filmovi</a></li>
	<li class='no-dropdown'><a href='reziseri.php'>Režiseri</a></li>";
	if (isset($_SESSION["ulogovan"]) && !empty($_SESSION["ulogovan"])) {
		echo "<li class='no-dropdown'><a href='javascript:void(0)' onclick='logout()'>Logout(".$_SESSION["korisnicko-ime"].")</a></li>";
	} else {
		echo "<li class='no-dropdown'><a href='login.php'>Login</a></li>";
	}
	echo "<li id='menubtn'><a href='javascript:void(0)' onclick='promeniTemu()'>Promeni temu</a></li>
</ul>";

 ?>