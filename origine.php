<?php		
error_reporting(E_ALL &~E_NOTICE);	//
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	
	<head> <title> Creazione e popolamento DB </title> </head>
	
	<body> 
		<h2> Creazione e popolamento di CesioDB </h2>
	
	
		<?php 
		//CREAZIONE DB
			$db_name = "CesioDB";
			$user_table_name = "Users";
			$post_table_name = "Posts";
			$prodotti_table_name = "Prodotti";
			
			//CONNESSIONE AL DB
			$connection = new mysqli("localhost", "cesio", "cesio");
			
			//CONTROLLO CONNESSIONE
			if(mysqli_connect_errno()) {
				printf("Errore di connessione al db: %s\n" ,  mysqli_connect_error());
			}
			
			$queryCreazioneDB = "CREATE DATABASE $db_name"; 
			
			if($resultQ = mysqli_query($connection , $queryCreazioneDB)) {
				printf("Database creato con successo!\n");
			}
			else {
				printf("Errore durante la creazione del database\n"); 
			}
			
			//CHIUSURA CONNESSIONE
			$connection->close();
			
		//CREAZIONE TABELLE	
			//APERTURA CONNESSIONE AL DB CREATO 
			$connection = new mysqli("localhost", "cesio", "cesio" , $db_name);
			
			//CONTROLLO CONNESSIONE
			if(mysqli_connect_errno()) {
				printf("Problemi di connessione al db: %s\n" ,  mysqli_connect_error());
				exit();
			}
			
			//CREAZIONE TABELLA USERS
			
			$sqlQuery = "CREATE TABLE if not exists $user_table_name (";
			$sqlQuery.= "userName varchar (15) NOT NULL, primary key (userName), ";
			$sqlQuery.= "password varchar (32) NOT NULL, ";
			$sqlQuery.= "nome varchar (20) NOT NULL, ";
			$sqlQuery.= "cognome varchar (20) NOT NULL, ";
			$sqlQuery.= "dataNascita DATE NOT NULL, "; 
			$sqlQuery.= "email varchar(30) NOT NULL, "; 
			$sqlQuery.= "sesso varchar(5), ";
			$sqlQuery.= "professione varchar(30), ";
			$sqlQuery.= "bio varchar(140), ";
			$sqlQuery.= "img BLOB, ";
			$sqlQuery.= "sommeSpese float ";
			$sqlQuery.= ");";
			
			echo "<pre> $sqlQuery </pre>";
			
			//VERIFICA CREAZIONE TABELLA USERS
			if ($resultQ = mysqli_query($connection, $sqlQuery)) 
				printf("Tabella Users creata con successo!\n");
			else {
				printf("Creazione tabella Users fallita\n");
				exit();
			}
			
			//CREAZIONE TABELLA POSTS
			$sqlQuery = "CREATE TABLE if not exists $post_table_name (";
			$sqlQuery.= "postId int NOT NULL auto_increment, primary key (postId), ";
			$sqlQuery.= "user varchar(15) NOT NULL, foreign key (user) references $user_table_name(userName), ";
			$sqlQuery.= "testo varchar(200) NOT NULL, ";
			$sqlQuery.= "file BLOB ";
			//ora di pubblicazione (?)
			$sqlQuery.= ");";
			
			echo "<pre> $sqlQuery </pre>";
			
			//VERIFICA CREAZIONE TABELLA POSTS
			if ($resultQ = mysqli_query($connection, $sqlQuery)) 
				printf("Tabella Posts creata con successo!\n");
			else {
				printf("Creazione tabella Posts fallita\n");
				exit();
			}
			
			//echo mysqli_errno($connection);
			
			//CREAZIONE TABELLA PRODOTTI
			$sqlQuery = "CREATE TABLE if not exists $prodotti_table_name (";
			$sqlQuery.= "prodottiId int NOT NULL auto_increment, primary key (prodottiId), ";
			$sqlQuery.= "nome varchar(100) NOT NULL, ";
			$sqlQuery.= "costo float NOT NULL )";
			
			echo "<pre> $sqlQuery </pre>";
			
			//VERIFICA CREAZIONE TABELLA
			if($resultQ = mysqli_query($connection, $sqlQuery)) 
				echo "<p>Tabella Prodotti creata con successo!</p>\n";
			else {
				echo "<p>Creazione tabella Prodotti fallita</p>\n";
				exit();
			}		
			
		
		//POPOLAMENTO 
			//POPOLAMENTO USERS
			$sql = "INSERT INTO $user_table_name
			(userName, password, nome, cognome, dataNascita, email, sesso, 
			professione, sommeSpese, bio)
			VALUES
			(\"xrushofblood\", \"1234\", \"Angelica\", \"Della Vecchia\", 
			\"1997-10-05\", \"angelica@mail.it\", \"F\", \"Studente\", \"0\",
			\"Sono una ragazza solare, e mi piacciono i gatti\")";
			
			if($resultQ = mysqli_query($connection, $sql)) 
				echo "<p>User inserito correttamente!</p>\n";
			else {
				echo "<p>Errore inserimento user</p>\n";
				exit();
			}
			
			$sql = "INSERT INTO $user_table_name 
			(userName, password, nome, cognome, dataNascita, email, sesso, 
			professione, sommeSpese, bio)
			VALUES
			(\"simonemessi\", \"5678\", \"Simone\", \"Orelli\", \"1997-09-13\", 
			\"simone@mail.it\", \"M\", \"Studente\", \"0\",
			\"Sono un ragazzo nuvoloso e mi piacciono i Pokémon!\")";
			
			if($resultQ = mysqli_query($connection, $sql)) 
				echo "<p>User inserito correttamente!</p>\n";
			else {
				echo "<p>Errore inserimento user</p>\n";
				exit();
			}	
			
			//POPOLAMENTO POSTS 
			$sql = "INSERT INTO $post_table_name
					(postId, user, testo) 
					VALUES 
					(\"1\", \"simonemessi\", \"che bella giornata\")
					";
			
			if($resultQ = mysqli_query($connection, $sql)) 
				echo "<p> Post inserito correttamente!</p>\n";
			
			else {
				echo "<p> Errore inserimento post </p>\n";
				exit();
			}
			
			//POPOLAMENTO PRODOTTI
			$sql = "INSERT INTO $prodotti_table_name (nome, costo)
					VALUES
					(\"Fotocamera Reflex Canon EOS 90D\" , \"1085.00\")";
			if($resultQ = mysqli_query($connection, $sql)) 
				echo "<p> Prodotto inserito correttamente!</p>\n";
			else {
				echo "<p> Errore inserimento prodotto </p>\n";
				exit();
			}
				
			$sql = "INSERT INTO $prodotti_table_name (nome, costo)
					VALUES
					(\"Cavalletto 269BU Super Stand Alu Bk\" , \"283.00\")";
			if($resultQ = mysqli_query($connection, $sql)) 
				echo "<p> Prodotto inserito correttamente!</p>\n";
			else {
				echo "<p> Errore inserimento prodotto </p>\n";
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo)
					VALUES
					(\"Fotocamera Canon EOS 4000D 18-55\" , \"459.00\")";
			if($resultQ = mysqli_query($connection, $sql)) 
				echo "<p> Prodotto inserito correttamente!</p>\n";
			else {
				echo "<p> Errore inserimento prodotto </p>\n";
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo)
					VALUES
					(\"Fotocamera Nikon coolpix b500 \" , \"267.00\")";
			if($resultQ = mysqli_query($connection, $sql)) 
				echo "<p> Prodotto inserito correttamente!</p>\n";
			else {
				echo "<p> Errore inserimento prodotto </p>\n";
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo)
					VALUES
					(\"Obiettivo TOP-MAX 420-800mm\" , \"119.00\")";
			if($resultQ = mysqli_query($connection, $sql)) 
				echo "<p> Prodotto inserito correttamente!</p>\n";
			else {
				echo "<p> Errore inserimento prodotto </p>\n";
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo)
					VALUES
					(\"Obiettivo Tamron TA025E Univerale per Canon\" , \"1116.83\")";
			if($resultQ = mysqli_query($connection, $sql)) 
				echo "<p> Prodotto inserito correttamente!</p>\n";
			else {
				echo "<p> Errore inserimento prodotto </p>\n";
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo)
					VALUES
					(\"Cavalletto treppiede leggero estensibile, con custodia\" , \"20.14\")";
			if($resultQ = mysqli_query($connection, $sql)) 
				echo "<p> Prodotto inserito correttamente!</p>\n";
			else {
				echo "<p> Errore inserimento prodotto </p>\n";
				exit();
			}
				
			$sql = "INSERT INTO $prodotti_table_name (nome, costo)
					VALUES
					(\"Luci Neewer 700W 60x60cm SoftBox\" , \"97.99\")";
			if($resultQ = mysqli_query($connection, $sql)) 
				echo "<p> Prodotto inserito correttamente!</p>\n";
			else {
				echo "<p> Errore inserimento prodotto </p>\n";
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo)
					VALUES
					(\"Flash Aputure LS C120d II kit\" , \"799.00\")";
			if($resultQ = mysqli_query($connection, $sql)) 
				echo "<p> Prodotto inserito correttamente!</p>\n";
			else {
				echo "<p> Errore inserimento prodotto </p>\n";
				exit();
			}
		?>		
	</body>
</html>