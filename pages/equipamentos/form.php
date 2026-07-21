<?php

$titulo = "Equipamentos";

require_once '../../controllers/EquipamentosController.php';

$controller = new EquipamentosController();

$equipamentos = $controller->index();

require_once '../../includes/layout_inicio.php';

?>

<div class="container-fluid">

    <div class="page-header">

        <div>

            <h1>Equipamentos</h1>

            <p>Cadastro e controle dos equipamentos.</p>

        </div>

        <div>

            <a href="form.php" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Novo Equipamento
            </a>

        </div>

    </div>

    <div class="card">

        <div class="card-body">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>Código</th>

                        <th>Patrimônio</th>

                        <th>Descrição</th>

                        <th>Categoria</th>

                        <th>Marca</th>

                        <th>Modelo</th>

                        <th>Status</th>

                        <th>Responsável</th>

                        <th width="220">Ações</th>

                    </tr>

                </thead>

                <tbody>

                <?php if(empty($equipamentos)): ?>

                    <tr>

                        <td colspan="9" class="text-center">

                            Nenhum equipamento cadastrado.

                        </td>

                    </tr>

                <?php else: ?>

                    <?php foreach($equipamentos as $equipamento): ?>

                        <tr>

                            <td>

                                <?= htmlspecialchars($equipamento['codigo']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($equipamento['patrimonio']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($equipamento['descricao']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($equipamento['categoria']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($equipamento['marca']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($equipamento['modelo']) ?>

                            </td>

                            <td>

                                <?php

                                switch($equipamento['status']){

                                    case 'OPERACAO':
                                        echo '<span class="badge bg-success">Operação</span>';
                                    break;

                                    case 'MANUTENCAO':
                                        echo '<span class="badge bg-warning">Manutenção</span>';
                                    break;

                                    case 'AGUARDANDO_PECA':
                                        echo '<span class="badge bg-info">Aguardando Peça</span>';
                                    break;

                                    case 'DESCARTADO':
                                        echo '<span class="badge bg-danger">Descartado</span>';
                                    break;

                                    case 'VENDIDO':
                                        echo '<span class="badge bg-secondary">Vendido</span>';
                                    break;

                                    default:
                                        echo $equipamento['status'];

                                }

                                ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($equipamento['responsavel']) ?>

                            </td>

                            <td>

                                <a
                                    href="form.php?id=<?= $equipamento['id'] ?>"
                                    class="btn btn-sm btn-primary">

                                    Editar

                                </a>

                                <a
                                    href="excluir.php?id=<?= $equipamento['id'] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Deseja excluir este equipamento?')">

                                    Excluir

                                </a>

                                <a
                                    href="../manutencao/nova.php?equipamento=<?= $equipamento['id'] ?>"
                                    class="btn btn-sm btn-warning">

                                    Manutenção

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

<?php

require_once '../../includes/layout_fim.php';

?>