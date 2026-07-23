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

<div class="container-fluid">

    <!-- Cabeçalho -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="mb-0">Estoque</h1>
            <small class="text-muted">
                Controle de Estoque
            </small>
        </div>

        <div>

            <a href="movimentacoes.php" class="btn btn-primary">
                <i class="fas fa-exchange-alt"></i>
                Movimentações
            </a>

        </div>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-hover table-striped align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Código</th>

                        <th>Produto</th>

                        <th class="text-center">
                            Atual
                        </th>

                        <th class="text-center">
                            Reservado
                        </th>

                        <th class="text-center">
                            Disponível
                        </th>

                        <th class="text-center">
                            Mínimo
                        </th>

                        <th class="text-center">
                            Máximo
                        </th>

                        <th>
                            Localização
                        </th>

                        <th class="text-center">
                            Status
                        </th>

                        <th width="180" class="text-center">
                            Ações
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (empty($estoque)): ?>

                    <tr>

                        <td colspan="10" class="text-center text-muted">

                            Nenhum produto encontrado no estoque.

                        </td>

                    </tr>

                    <?php else: ?>

                    <?php foreach ($estoque as $item): ?>

                    <?php

                        if ($item['quantidade_atual'] <= 0) {

                            $status = '<span class="badge bg-danger">Sem Estoque</span>';

                        } elseif ($item['quantidade_atual'] <= $item['estoque_minimo']) {

                            $status = '<span class="badge bg-warning text-dark">Estoque Baixo</span>';

                        } elseif (

                            $item['estoque_maximo'] > 0 &&
                            $item['quantidade_atual'] > $item['estoque_maximo']

                        ) {

                            $status = '<span class="badge bg-info">Acima do Máximo</span>';

                        } else {

                            $status = '<span class="badge bg-success">Normal</span>';

                        }

                        ?>

                    <tr>

                        <td>

                            <?= htmlspecialchars($item['codigo']) ?>

                        </td>

                        <td>

                            <?= htmlspecialchars($item['nome']) ?>

                        </td>

                        <td class="text-center">

                            <?= number_format($item['quantidade_atual'],3,',','.') ?>

                        </td>

                        <td class="text-center">

                            <?= number_format($item['quantidade_reservada'],3,',','.') ?>

                        </td>

                        <td class="text-center">

                            <?= number_format($item['disponivel'],3,',','.') ?>

                        </td>

                        <td class="text-center">

                            <?= number_format($item['estoque_minimo'],3,',','.') ?>

                        </td>

                        <td class="text-center">

                            <?= number_format($item['estoque_maximo'],3,',','.') ?>

                        </td>

                        <td>

                            <?= htmlspecialchars($item['localizacao'] ?? '') ?>

                        </td>

                        <td class="text-center">

                            <?= $status ?>

                        </td>

                        <td class="text-center">

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

    </div>

</div>

<?php require_once '../../includes/layout_fim.php'; ?>