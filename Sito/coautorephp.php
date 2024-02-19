<?php
//Apro la sessione 
session_start();

//Recupero nome utente e password 
$user = $_SESSION['user'];
$pass = $_SESSION['password'];

$idb = $_GET['id_blog'];

//Recupero i valori inseriti nel form
$coautore = $_POST['coautore'];

//Connessione al DB utilizzando MySQLi
$mysqli = new mysqli("localhost", "root", "", "progetto");

//Verifica su eventuali errori di connessione
if ($mysqli->connect_error) {
	echo "Connessione fallita: ". $mysqli->connect_error . ".";
	exit();
}                                                                                                 

//controllo se il coautore impostato è un utente presente nel database
$query = "SELECT COUNT(*) FROM utente WHERE nome_utente = '$coautore'";

//Esecuzione della query  
$oggetto =$mysqli->query($query);

$row = $oggetto->fetch_array(MYSQLI_NUM);

if($row[0]>0){	//il coautore è un utente presente nel database
	//Definisco la query di inserimento dati
	$query1 = "UPDATE blog SET coautore = '$coautore' WHERE id_blog='$idb'";

	//Esecuzione della query  
	if (!$mysqli->query($query1)) {
		die($mysqli->error);
	}

	header("Location: http://localhost/progetto/blog.php?id_blog=$idb");
}

else { //il coautore non è un utente presente nel database
	header("Location: http://localhost/progetto/coautore.php?id_blog=$idb&errore=1");
}

//Chiusura della connessione
$mysqli->close();

?>