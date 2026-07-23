<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Cabeçalho Principal (Layout)
|--------------------------------------------------------------------------
|
| Este arquivo é responsável por montar a estrutura
| inicial de todas as páginas do sistema.
|
| Responsabilidades:
| - Carregar as configurações globais.
| - Validar a autenticação do usuário.
| - Definir o título da página.
| - Definir os scripts específicos da página.
| - Carregar os arquivos CSS globais.
| - Incluir o Header e o Menu Lateral.
| - Iniciar a área principal do conteúdo.
|
|--------------------------------------------------------------------------
*/

//
// Carrega as configurações gerais do sistema.
//
require_once __DIR__ . '/../config/app.php';

//
// Verifica se o usuário está autenticado.
//
require_once __DIR__ . '/auth.php';

//
// Caso a página não informe um título,
// utiliza o nome padrão da aplicação.
//
if (!isset($titulo)) {
    $titulo = APP_NAME;
}

/*
|--------------------------------------------------------------------------
| Scripts específicos da página
|--------------------------------------------------------------------------
|
| Cada página poderá informar quais arquivos
| JavaScript serão carregados.
|
| Exemplo:
|
| $scripts = [
|     'tabs.js',
|     'produtos.js'
| ];
|
| Caso nenhuma página informe scripts,
| será utilizado um array vazio.
|--------------------------------------------------------------------------
*/

if (!isset($scripts)) {
    $scripts = [];
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <!-- Define a codificação UTF-8 -->
    <meta charset="UTF-8">

    <!-- Configuração para dispositivos móveis -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--
        Define o título exibido na aba
        do navegador.
    -->
    <title><?= htmlspecialchars($titulo) ?> | <?= APP_NAME ?></title>

    <!--
        Reset CSS
        Remove estilos padrões do navegador.
    -->
    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/reset.css?v=<?= filemtime(__DIR__ . '/../assets/css/reset.css') ?>">

    <!--
        Arquivo contendo todas as variáveis
        globais do sistema (cores, fontes, etc.).
    -->
    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/variables.css?v=<?= filemtime(__DIR__ . '/../assets/css/variables.css') ?>">

    <!--
        Arquivo principal de estilos do sistema.

        O parâmetro ?v=filemtime() evita problemas
        de cache, carregando sempre a versão mais
        recente do arquivo.
    -->
    <link rel="stylesheet"
        href="<?= BASE_URL ?>/assets/css/app.css?v=<?= filemtime(__DIR__ . '/../assets/css/app.css') ?>">

</head>

<body>

    <!--
        Cabeçalho principal do sistema.
    -->
    <?php include __DIR__ . '/header.php'; ?>

    <!--
        Menu lateral (Sidebar).
    -->
    <?php include __DIR__ . '/sidebar.php'; ?>

    <!--
        Início da área principal de conteúdo.
        Todo o conteúdo específico da página
        será exibido dentro desta tag.
    -->
    <main class="content">