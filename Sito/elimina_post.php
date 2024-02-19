<?php
	//Apro la sessione 
	session_start();

	//Recupero nome utente e password 
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
	
	//elimina post
	$query = "DELETE FROM post WHERE id_post='$idp'";
	
	if (!$mysqli->query($query)) {
		die($mysqli->error);
	}
	
	header("Location: http://localhost/progetto/blog.php?id_blog=$idb");

//Chiusura della connessione
$mysqli->close();

?>