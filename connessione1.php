<?php
	$db_name = "cesioDB";
	$user_table_name = "Users";
	$post_table_name = "Posts";
	$prodotti_table_name = "Prodotti";
	
	//TENTATIVO DI CONNESSIONE
	$connection = new mysqli("localhost", "cesio", "cesio", $db_name);
	
	//CONTROLLO CONNESSIONE
	if(mysqli_connect_errno()) {
		printf("Errore di connessione al db: %s\n", mysqli_connect_error($connection));
		exit();
	}
?>