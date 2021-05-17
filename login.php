<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	$msg = "";
	
	require_once("./connessione.php");

	//verifichiamo se siano stati inseriti correttamente i campi username e password
	if(isset($_POST['invio'])){
		if(empty($_POST['userName']) || empty($_POST['password']))
			$msg = "<p>Dati mancanti. Riprova </p>";
		else{
			//verifichiamo se i dati inseriti corrispondono ad un account esistente
			$sql = "SELECT * FROM $user_table_name WHERE userName = \"{$_POST['userName']}\" AND password =\"{$_POST['password']}\"";
			
			if(!$resultQ = mysqli_query($connection, $sql)){
				$msg = "<p>Riprova o registrati</p>";
				exit();
			}
			
			//se l'account esiste...
			$row = mysqli_fetch_array($resultQ);
			
			if($row){
				session_start();
				$_SESSION['userName'] = $_POST['userName'];
				$_SESSION['nome'] = $row['nome'];
				$_SESSION['cognome'] = $row['cognome'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['dataNascita'] = $row['dataNascita'];
				$_SESSION['professione'] = $row['professione'];
				$_SESSION['bio'] = $row['bio'];
				$_SESSION['img'] = $row['img'];
				$_SESSION['dataLogin'] = time();
				$_SESSION['accessoPermesso'] = 1000;
				header('Location: inizio.php');
				exit();
			}else
				$msg = "<p>Dati inseriti errati! Riprova o registrati</p>";
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>Login on Cesiogram</title>
	</head>

	<body>
		<h2> Login </h2>
		<p><em> <?php echo $msg ?> </em></p>
		<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
			<p> Username: <input type="text" name="userName"> </p>
			<p> Password: <input type="password" name="password"> </p>

			<input type="submit" name="invio" value="Login">
			<input type="reset" name="reset" value="Reset">
		</form>
		
		<p>Non hai ancora un account? <a href="signup.php"> Sign up </a></p>
	</body>
</html>