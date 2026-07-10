<?php

$titulo = "Editar Produto";

/*
|--------------------------------------------------------------------------
| JavaScripts da página
|--------------------------------------------------------------------------
*/

$scripts = [
    'tabs.js',
    'produtos.js'
];

require_once '../../includes/layout_inicio.php';
require_once '../../controllers/ProdutoController.php';

$controller = new ProdutoController();

?>