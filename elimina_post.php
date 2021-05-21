<?php
	error_reporting(E_ALL &~E_NOTICE);
	require_once("./connessione1.php");
	
	session_start();
	if (!isset($_SESSION['accessoPermesso'])) 
		header('Location: login.php');
	
	if(isset($_POST['eliminando'])){
		$sql = "DELETE FROM $post_table_name WHERE postId = '{$_POST['eliminando']}'";
		
		if(!$resultQ = mysqli_query($connection, $sql)){
			printf("<p>Errore!</p>");
			exit();
		}
		$_SESSION['eliminando'] = 0;
		$connection->close();
		header("Location: inizio.php");
	}



?>