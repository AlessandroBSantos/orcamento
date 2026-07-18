<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$titulo = "Estoque";
require_once '../../controllers/EstoqueController.php';
$controller = new EstoqueController();
$estoque = $controller->index();
require_once '../../includes/layout.php';
?>

<div>
    <div>
        <h1>Estoque</h1>
        <p>Controle de Estoque</p>
</div>

<div style="display:flex; gap:10px;">
    <a href="entrada.php" class="btn btn-primary">
        Entrada
    </a>
    <a href="saida.php" class="btn-warning">
        Saída
    </a>
    <a href="movimentacos.php" class="btn btn-primary">
        Movimentações
    </a>
</div>

<pre> 
    <?php print_r($estoque); ?>
</pre>

<?php require_once '../../includes/layout_fim.php'; ?>