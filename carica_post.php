<?php 
error_reporting(E_ALL &~E_NOTICE);
require_once("./connessione1.php");
session_start();

if (!isset($_SESSION['accessoPermesso'])) header('Location: login.php');

	//PUBBLICAZIONE POST
	if(isset($_POST['invio'])) {
		if($_POST['testo']) {
			
			$sql = "INSERT INTO $post_table_name (user, testo, file) 
					VALUES ('{$_SESSION['userName']}', '{$_POST['testo']}', '{$_POST['file']}')";
					
			//CONTROLLO QUERY		
			if(!($resultQ = mysqli_query($connection, $sql))) {
				printf("Si è verificato un problema. Impossibile pubblicare il post.\n");
				exit();
			}
	$msg = "<p> Post pubblicato con successo!</p>";		
	
	$connection->close();
	header("Location: inizio.php");
		}
	}
?>

