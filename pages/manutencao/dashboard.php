<?php

session_start();

$titulo = "Dashboard da Manutenção";

require_once '../../config/app.php';
require_once '../../controllers/ManutencaoController.php';

$controller = new ManutencaoController();

$dados = $controller->dashboard();
$ultimas = $controller->index();

require_once '../../includes/layout_inicio.php';

$total = (int)($dados['total'] ?? 0);
$abertas = (int)($dados['abertas'] ?? 0);
$analise = (int)($dados['analise'] ?? 0);
$aguardando = (int)($dados['aguardando'] ?? 0);
$manutencao = (int)($dados['manutencao'] ?? 0);
$teste = (int)($dados['teste'] ?? 0);
$finalizadas = (int)($dados['finalizadas'] ?? 0);

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>Dashboard da Manutenção</h2>

            <small class="text-muted">
                Indicadores gerais da manutenção
            </small>

        </div>

        <div>

            <a href="index.php" class="btn btn-primary">
                Ordens de Manutenção
            </a>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-body">

                    <h6>Total de OS</h6>

                    <h2><?= $total ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-body">

                    <h6>Em Manutenção</h6>

                    <h2><?= $manutencao ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-body">

                    <h6>Finalizadas</h6>

                    <h2><?= $finalizadas ?></h2>

                </div>

            </div>

        </div>

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card shadow border-0">

                <div class="card-body">

                    <h6>Aguardando Peça</h6>

                    <h2><?= $aguardando ?></h2>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header">

                    Situação das Ordens

                </div>

                <div class="card-body">

                    <canvas id="graficoStatus" height="120"></canvas>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header">

                    Resumo

                </div>

                <div class="card-body">

                    <table class="table table-sm">

                        <tr>
                            <td>Aberta</td>
                            <td><?= $abertas ?></td>
                        </tr>

                        <tr>
                            <td>Em Análise</td>
                            <td><?= $analise ?></td>
                        </tr>

                        <tr>
                            <td>Aguardando Peça</td>
                            <td><?= $aguardando ?></td>
                        </tr>

                        <tr>
                            <td>Em Manutenção</td>
                            <td><?= $manutencao ?></td>
                        </tr>

                        <tr>
                            <td>Teste</td>
                            <td><?= $teste ?></td>
                        </tr>

                        <tr>
                            <td>Finalizadas</td>
                            <td><?= $finalizadas ?></td>
                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow mt-4">

        <div class="card-header">

            Últimas Ordens

        </div>

        <div class="card-body">

            <table class="table table-hover">

                <thead>

                    <tr>

                        <th>OS</th>
                        <th>Equipamento</th>
                        <th>Status</th>
                        <th>Prioridade</th>
                        <th>Data</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach(array_slice($ultimas,0,10) as $os): ?>

                    <tr>

                        <td><?= htmlspecialchars($os['numero_os']) ?></td>

                        <td>

                            <?= htmlspecialchars($os['codigo']) ?>

                            -

                            <?= htmlspecialchars($os['descricao']) ?>

                        </td>

                        <td><?= htmlspecialchars($os['status']) ?></td>

                        <td><?= htmlspecialchars($os['prioridade']) ?></td>

                        <td><?= date('d/m/Y',strtotime($os['data_abertura'])) ?></td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script>

const dadosStatus = {

labels:[
'Aberta',
'Análise',
'Aguardando',
'Manutenção',
'Teste',
'Finalizadas'
],

datasets:[{

data:[
<?= $abertas ?>,
<?= $analise ?>,
<?= $aguardando ?>,
<?= $manutencao ?>,
<?= $teste ?>,
<?= $finalizadas ?>

]

}]

};

new Chart(

document.getElementById('graficoStatus'),

{

type:'bar',

data:dadosStatus,

options:{

responsive:true,

plugins:{

legend:{

display:false

}

}

}

}

);

</script>

<?php

require_once '../../includes/layout_fim.php';

?>