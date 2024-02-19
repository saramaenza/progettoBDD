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
		<a href="profilo.php"><input type="image" src="icona.png" class="icona"></a>
		<a href="ricerca2.html"><input type="image" src="lente.png" class="cerca"></a>
	</header>
	<div class="home">
		<div class="div_profilo"> 
			<a href="http://localhost/progetto/ricerca2.html"><img src="indietro.png" id="sx"></a><br>
			<h2>RISULTATI DELLA RICERCA</h2>

			<?php
			//Recupero i valori 
			$post = $_POST['post'];
			
			//Connessione al database
			$mysqli = new mysqli("localhost", "root", "", "progetto");

			//Verifica su eventuali errori di connessione
			if ($mysqli->connect_error) {
				echo "Connessione fallita: ". $mysqli->connect_error . ".";
				exit();
			}  
    
			//query recupero valori post
			$query = "SELECT titolo, testo, immagine, ora_data, id_post, id_blog FROM post WHERE titolo LIKE '%$post%'";
			
			//query per contare il numero di post
			$query2 = "SELECT COUNT(*) FROM post WHERE titolo LIKE '%$post%'";
	
			//esecuzione query
			$oggetto =$mysqli->query($query);
			$oggetto2 =$mysqli->query($query2);
			
			//salvo il numero di post
			$row = $oggetto2->fetch_array(MYSQLI_NUM);
	
			//se ci sono post, li visualizza
			if($row[0] >0){
    
				while($scorri_oggetto=$oggetto->fetch_assoc()){
					$idp = $scorri_oggetto['id_post'];
					$idb = $scorri_oggetto['id_blog'];

				?>
	
				<div class="div_post">
					<h4><?php printf($scorri_oggetto['titolo']);?></h4>
					<p><?php printf($scorri_oggetto['testo']);?></p>
					<img src="<?php printf($scorri_oggetto['immagine']);?>"><br>
					<p id="data"><?php printf($scorri_oggetto['ora_data']);?></p><br>
					<a href="commenti.php?id_blog=<?php printf($idb);?>&id_post=<?php printf($idp);?>">Visualizza post</a>
					<br><br>
				</div>

				<?php
				}
			} else { //Se non ci sono post, stampa "Nessun risultato"
				echo "<p id='center'>Non ci sono risultati</p>";
			}
				?>

		</div>	
	</div>
</body>


</html>