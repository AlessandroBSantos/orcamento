<?php

require_once 'includes/auth.php';

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>LLA ERP</title>

<link rel="stylesheet" href="/orcamento/assets/css/reset.css?v=<?= filemtime(__DIR__.'/assets/css/reset.css') ?>">
<link rel="stylesheet" href="/orcamento/assets/css/variables.css?v=<?= filemtime(__DIR__.'/assets/css/variables.css') ?>">
<link rel="stylesheet" href="/orcamento/assets/css/app.css?v=<?= filemtime(__DIR__.'/assets/css/app.css') ?>">
<link rel="stylesheet" href="/orcamento/assets/css/dashboard.css?v=<?= filemtime(__DIR__.'/assets/css/dashboard.css') ?>">


</head>

<body>

<?php include 'includes/header.php'; ?>

<?php include 'includes/sidebar.php'; ?>

<main class="content">

    <div class="dashboard-header">

        <h1>Dashboard</h1>

        <p>
            Bem-vindo,
            <strong><?= htmlspecialchars($_SESSION['usuario_nome']) ?></strong>
        </p>

    </div>

    <div class="cards">

        <div class="card">

            <span>Clientes</span>

            <h2>0</h2>

        </div>

        <div class="card">

            <span>Produtos</span>

            <h2>0</h2>

        </div>

        <div class="card">

            <span>Propostas</span>

            <h2>0</h2>

        </div>

        <div class="card">

            <span>Faturamento</span>

            <h2>R$ 0,00</h2>

        </div>

    </div>

    <div class="panel">

        <h3>Ações Rápidas</h3>

        <div class="actions">

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

        <h3>Produtos com Estoque Baixo</h3>

        <p>Nenhum produto encontrado.</p>

    </div>

    <div class="panel">

        <h3>Últimas Propostas Comerciais</h3>

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

    </div>

</main>

<?php include 'includes/footer.php'; ?>

<script src="/orcamento/assets/js/app.js?v=<?= filemtime(__DIR__.'/assets/js/app.js') ?>"></script>

</body>

</html>