<!DOCTYPE html>
<html lang="it" class="max">

<head>
    <title>Write on me</title>
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
	
    <?php
		//Connessione al DB utilizzando MySQLi
        $mysqli = new mysqli("localhost", "root", "", "progetto");

		//Verifica su eventuali errori di connessione
		if ($mysqli->connect_error) {
			echo "Connessione fallita: ". $mysqli->connect_error . ".";
			exit();
		}
		
		//Recupero valori
		$idb= $_GET["id_blog"];

    ?>
    
	<div class="home">
		<div class="div_profilo" id="marginebasso"  style="background-color:<?php 
            $queryc="SELECT sfondo FROM blog WHERE id_blog='$idb'";
            $oggettoc =$mysqli->query($queryc);  
            while($scorri_oggetto=$oggettoc->fetch_assoc()){
                printf($scorri_oggetto['sfondo']);
            }?>; font-family:<?php 
				$queryf="SELECT font FROM blog WHERE id_blog='$idb'";
				$oggettof =$mysqli->query($queryf);  
				while($scorri_oggetto=$oggettof->fetch_assoc()){
					$f = $scorri_oggetto['font'];
					printf($scorri_oggetto['font']);
				}?>;"> 
			
				<?php    
					//query recupero valori del blog
					$query = "SELECT nome FROM blog WHERE id_blog= '$idb'"; 
					
					$oggetto =$mysqli->query($query);
    
					while($scorri_oggetto=$oggetto->fetch_assoc()){
				?>
	
				<h2 style="font-family:<?php printf($f) ?>;"><?php printf($scorri_oggetto['nome']);?></h2>

				<?php
				}
				?>
				
				<?php    
					//query recupero valori post
					$query2 = "SELECT titolo, testo, immagine, ora_data, id_post FROM post WHERE id_blog='$idb'"; 
					
					$oggetto2 =$mysqli->query($query2);
    
					while($scorri_oggetto=$oggetto2->fetch_assoc()){
						$idp = $scorri_oggetto['id_post'];
				?>
				
				<div class="div_post">
				<h4><?php printf($scorri_oggetto['titolo']);?></h4>
				<p><?php printf($scorri_oggetto['testo']);?></p>
				<img src="<?php printf($scorri_oggetto['immagine']);?>"><br>
				<p id="data"><?php printf($scorri_oggetto['ora_data']);?></p><br>
				<hr align="center" size="1"  noshade ><br>
				
				<u><a href="commenti2.php?id_post=<?php printf($idp)?>&id_blog=<?php printf($idb)?>">Visualizza commenti</a></u>
				<br><br>
				</div>
				<?php
				}
				?>
				
		</div>	
	</div>
    
</body>

</html>