<?php
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	require_once("./stile_interno.php");
	$msg = "";

	//inserire uno stile interno
	
	//connessione db
	require_once("./connessione1.php");
	
	session_start();
	if (!isset($_SESSION['accessoPermesso'])) 
		header('Location: login.php');

	echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<title>Cesiogram</title>
		<?php echo $stileInterno; ?>
	</head>

	<body>
		
		<?php
			require_once("menu_home.php");
		?>
		<h1> Home </h1>
		<?php 
			require_once("carica_post.php");	
			require_once("elimina_post.php");
		?>
		
		<div class="pubblica">
			<form action="carica_post.php" method="post">
				<textarea rows="5" cols="42" name="testo">Cosa hai fatto oggi?</textarea><br />
				<input type="submit" name="invio" value="Pubblica">
			</form>
		</div>
		
		<pre class="post">
			<?php
				//query per accedere a tutti i post
				$sql = "SELECT * FROM $post_table_name ORDER BY postId DESC";
	
				if(!$resultQ = mysqli_query($connection, $sql)){
					$msg = "<p>Si è verificato un errore!</p>";
					exit();
				}
				
				while($row = mysqli_fetch_array($resultQ)){
					$post = "<table class=\"ogniPost\">\n<tbody>\n<tr>\n<td>\n<strong>";
					if($row['user'] == $_SESSION['userName']){
						$post .= $row['user'];
						$post .= "\n</strong><hr /></td><td><form action=\"elimina_post.php\" method=\"post\"><input class=\"elimina\" type=\"submit\" name=\"eliminando\" value=".$row['postId']." /></form></td></tr>\n";
						$post .= "<tr>\n<td>\n";
						$post .= "<p class=\"spostato\">".$row['testo']."</p>";
					}else{
						$post .= $row['user'];
						$post .= "\n</strong><hr /></td></tr>\n";
						$post .= "<tr>\n<td>\n";
						$post .= "<p class=\"spostato\">".$row['testo']."</p>";
					}
					$post .= "\n</td>\n</tr>\n</tbody>\n</table>\n";
					echo $post;
				}
			
			?>
		</pre>
		
		<div class="destra">
			<h3> Il tuo profilo: </h3>
			<p> <strong>Username:</strong> <?php echo $_SESSION['userName'] ?> </p>
			<p> <strong>Nome:</strong> <?php echo $_SESSION['nome'] ?> </p>
			<p> <strong>Cognome:</strong> <?php echo $_SESSION['cognome'] ?> </p>
			<p> <strong>Data di nascita:</strong> <?php echo $_SESSION['dataNascita'] ?> </p>
			<p> <strong>Professione:</strong> <?php echo $_SESSION['professione'] ?> </p>
			<p> <strong>Biografia:</strong> <?php echo $_SESSION['bio'] ?> </p>
			<p> <strong>Ti sei collegato alle:</strong> <?php echo date('g:i a', $_SESSION['dataLogin']); ?> </p>
			<p> <strong>Finora su Cesiogram hai speso:</strong> <?php echo $_SESSION['spesaFinora']." &euro;"; ?> </p>
		</div>

	</body>
</html>