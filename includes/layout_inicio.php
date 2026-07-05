<?php

require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/auth.php';

if (!isset($titulo)) {
    $titulo = APP_NAME;
}



?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($titulo) ?> | <?= APP_NAME ?></title>

    <link rel="stylesheet"
          href="<?= BASE_URL ?>/assets/css/reset.css?v=<?= filemtime(__DIR__ . '/../assets/css/reset.css') ?>">

    <link rel="stylesheet"
          href="<?= BASE_URL ?>/assets/css/variables.css?v=<?= filemtime(__DIR__ . '/../assets/css/variables.css') ?>">

    <link rel="stylesheet"
          href="<?= BASE_URL ?>/assets/css/app.css?v=<?= filemtime(__DIR__ . '/../assets/css/app.css') ?>">

</head>

<body>

<?php include __DIR__ . '/header.php'; ?>

<?php include __DIR__ . '/sidebar.php'; ?>

<main class="content">