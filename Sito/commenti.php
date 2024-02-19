<!DOCTYPE html>
<html lang="it" class="max">

<?php
	//Apro la sessione 
	session_start();

	//Recupero valori
	$user = $_SESSION['user'];
	$pass = $_SESSION['password'];
	$idp= $_GET["id_post"];
	$idb= $_GET["id_blog"];
	
	//Connessione al DB utilizzando MySQLi
	$mysqli = new mysqli("localhost", "root", "", "progetto");

	//Verifica su eventuali errori di connessione
	if ($mysqli->connect_error) {
		echo "Connessione fallita: ". $mysqli->connect_error . ".";
		exit();
	}
	
	//recupero titolo post
	$query="SELECT titolo FROM post WHERE id_post='$idp'";
    $oggetto =$mysqli->query($query);  
    while($scorri_oggetto=$oggetto->fetch_assoc()){
        $tit = $scorri_oggetto['titolo'];
    }
?>

<head>
    <title>Write on me - <?php echo($tit);?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Ibarra+Real+Nova|Raleway&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css.css" type="text/css">
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</head>

	<header>
		<a href="home.php"><input type="image" src="logo.jpeg" class="logo"></a>
		<a href="profilo.php"><input type="image" src="icona.png" class="icona"></a>
		<a href="ricerca2.html"><input type="image" src="lente.png" class="cerca"></a>
	</header>

		<div class="home">
		<div class="div_profilo" id="marginebasso" style="background-color:<?php 	//imposto colore del blog
            $queryc="SELECT sfondo FROM blog WHERE id_blog='$idb'";
            $oggettoc =$mysqli->query($queryc);  
            while($scorri_oggetto=$oggettoc->fetch_assoc()){
                printf($scorri_oggetto['sfondo']);
            }?>; font-family:<?php 			//imposto font del blog
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
				
				<a href="http://localhost/progetto/blog.php?id_blog=<?php printf($idb);?>"><img src="indietro.png" id="sx"></a><br>
				<h2 style="font-family:<?php printf($f) ?>;"><?php printf($scorri_oggetto['nome']);?></h2>
				
				<?php    
					}
					//query valori post
					$query2 = "SELECT titolo, testo, immagine, ora_data	FROM post WHERE id_post='$idp'"; 
					
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
				$query3 = "SELECT testo, nome_utente, id_commento FROM commenti WHERE id_post='$idp'"; 
				$oggetto3 =$mysqli->query($query3);
					while($scorri_oggetto=$oggetto3->fetch_assoc()){
						$idc = $scorri_oggetto['id_commento']; 
				?>
				
				<div class="comm">
				<b><?php printf($scorri_oggetto['nome_utente']);?></b><br>
				<?php printf($scorri_oggetto['testo']);?>
				<span id="destra">
					<a href="modifica_commento.php?id_commento=<?php printf($idc);?>&id_blog=<?php printf($idb);?>&id_post=<?php printf($idp);?>"><u>modifica</u> | </a>
					<a href="elimina_commento.php?id_commento=<?php printf($idc);?>&id_blog=<?php printf($idb);?>&id_post=<?php printf($idp);?>"><u>elimina</u></a>
				</span>
				
				<br>
				
				</div>
				
				<?php 
				}
				?>
				
				<form name="aggiungi_commento" method="post" action="commentiphp.php?id_post=<?php printf($idp)?>&id_blog=<?php printf($idb)?>" id="commento_form">
				<p>Aggiungi un commento:<p>
					<textarea name="commento" rows="3" cols="118%" id="form_commento">
					</textarea><br>
					<span class="errore_form" id="errore_commento"></span>
				<br>
					<input type="submit" value="invio"><br>
					<span class="errore_form" id="errore_invio"></span>
				</form>
			</div>
		</div>	
	</div>
    
</body>

</footer>
	
	<script type="text/javascript"> //script validazione form
      $(function() {  
		 //nasconde span di errore
         $("#errore_commento").hide();
		 $("#errore_invio").hide();
		
		 //imposto errore = false
         var errore_commento = false;
		 var errore_invio = false;
         
         $("#form_commento").focusout(function(){
            controllo_commento();
         });
		
         function controllo_commento() {
            var pattern = /^.[^']{1,120}$/i;
            var commento = $("#form_commento").val();
			//controllo se il commento rispetta il pattern e se il campo non è vuoto
            if (pattern.test(commento) && commento !== '') {
				//nasconde span di errore
               $("#errore_commento").hide();
			   //imposta il blocco con bordo nero
			   $("#form_commento").css("border","1px solid black");
            } else {
				//stampa messaggio di errore
               $("#errore_commento").html("Contiene caratteri non validi/troppo lungo (max 120 caratteri)");
			   //visualizza span di errore
               $("#errore_commento").show();
			   //imposta il blocco con bordo rosso
               $("#form_commento").css("border","2px solid #F90A0A");
			   //imposta errore commento = true
               errore_commento = true;
            }
         }
		 
         $("#commento_form").submit(function() {
            errore_commento = false;

            controllo_commento();
			
			if (errore_commento === false) {
            } else {	//se un campo non è stato riempito correttamente, stampa errore
			   $("#errore_invio").html("Riempi tutti i campi correttamente");
               $("#errore_invio").show();
               return false;
            }

         });
      });
   </script>

</html>