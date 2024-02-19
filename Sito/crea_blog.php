<!DOCTYPE html>
<html lang="it" class="max">

<head>
    <title>Write on me - Crea blog</title>
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
				
				//controllo il tipo di utente 
				$query = "SELECT premium FROM utente WHERE nome_utente='$user'";
				$oggetto =$mysqli->query($query);
				while($scorri_oggetto=$oggetto->fetch_assoc()){
					$tipo = ($scorri_oggetto['premium']);
				}
				
				if($tipo=='1'){
			?>
					<div class="div_profilo"> 
						<a href="http://localhost/progetto/profilo.php"><img src="indietro.png" id="sx"></a> <br>
						<h2>CREA IL TUO BLOG</h2> 
						<form  name="creazione_blog" method="post" class="acc_reg" action="crea_blogphp.php" id="blog_form">
							<p>Di che parla il tuo blog? </p> 
								<input type="text" name="tema_blog" id="form_tema" required>
								<span class="errore_form" id="errore_tema"></span>
							<p>Come si chiama?</p>
								<input type="text" name="nome_blog" id="form_nome" required>
								<span class="errore_form" id="errore_nome"></span>
							<p>Quale font vuoi usare per i tuoi caratteri?</p>
								<select name="font_blog" required>
									<option value="calibri" class="calibri">Calibri</option>
									<option value="times new roman" class="timesnewroman" >Times New Roman</option>
									<option value="georgia" class="georgia">Georgia</option>
									<option value="cambria" class="cambria" >Cambria</option>
									<option value="arial" class="arial">Arial</option>
									<option value="Book Antiqua" class="bookantiqua" >Book Antiqua</option>
									<option value="century" class="century">Century</option>
									<option value="Century Gothic" class="centurygothic" >Century Gothic</option>
									<option value="Comic Sans MS" class="comicsansms">Comic Sans MS</option>
									<option value="corbel" class="corbel" >Corbel</option>
									<option value="Courier New" class="couriernew">Courier New</option>
									<option value="garamond" class="garamond" >Garamond</option>
									<option value="verdana" class="verdana">Verdana</option>
								</select>
							<p>Che colore vuoi usare come sfondo?</p>
								<input type="color" name="colore_blog" required>
							<br><br>
								<input name="creab" type="submit" class="invio" value="CREA">
								<span class="errore_form" id="errore_invio"></span>
						</form>
						<br><br>
					</div>	
			<?php 
				}
				else {
					//controllo il numero di blog realizzati fino ad ora dall'utente semplice
					$query = "SELECT COUNT(*) FROM blog WHERE nome_utente='$user'";
					//eseguo la query
					$oggetto =$mysqli->query($query);
					//salvo il numero risultante dalla query
					$row = $oggetto->fetch_array(MYSQLI_NUM);
					if($row[0]==3){
					?>
						<div class="div_profilo"> 
							<h2>Mi dispiace!</h2>
							<p id="center">Hai raggiunto il numero limite di blog. <br> <br>Passa a premium per creare post e blog illimitati</p>
							<a href="profilo.php"><div class="pulsante_lungo">Torna al tuo profilo</div></a>
						</div>
					<?php
					}
					else { 
						?>
						<div class="div_profilo"> 
							<h2>CREA IL TUO BLOG</h2> 
							<form  name="creazione_blog" method="post" class="acc_reg" action="crea_blogphp.php" id="blog_form">
								<p>Di che parla il tuo blog? </p> 
									<input type="text" name="tema_blog" id="form_tema" required>
									<span class="errore_form" id="errore_tema"></span>
								<p>Come si chiama?</p>
									<input type="text" name="nome_blog" id="form_nome" required>
									<span class="errore_form" id="errore_nome"></span>
								<p>Quale font vuoi usare per i tuoi caratteri?</p>
									<select name="font_blog" required>
										<option value="calibri" class="calibri">Calibri</option>
										<option value="cal" class="timesnewroman" >Times New Roman</option>
										<option value="georgia" class="georgia">Georgia</option>
										<option value="cambria" class="cambria" >Cambria</option>
										<option value="arial" class="arial">Arial</option>
										<option value="cal" class="bookantiqua" >Book Antiqua</option>
										<option value="century" class="century">Century</option>
										<option value="cal" class="centurygothic" >Century Gothic</option>
										<option value="cal" class="comicsansms">Comic Sans MS</option>
										<option value="corbel" class="corbel" >Corbel</option>
										<option value="cal" class="couriernew">Courier New</option>
										<option value="garamond" class="garamond" >Garamond</option>
										<option value="verdana" class="verdana">Verdana</option>
									</select>
								<p>Che colore vuoi usare come sfondo?</p>
									<input type="color" name="colore_blog" required>
								<br><br>
									<input name="creab" type="submit" class="invio" value="CREA">
									<span class="errore_form" id="errore_invio"></span>
							</form>
							<br><br>
						</div>	
					<?php }
				}
				?>
	</div>
</body>

<footer>
	<div>
		Sito realizzato da Sara Maenza e Gaia Sasso
	</div>
</footer>
	
	<script type="text/javascript"> //script validazione form
      $(function() {
		  //nasconde span di errore
         $("#errore_nome").hide();
		 $("#errore_tema").hide();
		 $("#errore_invio").hide();
		 
		//imposto errore = false
         var errore_nome = false;
		 var errore_tema = false;
		 var errore_invio = false;
         
         $("#form_nome").focusout(function(){
            controllo_nome();
         });
		 $("#form_tema").focusout(function(){
            controllo_tema();
         });
		 
         function controllo_nome() {
            var pattern = /^.[^']{0,20}$/i;
            var nome = $("#form_nome").val();
			//controllo se il nome rispetta il pattern e se il campo non è vuoto
            if (pattern.test(nome) && nome !== '') {
				//nasconde span di errore
               $("#errore_nome").hide();
			    //imposta il blocco con bordo nero
			   $("#form_nome").css("border","1px solid black");
            } else {
				//stampa messaggio di errore
               $("#errore_nome").html("Contiene caratteri non validi/troppo lungo (max 20 caratteri)");
			   //visualizza span di errore
               $("#errore_nome").show();
			   //imposta il blocco con bordo rosso
               $("#form_nome").css("border","2px solid #F90A0A");
			   //imposta errore nome = true
               errore_nome = true;
            }
         }
		 
		 function controllo_tema() {
            var pattern = /^[a-zA-Zèéàòù0-9 \-]{1,20}$/i;
            var tema = $("#form_tema").val();
			//controllo se il tema rispetta il pattern e se il campo non è vuoto
            if (pattern.test(tema) && tema !== '') {
				//nasconde span di errore
               $("#errore_tema").hide();
			   //imposta il blocco con bordo nero
			   $("#form_tema").css("border","1px solid black");
            } else {
				//stampa messaggio di errore
               $("#errore_tema").html("Contiene caratteri non validi/troppo lungo (max 20 caratteri)");
			   //visualizza span di errore
               $("#errore_tema").show();
			   //imposta il blocco con bordo rosso
               $("#form_tema").css("border","2px solid #F90A0A");
			   //imposta errore tema = true
               errore_tema = true;
            }
         } 
		 
         $("#blog_form").submit(function() {
            errore_nome = false;
			errore_tema = false;

            controllo_nome();
			controllo_tema();
			
			if (errore_nome === false && errore_tema === false) {
            } else {	//se un campo non è stato riempito correttamente, stampa errore
			   $("#errore_invio").html("Riempi i campi correttamente");
               $("#errore_invio").show();
               return false;
            }

         });
      });
   </script>

</html>