<?php
//Apro la sessione 
session_start();

//Recupero nome utente e password 
$user = $_SESSION['user'];
$pass = $_SESSION['password'];

//Recupero valori GET
$idb= $_GET["id_blog"];

//Recupero i valori inseriti nel form
$titolo = $_POST['titolo_post'];
$testo = $_POST['testo_post'];
$immagine = $_POST['immagine']; 

//Connessione al DB utilizzando MySQLi
$mysqli = new mysqli("localhost", "root", "", "progetto");

//Verifica su eventuali errori di connessione
if ($mysqli->connect_error) {
	echo "Connessione fallita: ". $mysqli->connect_error . ".";
	exit();
}

//Definisco la query di inserimento dati in post
$query1 = "INSERT INTO post (titolo, testo, immagine, nome_utente, id_blog) VALUES ('$titolo', '$testo', '$immagine', '$user', '$idb')";

//Esecuzione della query  
if (!$mysqli->query($query1)) {
	die($mysqli->error);
}

header("Location: http://localhost/progetto/blog.php?id_blog=$idb");

    
//Chiusura della connessione
$mysqli->close();

?>