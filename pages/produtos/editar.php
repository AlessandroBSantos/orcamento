<?php

$titulo = "Editar Produto";

/*
|--------------------------------------------------------------------------
| JavaScripts da página
|--------------------------------------------------------------------------
*/

$scripts = [
    'tabs.js',
    'produtos.js'
];

require_once '../../includes/layout_inicio.php';
require_once '../../controllers/ProdutoController.php';

$controller = new ProdutoController();

/*
|--------------------------------------------------------------------------
| Valida o ID do produto
|--------------------------------------------------------------------------
*/

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {

    header('Location: index.php');
    exit;

}

/*
|--------------------------------------------------------------------------
| Busca o produto
|--------------------------------------------------------------------------
*/

$produto = $controller->buscarPorId($id);

if (!$produto) {

    header('Location: index.php');
    exit;

}

/*
|--------------------------------------------------------------------------
| Carrega listas
|--------------------------------------------------------------------------
*/

$categorias   = $controller->listarCategorias();
$marcas       = $controller->listarMarcas();
$unidades     = $controller->listarUnidades();
$fornecedores = $controller->listarFornecedores();

?>

<div class="dashboard-header">

    <div>

        <h1>Editar Produto</h1>

        <p><?= htmlspecialchars($produto['nome']) ?></p>

    </div>

    <a href="index.php" class="btn btn-primary">

        ← Voltar

    </a>

</div>

<?php

$acao = "atualizar.php";

require_once "form.php";

?>

<?php

require_once '../../includes/layout_fim.php';

?>