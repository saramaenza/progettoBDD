<!DOCTYPE html>
<html lang="it" class="max">

<head>
    <title>Write on me - Coautore</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Coautore</title> 
	<link rel="stylesheet" href="css.css" type="text/css">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	
	<script >	//autocompletamento
	$(document).ready(function(){
		$('.search-box input[type="text"]').on("keyup input", function(){
			//Ottieni valore di input in caso di modifica
			var inputVal = $(this).val();
			var resultDropdown = $(this).siblings(".result");
			if(inputVal.length){
				$.get("autocompletamento.php", {term: inputVal}).done(function(data){
					// Visualizza i dati restituiti nel browser
					resultDropdown.html(data);
				});
			} else{
				resultDropdown.empty();
			}
		});
		
		// Imposta il valore di input della ricerca facendo clic sull'elemento risultato
		$(document).on("click", ".result p", function(){
			$(this).parents(".search-box").find('input[type="text"]').val($(this).text());
			$(this).parent(".result").empty();
		});
	});
	</script>
	</head>
	
	<body class="max">
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
	$errore= $_GET["errore"];

	//Connessione al DB utilizzando MySQLi
	$mysqli = new mysqli("localhost", "root", "", "progetto");

	//Verifica su eventuali errori di connessione
	if ($mysqli->connect_error) {
		echo "Connessione fallita: ". $mysqli->connect_error . ".";
		exit();
	}
	
	//query recupero nome e coautore blog
	$query = "SELECT nome, coautore FROM blog WHERE id_blog='$idb'"; 
	
	$oggetto =$mysqli->query($query);

	while($scorri_oggetto=$oggetto->fetch_assoc()){
		$nomeb = $scorri_oggetto['nome'];
		$co = $scorri_oggetto['coautore'];
    ?>
	
	<div class="home">
		<div class="div_profilo"> 
			<a href="http://localhost/progetto/blog.php?id_blog=<?php printf($idb);?>"><img src="indietro.png" id="sx"></a><br>
			<h2>COAUTORE</h2>
			<p id="center">
			<?php 
				if($co){ 	//il blog ha un coautore
					echo ("Al momento il coautore del tuo blog <b>");echo($nomeb);echo("</b> è <b><i>");echo($co);echo("</i></b>");
				}
				else {		//il blog non ha un coautore
					echo ("Al momento il tuo blog <b>");echo($nomeb);echo("</b> non ha coautori.");
				}
			?>
			</p>
			<form method="post" class="acc_reg" action="coautorephp.php?id_blog=<?php printf($idb)?>"> 
				<div class="search-box">
					<?php
						if($errore!=0){		//il nome inserito non appartiene a nessun utente, stampa errore
							echo("<span class='errore'>L'utente inserito non esiste</span>");
						}
					?>
					<input type="text" autocomplete="off" placeholder="Cerca username coautore" name="coautore"/>
					<div class="result"></div>
				 </div>
				 <p>
					Ti ricordiamo che puoi avere solo un coautore per blog. <br>
					Se ne aggiungi un'altro, il primo verrà automaticamente rimosso.
				</p>
				 <input name="creab" type="submit" class="invio" value="INVIO">
			</form>
			<br>
			<p>Oppure:</p>
			<a href="elimina_coautore.php?id_blog=<?php printf($idb);?>"><div class="pulsante_lungo" id="smaller"><b>Elimina coautore</b></div></a>
		</div>
	</div>
</body>

	<?php } ?>
<footer>
	<div>
		Sito realizzato da Sara Maenza e Gaia Sasso
	</div>
</footer>

</html>
