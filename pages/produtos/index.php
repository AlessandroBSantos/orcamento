<?php

$titulo = "Produtos";

require_once '../../includes/layout_inicio.php';

require_once '../../controllers/ProdutoController.php';

echo "Index 1<br>";

$controller = new ProdutoController();

echo "Index 2<br>";

$produtos = $controller->index();

echo "Index 3<br>";

require_once '../../includes/layout_fim.php';