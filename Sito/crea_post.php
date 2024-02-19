<!DOCTYPE html>
<html lang="it" class="max">

<head>
    <title>Write on me - Crea post</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Ibarra+Real+Nova|Raleway&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css.css" type="text/css">
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
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
		
		//controllo il tipo di utente 
		$query = "SELECT premium FROM utente WHERE nome_utente='$user'";
		$oggetto =$mysqli->query($query);
		while($scorri_oggetto=$oggetto->fetch_assoc()){
			$tipo = ($scorri_oggetto['premium']);
		}
		
		if($tipo=='1'){  //l'utente è premium e può creare post illimitatamente 
	
		?>
		
		<div class="div_profilo"> 
			<a href="http://localhost/progetto/blog.php?id_blog=<?php printf($idb);?>"><img src="indietro.png" id="sx"></a><br>
			<h2>CREA POST</h2>
			<form  name="creazione_post" method="post" class="acc_reg" action="crea_postphp.php?id_blog=<?php printf($idb)?>" id="post_form">
				<p>Titolo:</p> 
					<input type="text" name="titolo_post" id="form_titolo" required>
					<span class="errore_form" id="errore_titolo"></span>
				<p>Testo:</p>
					<textarea name="testo_post" id="form_testo" rows="5" cols="100%" required></textarea>
					<span class="errore_form" id="errore_testo"></span>
                <p>Immagine:</p>
                    <input type="file" name="immagine" id="form_img">	
					<span class="errore_form" id="errore_img"></span>					
				<br><br><br>
					<input name="creap" type="submit" class="invio" value="CREA">
					<span class="errore_form" id="errore_invio"></span>
			</form>
			<br><br>
		</div>
			
		<?php 
		} 
		else {  //l'utente non è premium e può creare al massimo 3 post
			//conto il numero di post realizzati fino ad ora dall'utente 
			$query = "SELECT COUNT(*) FROM post WHERE id_blog='$idb'";
			
			//eseguo la query
			$oggetto =$mysqli->query($query);
			
			//salvo il numero risultante dalla query
			$row = $oggetto->fetch_array(MYSQLI_NUM);
			
			if($row[0]==3){  //se l'utente ha già creato 3 post, stampa errore
				?>
				<div class="div_profilo"> 
					<h2>Mi dispiace!</h2>
					<p id="center">Hai raggiunto il numero limite di post. <br> <br>Passa a premium per creare post e blog illimitati</p>
					<a href="blog.php?id_blog=<?php printf($idb);?>"><div class="pulsante_lungo">Torna al tuo blog</div></a>
				</div>
				
			<?php 
			} 
			else {  //se l'utente ha creato meno di 3 post, allora può crearne uno nuovo
			?>
				<div class="div_profilo"> 
					<h2>CREA POST</h2>
					<form  name="creazione_post" method="post" class="acc_reg" action="crea_postphp.php?id_blog=<?php printf($idb)?>" id="post_form">
						<p>Titolo:</p> 
							<input type="text" name="titolo_post" id="form_titolo" required>
							<span class="errore_form" id="errore_titolo"></span>
						<p>Testo:</p>
							<textarea name="testo_post" id="form_testo" rows="5" cols="100%" required></textarea>
							<span class="errore_form" id="errore_testo"></span>
						<p>Immagine:</p>
							<input type="file" name="immagine">					
						<br><br><br>
							<input name="creap" type="submit" class="invio" value="CREA">
							<span class="errore_form" id="errore_invio"></span>
					</form>
					<br><br>
				</div>
			<?php
			}
		}
		?>
	</div>
</body>

<footer>
	<div>
		Sito realizzato da Sara Maenza e Gaia Sasso
	</div>
</footer>

	<script type="text/javascript">	//script validazione form
      $(function() {
		 //nasconde span di errore
         $("#errore_titolo").hide();
		 $("#errore_testo").hide();
		 $("#errore_img").hide();
		 $("#errore_invio").hide();
		 
		//imposto errore = false
         var errore_titolo = false;
		 var errore_testo = false;
		 var errore_invio = false;
         
         $("#form_titolo").focusout(function(){
            controllo_titolo();
         });
		 $("#form_testo").focusout(function(){
            controllo_testo();
         });
		 
         function controllo_titolo() {
            var pattern = /^.[^']{0,20}$/i;
            var titolo = $("#form_titolo").val();
			//controllo se il titolo rispetta il pattern e se il campo non è vuoto
            if (pattern.test(titolo) && titolo !== '') {
				//nasconde span di errore
               $("#errore_titolo").hide();
			    //imposta il blocco con bordo nero
			   $("#form_titolo").css("border","1px solid black");
            } else {
				//stampa messaggio di errore
               $("#errore_titolo").html("Contiene caratteri non validi/troppo lungo (max 20 caratteri)");
			   //visualizza span di errore
               $("#errore_titolo").show();
			   //imposta il blocco con bordo rosso
               $("#form_titolo").css("border","2px solid #F90A0A");
			   //imposta errore titolo = true
               errore_titolo = true;
            }
         }
		 
		 function controllo_testo() {
			var pattern = /^.[^']{0,400}$/i;
            var testo = $("#form_testo").val();
			//controllo se il testo rispetta il pattern e se il campo non è vuoto
            if (pattern.test(testo) && testo !== '') {
				//nasconde span di errore
               $("#errore_testo").hide();
			    //imposta il blocco con bordo nero
			   $("#form_testo").css("border","1px solid black");
            } else {
				//stampa messaggio di errore
               $("#errore_testo").html("Contiene caratteri non validi/troppo lungo (max 400 caratteri)");
			   //visualizza span di errore
               $("#errore_testo").show();
			   //imposta il blocco con bordo rosso
               $("#form_testo").css("border","2px solid #F90A0A");
			   //imposta errore testo = true
               errore_testo = true;
            }
         } 
		 
		 
         $("#post_form").submit(function() {
            errore_titolo = false;
			errore_testo = false;

            controllo_titolo();
			controllo_testo();
			
			
			if (errore_titolo === false && errore_testo === false) {
            } else {  //se un campo non è stato riempito, stampa errore
			   $("#errore_invio").html("Riempi i campi correttamente");
               $("#errore_invio").show();
               return false;
            }

         });
      });
   </script>

</html>