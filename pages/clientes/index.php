<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "1 - Inicio<br>";

$titulo = "Clientes";

echo "2 - Titulo OK<br>";

require_once '../../includes/layout_inicio.php';

echo "3 - Layout carregado<br>";

require_once '../../controllers/ClienteController.php';

echo "4 - Controller carregado<br>";

$controller = new ClienteController();

echo "5 - Controller instanciado<br>";

$clientes = $controller->index();

echo "6 - Consulta realizada<br>";

echo "<pre>";
print_r($clientes);
echo "</pre>";
?>