<?php
error_reporting (E_ALL &~E_NOTICE);
session_start();                // sempre prima di qualunque contenuto html ...

if (!isset($_SESSION['accessoPermesso'])) header('Location: mysql.ST.login.php');

require_once("./connessione.php");

//ELIMINAZIONE DAL CARRELLO
$msg = "";
	if(empty($_POST['eliminandi'])) {
		if(isset($_POST['elimina']) && $_SESSION['carrello']) 
			$msg = "<p> Se vuoi elimanare qualcosa, prima selezionala!</p>";
	}
	else {
		foreach($_POST['eliminandi'] as $k =>$indiceElimina)
			unset($_SESSION['carrello'][$indiceElimina]);
	}
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head> <title> Il tuo carrello - Cesiogram </title> </head>
	
	<body>
		<?php require_once("menu_home.php") ?>
	
		
		<h2> Il tuo carrello </h2>
		<table>
			<tr>
				<td width = "80%">
				  <form action = "<?php $_SERVER['PHP_SELF']?>" method = "post"> 
					<?php if(empty($_SESSION['carrello']) || isset($_POST['svuota'])) {
						  $_SESSION['carrello'] = array();
						  echo "<p> Il tuo carrello è vuoto </p>";
						  }
						  else {
							foreach($_SESSION['carrello'] as $k=>$v) {
								$sql = "SELECT * 
								FROM $prodotti_table_name
								WHERE nome = \"$v\"
								";
								
								if(!$resultQ = mysqli_query($connection, $sql)) {
									echo "<p> Si è verificato un errore </p>";
									exit();
								}
		
								$row = mysqli_fetch_array($resultQ); 
								echo "<input type = \"checkbox\" name = \"eliminandi[]\" value = \"$k\" > $v  (".$row['costo']." &euro;)<br />";
						    }
						  }
					?>
				</td>
				<td>
					<p><input type = "submit" name = "elimina" value = "Elimina dal carrello"> </p>
					<p><input type = "submit" name = "svuota" value = "Svuota il carrello"></p>
		</form>
					<p><a href = "shop.php"><button> Continua gli acquisti </button></a> </p>
					<p><a href = "riepilogo.php"><button> Vai  al pagamento </button></a> </p>
					
				</td>
			</tr>
		  </table>
		  <?php echo $msg ?>
	</body>
</html>