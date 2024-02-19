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
		<a href="profilo.php"><input type="image" src="icona.png" class="icona"></a>
		<a href="ricerca2.html"><input type="image" src="lente.png" class="cerca"></a>
	</header>
	
    <?php
		//Apro la sessione 
		session_start();

		//Recupero valori
		$user = $_SESSION['user'];
		$pass = $_SESSION['password'];
		$idb= $_GET["id_blog"];

		//Connessione al DB utilizzando MySQLi
        $mysqli = new mysqli("localhost", "root", "", "progetto");

		//Verifica su eventuali errori di connessione
		if ($mysqli->connect_error) {
			echo "Connessione fallita: ". $mysqli->connect_error . ".";
			exit();
		}
		
		//recupero il coautore
		$querycoautore = "SELECT coautore FROM blog WHERE id_blog='$idb'";
		$oggettocoautore =$mysqli->query($querycoautore);
		while($scorri_oggettocoautore=$oggettocoautore->fetch_assoc()){
			$coautore = ($scorri_oggettocoautore['coautore']);
		}

    ?>
    
	<div class="home">
		<div class="div_profilo" id="marginebasso" style="background-color:<?php 	//imposto il colore del blog
            $queryc="SELECT sfondo FROM blog WHERE id_blog='$idb'";
            $oggettoc =$mysqli->query($queryc);  
            while($scorri_oggetto=$oggettoc->fetch_assoc()){
                printf($scorri_oggetto['sfondo']);
            }?>; font-family:<?php 			//imposto il font del blog
				$queryf="SELECT font FROM blog WHERE id_blog='$idb'";
				$oggettof =$mysqli->query($queryf);  
				while($scorri_oggetto=$oggettof->fetch_assoc()){
					$f = $scorri_oggetto['font'];
					printf($scorri_oggetto['font']);
				}?>;"> 
			
				<?php    
					//recupero il nome del blog
					$query = "SELECT nome FROM blog WHERE id_blog='$idb'"; 
					
					$oggetto =$mysqli->query($query);

					while($scorri_oggetto=$oggetto->fetch_assoc()){
				?>
	
				<h2 style="font-family:<?php printf($f) ?>;"><?php printf($scorri_oggetto['nome']);?></h2>

				<?php
				}
				?>
				
				<?php    
					//query recupero valori post
					$query2 = "SELECT titolo, testo, immagine, ora_data, id_post, id_blog FROM post WHERE id_blog='$idb'"; 
					
					$oggetto2 =$mysqli->query($query2);
					
					while($scorri_oggetto2=$oggetto2->fetch_assoc()){
						$idp = $scorri_oggetto2['id_post'];
						$idb = $scorri_oggetto2['id_blog'];
				?>
				
				<div class="div_post">
				<h4><?php printf($scorri_oggetto2['titolo']);?></h4>
				<p><?php printf($scorri_oggetto2['testo']);?></p>
				<img src="<?php printf($scorri_oggetto2['immagine']);?>"><br>
				<p id="data"><?php printf($scorri_oggetto2['ora_data']);?></p><br>
				
				<?php
				//controllo se l'user è coautore (che può modifcare il post)
				if($coautore==$user){
					echo('<a href="modifica_post.php?id_post=<?php printf($idp)?>&id_blog=<?php printf($idb)?>">Modifica post</a> <br>');
				}
				?>
				
				<a href="commenti.php?id_post=<?php printf($idp)?>&id_blog=<?php printf($idb)?>">Visualizza commenti</a>
				<br><br>
				</div>
				
				<?php 
					}
				//controllo se l'user è coautore (che può creare post e modificare il blog)
				if($coautore==$user){
				echo('<a href="crea_post.php?id_blog=<?php printf($idb);?>"><div class="pulsante_lungo">Crea un post</div></a>
					  <a href="modifica_blog.php?id_blog=<?php printf($idb);?>"><div class="pulsante_lungo">Modifica blog</div></a>');
				}
				?>
			
		</div>	
	</div>
    
</body>


</html>