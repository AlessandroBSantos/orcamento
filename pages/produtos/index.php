<?php

$titulo = "Produtos";

require_once '../../includes/layout_inicio.php';
require_once '../../controllers/ProdutoController.php';

$controller = new ProdutoController();

$produtos = $controller->index();

?>

<div class="dashboard-header">

    <div>

        <h1>Produtos</h1>

        <p>Cadastro de Produtos</p>

    </div>

    <a href="novo.php" class="btn btn-primary">

        + Novo Produto

    </a>

</div>

<?php if (isset($_GET['sucesso'])): ?>

<div class="alert alert-success">

<?php

switch ($_GET['sucesso']) {

    case "cadastrado":
        echo "Produto cadastrado com sucesso.";
        break;

    case "editado":
        echo "Produto atualizado com sucesso.";
        break;

    case "excluido":
        echo "Produto excluído com sucesso.";
        break;

}

?>

</div>

<?php endif; ?>

<div class="panel">

    <table>

        <thead>

            <tr>

                <th>ID</th>
                <th>Código</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Ativo</th>
                <th>Ações</th>

            </tr>

        </thead>

        <tbody>

        <?php if (empty($produtos)): ?>

            <tr>

                <td colspan="6" style="text-align:center;">

                    Nenhum produto cadastrado.

                </td>

            </tr>

        <?php else: ?>

            <?php foreach ($produtos as $produto): ?>

            <tr>

                <td><?= $produto['id'] ?></td>

                <td><?= htmlspecialchars($produto['codigo']) ?></td>

                <td><?= htmlspecialchars($produto['nome']) ?></td>

                <td>

                    R$

                    <?= number_format($produto['preco_venda'], 2, ",", ".") ?>

                </td>

                <td>

                    <?= $produto['ativo'] ? 'Sim' : 'Não' ?>

                </td>

                <td class="acoes">

                    <a href="editar.php?id=<?= $produto['id'] ?>" class="btn btn-primary">

                        ✏ Editar

                    </a>

                    <a
                        href="excluir.php?id=<?= $produto['id'] ?>"
                        class="btn btn-danger"
                        onclick="return confirm('Deseja realmente excluir este produto?')">

                        🗑 Excluir

                    </a>

                </td>

            </tr>

            <?php endforeach; ?>

        <?php endif; ?>

        </tbody>

    </table>

</div>

<?php

require_once '../../includes/layout_fim.php';

?>
