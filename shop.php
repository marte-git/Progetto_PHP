<?php
error_reporting (E_ALL &~E_NOTICE);
session_start(); 

if (!isset($_SESSION['accessoPermesso'])) header('Location: login.php');

require_once("./connessione.php");


//SELEZIONE DEI PRODOTTI 
$sql = "SELECT *
		FROM $prodotti_table_name
		";

if(!$resultQ = mysqli_query($connection, $sql)) {
	echo "<p> Si è verificato un errore </p>";
	exit;
}

$prodotto = "";
while($row = mysqli_fetch_array($resultQ)) {
	$prodotto.=  "<p class = \"prodotti\"><input type=\"radio\" name=\"selection\" value=\"{$row['nome']}\" />
           {$row['nome']} <span class = \"prezzi\">(&euro; {$row['costo']})</span><p>\n";
}

//CHIUSURA CONNESSIONE
$connection->close();

?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title> Shop Area - Cesiogram </title> 
		<?php require_once("stile_interno.php"); 
			  echo $stileInterno; ?>
	</head>
	
	<body>
		<?php require_once("menu_shop.php");?>
		
		<h1> Shop Cesiogram </h1>
			<p> Scegli il prodotto da acquistare: </p>
		
			<form action = "<?php $_SERVER['PHP_SELF']?>" method = "post">
				<table class = "carrello">
					<tr>
						<td width = "75%"> <?php echo $prodotto ?> </td>
						<td> <p> <input  class = "bottone" type = "submit" name = "invio" value = "Aggiungi al carrello" /> </p>
							 <p> <input class = "bottone" type = "reset" name = "reset" value = "Annulla selezione" /> </p>
						</td>			
					</tr>		
				</table>
			</form>
			
			<p> <a href = "carrello.php"><button class = "bottone"> Vai al carrello </button></a>
				<a href = "riepilogo.php"><button class = "bottone"> Vai al pagamento </button></a>
			</p>
			
		<?php 
			//AGGIUNGI AL CARRELLO
			if(empty($_SESSION['carrello']) && empty($_POST['selection'])) {
				$_SESSION['carrello'] = array();
			}
			else {
				if(isset($_POST['selection'])) {
					$_SESSION['carrello'][] = $_POST['selection'];
					echo "<em> Prodotto inserito nel carrello! </em>";
				}
			}
			if(empty($_POST['selection']) && isset($_POST['invio'])) 
				echo "<em>Per aggiungere un prodotto al carrello devi selezionarlo!</em>";
		?>
		
	</body>
</html>

