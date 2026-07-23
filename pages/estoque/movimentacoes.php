<?php

$titulo = "Movimentações de Estoque";

require_once '../../controllers/EstoqueController.php';

$controller = new EstoqueController();

$movimentacoes = $controller->listarMovimentacoes();

require_once '../../includes/layout_inicio.php';

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1 class="mb-0">
                Movimentações de Estoque
            </h1>

            <small class="text-muted">
                Histórico de entradas e saídas
            </small>

        </div>

        <div>

            <a href="index.php" class="btn btn-secondary">
                Voltar
            </a>

        </div>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <table class="table table-hover table-striped align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Data</th>

                        <th>Tipo</th>

                        <th>Código</th>

                        <th>Produto</th>

                        <th class="text-center">
                            Quantidade
                        </th>

                        <th class="text-end">
                            Valor Unitário
                        </th>

                        <th class="text-end">
                            Valor Total
                        </th>

                        <th>Documento</th>

                        <th>Fornecedor</th>

                        <th>Usuário</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if(empty($movimentacoes)): ?>

                    <tr>

                        <td colspan="10" class="text-center">

                            Nenhuma movimentação encontrada.

                        </td>

                    </tr>

                    <?php else: ?>

                    <?php foreach($movimentacoes as $item): ?>

                    <tr>

                        <td>

                            <?= date(
                                    'd/m/Y H:i',
                                    strtotime($item['data_movimentacao'])
                                ) ?>

                        </td>

                        <td>

                            <?php if($item['tipo'] == 'ENTRADA'): ?>

                            <span class="badge bg-success">
                                Entrada
                            </span>

                            <?php else: ?>

                            <span class="badge bg-danger">
                                Saída
                            </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <?= htmlspecialchars($item['codigo']) ?>

                        </td>

                        <td>

                            <?= htmlspecialchars($item['nome']) ?>

                        </td>

                        <td class="text-center">

                            <?= number_format(
                                    $item['quantidade'],
                                    3,
                                    ',',
                                    '.'
                                ) ?>

                        </td>

                        <td class="text-end">

                            R$
                            <?= number_format(
                                    $item['valor_unitario'],
                                    2,
                                    ',',
                                    '.'
                                ) ?>

                        </td>

                        <td class="text-end">

                            R$
                            <?= number_format(
                                    $item['valor_total'],
                                    2,
                                    ',',
                                    '.'
                                ) ?>

                        </td>

                        <td>

                            <?= htmlspecialchars(
                                    $item['documento']
                                ) ?>

                        </td>

                        <td>

                            <?= htmlspecialchars(
                                    $item['fornecedor'] ?? '-'
                                ) ?>

                        </td>

                        <td>

                            <?= htmlspecialchars(
                                    $item['usuario'] ?? '-'
                                ) ?>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?php

require_once '../../includes/layout_fim.php';

?>