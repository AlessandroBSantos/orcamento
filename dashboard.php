<?php

$titulo = "Dashboard";

require_once 'includes/layout_inicio.php';

?>

<div class="dashboard-header">

    <h1>Dashboard</h1>

    <p>

        Bem-vindo,

        <strong>

            <?= htmlspecialchars($_SESSION['usuario_nome']) ?>

        </strong>

    </p>

</div>

<!-- Aqui entrarão os cards -->

<?php

require_once 'includes/layout_fim.php';

?>