<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/auth.php';
require_once 'queries/dashboard.php';




require_once 'includes/auth.php';
require_once 'queries/dashboard.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - LLA ERP</title>

    <link rel="stylesheet" href="/orcamento/assets/css/reset.css?v=<?= filemtime(__DIR__.'/assets/css/reset.css') ?>">

    <link rel="stylesheet" href="/orcamento/assets/css/variables.css?v=<?= filemtime(__DIR__.'/assets/css/variables.css') ?>">

    <link rel="stylesheet" href="/orcamento/assets/css/app.css?v=<?= filemtime(__DIR__.'/assets/css/app.css') ?>">

    <link rel="stylesheet" href="/orcamento/assets/css/dashboard.css?v=<?= filemtime(__DIR__.'/assets/css/dashboard.css') ?>">

</head>

<body>

<?php include 'includes/header.php'; ?>

<?php include 'includes/sidebar.php'; ?>


<main class="content">

    <!-- Cabeçalho -->

    <section class="dashboard-header">

        <h1>Dashboard</h1>

        <p>

            Bem-vindo,

            <strong><?= htmlspecialchars($_SESSION['usuario_nome']) ?></strong>

        </p>

    </section>


    <!-- Cards -->

    <section class="cards">

        <div class="card">

            <span>Clientes</span>

            <h2><?= $totalClientes ?></h2>

        </div>

        <div class="card">

            <span>Produtos</span>

            <h2><?= $totalProdutos ?></h2>

        </div>

        <div class="card">

            <span>Propostas</span>

            <h2><?= $totalPropostas ?></h2>

        </div>

        <div class="card">

            <span>Faturamento</span>

            <h2>

                R$ <?= number_format($totalVendas,2,",",".") ?>

            </h2>

        </div>

    </section>


    <!-- Linha 1 -->

    <section class="dashboard-grid">

        <!-- Ações -->

        <div class="panel">

            <h3>Ações Rápidas</h3>

            <div class="actions">

                <a class="btn" href="/orcamento/pages/clientes.php">

                    Novo Cliente

                </a>

                <a class="btn" href="/orcamento/pages/produtos.php">

                    Novo Produto

                </a>

                <a class="btn" href="/orcamento/pages/propostas.php">

                    Nova Proposta

                </a>

            </div>

        </div>


        <!-- Estoque -->

        <div class="panel">

            <h3>Produtos com Estoque Baixo</h3>

            <?php if(count($estoqueBaixo) > 0): ?>

                <table>

                    <thead>

                        <tr>

                            <th>Produto</th>

                            <th>Estoque</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach($estoqueBaixo as $produto): ?>

                        <tr>

                            <td><?= htmlspecialchars($produto['nome']) ?></td>

                            <td><?= $produto['estoque'] ?></td>

                        </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            <?php else: ?>

                <p>Nenhum produto com estoque baixo.</p>

            <?php endif; ?>

        </div>

    </section>


    <!-- Últimas Propostas -->

    <section class="panel">

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

            <?php if(count($ultimasPropostas) > 0): ?>

                <?php foreach($ultimasPropostas as $proposta): ?>

                <tr>

                    <td>

                        <?= htmlspecialchars($proposta['numero']) ?>

                    </td>

                    <td>

                        <?= htmlspecialchars($proposta['cliente']) ?>

                    </td>

                    <td>

                        R$ <?= number_format($proposta['valor_total'],2,",",".") ?>

                    </td>

                    <td>

                        <?= htmlspecialchars($proposta['status']) ?>

                    </td>

                    <td>

                        <?= date("d/m/Y",strtotime($proposta['data_criacao'])) ?>

                    </td>

                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>

                    <td colspan="5">

                        Nenhuma proposta cadastrada.

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </section>

</main>


<?php include 'includes/footer.php'; ?>


<script src="/orcamento/assets/js/app.js?v=<?= filemtime(__DIR__.'/assets/js/app.js') ?>"></script>

</body>

</html>