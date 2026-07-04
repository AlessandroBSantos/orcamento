<?php

require_once __DIR__ . '/../config/database.php';

$db = Database::getConnection();


/*
|--------------------------------------------------------------------------
| Total de Clientes
|--------------------------------------------------------------------------
*/

$sql = $pdo->query("SELECT COUNT(*) FROM clientes");
$totalClientes = $sql->fetchColumn();

/*
|--------------------------------------------------------------------------
| Total de Produtos
|--------------------------------------------------------------------------
*/

$sql = $pdo->query("SELECT COUNT(*) FROM produtos");
$totalProdutos = $sql->fetchColumn();

/*
|--------------------------------------------------------------------------
| Total de Propostas
|--------------------------------------------------------------------------
*/

$sql = $pdo->query("SELECT COUNT(*) FROM propostas");
$totalPropostas = $sql->fetchColumn();

/*
|--------------------------------------------------------------------------
| Valor Total das Propostas
|--------------------------------------------------------------------------
*/

$sql = $pdo->query("
    SELECT
        COALESCE(SUM(valor_total),0)
    FROM propostas
");

$totalVendas = $sql->fetchColumn();

/*
|--------------------------------------------------------------------------
| Produtos com Estoque Baixo
|--------------------------------------------------------------------------
*/

$sql = $pdo->query("
    SELECT
        id,
        nome,
        estoque
    FROM produtos
    WHERE estoque <= estoque_minimo
    ORDER BY estoque ASC
    LIMIT 10
");

$estoqueBaixo = $sql->fetchAll();

/*
|--------------------------------------------------------------------------
| Últimas Propostas
|--------------------------------------------------------------------------
*/

$sql = $pdo->query("
    SELECT
        numero,
        cliente,
        valor_total,
        status,
        data_criacao
    FROM propostas
    ORDER BY id DESC
    LIMIT 10
");

$ultimasPropostas = $sql->fetchAll();