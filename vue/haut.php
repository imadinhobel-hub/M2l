<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure' => true // Activez seulement en HTTPS
    ]);
}

// Générer un token unique par session
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<div class='bandeau'>
	<div class="logo">Maison des Ligues</div>
</div>

<nav class="menuPrincipal">
	<?php
	echo $menuPrincipalM2L;
	?>
</nav>