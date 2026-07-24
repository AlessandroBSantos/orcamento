<?php
echo "<!-- SIDEBAR CARREGADA -->";
?>
<aside id="sidebar" class="sidebar">

    <nav class="sidebar-menu">

        <a href="<?= BASE_URL ?>/dashboard.php">
            Dashboard
        </a>

        <a href="<?= BASE_URL ?>/pages/clientes/index.php">
            Clientes
        </a>

        <a href="<?= BASE_URL ?>/pages/fornecedores/index.php">
            Fornecedores
        </a>

        <a href="<?= BASE_URL ?>/pages/produtos/index.php">
            Produtos
        </a>

        <a href="<?= BASE_URL ?>/pages/estoque/index.php">
            Estoque
        </a>

        <a href="<?= BASE_URL ?>/pages/propostas/index.php">
            Propostas
        </a>
        
        <a href="<?= BASE_URL ?>/pages/equipamentos/index.php">
            Equipamentos
        </a>

        <a href="<?= BASE_URL ?>/pages/manutencao/index.php">
            Manutenção
        </a>

        <a href="<?= BASE_URL ?>/pages/financeiro/index.php">
            Financeiro
        </a>

        <a href="<?= BASE_URL ?>/pages/configuracoes/index.php">
            Configurações
        </a>

        <hr>

        <a href="<?= BASE_URL ?>/logout.php">
            Sair
        </a>

    </nav>

</aside>