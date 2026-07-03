<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario_nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | LLA ERP Comercial</title>

    <link rel="stylesheet" href="/orcamento/assets/css/reset.css">
    <link rel="stylesheet" href="/orcamento/assets/css/variables.css">
    <link rel="stylesheet" href="/orcamento/assets/css/layout.css">
    <link rel="stylesheet" href="/orcamento/assets/css/header.css">
    <link rel="stylesheet" href="/orcamento/assets/css/menu.css">
    <link rel="stylesheet" href="/orcamento/assets/css/dashboard.css">

</head>

<body>

    <?php include 'includes/header.php'; ?>

    <?php include 'includes/menu.php'; ?>

    <main id="content" class="content">

        <div class="container">

            <section class="page-header">

                <h1>Dashboard</h1>

                <p>

                    Bem-vindo,

                    <strong><?= htmlspecialchars($usuario) ?></strong>

                </p>

            </section>

            <section class="dashboard">

                <div class="dashboard-empty">

                    <h2>

                        LLA ERP Comercial

                    </h2>

                    <p>

                        Sistema iniciado com sucesso.

                    </p>

                    <p>

                        Nesta área serão exibidos os indicadores do sistema.

                    </p>

                </div>

            </section>

        </div>

    </main>

    <script src="/orcamento/assets/js/menu.js"></script>

    <script src="/orcamento/assets/js/app.js"></script>

</body>

</html>