<?php 
	echo '<?xml version="1.0" encoding="UTF-8"?>'; 
	error_reporting(E_ALL &~E_NOTICE);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title> Creazione e popolazione DB </title>
	</head>
	
	<body>
		<h2> Cesio DB </h2>
		
		<?php
		//CREAZIONE DB
			$db_name = "CesioDB";
			$user_table_name = "Users";
			$post_table_name = "Posts";
			
			//Connessione al database
			$connection = new mysqli("localhost", "cesio", "cesio");
		
			//Controllo connessione
			if(mysqli_connect_errno())
				printf("Errore di connessione al db: %s\n", mysqli_connect_error());
				
			//Creazione del database
			$queryCreazioneDB = "CREATE DATABASE $db_name";
			if($resultQ = mysqli_query($connection, $queryCreazioneDB)){
				printf("Database creato con successo!\n");
			}else{
				printf("Errore durante la creazione del database!\n");
			}
			
			//Chiusura connessione
			$connection->close();
		
		//CREAZIONE TABELLE DB
			//Apertura connessione con il collegamento al db appena creato
			$connection = new mysqli("localhost", "cesio", "cesio", $db_name);
			//controllo connessione
			if(mysqli_connect_errno()){
				printf("Errore di connessione al db: %s\n", mysqli_connect_error());
				exit();
			}
			
			//creazione tabella Users
			$sqlQuery = "CREATE TABLE if not exists $user_table_name(";
			$sqlQuery .= "userName varchar(15) NOT NULL, primary key(userName),";
			$sqlQuery .= "password varchar(15) NOT NULL,";
			$sqlQuery .= "nome varchar(20) NOT NULL,";
			$sqlQuery .= "cognome varchar(20) NOT NULL,";
			$sqlQuery .= "dataNascita DATE NOT NULL,";
			$sqlQuery .= "email varchar(30) NOT NULL,";
			$sqlQuery .= "sesso varchar(5),";
			$sqlQuery .= "professione varchar(30),";
			$sqlQuery .= "bio varchar(140), ";
			$sqlQuery .= "img BLOB";
			$sqlQuery .= ");";
			
			echo "<pre> $sqlQuery </pre>";
			
			//verifica creazione tabella Users
			if($resultQ = mysqli_query($connection, $sqlQuery))
				printf("Tabella Users creata con successo\n");
			else{
				printf("Creazione tabella Users fallita!");
				exit();
			}
			
			//creazione tabella Posts
			$sqlQuery = "CREATE TABLE if not exists $post_table_name (";
			$sqlQuery .= "postId int NOT NULL auto_increment, primary key(postId), ";
			$sqlQuery .= "user varchar(15) NOT NULL, foreign key(user) references $user_table_name(userName), ";
			$sqlQuery .= "testo varchar(200) NOT NULL, ";
			$sqlQuery .= "file BLOB ";
			//vedere se implementare l'ora di pubblicazione
			$sqlQuery .= ");";
			
			echo "<pre>$sqlQuery</pre>";
			
			//verifica creazione tabella Posts
			if($resultQ = mysqli_query($connection, $sqlQuery))
				printf("Tabella Posts creata con successo\n");
			else{
				printf("Creazione tabella Posts fallita!");
				exit();
			}
			
			echo "<p style=\"display:none\">".mysqli_errno($connection)."</p>";
			
		//POPOLAMENTO DB
			//popolamento Users
			$sql = "INSERT INTO $user_table_name
					(userName, password, nome, cognome, dataNascita, email, sesso, professione, bio)
					VALUES
					(\"xrushofblood\", \"1234\", \"Angelica\", \"Della Vecchia\", \"1997-10-05\", \"angelica@mail.it\", \"F\", \"Studente\", \"Sono una ragazza solare, e mi piacciono i gatti\")";
			if($resultQ = mysqli_query($connection, $sql)){
				echo "<br />";
				printf("User inserito correttamente\n");
			}else{
				echo "<br />";
				printf("Errore inserimento user!\n");
				exit();
			}
			
			$sql = "INSERT INTO $user_table_name
					(userName, password, nome, cognome, dataNascita, email, sesso, professione, bio)
					VALUES
					(\"simonemessi\", \"5678\", \"Simone\", \"Orelli\", \"1997-09-13\", \"simone@mail.it\", \"M\", \"Studente\", \"Sono un ragazzo solare, e mi piacciono i Pokémon\")";
			if($resultQ = mysqli_query($connection, $sql)){
				echo "<br />";
				printf("User inserito correttamente\n");
			}else{
				echo "<br />";
				printf("Errore inserimento user!\n");
				exit();
			}
		?>
	</body>
</html>