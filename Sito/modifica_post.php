<!DOCTYPE html>
<html lang="it" class="max">
<head>
    <title>Write on me - Modifica post</title>
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
		<div class="div_profilo"> 
		<?php
			//Apro la sessione 
			session_start();

			//Recupero valori
			$user = $_SESSION['user'];
			$pass = $_SESSION['password'];
			$idb= $_GET["id_blog"];
			$idp= $_GET["id_post"];

			//Connessione al DB utilizzando MySQLi
			$mysqli = new mysqli("localhost", "root", "", "progetto");

			//Verifica su eventuali errori di connessione
			if ($mysqli->connect_error) {
				echo "Connessione fallita: ". $mysqli->connect_error . ".";
				exit();
			}
			
			//query recupero titolo post 
			$query = "SELECT titolo,testo FROM post WHERE id_post='$idp'"; 
				
			$oggetto =$mysqli->query($query);    

			while($scorri_oggetto=$oggetto->fetch_assoc()){
				$titolo = $scorri_oggetto['titolo'];
				
			?>
			<a href="http://localhost/progetto/blog.php?id_blog=<?php printf($idb);?>"><img src="indietro.png" id="sx"></a><br>
			<h2>MODIFICA IL TUO POST '<?php printf ($titolo)?>'</h2>
			<form  name="modifica_blog" method="post" class="acc_reg" action="modifica_post2.php?id_blog=<?php printf($idb)?>&id_post=<?php printf($idp)?>" id="post_form">
				<p>Titolo: </p> 
					<input type="text" name="titolo_post" placeholder="<?php echo ($titolo) ?>" id="form_titolo">
					<span class="errore_form" id="errore_titolo"></span>
				<p>Testo:</p>
					<textarea name="testo_post" id="form_testo" rows="5" cols="100%" placeholder="<?php printf($scorri_oggetto['testo']);?>"></textarea>
					<span class="errore_form" id="errore_testo"></span>
				<p>Immagine:</p>
                    <input type="file" name="immagine">
				<br><br>
					<input name="modificab" type="submit" class="invio" value="MODIFICA">
					<span class="errore_form" id="errore_invio"></span>
			</form>
			<?php
				}
			?>
			<br><br>
		</div>	
	</div>
</body>

<footer>
	<div>
		Sito realizzato da Sara Maenza e Gaia Sasso
	</div>
</footer>

	<script type="text/javascript"> 	//script validazione form
      $(function() {
		  //nasconde span di errore
         $("#errore_titolo").hide();
		 $("#errore_testo").hide();
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
			//controllo se il titolo rispetta il pattern o se il campo è vuoto
            if (pattern.test(titolo) || titolo == '') {
				//nasconde span di errore
               $("#errore_titolo").hide();
			   //imposta il blocco con bordo nero
			   $("#form_titolo").css("border","1px solid black");
            } else {
               $("#errore_titolo").html("Contiene caratteri non validi/troppo lungo (max 20 caratteri)");
               $("#errore_titolo").show();
			   //imposta il blocco con bordo rosso
               $("#form_titolo").css("border","2px solid #F90A0A");
               errore_titolo = true;
            }
         }
		 
		 function controllo_testo() {
            var pattern = /^.[^']{0,400}$/i;
            var testo = $("#form_testo").val();
			//controllo se il testo rispetta il pattern o se il campo è vuoto
            if (pattern.test(testo) || testo == '') {
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
               errore_testo = true;
            }
         } 
		 
         $("#post_form").submit(function() {
            errore_titolo = false;
			errore_testo = false;

            controllo_titolo();
			controllo_testo();
			
			if (errore_titolo === false && errore_testo === false) {
            } else {	//se un campo non è stato riempito correttamente, stampa errore
			   $("#errore_invio").html("Riempi i campi correttamente");
               $("#errore_invio").show();
               return false;
            }

         });
      });
   </script>

</html>