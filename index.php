<?php
// Requrir clase UserOAuth2:
require 'src/php/userOAuth2.class.php';

//Iniciar sesión PHP:
session_start();

// Declarar ek objeto tipo usuario:
$userOAuth2 = NULL;

// Si ya hay token de acceso:
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
	
	// Instanciar usuario:
	$userOAuth2 = new userOAuth2($_SESSION['access_token']);		
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Inicio</title>
</head>

<body>
<?php
include 'src/templates/header.php';
?>
<!-- Cotenido -->
<h1>Inicio</h1>
<?php
//Si el usuario está definido: 
if ($userOAuth2) {
?>
<img src="<?php echo $userOAuth2->picture; ?>">
<?php
}
?>
<p>
Hola<?php echo ($userOAuth2) ? ' ' .$userOAuth2->given_name : '' . '.'; ?>
</p>
<!-- Fin de contenido-->
<?php
include 'src/templates/footer.php';
?>
</body>
</html>