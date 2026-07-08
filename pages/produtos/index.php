<?php

$titulo = "Produtos";

require_once '../../includes/layout_inicio.php';
require_once '../../controllers/ClienteController.php';

$controller = new ClienteController();

$clientes = $controller->index();

?>


<?php

require_once '../../includes/layout_fim.php';

?>