<!DOCTYPE html>
<html lang="it" class="max">

<head>
    <title>Write on me - Passa a premiun</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Ibarra+Real+Nova|Raleway&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css.css" type="text/css">
</head>

<body class="max">
	<header>
		<a href="home.php"><input type="image" src="logo.jpeg" class="logo"></a>
		<a href="profilo.php"><input type="image" src="icona.png" class="icona"></a>
		<a href="ricerca2.html"><input type="image" src="lente.png" class="cerca"></a>
	</header>
	<div class="home">
	<?php
		//Apro la sessione 
		session_start();

		//Recupero nome utente e password 
		$user = $_SESSION['user'];
		$pass = $_SESSION['password'];
	
		//Connessione al DB utilizzando MySQLi
		$mysqli = new mysqli("localhost", "root", "", "progetto");

		//Verifica su eventuali errori di connessione
		if ($mysqli->connect_error) {
			echo "Connessione fallita: ". $mysqli->connect_error . ".";
			exit();
		}

	?>
		<div class="div_profilo"> 
			<h2>PASSA A PREMIUN</h2> 
			<p id="center">Passando a premium potrai creare blog e post illimitati!</p>
			<a href="passa_a_premium2.php"><div class="pulsante_lungo">Diventa PREMIUM</div></a>
		</div>	
	</div>
</body>

<footer>
	<div>
		Sito realizzato da Sara Maenza e Gaia Sasso
	</div>
</footer>

</html>