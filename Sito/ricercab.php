<!DOCTYPE html>
<html lang="it" class="max">

<head>
    <title>Write on me - Risultati della ricerca</title>
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
			<a href="http://localhost/progetto/ricerca2.html"><img src="indietro.png" id="sx"></a><br>
			<h2>RISULTATI DELLA RICERCA</h2>

			<?php
			//Recupero i valori inseriti nel form
			$nomeblog = $_POST['nomeblog'];
			$nomeutente = $_POST['nomeutente'];
			$tema = $_POST['tema'];
			
			//connessione al database
			$mysqli = new mysqli("localhost", "root", "", "progetto");

			//Verifica su eventuali errori di connessione
			if ($mysqli->connect_error) {
				echo "Connessione fallita: ". $mysqli->connect_error . ".";
				exit();
			}  
			
			//query recupero valori del blog
			$query = "SELECT nome, nome_utente, tema, id_blog FROM blog WHERE nome ='$nomeblog' OR nome_utente ='$nomeutente' OR tema ='$tema'";
			
			//query per contare il numero di blog
			$query2 = "SELECT COUNT(*) FROM blog WHERE nome = '$nomeblog' OR nome_utente='$nomeutente' OR tema='$tema'";
			
			//esecuzione query
			$oggetto =$mysqli->query($query);
			$oggetto2 =$mysqli->query($query2);
			
			//salvo il numero di blog
			$row = $oggetto2->fetch_array(MYSQLI_NUM);
			
			//se ci sono blog, li visualizza
			if($row[0] >0){
			
				echo "<table class='tabella'><tr class='spazio'><th>BLOG</th><th>CREATORE</th><th>TEMA</th></tr>";
				
				//inizio ciclo
				while($scorri_oggetto=$oggetto->fetch_assoc()){
					$idb = $scorri_oggetto['id_blog'];
				?>
				
				<tr class="bordo">
					<td><a href="blog2.php?id_blog=<?php printf($idb);?>"><?php printf($scorri_oggetto['nome']);?></a></td> 
					<td><?php printf($scorri_oggetto['nome_utente']);?></td> 
					<td><?php printf($scorri_oggetto['tema']);?></td>
				</tr>


				<?php
				}
				 echo "</table>";
			} else { //se non ci sono blog, stampa "Nessun risultato"
				echo "<p id='center'>Non ci sono risultati</p>";
			}
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
