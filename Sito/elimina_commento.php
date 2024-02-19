<?php
	//Apro la sessione 
	session_start();

	//Recupero nome utente e password 
	$user = $_SESSION['user'];
	$pass = $_SESSION['password'];
	$idc= $_GET["id_commento"];
	$idb= $_GET["id_blog"];
	$idp= $_GET["id_post"];

	//Connessione al DB utilizzando MySQLi
	$mysqli = new mysqli("localhost", "root", "", "progetto");

	//Verifica su eventuali errori di connessione
	if ($mysqli->connect_error) {
		echo "Connessione fallita: ". $mysqli->connect_error . ".";
		exit();
	}
	
	//elimina commento
	$query = "DELETE FROM commenti WHERE id_commento='$idc'";
	
	if (!$mysqli->query($query)) {
		die($mysqli->error);
	}
	
	header("Location: http://localhost/progetto/commenti.php?id_post=$idp&id_blog=$idb");

//Chiusura della connessione
$mysqli->close();

?>