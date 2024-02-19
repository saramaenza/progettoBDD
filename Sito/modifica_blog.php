<!DOCTYPE html>
<html lang="it" class="max">
<head>
    <title>Write on me - Modifica blog</title>
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

			//Connessione al DB utilizzando MySQLi
			$mysqli = new mysqli("localhost", "root", "", "progetto");

			//Verifica su eventuali errori di connessione
			if ($mysqli->connect_error) {
				echo "Connessione fallita: ". $mysqli->connect_error . ".";
				exit();
			}
			
			//query recupero valori blog
			$query = "SELECT nome,tema FROM blog WHERE id_blog='$idb'"; 
				
			$oggetto =$mysqli->query($query);    

			while($scorri_oggetto=$oggetto->fetch_assoc()){
				$nome = $scorri_oggetto['nome'];
			?>
			
			<a href="http://localhost/progetto/blog.php?id_blog=<?php printf($idb);?>"><img src="indietro.png" id="sx"></a><br>
			<h2>MODIFICA IL TUO BLOG '<?php printf($scorri_oggetto['nome']);?>'</h2>
			<form  name="modifica_blog" method="post" class="acc_reg" action="modifica_blog2.php?id_blog=<?php printf($idb)?>" id="blog_form">
				<p>Nome: </p> 
					<input type="text" name="nome_blog" id="form_nome" placeholder="<?php echo ($nome) ?>">
					<span class="errore_form" id="errore_nome"></span>
				<p>Tema:</p>
					<input type="text" name="tema_blog" id="form_tema" placeholder="<?php printf($scorri_oggetto['tema']);?>">
					<span class="errore_form" id="errore_tema"></span>
				<p>Quale font vuoi usare per i tuoi caratteri?</p>
					<select name="font_blog">
						<option value="calibri" class="calibri">Calibri</option>
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
					<input type="color" name="colore_blog">
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
	
	<script type="text/javascript">  //script validazione form
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
			//controllo se il nome rispetta il pattern o se il campo è vuoto
            if (pattern.test(nome) || nome == '') {
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
			//controllo se il tema rispetta il pattern o se il campo è vuoto
            if (pattern.test(tema) || tema == '') {
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