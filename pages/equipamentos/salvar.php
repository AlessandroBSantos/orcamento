<?php

session_start();

require_once '../../config/app.php';
require_once '../../controllers/EquipamentosController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

try {

    $controller = new EquipamentosController();

    /*
    |--------------------------------------------------------------------------
    | Dados do formulário
    |--------------------------------------------------------------------------
    */

    $dados = [

        'id' => !empty($_POST['id']) ? (int)$_POST['id'] : null,

        'codigo' => trim($_POST['codigo'] ?? ''),
        'patrimonio' => trim($_POST['patrimonio'] ?? ''),
        'descricao' => trim($_POST['descricao'] ?? ''),
        'categoria' => trim($_POST['categoria'] ?? ''),
        'fabricante' => trim($_POST['fabricante'] ?? ''),
        'marca' => trim($_POST['marca'] ?? ''),
        'modelo' => trim($_POST['modelo'] ?? ''),
        'numero_serie' => trim($_POST['numero_serie'] ?? ''),
        'numero_patrimonio' => trim($_POST['numero_patrimonio'] ?? ''),
        'localizacao' => trim($_POST['localizacao'] ?? ''),
        'setor' => trim($_POST['setor'] ?? ''),
        'responsavel' => trim($_POST['responsavel'] ?? ''),

        'fornecedor_id' => !empty($_POST['fornecedor_id'])
            ? (int)$_POST['fornecedor_id']
            : null,

        'data_compra' => !empty($_POST['data_compra'])
            ? $_POST['data_compra']
            : null,

        'garantia_ate' => !empty($_POST['garantia_ate'])
            ? $_POST['garantia_ate']
            : null,

        'valor_compra' => !empty($_POST['valor_compra'])
            ? (float) str_replace(',', '.', $_POST['valor_compra'])
            : 0,

        'observacoes' => trim($_POST['observacoes'] ?? ''),

        'status' => $_POST['status'] ?? 'OPERACAO'

    ];

    /*
    |--------------------------------------------------------------------------
    | Validações
    |--------------------------------------------------------------------------
    */

    if ($dados['codigo'] === '') {
        throw new Exception('Informe o código do equipamento.');
    }

    if ($dados['descricao'] === '') {
        throw new Exception('Informe a descrição do equipamento.');
    }

    /*
    |--------------------------------------------------------------------------
    | Cadastro / Atualização
    |--------------------------------------------------------------------------
    */

    if ($dados['id'] === null) {

        $controller->cadastrar($dados);

        header("Location: index.php?sucesso=cadastro");
        exit;

    }

    $controller->atualizar($dados);

    header("Location: index.php?sucesso=edicao");
    exit;

} catch (Exception $e) {

    header(
        "Location: form.php?erro=" .
        urlencode($e->getMessage()) .
        (!empty($_POST['id']) ? "&id=" . (int)$_POST['id'] : '')
    );

    exit;

}