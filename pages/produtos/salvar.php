<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once '../../controllers/ProdutoController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: index.php');
    exit;

}

$controller = new ProdutoController();

$dados = [

    'codigo'             => $_POST['codigo'] ?? '',
    'codigo_barras'      => $_POST['codigo_barras'] ?? '',
    'sku'                => $_POST['sku'] ?? '',
    'nome'               => $_POST['nome'] ?? '',
    'descricao'          => $_POST['descricao'] ?? '',

    'categoria_id'       => $_POST['categoria_id'] ?? null,
    'marca_id'           => $_POST['marca_id'] ?? null,
    'unidade_id'         => $_POST['unidade_id'] ?? null,
    'fornecedor_id'      => $_POST['fornecedor_id'] ?? null,

    'ncm'                => $_POST['ncm'] ?? '',
    'cfop'               => $_POST['cfop'] ?? '',
    'cest'               => $_POST['cest'] ?? '',
    'origem'             => $_POST['origem'] ?? '',

    'peso'               => $_POST['peso'] ?? 0,
    'largura'            => $_POST['largura'] ?? 0,
    'altura'             => $_POST['altura'] ?? 0,
    'comprimento'        => $_POST['comprimento'] ?? 0,

    'custo'              => $_POST['custo'] ?? 0,
    'percentual_lucro'   => $_POST['percentual_lucro'] ?? 0,
    'preco_venda'        => $_POST['preco_venda'] ?? 0,

    'localizacao'        => $_POST['localizacao'] ?? '',

    'controla_estoque'   => isset($_POST['controla_estoque']) ? 1 : 0,
    'vende'              => isset($_POST['vende']) ? 1 : 0,
    'compra'             => isset($_POST['compra']) ? 1 : 0,
    'ativo'              => isset($_POST['ativo']) ? 1 : 0,

    'observacoes'        => $_POST['observacoes'] ?? ''

];

if ($controller->salvar($dados)) {

    header('Location: index.php?sucesso=cadastrado');
    exit;

}

echo "Erro ao salvar o produto.";