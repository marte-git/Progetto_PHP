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
	$prodotto.=  "<input type=\"radio\" name=\"selection\" value=\"{$row['nome']}\" />
           {$row['nome']} (&euro; {$row['costo']})<br />\n";
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
	</head>
	
	<body>
		<?php require_once("menu_shop.php");?>
		
		<h2> Shop Cesiogram </h2>
			<p> Scegli il prodotto da acquistare: </p>
		
			<form action = "<?php $_SERVER['PHP_SELF']?>" method = "post">
				<table>
					<tr>
						<td width = "80%"> <?php echo $prodotto ?> </td>
						<td> <p> <input type = "submit" name = "invio" value = "Aggiungi al carrello" /> </p>
							 <p> <input type = "reset" name = "reset" value = "Annulla selezione" /> </p>
						</td>			
					</tr>		
				</table>
			</form>
			
			<p> <a href = "carrello.php"> <button> Vai al carrello </button> </a> </p>
			<p> <a href = "riepilogo.php"> <button> Vai al pagamento </button> </a></p>
			
		<?php 
			//AGGIUNGI AL CARRELLO
			if(empty($_SESSION['carrello']) && empty($_POST['selection'])) {
				$_SESSION['carrello'] = array();
			}
			else {
				if(isset($_POST['selection'])) {
					$_SESSION['carrello'][] = $_POST['selection'];
					echo "<p> Prodotto inserito nel carrello! </p>";
				}
			}
			if(empty($_POST['selection']) && isset($_POST['invio'])) 
				echo "<p>Per aggiungere un prodotto al carrello devi selezionarlo!</p>";
		?>
		
	</body>
</html>

