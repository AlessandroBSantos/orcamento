<?php

require_once 'includes/auth.php';

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

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

    <h1>

        Dashboard

    </h1>

    <p>

        Bem-vindo,

        <?= htmlspecialchars($_SESSION['usuario_nome']) ?>

    </p>

</main>

<?php include 'includes/footer.php'; ?>

<script src="/orcamento/assets/js/app.js"></script>

</body>

</html>