<!DOCTYPE html>
<html lang="it" class="max">
<head>
    <title>Write on me - Modifica commento</title>
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
			$idc= $_GET["id_commento"];

			//Connessione al DB utilizzando MySQLi
			$mysqli = new mysqli("localhost", "root", "", "progetto");

			//Verifica su eventuali errori di connessione
			if ($mysqli->connect_error) {
				echo "Connessione fallita: ". $mysqli->connect_error . ".";
				exit();
			}
			
			//query recupero testo del commento
			$query = "SELECT testo FROM commenti WHERE id_commento='$idc'"; 
				
			$oggetto =$mysqli->query($query);    

			while($scorri_oggetto=$oggetto->fetch_assoc()){
				$testo = $scorri_oggetto['testo'];
				
			?>
			<a href="http://localhost/progetto/commenti.php?id_blog=<?php printf($idb);?>&id_post=<?php printf($idp);?>"><img src="indietro.png" id="sx"></a><br>
			<h2>MODIFICA IL TUO COMMENTO</h2>
			<form  name="modifica_commento" id="commento_form" method="post" class="acc_reg" action="modifica_commenti2.php?id_post=<?php printf($idp)?>&id_blog=<?php printf($idb)?>&id_commento=<?php printf($idc); ?>">
				<textarea id="form_testo" name="commento" rows="4" cols="99%" placeholder="<?php printf($testo);?>" ></textarea>
				<span class="errore_form" id="errore_testo"></span>
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

<script type="text/javascript">	//script validazione form
      $(function() {
		  //nasconde span di errore
         $("#errore_testo").hide();
		 $("#errore_invio").hide();

		 //imposto errore = false
         var errore_testo = false;
		 var errore_invio = false;
         
         $("#form_testo").focusout(function(){
            controllo_testo();
         });

         function controllo_testo() {
            var pattern = /^.[^']{0,120}$/i;
            var testo = $("#form_testo").val();
			//controllo se il testo rispetta il pattern o se il campo è vuoto
            if (pattern.test(testo) && testo !== '') {
				//nasconde span di errore
               $("#errore_testo").hide();
			   //imposta il blocco con bordo nero
			   $("#form_testo").css("border","1px solid black");
            } else {
				//stampa messaggio di errore
               $("#errore_testo").html("Contiene caratteri non validi/troppo lungo (max 120 caratteri)");
			   //visualizza span di errore
               $("#errore_testo").show();
			   //imposto blocco con bordo rosso
               $("#form_testo").css("border","2px solid #F90A0A");
			   //imposto errore testo = true
               errore_testo = true;
            }
         }
		 
         $("#commento_form").submit(function() {
            errore_testo = false;

            controllo_testo();
			
			if (errore_testo === false) {
            } else {	//se un campo non è stato riempito correttamente, stampa errore
			   $("#errore_invio").html("Riempi tutti i campi correttamente");
               $("#errore_invio").show();
               return false;
            }

         });
      });
   </script>

</html>