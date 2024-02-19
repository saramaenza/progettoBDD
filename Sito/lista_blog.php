<!DOCTYPE html>
<html lang="it" class="max">

<head>
    <title>Write on me - Profilo</title>
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
			<a href="http://localhost/progetto/profilo.php"><img src="indietro.png" id="sx"></a> <br>
			<h2>I MIEI BLOG</h2>
			
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
		
				//query recupero valori del blog
				$query = "SELECT nome, id_blog FROM blog WHERE nome_utente='$user'";
				
				$oggetto =$mysqli->query($query);
				
				echo "<table class='tab_lista_blog'>";      

				while($scorri_oggetto=$oggetto->fetch_assoc()){
					$idb = $scorri_oggetto['id_blog'];
			?>
	
			<tr>
				<td><a href="blog.php?id_blog=<?php printf($idb)?>"><?php printf($scorri_oggetto['nome']);?></a></td> 
			</tr>

			<?php
				}
				echo "</table>
				<br>
				<h2>I BLOG DI CUI SEI COAUTORE</h2>";
				
				//query blog del coautore
				$query = "SELECT coautore, nome, id_blog FROM blog WHERE coautore='$user'";
				
				$oggetto =$mysqli->query($query);
				
				echo "<table class='tab_lista_blog'>";      

				while($scorri_oggetto=$oggetto->fetch_assoc()){
					$idb = $scorri_oggetto['id_blog'];
			?>

			<tr>
				<td><a href="blog.php?id_blog=<?php printf($idb)?>"><?php printf($scorri_oggetto['nome']);?></a></td> 
			</tr>
			
			<?php
				}
			?>
			
		</div>	
	</div>
</body>



</html>
    