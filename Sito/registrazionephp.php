<?php
//Recupero i valori inseriti nel form
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
$nome_utente = $_POST['nome_utente'];
$password = $_POST['password'];
$indirizzo = $_POST['indirizzo'];
$tel = $_POST['telefono'];
$num_doc = $_POST['numdoc'];
$data_doc = $_POST['datadoc'];
$luogo_doc = $_POST['luogodoc'];
$ente_doc = $_POST['entedoc'];

//Connessione al DB utilizzando MySQLi
$mysqli = new mysqli("localhost", "root", "", "progetto");

//Verifica su eventuali errori di connessione
if ($mysqli->connect_error) {
	echo "Connessione fallita: ". $mysqli->connect_error . ".";
	exit();
}

//query controllo se l'usurname inserito è già presente nel database
$q = "SELECT COUNT(*) FROM utente WHERE nome_utente = '$nome_utente'";
$o =$mysqli->query($q);
$row = $o->fetch_array(MYSQLI_NUM);

//query controllo se email inserita è già presente nel database
$q2 = "SELECT COUNT(*) FROM utente WHERE email = '$email'";
$o2 =$mysqli->query($q2);
$row2 = $o2->fetch_array(MYSQLI_NUM);


if($row[0]>0 && $row2[0]>0){	//l'email e il nome utente inseriti sono già presenti nel database, stampa errore
	header("Location: http://localhost/progetto/registrazione.php?erroreuser=1&erroreemail=1");
}
else if($row[0]>0){				//il nome utente inserito è già presente nel database, stampa errore
	header("Location: http://localhost/progetto/registrazione.php?erroreuser=1&erroreemail=0");
}
else if($row2[0]>0){		//l'email inserita è già presente nel database, stampa errore
	header("Location: http://localhost/progetto/registrazione.php?erroreuser=0&erroreemail=1");
}
else {		//email e nome utente inseriti non sono presenti nel database
	//Definisco la query di inserimento dati
	$query = "INSERT INTO utente (nome_utente, nome, cognome, password, indirizzo, tel, email, num_doc, data_doc, luogo_doc, ente_doc) VALUES ('$nome_utente','$nome', '$cognome', '$password', '$indirizzo', '$tel', '$email', '$num_doc', '$data_doc', '$luogo_doc', '$ente_doc')";

	//Esecuzione della query  
	if (!$mysqli->query($query)) {
		die($mysqli->error);
	}
	
	header('Location: http://localhost/progetto/profilo.php');
}

//Apro la sessione 
session_start();

//Salvo i dati
$_SESSION['user'] = $nome_utente;
$_SESSION['password'] = $password;

//Chiusura della connessione
$mysqli->close();

?>