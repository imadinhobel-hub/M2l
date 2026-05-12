<?php
require_once __DIR__ . '/adminUtils.php';

verifierConnexionAdmin();

$section = $_GET['section'] ?? 'ligues';
afficherPageAdmin($section);
