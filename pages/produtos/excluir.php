<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../controllers/ProdutoController.php';

/*
|--------------------------------------------------------------------------
| Valida o ID
|--------------------------------------------------------------------------
*/

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {

    header('Location: index.php');
    exit;

}

/*
|--------------------------------------------------------------------------
| Controller
|--------------------------------------------------------------------------
*/

$controller = new ProdutoController();

/*
|--------------------------------------------------------------------------
| Exclui o produto
|--------------------------------------------------------------------------
*/

if ($controller->excluir($id)) {

    header('Location: index.php?sucesso=excluido');
    exit;

}

/*
|--------------------------------------------------------------------------
| Erro
|--------------------------------------------------------------------------
*/

echo "Erro ao excluir o produto.";