<?php

$titulo = "Movimentações de Estoque";

require_once '../../controllers/EstoqueController.php';

$controller = new EstoqueController();

$movimentacoes = $controller->listarMovimentacoes();

require_once '../../includes/layout_inicio.php';

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-4">

        <h2>Movimentações de Estoque</h2>

        <a href="index.php" class="btn btn-secondary">
            Voltar
        </a>

    </div>

    <pre>

<?php print_r($movimentacoes); ?>

    </pre>

</div>

<?php require_once '../../includes/layout_fim.php'; ?>