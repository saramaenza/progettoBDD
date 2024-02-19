<?php
//Apro la sessione 
session_start();

//Recupero nome utente 
$user = $_SESSION['user'];

//connessione al database
$mysqli = new mysqli("localhost", "root", "", "progetto");

//Verifica su eventuali errori di connessione
if ($mysqli->connect_error) {
	echo "Connessione fallita: ". $mysqli->connect_error . ".";
	exit();
}  

//autocompletamento
if(isset($_REQUEST["term"])){
    //query recupero nome utente cercato (che sia diverso da user)
    $sql = "SELECT * FROM blog WHERE nome_utente<>'$user' AND nome_utente LIKE ?";
    
    if($stmt = mysqli_prepare($mysqli, $sql)){
       
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        
        //imposta parametri
        $param_term = $_REQUEST["term"] . '%';
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            
            //Controlla il numero di valori risultati
            if(mysqli_num_rows($result) > 0){	//ci sono risultati
                // Recupera le righe dei risultati come un array associativo
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    echo "<p>" . $row["nome_utente"] . "</p>";
                }
            } else{
                echo "<p>Nessun risultato</p>";
            }
        } else{
            echo "ERRORE" . mysqli_error($mysqli);
        }
    }
     
    mysqli_stmt_close($stmt);
}
 
//chiudi connessione
mysqli_close($mysqli);

?>