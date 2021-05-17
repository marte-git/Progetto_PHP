<?php
	$db_name = "cesioDB";
	$user_table_name = "Users";
	$post_table_name = "Posts";
	
	$connection = new mysqli("localhost", "cesio", "cesio", $db_name);
	
	if(mysqli_connect_errno()){
		printf("Errore di connessione al database: %s", mysqli_connect_error($connection));
		exit();
	}
?>