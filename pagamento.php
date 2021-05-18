<?php
	error_reporting (E_ALL &~E_NOTICE);
	session_start();                // sempre prima di qualunque contenuto htmnl ...

	if (!isset($_SESSION['accessoPermesso']))
		header('Location: login.php');
	
	require_once("./connessione.php");
	$output = "";
	
	//conteggio delle somme spesse di acquisto in acquisto da questo utente
	$tot = $_SESSION['daPagare'] + $_SESSION['spesaFinora'];
	$sql = "UPDATE $user_table_name SET sommeSpese=\"$tot\" WHERE userName=\"{$_SESSION['userName']}\"";
	
	if(!mysqli_query($connection,$sql)){
		printf("<p>Si è verificato un errore!</p>");
		exit();
	}
	
	if(mysqli_affected_rows($connection) == 1)
		$output ="<h3>Totale da pagare: {$_SESSION['daPagare']} &euro;</h3>\n";
	
	$output.="<p>Presso il nostro shop fino ad ora hai speso: {$tot} &euro;</p>\n";
	
	//nel caso si rientri senza logout
	$_SESSION['carrello'] = array();
	$_SESSION['daPagare'] = 0;
	$_SESSION['spesaFinora'] = $tot;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>Safe pay - Cesiogram</title>
	</head>

	<body>
	<?php
		require_once("menu_shop.php");
	?>

	<h2>Pagamento effettuato con successo!</h2>

	<?php
		echo $output;
	?>

	</body>
</html>