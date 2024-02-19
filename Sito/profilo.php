<!DOCTYPE html>
<html lang="it" class="max">

<?php  
  
	//Apro la sessione 
	session_start();

	//Recupero nome utente 
	$user = $_SESSION['user'];
	
	//Connessione al DB utilizzando MySQLi
	$mysqli = new mysqli("localhost", "root", "", "progetto");

	//Verifica su eventuali errori di connessione
	if ($mysqli->connect_error) {
		echo "Connessione fallita: ". $mysqli->connect_error . ".";
		exit();
	}
	
	//controllo se l'utente è premium o no
	$query = "SELECT premium FROM utente WHERE nome_utente='$user'";
	$oggetto =$mysqli->query($query);
	while($scorri_oggetto=$oggetto->fetch_assoc()){
		$tipo = ($scorri_oggetto['premium']);
	}	
?>

<head>
    <title>Write on me - <?php printf($user);?></title>
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
		<div class="div_profilo"> 
	
			<h2><?php printf($user);?></h2>

            <a href="lista_blog.php"><div class="pulsante_lungo">I tuoi blog </div></a>
			<a href="crea_blog.php"><div class="pulsante_lungo">Crea un blog </div></a>
			<a href="modifica_profilo.php"><div class="pulsante_lungo">Modifica profilo</div></a>
			
			<?php
				//se l'utente non è premium, appare pulsante per poter passare a premium
				if($tipo==0){
					echo('<a href="passa_a_premium.php"><div class="pulsante_lungo">Passa a premium</div></a>');
				}
			?>
			
			<a href="disiscrizione.php"><div class="pulsante_lungo">Elimina il tuo Account</div></a>
			<a href="logout.php"><div class="pulsante_lungo">Esci</div></a>
		</div>	
	</div>
</body>

<footer>
	<div>
		Sito realizzato da Sara Maenza e Gaia Sasso
	</div>
</footer>

</html>