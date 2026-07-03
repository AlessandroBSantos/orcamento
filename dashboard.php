<?php

require_once 'includes/auth.php';

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<link rel="stylesheet" href="/orcamento/assets/css/reset.css">
<link rel="stylesheet" href="/orcamento/assets/css/variables.css">
<link rel="stylesheet" href="/orcamento/assets/css/app.css">
<link rel="stylesheet" href="/orcamento/assets/css/dashboard.css">

</head>

<body>

<?php include 'includes/header.php'; ?>

<?php include 'includes/sidebar.php'; ?>

<main class="content">

    <section class="page-header">

        <h1>Dashboard</h1>

        <p>

            Bem-vindo,

            <strong><?= htmlspecialchars($_SESSION['usuario_nome']) ?></strong>

        </p>

    </section>

    <section class="cards">

        <div class="card">

            <h3>Clientes</h3>

            <h2 id="totalClientes">0</h2>

        </div>

        <div class="card">

            <h3>Produtos</h3>

            <h2 id="totalProdutos">0</h2>

        </div>

        <div class="card">

            <h3>Propostas</h3>

            <h2 id="totalPropostas">0</h2>

        </div>

        <div class="card">

            <h3>Faturamento</h3>

            <h2 id="totalFaturamento">R$ 0,00</h2>

        </div>

    </section>

    <section class="dashboard-grid">

        <div class="panel">

            <h2>Ações Rápidas</h2>

            <div class="quick-actions">

                <a href="/orcamento/pages/clientes.php" class="btn">
                    Novo Cliente
                </a>

                <a href="/orcamento/pages/produtos.php" class="btn">
                    Novo Produto
                </a>

                <a href="/orcamento/pages/propostas.php" class="btn">
                    Nova Proposta
                </a>

            </div>

        </div>

        <div class="panel">

            <h2>Produtos com Estoque Baixo</h2>

            <p>Nenhum produto encontrado.</p>

        </div>

    </section>

    <section class="panel">

        <h2>Últimas Propostas Comerciais</h2>

        <table>

            <thead>

                <tr>

                    <th>Número</th>

                    <th>Cliente</th>

                    <th>Valor</th>

                    <th>Status</th>

                    <th>Data</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td colspan="5">

                        Nenhuma proposta cadastrada.

                    </td>

                </tr>

            </tbody>

        </table>

    </section>

</main>

<script src="/orcamento/assets/js/app.js"></script>

</body>

</html>