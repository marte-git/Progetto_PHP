<?php 
error_reporting(E_ALL &~E_NOTICE);
require_once("./connessione1.php");
session_start();

if (!isset($_SESSION['accessoPermesso'])) header('Location: login.php');

$_SESSION['msg'] = "";
	//PUBBLICAZIONE POST
	if(isset($_POST['invio'])) {
		if($_POST['testo']) {
			
			$sql = "INSERT INTO $post_table_name (user, testo) 
					VALUES ('{$_SESSION['userName']}', '{$_POST['testo']}')";
					
			//CONTROLLO QUERY		
			if(!($resultQ = mysqli_query($connection, $sql))) {
				printf("Si è verificato un problema. Impossibile pubblicare il post.\n");
				exit();
			}		
	$connection->close();
	header("Location: inizio.php");
		}
	}
?>

