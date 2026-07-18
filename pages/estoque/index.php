<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$titulo = "Estoque";

require_once '../../controllers/EstoqueController.php';

$controller = new EstoqueController();
$estoque = $controller->index();

require_once '../../includes/layout_inicio.php';
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

<div class="card">

    <table class="table table-hover align-middle">

        <thead>
            <tr>
                <th>Código</th>
                <th>Produto</th>
                <th class="text-center">Atual</th>
                <th class="text-center">Reservado</th>
                <th class="text-center">Disponível</th>
                <th class="text-center">Mínimo</th>
                <th class="text-center">Máximo</th>
                <th>Localização</th>
                <th>Status</th>
                <th width="140">Ações</th>
            </tr>
        </thead>

        <tbody>

        <?php if(empty($estoque)): ?>

            <tr>
                <td colspan="10" class="text-center">
                    Nenhum produto encontrado no estoque.
                </td>
            </tr>

        <?php else: ?>

            <?php foreach($estoque as $item): ?>

                <?php

                    if($item['quantidade_atual'] <= 0){

                        $status = '<span class="badge bg-danger">Sem Estoque</span>';

                    }elseif($item['quantidade_atual'] <= $item['estoque_minimo']){

                        $status = '<span class="badge bg-warning text-dark">Estoque Baixo</span>';

                    }elseif($item['quantidade_atual'] > $item['estoque_maximo']){

                        $status = '<span class="badge bg-info">Acima do Máximo</span>';

                    }else{

                        $status = '<span class="badge bg-success">Normal</span>';

                    }

                ?>

                <tr>

                    <td><?= htmlspecialchars($item['codigo']) ?></td>

                    <td><?= htmlspecialchars($item['nome']) ?></td>

                    <td class="text-center"><?= $item['quantidade_atual'] ?></td>

                    <td class="text-center"><?= $item['quantidade_reservada'] ?></td>

                    <td class="text-center"><?= $item['disponivel'] ?></td>

                    <td class="text-center"><?= $item['estoque_minimo'] ?></td>

                    <td class="text-center"><?= $item['estoque_maximo'] ?></td>

                    <td><?= htmlspecialchars($item['localizacao']) ?></td>

                    <td><?= $status ?></td>

                    <td>

                        <a href="entrada.php?id=<?= $item['produto_id'] ?>" class="btn btn-success btn-sm">
                            Entrada
                        </a>

                        <a href="saida.php?id=<?= $item['produto_id'] ?>" class="btn btn-danger btn-sm">
                            Saída
                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php endif; ?>

        </tbody>

    </table>

</div>

<?php require_once '../../includes/layout_fim.php'; ?>