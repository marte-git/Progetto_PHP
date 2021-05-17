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
		<?php //fare un menu in un file esterno ?>
		
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
					$post = "<div> \n";
					$post.= $row['user']."\n";
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
	</body>
</html>