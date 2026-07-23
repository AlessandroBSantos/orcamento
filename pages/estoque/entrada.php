<?php

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

        <h2>Entrada de Estoque</h2>

        <a href="index.php" class="btn btn-secondary">
            Voltar
        </a>

    </div>

    <div class="card shadow-sm">

        <div class="card-body">

            <div class="row">

                <div class="col-md-2 mb-3">

                    <label class="form-label">
                        Código
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars($produto['codigo']) ?>"
                        readonly>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Produto
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= htmlspecialchars($produto['nome']) ?>"
                        readonly>

                </div>

                <div class="col-md-2 mb-3">

                    <label class="form-label">
                        Estoque Atual
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= number_format($produto['quantidade_atual'], 3, ',', '.') ?>"
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
                            min="0.001"
                            step="0.001"
                            class="form-control"
                            required>

                    </div>

                    <div class="form-group label">

                        <label class="form-label">
                            Valor Unitário
                        </label>

                        <input
                            type="number"
                            name="valor_unitario"
                            step="0.01"
                            min="0"
                            value="0.00"
                            class="form-control">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Documento
                        </label>

                        <input
                            type="text"
                            name="documento"
                            class="form-control"
                            placeholder="Ex.: NF-e 12345">

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Fornecedor
                        </label>

                        <select
                            name="fornecedor_id"
                            class="form-select">

                            <option value="">
                                Selecione...
                            </option>

                        </select>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Lote
                        </label>

                        <input
                            type="text"
                            name="lote"
                            class="form-control">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Número de Série
                        </label>

                        <input
                            type="text"
                            name="numero_serie"
                            class="form-control">

                    </div>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Observações
                    </label>

                    <textarea
                        name="observacoes"
                        rows="4"
                        class="form-control"></textarea>

                </div>

                <div class="d-flex gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="fas fa-save"></i>
                        Salvar Entrada

                    </button>

                    <a
                        href="index.php"
                        class="btn btn-secondary">

                        Cancelar

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?php require_once '../../includes/layout_fim.php'; ?>