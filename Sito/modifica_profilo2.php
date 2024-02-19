<?php
//Recupero i valori inseriti nel form
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$password = $_POST['password'];
$indirizzo = $_POST['indirizzo'];
$tel = $_POST['telefono'];
$num_doc = $_POST['numdoc'];
$data_doc = $_POST['datadoc'];
$luogo_doc = $_POST['luogodoc'];
$ente_doc = $_POST['entedoc'];

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

//Verifico se il dato è stato inserito
if($nome){
	//Aggiorno nome utente nel database
	$query = "UPDATE utente SET nome = '$nome' WHERE nome_utente='$user'";

	//Esecuzione della query  
    if (!$mysqli->query($query)) {
        die($mysqli->error);
	}
}

//Verifico se il dato è stato inserito
if($cognome){
	//Aggiorno cognome utente nel database
	$query = "UPDATE utente SET cognome = '$cognome' WHERE nome_utente='$user'";

	//Esecuzione della query  
    if (!$mysqli->query($query)) {
        die($mysqli->error);
    }
}

//Verifico se il dato è stato inserito
if($email){
	//Aggiorno email utente nel database
	$query = "UPDATE utente SET email = '$email' WHERE nome_utente='$user'";

	//Esecuzione della query  
    if (!$mysqli->query($query)) {
        die($mysqli->error);
    }
}

//Verifico se il dato è stato inserito
if($indirizzo){
	//Aggiorno indirizzo utente nel databasase
	$query = "UPDATE utente SET indirizzo = '$indirizzo' WHERE nome_utente='$user'";

	//Esecuzione della query  
    if (!$mysqli->query($query)) {
        die($mysqli->error);
    }
}

//Verifico se il dato è stato inserito
if($tel){
	//Aggiorno telefono utente nel database
	$query = "UPDATE utente SET tel = '$tel' WHERE nome_utente='$user'";

	//Esecuzione della query  
    if (!$mysqli->query($query)) {
        die($mysqli->error);
    }
}

//Verifico se il dato è stato inserito
if($num_doc){
	//Aggiorno numero documento utente database
	$query = "UPDATE utente SET num_doc = '$num_doc' WHERE nome_utente='$user'";

	//Esecuzione della query  
    if (!$mysqli->query($query)) {
        die($mysqli->error);
    }
}

//Verifico se il dato è stato inserito
if($data_doc){
	//Aggiorno data rilascio del documento nel database
	$query = "UPDATE utente SET data_doc = '$data_doc' WHERE nome_utente='$user'";

	//Esecuzione della query  
    if (!$mysqli->query($query)) {
        die($mysqli->error);
	}
}

//Verifico se il dato è stato inserito
if($luogo_doc){
	//Aggiorno luogo rilascio documento nel database
	$query = "UPDATE utente SET luogo_doc = '$luogo_doc' WHERE nome_utente='$user'";

	//Esecuzione della query  
    if (!$mysqli->query($query)) {
        die($mysqli->error);
    }
}

//Verifico se il dato è stato inserito
if($ente_doc){
	//Aggiorno ente di rilasio del documento nel databasase
	$query = "UPDATE utente SET ente_doc = '$ente_doc' WHERE nome_utente='$user'";

	//Esecuzione della query  
    if (!$mysqli->query($query)) {
        die($mysqli->error);
    }
}

//Verifico se il dato è stato inserito
if($password){
	//Aggiorno password utente nel database
	$query = "UPDATE utente SET password = '$password' WHERE nome_utente='$user'";
	//Esecuzione della query  
    if (!$mysqli->query($query)) {
        die($mysqli->error);
    
	}
}

 header('Location: http://localhost/progetto/profilo.php');
    
//Chiusura della connessione
$mysqli->close();

?>