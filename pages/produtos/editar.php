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

/*
|--------------------------------------------------------------------------
| Valida o ID do produto
|--------------------------------------------------------------------------
*/

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {

    header('Location: index.php');
    exit;

}

?>