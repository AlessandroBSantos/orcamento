<?php

session_start();

$titulo = "Ordens de Manutenção";

require_once '../../config/app.php';
require_once '../../controllers/ManutencaoController.php';

$controller = new ManutencaoController();
$manutencoes = $controller->index();

require_once '../../includes/layout_inicio.php';

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">Ordens de Manutenção</h2>
            <small class="text-muted">
                Controle das Ordens de Manutenção
            </small>
        </div>

        <div>

            <a href="dashboard.php" class="btn btn-secondary">
                Dashboard
            </a>

            <a href="nova.php" class="btn btn-primary">
                Nova Ordem
            </a>

        </div>

    </div>

    <?php if(isset($_GET['sucesso'])): ?>

        <div class="alert alert-success">
            Operação realizada com sucesso.
        </div>

    <?php endif; ?>

    <?php if(isset($_GET['erro'])): ?>

        <div class="alert alert-danger">
            <?= htmlspecialchars($_GET['erro']) ?>
        </div>

    <?php endif; ?>

    <div class="card shadow">

        <div class="card-header">

            <strong>Ordens Cadastradas</strong>

        </div>

        <div class="card-body">

            <table class="table table-striped table-hover align-middle">

                <thead>

                    <tr>

                        <th>OS</th>

                        <th>Equipamento</th>

                        <th>Tipo</th>

                        <th>Prioridade</th>

                        <th>Status</th>

                        <th>Data</th>

                        <th width="300">Ações</th>

                    </tr>

                </thead>

                <tbody>

                <?php if(empty($manutencoes)): ?>

                    <tr>

                        <td colspan="7" class="text-center">

                            Nenhuma Ordem cadastrada.

                        </td>

                    </tr>

                <?php else: ?>

                    <?php foreach($manutencoes as $item): ?>

                        <tr>

                            <td>

                                <?= htmlspecialchars($item['numero_os']) ?>

                            </td>

                            <td>

                                <strong><?= htmlspecialchars($item['codigo']) ?></strong>

                                <br>

                                <?= htmlspecialchars($item['descricao']) ?>

                            </td>

                            <td>

                                <?= htmlspecialchars($item['tipo']) ?>

                            </td>

                            <td>

                                <?php

                                switch($item['prioridade']){

                                    case 'URGENTE':

                                        echo '<span class="badge bg-danger">URGENTE</span>';

                                        break;

                                    case 'ALTA':

                                        echo '<span class="badge bg-warning text-dark">ALTA</span>';

                                        break;

                                    case 'MEDIA':

                                        echo '<span class="badge bg-primary">MÉDIA</span>';

                                        break;

                                    default:

                                        echo '<span class="badge bg-success">BAIXA</span>';

                                }

                                ?>

                            </td>

                            <td>

                                <?php

                                switch($item['status']){

                                    case 'ABERTA':
                                        echo '<span class="badge bg-secondary">ABERTA</span>';
                                        break;

                                    case 'EM_ANALISE':
                                        echo '<span class="badge bg-info text-dark">EM ANÁLISE</span>';
                                        break;

                                    case 'AGUARDANDO_APROVACAO':
                                        echo '<span class="badge bg-warning text-dark">AG. APROVAÇÃO</span>';
                                        break;

                                    case 'AGUARDANDO_PECA':
                                        echo '<span class="badge bg-warning text-dark">AG. PEÇA</span>';
                                        break;

                                    case 'EM_MANUTENCAO':
                                        echo '<span class="badge bg-primary">EM MANUTENÇÃO</span>';
                                        break;

                                    case 'TESTE':
                                        echo '<span class="badge bg-dark">TESTE</span>';
                                        break;

                                    case 'FINALIZADA':
                                        echo '<span class="badge bg-success">FINALIZADA</span>';
                                        break;

                                    case 'ENTREGUE':
                                        echo '<span class="badge bg-success">ENTREGUE</span>';
                                        break;

                                    case 'CANCELADA':
                                        echo '<span class="badge bg-danger">CANCELADA</span>';
                                        break;

                                    default:
                                        echo htmlspecialchars($item['status']);

                                }

                                ?>

                            </td>

                            <td>

                                <?php

                                if(!empty($item['data_abertura'])){

                                    echo date('d/m/Y', strtotime($item['data_abertura']));

                                }

                                ?>

                            </td>

                            <td>

                                <a href="visualizar.php?id=<?= $item['id'] ?>"
                                   class="btn btn-sm btn-info">

                                    Visualizar

                                </a>

                                <a href="editar.php?id=<?= $item['id'] ?>"
                                   class="btn btn-sm btn-primary">

                                    Editar

                                </a>

                                <a href="finalizar.php?id=<?= $item['id'] ?>"
                                   class="btn btn-sm btn-success">

                                    Finalizar

                                </a>

                                <a href="cancelar.php?id=<?= $item['id'] ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Deseja cancelar esta Ordem?')">

                                    Cancelar

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