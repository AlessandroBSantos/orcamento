<?php

$titulo = "Dashboard da Manutenção";

require_once '../../models/Database.php';

$db = Database::getConnection();

/*
|--------------------------------------------------------------------------
| Indicadores
|--------------------------------------------------------------------------
*/

$totalEquipamentos = $db->query("
    SELECT COUNT(*) total
    FROM equipamentos
    WHERE ativo = 1
")->fetch(PDO::FETCH_ASSOC)['total'];

$totalManutencoes = $db->query("
    SELECT COUNT(*) total
    FROM manutencoes
")->fetch(PDO::FETCH_ASSOC)['total'];

$abertas = $db->query("
    SELECT COUNT(*) total
    FROM manutencoes
    WHERE status='ABERTA'
")->fetch(PDO::FETCH_ASSOC)['total'];

$analise = $db->query("
    SELECT COUNT(*) total
    FROM manutencoes
    WHERE status='EM_ANALISE'
")->fetch(PDO::FETCH_ASSOC)['total'];

$pecas = $db->query("
    SELECT COUNT(*) total
    FROM manutencoes
    WHERE status='AGUARDANDO_PECA'
")->fetch(PDO::FETCH_ASSOC)['total'];

$execucao = $db->query("
    SELECT COUNT(*) total
    FROM manutencoes
    WHERE status='EM_MANUTENCAO'
")->fetch(PDO::FETCH_ASSOC)['total'];

$teste = $db->query("
    SELECT COUNT(*) total
    FROM manutencoes
    WHERE status='TESTE'
")->fetch(PDO::FETCH_ASSOC)['total'];

$finalizadas = $db->query("
    SELECT COUNT(*) total
    FROM manutencoes
    WHERE status='FINALIZADA'
")->fetch(PDO::FETCH_ASSOC)['total'];

$ultimas = $db->query("
SELECT

m.id,
m.numero_os,
m.status,
m.prioridade,
m.data_abertura,

e.codigo,
e.descricao

FROM manutencoes m

INNER JOIN equipamentos e
ON e.id=m.equipamento_id

ORDER BY m.id DESC

LIMIT 10

")->fetchAll(PDO::FETCH_ASSOC);

require_once '../../includes/layout_inicio.php';

?>

<div class="container-fluid">

<div class="page-header">

<div>

<h1>Dashboard da Manutenção</h1>

<p>Controle das Ordens de Manutenção</p>

</div>

<div>

<a href="nova.php" class="btn btn-primary">

Nova Manutenção

</a>

</div>

</div>

<div class="row">

<div class="col-md-3">

<div class="card">

<div class="card-body">

<h6>Equipamentos</h6>

<h2><?= $totalEquipamentos ?></h2>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card">

<div class="card-body">

<h6>Total OS</h6>

<h2><?= $totalManutencoes ?></h2>

</div>

</div>

</div>

<div class="col-md-2">

<div class="card">

<div class="card-body">

<h6>Abertas</h6>

<h2><?= $abertas ?></h2>

</div>

</div>

</div>

<div class="col-md-2">

<div class="card">

<div class="card-body">

<h6>Em análise</h6>

<h2><?= $analise ?></h2>

</div>

</div>

</div>

<div class="col-md-2">

<div class="card">

<div class="card-body">

<h6>Aguardando peças</h6>

<h2><?= $pecas ?></h2>

</div>

</div>

</div>

</div>

<br>

<div class="row">

<div class="col-md-4">

<div class="card">

<div class="card-body">

<h6>Em manutenção</h6>

<h2><?= $execucao ?></h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<div class="card-body">

<h6>Em teste</h6>

<h2><?= $teste ?></h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<div class="card-body">

<h6>Finalizadas</h6>

<h2><?= $finalizadas ?></h2>

</div>

</div>

</div>

</div>

<br>

<div class="card">

<div class="card-header">

Últimas Ordens de Manutenção

</div>

<div class="card-body">

<table class="table table-hover">

<thead>

<tr>

<th>OS</th>

<th>Equipamento</th>

<th>Descrição</th>

<th>Prioridade</th>

<th>Status</th>

<th>Data</th>

<th>Ações</th>

</tr>

</thead>

<tbody>

<?php foreach($ultimas as $os): ?>

<tr>

<td>

<?= $os['numero_os'] ?>

</td>

<td>

<?= $os['codigo'] ?>

</td>

<td>

<?= $os['descricao'] ?>

</td>

<td>

<?= $os['prioridade'] ?>

</td>

<td>

<?= $os['status'] ?>

</td>

<td>

<?= date('d/m/Y',strtotime($os['data_abertura'])) ?>

</td>

<td>

<a
href="visualizar.php?id=<?= $os['id'] ?>"
class="btn btn-sm btn-primary">

Abrir

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

<?php

require_once '../../includes/layout_fim.php';

?>