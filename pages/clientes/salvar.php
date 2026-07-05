<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../includes/auth.php';
require_once '../../controllers/ClienteController.php';

echo "<h2>Cheguei no salvar.php</h2>";

echo "<pre>";
print_r($_POST);
echo "</pre>";

$controller = new ClienteController();

echo "<h3>Controller carregado.</h3>";

$resultado = $controller->salvar($_POST);

var_dump($resultado);

die();