<?php
//Apro la sessione 
session_start();

//Recupero email e password dal form
$user = $_POST['nomeutente'];
$pass = $_POST['password'];

//Salvo i dati
$_SESSION['user'] = $user;
$_SESSION['password'] = $pass;

//Connessione al DB utilizzando MySQLi
$mysqli = new mysqli("localhost", "root", "", "progetto");

//controllo se il nome utente e la password inseriti sono presente nel database
$query = $mysqli->query("SELECT * FROM utente WHERE nome_utente = '$user' AND password = '$pass'");
if($query->num_rows) {
    header('Location: http://localhost/progetto/profilo.php');
} else {
   header('Location: http://localhost/progetto/accesso.html');
}
?>



