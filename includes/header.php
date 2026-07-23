<header class="topbar">

    <div class="topbar-left">

        <button id="btnMenu" class="menu-button" type="button" aria-label="Abrir Menu">

            ☰

        </button>

        <div class="logo">

            <span>LLA</span> ERP

        </div>

    </div>

    <div class="topbar-center">

        <input type="text" class="search-box" placeholder="Pesquisar...">

    </div>

    <div class="topbar-right">

        <div class="user-info">

            <div class="avatar">

                <?= strtoupper(substr($_SESSION['usuario_nome'],0,1)); ?>

            </div>

            <div>

                <strong><?= htmlspecialchars($_SESSION['usuario_nome']) ?></strong>

                <small>Administrador</small>

            </div>

        </div>

    </div>

</header>