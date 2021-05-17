<?php 
error_reporting(E_ALL &~E_NOTICE);

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head> <title> Sign-Up to Cesiogram </title> </head>
	
	<body>
		<h2> Crea il tuo account Cesiogram </h2>
		
		<?php
			$db_name = "cesioDB";
			$user_table_name = "Users";
			
			//CONNESSIONE DB
			$connection = new mysqli("localhost", "cesio", "cesio", $db_name);
			
			//VERIFICA CONNESSIONE DB
			if (mysqli_connect_errno()) {
				printf("Errore di connessione al db: %s\n", mysqli_connect_error($connection));
				exit();
			}
			
			
			if(isset($_POST['invio'])) {
				if(($_POST['nome']) && ($_POST['cognome']) && ($_POST['userName'])
				  && ($_POST['password']) && ($_POST['email']) && ($_POST['dataNascita']) && $_POST['sesso']) {
					  $sql = "INSERT INTO $user_table_name 
							 (userName, password, nome, cognome, dataNascita, email, sesso,
							 professione, bio, img)
							 VALUES
							 ('{$_POST['userName']}', '{$_POST['password']}','{$_POST['nome']}','{$_POST['cognome']}',
							 '{$_POST['dataNascita']}','{$_POST['email']}','{$_POST['sesso']}','{$_POST['professione']}',
							 '{$_POST['bio']}','{$_POST['img']}')
							 ";
							 
							//CONTROLLO QUERY
							if(!($resultQ = mysqli_query($connection, $sql))) {
								printf("Si è verificato un problema. Impossibile registrarsi.\n");
								exit();
							}
							
							echo "<h3> Registrazione avvenuta con successo!</h3>";
				}
			}
			
			//CHIUSURA CONNESSIONE
			$connection->close();		
		?>
		
		<form action = "signup.php" method = "POST">
			<p> Nome*:
				<input type = "text" name = "nome" size = "30">
			</p>
			
			<p> Cognome*: 
				<input type = "text" name = "cognome" size = "30">
			</p>
		
			<p> Data di nascita*: 
				<input type = "date" name = "dataNascita">
			</p>
			
			<p>
				Sesso*:
				<input type = "radio" name = "sesso" value = "M"> M 
				<input type = "radio" name = "sesso" value = "F"> F 
				<input type = "radio" name = "sesso" value = "NULL"> Non specificato 
			</p>
			
			<p> Professione
				<input type = "text" name = "professione" size = "30">
			</p>
			
			<p> Username*:
				<input type = "text" name = "userName" size = "30">
			</p>
			
			<p> Password*:
				<input type = "password" name = "password" size = "30">
			</p>
			
			<p> E-mail*:
				<input type = "text" name = "email" size = "30">
			</p>
			
			<p> 
				<textarea rows = "7" cols = "40" name = "bio"> Inserisci una breve descrizione di te... </textarea>
			</p>
			
			<p> Immagine del profilo:
				<input type = "file" name = "img" accept = "image/*">
			</p>
			
			<p>
				<input type = "submit" name = "invio" value = "Registrati">
			</p>
	</body>
</html>