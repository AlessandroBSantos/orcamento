<?php

$titulo = "Clientes";

require_once '../../includes/layout_inicio.php';

echo "<h2>Passo 1 - Layout OK</h2>";

require_once '../../controllers/ClienteController.php';

echo "<h2>Passo 2 - Controller OK</h2>";

$controller = new ClienteController();

echo "<h2>Passo 3 - Instância OK</h2>";

$clientes = $controller->index();

echo "<h2>Passo 4 - Consulta OK</h2>";

?>

<div class="dashboard-header">

    <h1>Clientes</h1>

</div>

<?php

require_once '../../includes/layout_fim.php';