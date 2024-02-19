<?php
//Apro la sessione 
session_start();

//Recupero valori
$user = $_SESSION['user'];
$pass = $_SESSION['password'];
$idp= $_GET["id_post"];
$idb= $_GET["id_blog"];

//Recupero i valori inseriti nel form
$commento = $_POST['commento'];

//Connessione al DB utilizzando MySQLi
$mysqli = new mysqli("localhost", "root", "", "progetto");

//Verifica su eventuali errori di connessione
if ($mysqli->connect_error) {
	echo "Connessione fallita: ". $mysqli->connect_error . ".";
	exit();
}  

//query di inserimento commento
$query = "INSERT INTO commenti (testo, nome_utente, id_post) VALUES ('$commento', '$user', '$idp')";

if (!$mysqli->query($query)) {
	die($mysqli->error);
}

header("Location: http://localhost/progetto/commenti.php?id_post=$idp&id_blog=$idb");

//Chiusura della connessione
$mysqli->close();

?>