<!DOCTYPE html>
<html lang="it" class="max">

<head>
    <title>Write on me - Visitatore </title>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Ibarra+Real+Nova|Raleway&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css.css" type="text/css">
</head>

<body class="max">
	<header>
		<a href="home.php"><input type="image" src="logo.jpeg" class="logo"></a>
		<a href="ricerca.html"><input type="image" src="lente.png" class="cerca"></a>
	</header>
	<div class="home">
		<div class="div_profilo"> 
			<h2>BLOG</h2>
			
			<?php
				//Connessione al DB utilizzando MySQLi
				$mysqli = new mysqli("localhost", "root", "", "progetto");

				//Verifica su eventuali errori di connessione
				if ($mysqli->connect_error) {
					echo "Connessione fallita: ". $mysqli->connect_error . ".";
					exit();
				}
				
				//query recupero valori di 10 blog
				$query = "SELECT nome, id_blog, nome_utente,tema FROM blog LIMIT 10";
				
				//esecuzione query
				$oggetto =$mysqli->query($query);
				
				echo "<table class='tabella'><tr class='spazio'><th>BLOG</th><th>CREATORE</th><th>TEMA</th></tr>";
				while($scorri_oggetto=$oggetto->fetch_assoc()){
					$id = $scorri_oggetto['id_blog'];
				
			?>
	
			<tr class="bordo">
				<td><a href="blog2.php?id_blog=<?php printf($id)?>"><?php printf($scorri_oggetto['nome']);?></a></td>
				<td><?php printf($scorri_oggetto['nome_utente']);?></td> 
				<td><?php printf($scorri_oggetto['tema']);?></td> 
			</tr>


				<?php
				}
				echo "</table>"; 
				?>

		</div>	
	</div>
</body>

<footer>
	<div>
		Sito realizzato da Sara Maenza e Gaia Sasso
	</div>
</footer>

</html>
    

    
