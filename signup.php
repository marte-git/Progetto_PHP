<?php 
error_reporting(E_ALL &~E_NOTICE);

require_once("./connessione.php");
require_once("style.php");


echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head> 
		<title> Sign-Up to Cesiogram </title> 
		<?php echo $stile; ?>
	</head>
	
	<body>
		<h2> Crea il tuo account Cesiogram </h2>
		
		<?php
			
			if(isset($_POST['invio'])) {
				if(($_POST['nome']) && ($_POST['cognome']) && ($_POST['userName'])
				  && ($_POST['password']) && ($_POST['email']) && ($_POST['dataNascita']) && $_POST['sesso']) {
					  $sql = "INSERT INTO $user_table_name 
							 (userName, password, nome, cognome, dataNascita, email, sesso,
							 professione, bio)
							 VALUES
							 ('{$_POST['userName']}', '{$_POST['password']}','{$_POST['nome']}','{$_POST['cognome']}',
							 '{$_POST['dataNascita']}','{$_POST['email']}','{$_POST['sesso']}','{$_POST['professione']}',
							 '{$_POST['bio']}')
							 ";
							 
							//CONTROLLO QUERY
							if(!($resultQ = mysqli_query($connection, $sql))) {
								printf("Si è verificato un problema. Impossibile registrarsi.\n");
								exit();
							}
							echo "<em> Registrazione avvenuta con successo!</em><br />";
							echo "<p>Vai al <a href = \"login.php\"> login </a></p>";
				}
			}
			
			//CHIUSURA CONNESSIONE
			$connection->close();		
		?>
		
		<h3> Signup </h3>
		
		<p>
			<em>(*) Campi obbligatori</em>
		</p>
		
		<form action = "signup.php" method = "POST">
		   <table class = "signup" align = "center">
		   
			<tr><td>Nome*:</td>
				<td><input type = "text" name = "nome" size = "30"></td>
			</tr>
			
			<tr> <td>Cognome*: </td>
				<td><input type = "text" name = "cognome" size = "30"></td>
			</tr>
		
			<tr> <td> Data di nascita*: </td>
				<td><input type = "date" name = "dataNascita"></td>
			</tr>
			
			<tr>
				<td>Sesso*:</td>
				<td>
					<input class = "selezione" type = "radio" name = "sesso" value = "M"> M 
					<input class = "selezione" type = "radio" name = "sesso" value = "F"> F 
					<input class = "selezione" type = "radio" name = "sesso" value = "NULL"> Non specificato 
				</td>
			</tr>
			
			<tr> <td> Professione</td>
				<td><input type = "text" name = "professione" size = "30"></td>
			</tr>
			
			<tr> <td>Username*:</td>
				<td><input type = "text" name = "userName" size = "30"></td>
			</tr>
			
			<tr> <td>Password*:</td>
				<td><input type = "password" name = "password" size = "30"></td>
			</tr>
			
			<tr><td> E-mail*:</td>
				<td><input type = "text" name = "email" size = "30"></td>
			</tr>
			
			<tr> <td> Biografia: </td>
				<td><textarea rows = "7" cols = "40" name = "bio"> Inserisci una breve descrizione di te... </textarea></td>
			</tr>
		   </table>
			<p>
				<input class = "bottone" type = "submit" name = "invio" value = "Registrati">
				<input class = "bottone" type = "reset" name = "reset" value = "Reset">
			</p>
		</form>
		<p> Hai gi&agrave; un account? <a href = "login.php"> Accedi </a>
	</body>
</html>