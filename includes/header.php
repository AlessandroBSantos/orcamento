<!--
=====================================================
LLA ERP
Topbar (Cabeçalho)

Este componente representa o cabeçalho principal
do sistema e permanece visível durante a navegação.

Elementos disponíveis:
- Botão para abrir/fechar o menu lateral.
- Logotipo do sistema.
- Campo de pesquisa.
- Informações do usuário autenticado.
- Avatar com a inicial do usuário.

=====================================================
-->

<header class="topbar">

    <!-- Área esquerda do cabeçalho -->
    <div class="topbar-left">

        <!--
            Botão responsável por abrir
            e fechar o menu lateral.
        -->
        <button id="btnMenu" class="menu-button" type="button" aria-label="Abrir Menu">

            ☰

        </button>

        <!-- Logotipo do sistema -->
        <div class="logo">

            <span>LLA</span> ERP

        </div>

    </div>

    <!-- Área central do cabeçalho -->
    <div class="topbar-center">

        <!--
            Campo destinado à pesquisa
            de informações dentro do sistema.
        -->
        <input type="text" class="search-box" placeholder="Pesquisar...">

    </div>

    <!-- Área direita do cabeçalho -->
    <div class="topbar-right">

        <!-- Informações do usuário logado -->
        <div class="user-info">

            <!--
                Avatar do usuário.

                Exibe automaticamente a primeira
                letra do nome em maiúsculo.
            -->
            <div class="avatar">

                <?= strtoupper(substr($_SESSION['usuario_nome'],0,1)); ?>

            </div>

            <!-- Nome e perfil do usuário -->
            <div>

                <!-- Nome do usuário autenticado -->
                <strong><?= htmlspecialchars($_SESSION['usuario_nome']) ?></strong>

                <!-- Perfil de acesso -->
                <small>Administrador</small>

            </div>

        </div>

    </div>

</header>