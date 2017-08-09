<?php
/*	Este còdigo sirve (de moemento) ya sea para iniciar sesión (sign-in) o registrar sesión (sign-up)
*/

// Requrir clase UserOAuth2:
require 'src/php/userOAuth2.class.php';

//Iniciar sesión PHP:
session_start();

// Si ya hay token de acceso:
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
	
	// Instanciar usuario:
	$userOAuth2 = new userOAuth2($_SESSION['access_token']);
	
	// Para revocar los permisos del cliente de la API:
	if(isset($_GET['revoke']) && $_GET['revoke'])
	{
		$userOAuth2->google_client->revokeToken();
		echo '<br>LOG: Accesso revocado.<br>';
		header('Location: src/php/logout.php');
	}	
	
// Si no hay token de acceso:	
} else {
	// Ir a autenticación de Google
	$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/src/php/google-api-php-client/oauth2callback.php';
	header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bienvenido</title>
</head>
<body>
<!-- Encabezado --> <?php include 'src/templates/header.php'; ?>
<h1>Bienvenido,</h1>
<img src="<?php echo $userOAuth2->picture; ?>">

<p>
Hola <?php echo $userOAuth2->given_name; ?>, su email es:
</p>

<p>
<strong><?php print_r($userOAuth2->email); ?></strong>
</p>

<p>
<button>Ver cronograma de eventos</button>
</p>

<p><a href="?revoke=true">Revocar accesso de la API de Google</a></p>

<!-- Footer --> <?php include 'src/templates/footer.php'; ?>
</body>
</html>
