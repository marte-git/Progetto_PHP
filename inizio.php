<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("./connessione.php");
$msg = "";

//inserire uno stile interno

session_start();
if (!isset($_SESSION['accessoPermesso'])) header('Location: login.php');

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title> Cesiogram </title>
		<?php //echo $stileInterno; ?>
	</head>
	
	<body>
	<h3> Men&ugrave; </h3>
		<?php require_once("menu_home.php") ?>
		
		<h1> Home </h1>
		
		<div>
			<?php	//creiamo la query per accedere a tutti i post
				$sql = "SELECT * 
				FROM $post_table_name
				ORDER BY postId DESC
				";

				if(!$resultQ = mysqli_query($connection, $sql)) {
				$msg = "<p> Si è verificato un errore. </p>";
				exit();
				}
				
				
				while($row = mysqli_fetch_array($resultQ)) {
					$post = "<div><strong> \n";
					$post.= $row['user']."\n</strong>";
					$post.= "<br />\n";
					$post.= "<span>\n";
					$post.= $row['testo']."\n";
					$post.= "</span>\n";
					$post.= "<span>\n";
					$post.= $row['file']."\n";
					$post.= "</span>\n";
					$post.= "</div>\n";
					echo $post;
				}
			?>
		</div>	
		
		<p> <strong>Username:</strong> <?php echo $_SESSION['userName'] ?> </p>
		<p> <strong>Nome:</strong> <?php echo $_SESSION['nome'] ?> </p>
		<p> <strong>Cognome:</strong> <?php echo $_SESSION['cognome'] ?> </p>
		<p> <strong>Data di nascita:</strong> <?php echo $_SESSION['dataNascita'] ?> </p>
		<p> <strong>Professione:</strong> <?php echo $_SESSION['professione'] ?> </p>
		<p> <strong>Biografia:</strong> <?php echo $_SESSION['bio'] ?> </p>
		<p> <strong>Ti sei collegato alle:</strong> <?php echo date ('g:i a', $_SESSION['dataLogin']) ?>
		
		
		
		
		
	</body>
</html>