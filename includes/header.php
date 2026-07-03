<header class="topbar">

    <div class="topbar-left">

        <button id="btnMenu" class="btn-menu">

            <img
                src="/orcamento/assets/icons/menu.svg"
                alt="Menu">

        </button>

        <div class="logo">

            <span>LLA</span>

            ERP Comercial

        </div>

    </div>

    <div class="topbar-right">

        <div class="usuario">

            <?= htmlspecialchars($usuario ?? "Administrador") ?>

        </div>

        <img
            src="/orcamento/assets/images/avatar.png"
            class="avatar"
            alt="Usuário">

    </div>

</header>