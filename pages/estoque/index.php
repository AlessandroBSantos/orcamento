<?php 
$titulo = "Estoque";
requere_once '../../includes/layout.php';
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

<div class="panel">
    <h2>Estoque</h2>
    <p>Em construção...</p>
</div>

<?php require_once '../../includes/layout_fim.php'; ?>