<?php
	error_reporting(E_ALL &~E_NOTICE);
	session_start();

	require_once("./connessione1.php");


	if (!isset($_SESSION['accessoPermesso'])) header('Location: login.php');	


if(isset($_POST['eliminando'])) {
		$sql = "DELETE FROM $post_table_name 
				WHERE postId = '{$_POST['eliminando']}'
				";
	if(!($resultQ = mysqli_query($connection , $sql))) {
		printf("<p>Errore</p>\n");
		exit();
	}
	$connection->close();
	header("Location: inizio.php");
}
 
?>


