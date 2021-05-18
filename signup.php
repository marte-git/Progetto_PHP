<?php 
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	error_reporting(E_ALL &~E_NOTICE);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Signup to Cesiogram</title>
	</head>

	<body>
		<h1> Crea il tuo account Cesiogram </h1>
		
		<?php
			$db_name = "CesioDB";
			$user_table_name = "Users";
			
			//connessione al db
			$connection = new mysqli("localhost", "cesio", "cesio", $db_name);
			
			//verifica connessione db
			if(mysqli_connect_errno()){
				printf("Errore di connessione al db: %s\n", mysqli_connect_error($connection));
				exit();
			}
			if(isset($_POST['invio'])){
				if($_POST['nome'] && $_POST['cognome'] && $_POST['userName'] && $_POST['password'] && $_POST['dataNascita'] && $_POST['email']){
					$sql = "INSERT INTO $user_table_name(userName, password, nome, cognome, dataNascita, email, sesso, professione, bio, img) VALUES ('{$_POST['userName']}','{$_POST['password']}','{$_POST['nome']}','{$_POST['cognome']}','{$_POST['dataNascita']}','{$_POST['email']}','{$_POST['sesso']}','{$_POST['professione']}','{$_POST['bio']}','{$_POST['img']}')";
				
					//controllo query
					if (!$resultQ = mysqli_query($connection, $sql)) {
						printf("Si è verificato un problema!<br />Impossibile registrarsi\n");
						exit();
					}
				
					echo "<h3> Registrazione avvenuta con successo </h3>\n";
				}
			}
			
			//chiusura della connessione
			$connection->close();
			
		?>
		<p><em>(*) Campi obbligatori.</em></p>
		<h2> Signup </h2>
		<form action="signup.php" method="post">
			<p>
				Nome*: <input type="text" name="nome" size="30">
			</p>
			<p>
				Cognome*: <input type="text" name="cognome" size="30">
			</p>
			<p>
				Data di nascita*: <input type="date" name="dataNascita" size="100">
			</p>
			<p>
				Sesso*: <input type="radio" name="sesso" value="M" size="100">M <input type="radio" name="sesso" value="F" size="100">F <input type="radio" name="sesso" value="NULL"> Non specificato
			</p>
			<p>
				Username*: <input type="text" name="userName" size="30">
			</p>
			<p>
				E-mail*: <input type="text" name="email" size="30">
			</p>
			<p>
				Password*: <input type="password" name="password" size="30">
			</p>
			<p>
				Professione: <input type="text" name="professione" size="30">
			</p>
			<p>
				<textarea rows="7" cols="40" name="bio">Inserisci una breve descrizione di te...</textarea>
			</p>
			<p>
				Immagine del profilo: <input type="file" name="img" accept="image/*">
			</p>
			<p>
				<input type="submit" name="invio" value="Signup">
				<input type="reset" name="reset" value="Ripristina">
			</p>
		
		</form>
		
		<p> Hai gi&agrave; un account? <a href="login.php"> Sign in </a></p>
	</body>
</html>