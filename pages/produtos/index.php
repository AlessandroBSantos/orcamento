<?php

$titulo = "Produtos";

require_once '../../includes/layout_inicio.php';
require_once '../../controllers/ProdutosController.php';

$controller = new ProdutoController();

$clientes = $controller->index();

?>


<?php

require_once '../../includes/layout_fim.php';

?>