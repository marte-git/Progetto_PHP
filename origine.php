<?php 
	echo '<?xml version="1.0" encoding="UTF-8"?>'; 
	error_reporting(E_ALL &~E_NOTICE);
	require_once("./style.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title> Creazione e popolazione DB </title>
		<?php echo $stile ?>
	</head>
	
	<body>
		<h1> Cesio DB </h1>
		
		<?php
			$db_name = "lweb9";
			$user_table_name = "Users";
			$post_table_name = "Posts";
			$prodotti_table_name = "Prodotti";
			
			
		
		//CREAZIONE TABELLE DB
			//Apertura connessione con il collegamento al db appena creato
			$connection = new mysqli("localhost", "lweb9", "lweb9", $db_name);
			//controllo connessione
			if(mysqli_connect_errno()){
				printf("<h3>Errore di connessione al db: %s</h3>\n", mysqli_connect_error());
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
			$sqlQuery .= "sommeSpese float ";
			$sqlQuery .= ");";
			
			//echo "<pre>$sqlQuery </pre>";
			
			//verifica creazione tabella Users
			if($resultQ = mysqli_query($connection, $sqlQuery))
				printf("<h3>Tabella Users creata con successo</h3>\n");
			else{
				printf("<h3>Creazione tabella Users fallita!</h3>");
				exit();
			}
			
			//creazione tabella Posts
			$sqlQuery = "CREATE TABLE if not exists $post_table_name (";
			$sqlQuery .= "postId int NOT NULL auto_increment, primary key(postId), ";
			$sqlQuery .= "user varchar(15) NOT NULL, foreign key(user) references $user_table_name(userName), ";
			$sqlQuery .= "testo varchar(200) NOT NULL ";
			$sqlQuery .= ");";
			
			//echo "<pre>$sqlQuery</pre>";
			
			//verifica creazione tabella Posts
			if($resultQ = mysqli_query($connection, $sqlQuery))
				printf("<h3>Tabella Posts creata con successo</h3>\n");
			else{
				printf("<h3>Creazione tabella Posts fallita!</h3>");
				exit();
			}
			
			//creazione tabella prodotti_table_name
			$sqlQuery = "CREATE TABLE if not exists $prodotti_table_name (";
			$sqlQuery .= "prodottiId int NOT NULL auto_increment, primary key(prodottiId), ";
			$sqlQuery .= "nome varchar(100) NOT NULL, ";
			$sqlQuery .= "costo float NOT NULL );";
			

			
			//verifica creazione tabella
			if($resultQ = mysqli_query($connection, $sqlQuery))
				printf("<h3>Tabella prodotti creata con successo<h3/>\n");
			else{
				printf("<h3>Creazione tabella prodotti fallita</h3>\n");
				exit();
			}
			
			//echo "<p>".mysqli_errno($connection)."</p>";
			
		//POPOLAMENTO DB
			//popolamento Users
			$sql = "INSERT INTO $user_table_name
					(userName, password, nome, cognome, dataNascita, email, sesso, professione,sommeSpese, bio)
					VALUES
					(\"xrushofblood\", \"1234\", \"Angelica\", \"Della Vecchia\", \"1997-10-05\", \"angelica@mail.it\", \"F\", \"Studente\", \"0\", \"Sono una ragazza solare, e mi piacciono i gatti\")";
			if($resultQ = mysqli_query($connection, $sql)){
				printf("<p>User inserito correttamente</p>\n");
			}else{
				printf("<p>Errore inserimento user!</p>\n");
				exit();
			}
			
			$sql = "INSERT INTO $user_table_name
					(userName, password, nome, cognome, dataNascita, email, sesso, professione, sommeSpese, bio)
					VALUES
					(\"simonemessi\", \"5678\", \"Simone\", \"Orelli\", \"1997-09-13\", \"simone@mail.it\", \"M\", \"Studente\", \"0\", \"Sono un ragazzo pensieroso, e mi piacciono i cani\")";
			if($resultQ = mysqli_query($connection, $sql)){
				printf("<p>User inserito correttamente</p>\n");
			}else{
				printf("<p>Errore inserimento user!</p>\n");
				exit();
			}
			
			//popolamento Posts
			$sql = "INSERT INTO $post_table_name (postId, user, testo) VALUES (\"1\", \"xrushofblood\", \"Tante care cose\")";
			if($resultQ = mysqli_query($connection, $sql)){
				printf("<p>Post inserito correttamente</p>\n");
			}else{
				printf("<p>Errore nel caricamento post!</p>\n");  
				exit();
			}
			
			$sql = "INSERT INTO $post_table_name (postId, user, testo) VALUES (\"2\", \"simonemessi\", \"Oggi fa freddissimo!\")";
			if($resultQ = mysqli_query($connection, $sql)){
				printf("<p>Post inserito correttamente</p>\n");
			}else{
				printf("<p>Errore nel caricamento post!</p>\n");  
				exit();
			}
			
			//popolamento Prodotti
			$sql = "INSERT INTO $prodotti_table_name (nome, costo) VALUES (\"Fotocamera Reflex Canon EOS 90D\", '1085.00')";
			if($resultQ = mysqli_query($connection, $sql)){
				printf("<p>Prodotto inserito correttamente</p>\n");
			}else{
				printf("<p>Errore durante l'inserimento del prodotto</p>\n");
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo) VALUES (\"Cavalletto 269PU Super Stand Alu Bk\", '283.00')";
			if($resultQ = mysqli_query($connection, $sql)){
				printf("<p>Prodotto inserito correttamente</p>\n");
			}else{
				printf("<p>Errore durante l'inserimento del prodotto</p>\n");
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo) VALUES (\"Fotocamera Canon EOS 4000D\", '459.00')";
			if($resultQ = mysqli_query($connection, $sql)){
				printf("<p>Prodotto inserito correttamente</p>\n");
			}else{
				printf("<p>Errore durante l'inserimento del prodotto</p>\n");
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo) VALUES (\"Fotocamera Nikon coolpix b500\", '267.00')";
			if($resultQ = mysqli_query($connection, $sql)){
				printf("<p>Prodotto inserito correttamente</p>\n");
			}else{
				printf("<p>Errore durante l'inserimento del prodotto</p>\n");
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo) VALUES (\"Obiettivo TOP-MAX 420-800mm\", '119.00')";
			if($resultQ = mysqli_query($connection, $sql)){
				printf("<p>Prodotto inserito correttamente</p>\n");
			}else{
				printf("<p>Errore durante l'inserimento del prodotto</p>\n");
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo) VALUES (\"Obiettivo Tamron TA025E Universale per Canon\", '1116.83')";
			if($resultQ = mysqli_query($connection, $sql)){
				printf("<p>Prodotto inserito correttamente</p>\n");
			}else{
				printf("<p>Errore durante l'inserimento del prodotto</p>\n");
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo) VALUES (\"Cavalletto treppiede leggero estensibile, con custodia\", '20.14')";
			if($resultQ = mysqli_query($connection, $sql)){
				printf("<p>Prodotto inserito correttamente</p>\n");
			}else{
				printf("<p>Errore durante l'inserimento del prodotto</p>\n");
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo) VALUES (\"Luci Neewer 700W 60x60 cm soft box\", '97.99')";
			if($resultQ = mysqli_query($connection, $sql)){
				printf("<p>Prodotto inserito correttamente</p>\n");
			}else{
				printf("<p>Errore durante l'inserimento del prodotto</p>\n");
				exit();
			}
			
			$sql = "INSERT INTO $prodotti_table_name (nome, costo) VALUES (\"Flash Aputure LS C120d II kit\", '799.00')";
			if($resultQ = mysqli_query($connection, $sql)){
				printf("<p>Prodotto inserito correttamente</p>\n");
			}else{
				printf("<p>Errore durante l'inserimento del prodotto</p>\n");
				exit();
			}
		?>
	</body>
</html>