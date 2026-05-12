

<?php require_once 'lib/autoLoader.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 session_start();?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Maison des Ligues de Lorraine</title>
		<style type="text/css">
			@import url(styles/m2l.css);
			@import url(styles/gestion-ligues.css);
		</style>
	
	</head>
	<body >
		<?php
			require_once 'controleur/controleurPrincipal.php';	
		?>

	</body>
</html>
