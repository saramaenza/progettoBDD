<?php
//Apro la sessione 
session_start();

//Recupero valori 
$user = $_SESSION['user'];
$pass = $_SESSION['password'];
$idb= $_GET["id_blog"];

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

//Verifico se il campo c'è
if($nomeblog){
	//Aggiorno nome blog nel database 
	$query1 = "UPDATE blog SET nome = '$nomeblog' WHERE id_blog='$idb'";
	if (!$mysqli->query($query1)) {
		die($mysqli->error);

	}
}

//Verifico se il campo c'è
if($font){
	//Aggiorno font del blog nel database
	$query1 = "UPDATE blog SET font = '$font' WHERE id_blog='$idb'";
	if (!$mysqli->query($query1)) {
		die($mysqli->error);
	}
}

//Verifico se il campo c'è
if($colore){
	//Aggiorno colore di sfondo del blog nel database
	$query1 = "UPDATE blog SET sfondo = '$colore' WHERE id_blog='$idb'";
	if (!$mysqli->query($query1)) {
		die($mysqli->error);
	}
}
//Verifico se il campo c'è
if($tema){
	//Aggiorno tema del blog nel database
	$query1 = "INSERT IGNORE INTO tema (nome_tema) VALUES ('$tema')";
	$query2 = "UPDATE blog SET tema = '$tema' WHERE id_blog='$idb'";
	if (!$mysqli->query($query1)) {
		die($mysqli->error);
	}
	if (!$mysqli->query($query2)) {
		die($mysqli->error);
	}
}

header("Location: http://localhost/progetto/blog.php?id_blog=$idb");

//Chiusura della connessione
$mysqli->close();

?>