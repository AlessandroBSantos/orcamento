
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$titulo = "Entrada de Estoque";

require_once '../../controllers/EstoqueController.php';

$controller = new EstoqueController();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Produto não informado.");
}

$produto = $controller->buscarPorProduto((int)$_GET['id']);

if (!$produto) {
    die("Produto não encontrado.");
}

require_once '../../includes/layout_inicio.php';

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>
            Entrada de Estoque
        </h2>

        <a href="index.php" class="btn btn-secondary">
            Voltar
        </a>

    </div>

    <div class="card">

        <div class="card-body">

            <div class="row">

                <div class="col-md-2 mb-3">
                    <label class="form-label">Código</label>
                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars($produto['codigo']) ?>"
                        readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Produto</label>
                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars($produto['nome']) ?>"
                        readonly>
                </div>

                <div class="col-md-2 mb-3">
                    <label class="form-label">Estoque Atual</label>
                    <input
                        type="text"
                        class="form-control"
                        value="<?= $produto['quantidade_atual'] ?>"
                        readonly>
                </div>

            </div>

            <hr>

            <form action="salvar_entrada.php" method="POST">

                <input
                    type="hidden"
                    name="produto_id"
                    value="<?= $produto['produto_id'] ?>">

                <div class="row">

                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Quantidade
                        </label>

                        <input
                            type="number"
                            name="quantidade"
                            min="1"
                            class="form-control"
                            required>

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">
                            Valor Unitário
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="valor_unitario"
                            class="form-control">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Documento
                        </label>

                        <input
                            type="text"
                            name="documento"
                            class="form-control">

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Observações
                    </label>

                    <textarea
                        name="observacoes"
                        class="form-control"
                        rows="4"></textarea>

                </div>

                <button
                    type="submit"
                    class="btn btn-success">

                    Salvar Entrada

                </button>

                <a
                    href="index.php"
                    class="btn btn-secondary">

                    Cancelar

                </a>

            </form>

        </div>

    </div>

</div>

<?php

require_once '../../includes/layout_fim.php';

?>