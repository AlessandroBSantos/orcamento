<header class="topbar">

    <div class="topbar-left">

        <button
            id="btnMenu"
            class="menu-button"
            aria-label="Abrir Menu">

            ☰

        </button>

        <div class="logo">

            LLA <span>ERP</span>

        </div>

    </div>

    <div class="usuario">

        <span>

            <?= htmlspecialchars($_SESSION['usuario_nome']) ?>

        </span>

    </div>

</header>