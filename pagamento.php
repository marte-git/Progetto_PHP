<?php
	error_reporting (E_ALL &~E_NOTICE);
	session_start();                // sempre prima di qualunque contenuto htmnl ...

	if (!isset($_SESSION['accessoPermesso']))
		header('Location: login.php');
	
	require_once("./connessione.php");
	require_once("./stile_interno.php");
	$output = "";
	
	//conteggio delle somme spesse di acquisto in acquisto da questo utente
	$tot = $_SESSION['daPagare'] + $_SESSION['spesaFinora'];
	$sql = "UPDATE $user_table_name SET sommeSpese=\"$tot\" WHERE userName=\"{$_SESSION['userName']}\"";
	
	if(!mysqli_query($connection,$sql)){
		printf("<p>Si è verificato un errore!</p>");
		exit();
	}
	
	if(mysqli_affected_rows($connection) == 1)
		$output ="<h3>Totale pagato: {$_SESSION['daPagare']} &euro;</h3>\n";
	
	$output.="<p>Presso il nostro shop fino ad ora hai speso: <strong>{$tot} &euro;</strong></p>\n";
	
	//nel caso si rientri senza logout
	$_SESSION['carrello'] = array();
	$_SESSION['daPagare'] = 0;
	$_SESSION['spesaFinora'] = $tot;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>Safe pay - Cesiogram</title>
		<?php echo $stileInterno; ?>
	</head>

	<body>
	<?php
		require_once("menu_shop.php");
	?>
	<div class="centro">
		<h1>Pagamento effettuato con successo!</h1>

		<?php
			echo $output;
		?>
	</div>
	
	<div class="pubblica">
		<p> Lascia una recensione: </p>
		<form action="carica_post.php" method="post">
			<textarea rows="5" cols="42" name="testo">...</textarea><br />
			<input type="submit" name="invio" value="Pubblica">
		</form>
	</div>

	</body>
</html>