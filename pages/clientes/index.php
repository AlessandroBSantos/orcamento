<?php

$titulo = "Clientes";

require_once '../../includes/layout_inicio.php';
require_once '../../controllers/ClienteController.php';

$controller = new ClienteController();

$clientes = $controller->index();

?>

<div class="dashboard-header">

    <h1>Clientes</h1>

    <a href="novo.php" class="btn">
        + Novo Cliente
    </a>

</div>

<?php if (isset($_GET['sucesso'])): ?>

<div class="alert alert-success">

    Cliente cadastrado com sucesso!

</div>

<?php endif; ?>

<div class="panel">

    <table>

<thead>

<tr>

    <th>ID</th>

    <th>Nome</th>

    <th>Cidade</th>

    <th>CPF/CNPJ</th>

    <th>Status</th>

    <th>Ações</th>

</tr>

</thead>
<tbody>

<?php if(!empty($clientes)): ?>

<?php foreach($clientes as $cliente): ?>

<tr>

    <td><?= $cliente['id'] ?></td>

    <td><?= htmlspecialchars($cliente['nome']) ?></td>

    <td><?= htmlspecialchars($cliente['cidade']) ?></td>

    <td><?= htmlspecialchars($cliente['cpf_cnpj']) ?></td>

    <td><?= htmlspecialchars($cliente['status']) ?></td>

    <td>

        <a href="editar.php?id=<?= $cliente['id'] ?>">

            ✏ Editar

        </a>

    </td>

</tr>

<?php endforeach; ?>

<?php else: ?>

<tr>

    <td colspan="6">

        Nenhum cliente encontrado.

    </td>

</tr>

<?php endif; ?>

</tbody>
        



    </table>

</div>

<?php

require_once '../../includes/layout_fim.php';

?>