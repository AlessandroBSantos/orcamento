<?php

session_start();

require_once '../../controllers/EstoqueController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$dados = [

    'produto_id'      => (int)($_POST['produto_id'] ?? 0),

    'quantidade'      => (float)($_POST['quantidade'] ?? 0),

    'valor_unitario'  => (float)($_POST['valor_unitario'] ?? 0),

    'documento'       => trim($_POST['documento'] ?? ''),

    'fornecedor_id'   => !empty($_POST['fornecedor_id'])
                            ? (int)$_POST['fornecedor_id']
                            : null,

    'lote'            => trim($_POST['lote'] ?? ''),

    'numero_serie'    => trim($_POST['numero_serie'] ?? ''),

    'observacoes'     => trim($_POST['observacoes'] ?? ''),

    'usuario_id'      => $_SESSION['usuario_id'] ?? 1

];

if ($dados['produto_id'] <= 0) {
    die("Produto inválido.");
}

if ($dados['quantidade'] <= 0) {
    die("Quantidade deve ser maior que zero.");
}

try {

    $controller = new EstoqueController();

    $controller->saida($dados);

    header("Location: index.php?sucesso=saida");

    exit;

} catch (Exception $e) {

    die($e->getMessage());

}