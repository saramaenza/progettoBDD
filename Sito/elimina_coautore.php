<?php
	//Apro la sessione 
	session_start();

	//Recupero nome utente e password 
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
	
	//elimina coautore
	$query = "UPDATE blog SET coautore=null WHERE id_blog='$idb'";
	
	if (!$mysqli->query($query)) {
		die($mysqli->error);
	}
	
	header("Location: http://localhost/progetto/blog.php?id_blog=$idb");

//Chiusura della connessione
$mysqli->close();

?>

