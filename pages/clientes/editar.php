<?php

$titulo = "Editar Cliente";

require_once '../../includes/layout_inicio.php';
require_once '../../controllers/ClienteController.php';

if (!isset($_GET['id'])) {

    die("ID do cliente não informado.");

}

$id = (int) $_GET['id'];

$controller = new ClienteController();

$cliente = $controller->buscarPorId($id);

if (!$cliente) {

    die("Cliente não encontrado.");

}

?>

<div class="dashboard-header">

    <div>

        <h1>Editar Cliente</h1>

        <p>Teste de carregamento dos dados</p>

    </div>

    <a href="index.php" class="btn">

        ← Voltar

    </a>

</div>

<div class="panel">

    <h2>Dados do Cliente</h2>

    <pre>

<?php print_r($cliente); ?>

    </pre>

</div>

<?php

require_once '../../includes/layout_fim.php';

?>