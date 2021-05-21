<?php 
	echo '<?xml version="1.0" encoding="UTF-8"?>';
	error_reporting(E_ALL &~E_NOTICE);
	require_once("./style.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Signup to Cesiogram</title>
		<?php echo $stile; ?>
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
					$sql = "INSERT INTO $user_table_name(userName, password, nome, cognome, dataNascita, email, sesso, professione, bio) VALUES ('{$_POST['userName']}','{$_POST['password']}','{$_POST['nome']}','{$_POST['cognome']}','{$_POST['dataNascita']}','{$_POST['email']}','{$_POST['sesso']}','{$_POST['professione']}','{$_POST['bio']}')";
				
					//controllo query
					if (!$resultQ = mysqli_query($connection, $sql)) {
						printf("Si è verificato un problema!<br />Impossibile registrarsi\n");
						exit();
					}
					echo "<p><em> Registrazione avvenuta con successo </em><br />
					Vai al <a href=\"login.php\"> login </a></p>\n";
				}
			}
			
			//chiusura della connessione
			$connection->close();
			
		?>
		<h3> Signup </h3>
		<p><em>(*) Campi obbligatori.</em></p>
		<form action="signup.php" method="post">
			<table align="center" class="signup">
				<tr>
					<td>
						<strong>Nome*:</strong>
					</td>
					<td>
						<input type="text" name="nome" size="30">
					</td>
				</tr>
				<tr>
					<td>
						<strong>Cognome*:</strong>
					</td>
					<td>
						<input type="text" name="cognome" size="30">
					</td>
				</tr>
				<tr>
					<td>
						<strong>Data di nascita*:</strong>
					</td>
					<td>
						<input type="date" name="dataNascita" size="100">
					</td>
				</tr>
				<tr>
					<td>
						<strong>Sesso*:</strong> 
					</td>
					<td>
						<input class="selezione" type="radio" name="sesso" value="M" size="100">M <input class="selezione" type="radio" name="sesso" value="F" size="100">F <input class="selezione" type="radio" name="sesso" value="NULL"> Non specificato
					</td>
				</tr>
				<tr>
					<td>
						<strong>Username*:</strong>
					</td>
					<td>
						<input type="text" name="userName" size="30">
					</td>
				</tr>
				<tr>
					<td>
						<strong>E-mail*:</strong>
					</td>
					<td>
						<input type="text" name="email" size="30">
					</td>
				</tr>
				<tr>
					<td>
						<strong>Password*:</strong>
					</td>
					<td>
						<input type="password" name="password" size="30">
					</td>
				</tr>
				<tr>
					<td>
						<strong>Professione:</strong>		
					</td>
					<td>
						<input type="text" name="professione" size="30">
					</td>
				</tr>
				<tr>
					<td>
						<strong>Biografia:</strong>
					</td>
					<td>
						<textarea rows="7" cols="40" name="bio">Inserisci una breve descrizione di te...</textarea>
					</td>
				</tr>
			</table>
			<p>
				<input class="bottone" type="submit" name="invio" value="Signup">
				<input class="bottone" type="reset" name="reset" value="Ripristina">
			</p>
		
		</form>
		
		<p> Hai gi&agrave; un account? <a href="login.php"> Login</a></p>
	</body>
</html>