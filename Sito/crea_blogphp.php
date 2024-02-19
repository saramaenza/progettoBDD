<?php
//Apro la sessione 
session_start();

//Recupero nome utente e password 
$user = $_SESSION['user'];
$pass = $_SESSION['password'];

//Recupero i valori inseriti nel form
$tema = $_POST['tema_blog'];
$nomeblog = $_POST['nome_blog'];
$font = $_POST['font_blog'];
$colore = $_POST['colore_blog'];

//Connessione al DB utilizzando MySQLi
$mysqli = new mysqli("localhost", "root", "", "progetto");

//Verifica su eventuali errori di connessione
if ($mysqli->connect_error) {
	echo "Connessione fallita: ". $mysqli->connect_error . ".";
	exit();
}  

//Definisco query di inserimento tema 
$query1 = "INSERT IGNORE INTO tema (nome_tema) VALUES ('$tema')";

//Definisco query di inserimento blog 
$query2 = "INSERT INTO blog (nome, font, sfondo, nome_utente,tema) VALUES ('$nomeblog', '$font', '$colore', '$user', '$tema')";

//Esecuzione query  
if (!$mysqli->query($query1)) {
	die($mysqli->error);
}
if (!$mysqli->query($query2)) { 	
	die($mysqli->error);
}

//salvo id dell'ultimo blog inserito
$idb = mysqli_insert_id($mysqli); 

header("Location:http://localhost/progetto/blog.php?id_blog=$idb");


//Chiusura della connessione
$mysqli->close();

?>