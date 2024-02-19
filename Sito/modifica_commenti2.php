<?php
//Apro la sessione 
session_start();

//Recupero valori
$user = $_SESSION['user'];
$pass = $_SESSION['password'];
$idb= $_GET["id_blog"];
$idp= $_GET["id_post"];
$idc= $_GET["id_commento"];

//Recupero i valori inseriti nel form
$commento = $_POST['commento'];

//Connessione al DB utilizzando MySQLi
$mysqli = new mysqli("localhost", "root", "", "progetto");

//Verifica su eventuali errori di connessione
if ($mysqli->connect_error) {
	echo "Connessione fallita: ". $mysqli->connect_error . ".";
	exit();
}                                                                                                 

//Verifico se il campo c'è
if($commento){
	//Aggiorno testo commento nel database
	$query = "UPDATE commenti SET testo = '$commento' WHERE id_commento='$idc'";
	if (!$mysqli->query($query)) {
		die($mysqli->error);
	}
}

header("Location: http://localhost/progetto/commenti.php?id_post=$idp&id_blog=$idb");
	
//Chiusura della connessione
$mysqli->close();

?>