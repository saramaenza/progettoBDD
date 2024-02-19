<?php
//logout  
session_start();

$_SESSION=array(); // Desetta tutte le variabili di sessione.

session_destroy(); //DISTRUGGE la sessione.

 header('Location: http://localhost/progetto/home.php');
?>