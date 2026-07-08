<?php

$titulo = "Produtos";

require_once '../../includes/layout_inicio.php';
require_once '../../controllers/ClienteController.php';

$controller = new ClienteController();

$clientes = $controller->index();

?>

<div class="dashboard-header">

    <div>

        <h1>Clientes</h1>

        <p>Cadastro de Clientes</p>

    </div>

    <a href="novo.php" class="btn">

        + Novo Cliente

    </a>

</div>

<?php if(isset($_GET['sucesso'])): ?>

<div class="alert alert-success">

<?php

switch($_GET['sucesso']){

    case "cadastrado":

        echo "Cliente cadastrado com sucesso.";

        break;

    case "editado":

        echo "Cliente atualizado com sucesso.";

        break;

    case "excluido":

        echo "Cliente excluído com sucesso.";

        break;

}

?>

</div>

<?php endif; ?>



<?php

require_once '../../includes/layout_fim.php';

?>