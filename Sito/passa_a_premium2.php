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

//imposta utente come utente premium
$query = "UPDATE utente SET premium=1 WHERE nome_utente='$user'";

//esecuzione query
if (!$mysqli->query($query)) {
	die($mysqli->error);
}

header('Location: http://localhost/progetto/profilo.php');

//Chiusura della connessione
$mysqli->close();

?>
