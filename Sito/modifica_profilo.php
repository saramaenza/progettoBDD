<!DOCTYPE html>
<html lang="it" class="max" id="sfondo_alto">
<head>
    <title>Write on me - Modifica profilo</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Ibarra+Real+Nova|Raleway&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css.css" type="text/css">
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</head>

<body id="sfondo_alto2">
	<header>
		<a href="home.php"><input type="image" src="logo.jpeg" class="logo"></a>
		<a href="profilo.php"><input type="image" src="icona.png" class="icona"></a>
		<a href="ricerca2.html"><input type="image" src="lente.png" class="cerca"></a>
	</header>
	<div class="home" id="wrap">
		<div class="div_profilo" id="mod_utente"> 
		<?php
			//Apro la sessione 
			session_start();

			//Recupero nome utente e password 
			$user = $_SESSION['user'];
			$pass = $_SESSION['password'];

			//Connessione al DB utilizzando MySQLi
			$mysqli = new mysqli("localhost", "root", "", "progetto");

			//Verifica su eventuali errori di connessione
			if ($mysqli->connect_error) {
				echo "Connessione fallita: ". $mysqli->connect_error . ".";
				exit();
			}
			
			//query recupero valori da utente
			$query = "SELECT * FROM utente WHERE nome_utente='$user'"; 
				
			//esecuzione query
			$oggetto =$mysqli->query($query);    

			//inizio ciclo
			while($scorri_oggetto=$oggetto->fetch_assoc()){
				
			?>
				<a href="http://localhost/progetto/profilo.php"><img src="indietro.png" id="sx"></a> <br>
				<h2>Modifica il tuo profilo, <?php printf($user);?></h2>
				<form name="modificautente" method="post" class="acc_reg" action="modifica_profilo2.php" id="registration_form">
					<p>Email:</p>
						<input type="text" name="email" id="form_email" placeholder="<?php printf($scorri_oggetto['email']);?>">
						<span class="errore_form" id="errore_email"></span>
					<p>Nome:</p>
						<input type="text" name="nome" id="form_nome" placeholder="<?php printf($scorri_oggetto['nome']);?>">
						<span class="errore_form" id="errore_nome"></span>
					<p>Cognome:</p>
						<input type="text" name="cognome"  id="form_cognome" placeholder="<?php printf($scorri_oggetto['cognome']);?>">
						<span class="errore_form" id="errore_cognome"></span>
					<p>Password:</p>
						<input type="password" name="password"  id="form_password">
						<span class="errore_form" id="errore_password"></span>
					<p>Indirizzo</p>
						<input type="text" name="indirizzo"  id="form_indirizzo" placeholder="<?php printf($scorri_oggetto['indirizzo']);?>">
						<span class="errore_form" id="errore_indirizzo"></span>
					<p>Telefono:</p>
						<input type="text" name="telefono" id="form_tel" placeholder="<?php printf($scorri_oggetto['tel']);?>">
						<span class="errore_form" id="errore_tel"></span>
					<p>Numero documento:</p>
						<input type="text" name="numdoc"  id="form_numdoc" placeholder="<?php printf($scorri_oggetto['num_doc']);?>">
						<span class="errore_form" id="errore_numdoc"></span>
					<p>Data di rilascio del documento:</p>
						<input type="text" name="datadoc"  id="form_datadoc" placeholder="<?php printf($scorri_oggetto['data_doc']);?>">
						<span class="errore_form" id="errore_datadoc"></span>
					<p>Luogo di rilascio del documento:</p>
						<input type="text" name="luogodoc"  id="form_luogodoc" placeholder="<?php printf($scorri_oggetto['luogo_doc']);?>">
						<span class="errore_form" id="errore_luogodoc"></span>
					<p>Ente di rilascio del documento:</p>
						<input type="text" name="entedoc"  id="form_entedoc" placeholder="<?php printf($scorri_oggetto['ente_doc']);?>">
						<span class="errore_form" id="errore_entedoc"></span>
					<br><br>
						<input type="submit" name="Registrati" class="invio" value="MODIFICA">
						<span class="errore_form" id="errore_invio"></span>
				</form>
			
			<?php
			}
			?>
			
		</div>	
	</div>
	
	<footer>
		<div>
			Sito realizzato da Sara Maenza e Gaia Sasso
		</div>
	</footer>
	
	<script type="text/javascript"> //script validazione form
      $(function() {
		  //nasconde span di errore
         $("#errore_nome").hide();
		 $("#errore_cognome").hide();
		 $("#errore_email").hide();
		 $("#errore_password").hide();
		 $("#errore_indirizzo").hide();
		 $("#errore_tel").hide();
		 $("#errore_numdoc").hide();
		 $("#errore_datadoc").hide();
		 $("#errore_luogodoc").hide();
		 $("#errore_entedoc").hide();
		 $("#errore_invio").hide();

		 //imposto errore = false
         var errore_nome = false;
		 var errore_cognome = false;
		 var errore_email = false;
		 var errore_password = false;
		 var errore_indirizzo = false;
		 var errore_tel = false;
		 var errore_numdoc = false;
		 var errore_datadoc = false;
		 var errore_luogodoc = false;
		 var errore_entedoc = false;
		 var errore_invio = false;
         
         $("#form_nome").focusout(function(){
            controllo_nome();
         });
		 $("#form_cognome").focusout(function(){
            controllo_cognome();
         });
		 $("#form_email").focusout(function(){
            controllo_email();
         });
		 $("#form_password").focusout(function(){
            controllo_password();
         });
		 $("#form_indirizzo").focusout(function(){
            controllo_indirizzo();
         });
		 $("#form_tel").focusout(function(){
            controllo_tel();
         });
		 $("#form_numdoc").focusout(function(){
            controllo_numdoc();
         });
		 $("#form_datadoc").focusout(function(){
            controllo_datadoc();
         });
		 $("#form_luogodoc").focusout(function(){
            controllo_luogodoc();
         });
		 $("#form_entedoc").focusout(function(){
            controllo_entedoc();
         });
		 
         function controllo_nome() {
            var pattern = /^[a-zA-Z]{1,20}$/i;
            var nome = $("#form_nome").val();
			//controllo se il nome rispetta il pattern o se il campo è vuoto
            if (pattern.test(nome) || nome == '') {
				//nasconde span di errore
               $("#errore_nome").hide();
			   //imposta il blocco con bordo nero
			   $("#form_nome").css("border","1px solid black");
            } else {
				//stampa messaggio di errore
               $("#errore_nome").html("Contiene caratteri non validi/max 20 caratteri");
			   //visualizza span di errore
               $("#errore_nome").show();
			   //imposta il blocco con bordo rosso
               $("#form_nome").css("border","2px solid #F90A0A");
               errore_nome = true;
            }
         }
		 
		 function controllo_cognome() {
            var pattern = /^[a-zA-Z]{1,20}$/i;
            var cognome = $("#form_cognome").val();
            if (pattern.test(cognome) || cognome == '') {
               $("#errore_cognome").hide();
			   $("#form_cognome").css("border","1px solid black");
            } else {
               $("#errore_cognome").html("Contiene caratteri non validi/max 20 caratteri");;
               $("#errore_cognome").show();
               $("#form_cognome").css("border","2px solid #F90A0A");
               errore_nome = true;
            }
         }
		 
		 function controllo_email() {
            var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var email = $("#form_email").val();
            if (pattern.test(email) || email == '') {
               $("#errore_email").hide();
			   $("#form_email").css("border","1px solid black");
            } else {
               $("#errore_email").html("Email non valida");
               $("#errore_email").show();
               $("#form_email").css("border","2px solid #F90A0A");
               errore_email = true;
            }
         }
		 
		 function controllo_password() {
            var pattern = /^[a-zA-Z0-9]{8,20}/i;
            var password = $("#form_password").val();
            if (pattern.test(password) || password == '') {
               $("#errore_password").hide();
			   $("#form_password").css("border","1px solid black");
            } else {
               $("#errore_password").html("Contiene caratteri non validi/min 8 caratteri");;
               $("#errore_password").show();
               $("#form_password").css("border","2px solid #F90A0A");
               errore_password = true;
            }
         }
		 
		 function controllo_indirizzo() {
            var pattern = /^[a-zA-Z0-9 \'-]{1,30}$/i;
            var indirizzo = $("#form_indirizzo").val();
            if (pattern.test(indirizzo) || indirizzo == '') {
               $("#errore_indirizzo").hide();
			   $("#form_indirizzo").css("border","1px solid black");
            } else {
               $("#errore_indirizzo").html("Contiene caratteri non validi/max 30 caratteri");
               $("#errore_indirizzo").show();
               $("#form_indirizzo").css("border","2px solid #F90A0A");
               errore_indirizzo = true;
            }
         }
	
		 function controllo_tel() {
            var pattern = /^[0-9]{10}/i;
            var tel = $("#form_tel").val();
            if (pattern.test(tel) || tel == '') {
               $("#errore_tel").hide();
			   $("#form_tel").css("border","1px solid black");
            } else {
               $("#errore_tel").html("Può contenere solo numeri");
               $("#errore_tel").show();
               $("#form_tel").css("border","2px solid #F90A0A");
               errore_tel = true;
            }
         }
		 
		 function controllo_numdoc() {
            var pattern = /^[a-zA-Z0-9]{1,20}$/i;
            var numdoc = $("#form_numdoc").val();
            if (pattern.test(numdoc) || numdoc == '') {
               $("#errore_numdoc").hide();
			   $("#form_numdoc").css("border","1px solid black");
            } else {
               $("#errore_numdoc").html("Contiene caratteri non validi/max 20 caratteri");
               $("#errore_numdoc").show();
               $("#form_numdoc").css("border","2px solid #F90A0A");
               errore_numdoc = true;
            }
         }
		 
		 function controllo_datadoc() {
            var pattern = /^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}/i;
            var datadoc = $("#form_datadoc").val();
            if (pattern.test(datadoc) || datadoc == '') {
               $("#errore_datadoc").hide();
			   $("#form_datadoc").css("border","1px solid black");
            } else {
               $("#errore_datadoc").html("Data non valida");
               $("#errore_datadoc").show();
               $("#form_datadoc").css("border","2px solid #F90A0A");
               errore_datadoc = true;
            }
         }
		 
		 function controllo_luogodoc() {
            var pattern = /^[a-zA-Z]{1,20}$/i;
            var luogodoc = $("#form_luogodoc").val();
            if (pattern.test(luogodoc) || luogodoc == '') {
               $("#errore_luogodoc").hide();
			   $("#form_luogodoc").css("border","1px solid black");
            } else {
               $("#errore_luogodoc").html("Contiene caratteri non validi/max 20 caratteri");
               $("#errore_luogodoc").show();
               $("#form_luogodoc").css("border","2px solid #F90A0A");
               errore_luogodoc = true;
            }
         }

		 function controllo_entedoc() {
            var pattern = /^[a-zA-Z]{1,20}$/i;
            var entedoc = $("#form_entedoc").val();
            if (pattern.test(entedoc) || entedoc == '') {
               $("#errore_entedoc").hide();
			   $("#form_entedoc").css("border","1px solid black");
            } else {
               $("#errore_entedoc").html("Contiene caratteri non validi/max 20 caratteri");
               $("#errore_entedoc").show();
               $("#form_entedoc").css("border","2px solid #F90A0A");
               errore_entedoc = true;
            }
         }		 
		 
         $("#registration_form").submit(function() {
            errore_nome = false;
			errore_cognome = false;
			errore_email = false;
			errore_password = false;
			errore_indirizzo = false;
			errore_tel = false;
			errore_numdoc = false;
			errore_datadoc = false;
			errore_luogodoc = false;
			errore_entedoc = false;

            controllo_nome();
			controllo_cognome();
			controllo_email();
			controllo_password();
			controllo_indirizzo();
			controllo_tel();
			controllo_numdoc();
			controllo_datadoc();
			controllo_luogodoc();
			controllo_entedoc();
			
			if (errore_nome === false && errore_cognome === false && errore_email === false && errore_password === false && errore_indirizzo === false  && errore_tel === false && errore_numdoc === false && errore_datadoc === false && errore_luogodoc === false && errore_entedoc === false) {
			   return true;
            } else {	//se un campo non è stato riempito correttamente, stampa errore
			   $("#errore_invio").html("Riempi i campi correttamente");
               $("#errore_invio").show();
               return false;
            }

         });
      });
   </script>
   
</body>
</html>