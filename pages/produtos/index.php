<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$titulo = "Produtos";

require_once '../../includes/layout_inicio.php';

echo "<h2>Passo 1</h2>";

require_once '../../controllers/ProdutoController.php';

echo "<h2>Passo 2</h2>";

$controller = new ProdutoController();

echo "<h2>Passo 3</h2>";

$produtos = $controller->index();

echo "<h2>Passo 4</h2>";

echo "<pre>";
print_r($produtos);
echo "</pre>";

require_once '../../includes/layout_fim.php';