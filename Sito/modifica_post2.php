<?php
//Apro la sessione 
session_start();

//Recupero valori
$user = $_SESSION['user'];
$pass = $_SESSION['password'];
$idb= $_GET["id_blog"];
$idp= $_GET["id_post"];

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

//Verifico se il campo c'è
if($titolo){
	//Aggiorno titolo del post nel database
	$query1 = "UPDATE post SET titolo = '$titolo' WHERE id_post='$idp'";
	if (!$mysqli->query($query1)) {
		die($mysqli->error);
	}
}

//Verifico se il campo c'è
if($testo){
	//Aggiorno testo del post nel database
	$query1 = "UPDATE post SET testo = '$testo' WHERE id_post='$idp'";
	if (!$mysqli->query($query1)) {
		die($mysqli->error);
	}
}

if($immagine){
	//Aggiorno immagine del post nel database
	$query1 = "UPDATE post SET immagine = '$immagine' WHERE id_post='$idp'";
	if (!$mysqli->query($query1)) {
		die($mysqli->error);
	}
}

header("Location: http://localhost/progetto/blog.php?id_blog=$idb");
	
//Chiusura della connessione
$mysqli->close();

?>