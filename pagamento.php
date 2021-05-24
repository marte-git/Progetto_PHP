<?php
error_reporting (E_ALL &~E_NOTICE);
session_start();   

if (!isset($_SESSION['accessoPermesso']))
header('Location: mysql.ST.login.php');

require_once("connessione.php");
require_once("stile_interno.php");

$tot = $_SESSION['daPagare']+$_SESSION['spesaFinora'];
$output = "";
// CONTEGGIO DELLE SOMME SPESE DI ACQUISTO IN ACQUISTO DA QUESTO UTENTE
$sql = "UPDATE $user_table_name 
		SET sommeSpese = \"$tot\"
		WHERE userName = \"{$_SESSION['userName']}\"
		";
//CONTROLLO QUERY
if (!mysqli_query($connection, $sql)) {
             printf("Si è verificato un errore: %s\n",
                     mysqli_error($connection));
             exit();
         }

if(mysqli_affected_rows($connection) == 1) 
	$output.= "<h3> Totale pagato: {$_SESSION['daPagare']} &euro; </h3>\n";

	$output.= "<p>Presso il nostro shop fino ad ora hai speso:<strong> {$tot} &euro;</strong></p>\n";

//NEL CASO SI RIENTRI SENZA LOGOUT
$_SESSION['carrello'] = array();
$_SESSION['daPagare'] = 0;
$_SESSION['spesaFinora'] = $tot;

?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head> 
		<title> SafePay - Cesiogram </title> 
		<?php echo $stileInterno?>
	</head>
	
	<body>	
		<?php require_once('menu_shop.php');?>
		
	<div class = "centro">	<h1> Pagamento effettuato con successo! </h1>
		<?php echo $output ?>
	</div>
	
	<div class = "pubblica">
			<form action = "carica_post.php" method = "post">
				<textarea rows ="5" cols = "42" name = "testo"> Lascia una tua recensione! </textarea>
				<br />
				<input type = "submit" name = "invio" value = "Pubblica">
			</form>
		</div>
	</body>
	
	
</html>