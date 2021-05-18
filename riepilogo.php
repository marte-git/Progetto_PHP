<?php
error_reporting (E_ALL &~E_NOTICE);
session_start();

if (!isset($_SESSION['accessoPermesso'])) header('Location: login.php');

require_once("./connessione.php");

//ELENCO E COSTO ARTICOLI
$_SESSION['daPagare'] = 0;
$output = "<h3> Ciao ".$_SESSION['nome']."</h3>\n";

if(empty($_SESSION['carrello'])) {
	$output.= "<p> Il carrello è vuoto </p>\n";
}
else {
	$output.= "<ul>\n";
	
	foreach($_SESSION['carrello'] as $k=>$v) {
		$output.= "<li>".$v;
	//COSTI	
		$sql = "SELECT * 
				FROM $prodotti_table_name
				WHERE nome = \"$v\"
		";
		if(!$resultQ = mysqli_query($connection, $sql)) {
			echo "<p> Si è verificato un errore </p>";
			exit();
		}
		
		$row = mysqli_fetch_array($resultQ); 
		$output.= "(".$row['costo']."&euro;)";
		$output.= "</li>\n";
		
		$_SESSION['daPagare'] += $row['costo'];
	}
	
	$output.= "</ul>\n";
	$output .= "<p> Totale da pagare: {$_SESSION['daPagare']} &euro; </p>\n\n";
	$output.= "<form action = \"pagamento.php\" method = \"post\">";
	$output.= "<p> <input type = \"submit\" name = \"paga\" value = \"Procedi con il pagamento\"></p>";
	$output.= "</form>";
}
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head> <title> Riepilogo - Cesiogram </title> </head>
	
	<body>
		<h1> Riepilogo acquisto </h1>
		
		<?php 
			require_once("menu_shop.php");
			echo $output;
		?>
	
		<p><a href = "shop.php"><button>Continua con gli acquisti</button></a></p>
	</body>
</html>