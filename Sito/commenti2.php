<!DOCTYPE html>
<html lang="it" class="max">

<head>
    <title>Write on me</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Ibarra+Real+Nova|Raleway&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css.css" type="text/css">
</head>

	<header>
		<a href="home.php"><input type="image" src="logo.jpeg" class="logo"></a>
		<a href="ricerca.html"><input type="image" src="lente.png" class="cerca"></a>
	</header>
	
	 <?php

		//Recupero valori
		$idp= $_GET["id_post"];
		$idb= $_GET["id_blog"];
		
		//Connessione al DB utilizzando MySQLi
        $mysqli = new mysqli("localhost", "root", "", "progetto");

		//Verifica su eventuali errori di connessione
		if ($mysqli->connect_error) {
			echo "Connessione fallita: ". $mysqli->connect_error . ".";
			exit();
		}
    ?>
	
		<div class="home">
		<div class="div_profilo" id="marginebasso" style="background-color:<?php 	//imposto colore blog
            $queryc="SELECT sfondo FROM blog WHERE id_blog='$idb'";
            $oggettoc =$mysqli->query($queryc);  
            while($scorri_oggetto=$oggettoc->fetch_assoc()){
                printf($scorri_oggetto['sfondo']);
            }?>; font-family:<?php 		//imposto font blog
				$queryf="SELECT font FROM blog WHERE id_blog='$idb'";
				$oggettof =$mysqli->query($queryf);  
				while($scorri_oggetto=$oggettof->fetch_assoc()){
					$f = $scorri_oggetto['font'];
					printf($scorri_oggetto['font']);
				}?>;"> 
				
				<?php    
					//query recupero nome blog
					$q = "SELECT nome FROM blog WHERE id_blog='$idb'"; 
					
					$oggetto =$mysqli->query($q);

					while($scorri_oggetto=$oggetto->fetch_assoc()){
				?>
				
				<a href="http://localhost/progetto/blog2.php?id_blog=<?php printf($idb);?>"><img src="indietro.png" id="sx"></a>
				<h2 style="font-family:<?php printf($f) ?>;"><?php printf($scorri_oggetto['nome']);?></h2>
				
				<?php    
					}
					//query recupero valori post
					$query2 = "SELECT titolo, testo, immagine, ora_data FROM post WHERE id_post='$idp'"; 
					
					$oggetto2 =$mysqli->query($query2);
					
					while($scorri_oggetto2=$oggetto2->fetch_assoc()){
				?>
				
				<div class="div_post">
				<h4><?php printf($scorri_oggetto2['titolo']);?></h4>
				<p><?php printf($scorri_oggetto2['testo']);?></p>
				<img src="<?php printf($scorri_oggetto2['immagine']);?>"><br>
				<p id="data"><?php printf($scorri_oggetto2['ora_data']);?></p><br><br>
				<hr align="center" size="1"  noshade >
				<br>
				<h5>COMMENTI:</h5>
				
				<?php
				}
				//query recupero valori commento
				$query3 = "SELECT testo, nome_utente FROM commenti WHERE id_post='$idp'"; 
				$oggetto3 =$mysqli->query($query3);
					while($scorri_oggetto=$oggetto3->fetch_assoc()){
				?>
				
				<div class="comm">
				<span><b><?php printf($scorri_oggetto['nome_utente']);?></b></span><br>
				<?php printf($scorri_oggetto['testo']);?>
				</div>
				<?php 
					
				}
				?>
				</div>
		</div>	
	</div>
    
</body>


</html>