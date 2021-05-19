<?php 
	error_reporting(E_ALL &~E_NOTICE);
	require_once("./connessione1.php");
	$msg="";
	
	session_start();
	if (!isset($_SESSION['accessoPermesso'])) 
		header('Location: login.php');
	
	if(isset($_POST['invio'])){
		if($_POST['testo']){
			$sql = "INSERT INTO $post_table_name (user, testo, file) VALUES ('{$_SESSION['userName']}', '{$_POST['testo']}', '{$_POST['file']}')";
			
			if(!($resultQ = mysqli_query($connection, $sql))){
				printf("<p>Si è verificato un problema!<br />Impossibile pubblicare il post\n</p>");
				exit();
			}
			$msg = "<p>Post pubblicato con successo!</p>";
			$connection->close();
			header("Location : inizio.php");
		}
	}
?>

