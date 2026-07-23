<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Sidebar (Menu Lateral)
|--------------------------------------------------------------------------
|
| Este arquivo é responsável por exibir o menu
| lateral de navegação do sistema.
|
| Funcionalidades:
| - Exibe os módulos disponíveis.
| - Permite a navegação entre as páginas.
| - Disponibiliza a opção de logout.
|
|--------------------------------------------------------------------------
*/

//
// Mensagem utilizada apenas para testes,
// indicando que o menu lateral foi carregado.
//
echo "<!-- SIDEBAR CARREGADA -->";
?>

<!--
=====================================================
Menu Lateral (Sidebar)

Contém todos os links de navegação
do sistema LLA ERP.
=====================================================
-->

<aside id="sidebar" class="sidebar">

    <!-- Início do menu de navegação -->
    <nav class="sidebar-menu">

        <!-- Dashboard -->
        <a href="<?= BASE_URL ?>/dashboard.php">
            🏠 Dashboard
        </a>

        <!-- Cadastro de Clientes -->
        <a href="<?= BASE_URL ?>/pages/clientes/index.php">
            👥 Clientes
        </a>

        <!-- Cadastro de Fornecedores -->
        <a href="<?= BASE_URL ?>/pages/fornecedores/index.php">
            🚚 Fornecedores
        </a>

        <!-- Cadastro de Produtos -->
        <a href="<?= BASE_URL ?>/pages/produtos/index.php">
            📦 Produtos
        </a>

        <!-- Controle de Estoque -->
        <a href="<?= BASE_URL ?>/pages/estoque/index.php">
            📋 Estoque
        </a>

        <!-- Gestão de Propostas -->
        <a href="<?= BASE_URL ?>/pages/propostas/index.php">
            📑 Propostas
        </a>

        <!-- Módulo Financeiro -->
        <a href="<?= BASE_URL ?>/pages/financeiro/index.php">
            💰 Financeiro
        </a>

        <!-- Configurações do Sistema -->
        <a href="<?= BASE_URL ?>/pages/configuracoes/index.php">
            ⚙️ Configurações
        </a>

        <!-- Separador visual -->
        <hr>

        <!-- Encerrar sessão do usuário -->
        <a href="<?= BASE_URL ?>/logout.php">
            🚪 Sair
        </a>

    </nav>

</aside>