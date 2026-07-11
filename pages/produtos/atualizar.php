<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../controllers/ProdutoController.php';

/*
|--------------------------------------------------------------------------
| Aceita somente POST
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: index.php');
    exit;

}

$controller = new ProdutoController();

/*
|--------------------------------------------------------------------------
| Dados do formulário
|--------------------------------------------------------------------------
*/

$dados = [

    'id'                 => $_POST['id'] ?? 0,

    'codigo'             => trim($_POST['codigo'] ?? ''),
    'codigo_barras'      => trim($_POST['codigo_barras'] ?? ''),
    'sku'                => trim($_POST['sku'] ?? ''),
    'nome'               => trim($_POST['nome'] ?? ''),
    'descricao'          => trim($_POST['descricao'] ?? ''),

    'categoria_id'       => !empty($_POST['categoria_id']) ? (int) $_POST['categoria_id'] : null,
    'marca_id'           => !empty($_POST['marca_id']) ? (int) $_POST['marca_id'] : null,
    'unidade_id'         => !empty($_POST['unidade_id']) ? (int) $_POST['unidade_id'] : null,
    'fornecedor_id'      => !empty($_POST['fornecedor_id']) ? (int) $_POST['fornecedor_id'] : null,

    'ncm'                => trim($_POST['ncm'] ?? ''),
    'cfop'               => trim($_POST['cfop'] ?? ''),
    'cest'               => trim($_POST['cest'] ?? ''),
    'origem'             => ($_POST['origem'] !== '') ? (int) $_POST['origem'] : null,

    'peso'               => (float) ($_POST['peso'] ?? 0),
    'largura'            => (float) ($_POST['largura'] ?? 0),
    'altura'             => (float) ($_POST['altura'] ?? 0),
    'comprimento'        => (float) ($_POST['comprimento'] ?? 0),

    'custo'              => (float) ($_POST['custo'] ?? 0),
    'percentual_lucro'   => (float) ($_POST['percentual_lucro'] ?? 0),
    'preco_venda'        => (float) ($_POST['preco_venda'] ?? 0),

    'localizacao'        => trim($_POST['localizacao'] ?? ''),

    'controla_estoque'   => isset($_POST['controla_estoque']) ? 1 : 0,
    'vende'              => isset($_POST['vende']) ? 1 : 0,
    'compra'             => isset($_POST['compra']) ? 1 : 0,
    'ativo'              => isset($_POST['ativo']) ? 1 : 0,

    'observacoes'        => trim($_POST['observacoes'] ?? '')

];

/*
|--------------------------------------------------------------------------
| Atualiza
|--------------------------------------------------------------------------
*/

if ($controller->atualizar($dados)) {

    header('Location: index.php?sucesso=editado');
    exit;

}

echo "Erro ao atualizar o produto.";