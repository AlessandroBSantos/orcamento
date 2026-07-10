<?php

$titulo = "Novo Produto";

/*
|--------------------------------------------------------------------------
| JavaScripts da página
|--------------------------------------------------------------------------
*/

$scripts = [
    'tabs.js',
    'produtos.js'
];

require_once '../../includes/layout_inicio.php';
require_once '../../controllers/ProdutoController.php';

$controller = new ProdutoController();

/*
|--------------------------------------------------------------------------
| Listas dos selects
|--------------------------------------------------------------------------
*/

$categorias = $controller->listarCategorias();
$marcas = $controller->listarMarcas();
$unidades = $controller->listarUnidades();
$fornecedores = $controller->listarFornecedores();

/*
|--------------------------------------------------------------------------
| Dados do formulário
|--------------------------------------------------------------------------
*/

$acao = "salvar.php";

$produto = [];

?>

<div class="dashboard-header">

    <div>

        <h1>Novo Produto</h1>

        <p>Cadastro de Produtos</p>

    </div>

    <a href="index.php" class="btn btn-primary">

        ← Voltar

    </a>

</div>

<?php require_once '_form.php'; ?>

    <!-- ==========================================
         ABAS
    =========================================== -->

    <div class="tabs">

        <button
            type="button"
            class="tab-button active"
            data-tab="dados">

            📦 Dados Gerais

        </button>

        <button
            type="button"
            class="tab-button"
            data-tab="classificacao">

            🏷️ Classificação

        </button>

        <button
            type="button"
            class="tab-button"
            data-tab="fiscal">

            📄 Fiscal

        </button>

        <button
            type="button"
            class="tab-button"
            data-tab="comercial">

            💰 Comercial

        </button>

        <button
            type="button"
            class="tab-button"
            data-tab="estoque">

            📦 Estoque

        </button>

        <button
            type="button"
            class="tab-button"
            data-tab="observacoes">

            📝 Observações

        </button>

    </div>

    <!-- ==========================================
         DADOS GERAIS
    =========================================== -->

    <div
        class="tab-content active"
        id="dados">

        <div class="panel">

            <h2>Dados Gerais</h2>

            <div class="form-grid">

                <div class="form-group">

                    <label>Nome do Produto</label>

                    <input
                        type="text"
                        name="nome"
                        required>

                </div>

                <div class="form-group">

                    <label>SKU</label>

                    <input
                        type="text"
                        name="sku">

                </div>

                <div class="form-group">

                    <label>Código</label>

                    <input
                        type="text"
                        name="codigo">

                </div>

                <div class="form-group">

                    <label>Código de Barras</label>

                    <input
                        type="text"
                        name="codigo_barras">

                </div>

                <div
                    class="form-group"
                    style="grid-column:1/-1;">

                    <label>Descrição</label>

                    <textarea
                        name="descricao"
                        rows="5"></textarea>

                </div>

            </div>
        </div>

    </div>

<!-- ==========================================
     CLASSIFICAÇÃO
=========================================== -->

<div
    class="tab-content"
    id="classificacao">

    <div class="panel">

        <h2>Classificação</h2>

        <div class="form-grid">

<div class="form-group">

    <label>Categoria</label>

    <select
        name="categoria_id"
        required>

        <option value="">Selecione uma categoria</option>

        <?php foreach ($categorias as $categoria): ?>

            <option value="<?= $categoria['id']; ?>">

                <?= htmlspecialchars($categoria['nome']); ?>

            </option>

        <?php endforeach; ?>

    </select>

</div>

<div class="form-group">

    <label>Marca</label>

    <select
        name="marca_id">

        <option value="">Selecione uma marca</option>

        <?php foreach ($marcas as $marca): ?>

            <option value="<?= $marca['id']; ?>">

                <?= htmlspecialchars($marca['nome']); ?>

            </option>

        <?php endforeach; ?>

    </select>

</div>

<div class="form-group">

    <label>Unidade de Medida</label>

    <select
        name="unidade_id"
        required>

        <option value="">Selecione uma unidade</option>

        <?php foreach ($unidades as $unidade): ?>

            <option value="<?= $unidade['id']; ?>">

                <?= htmlspecialchars($unidade['sigla']); ?>
                -
                <?= htmlspecialchars($unidade['descricao']); ?>

            </option>

        <?php endforeach; ?>

    </select>

</div>

<div class="form-group">

    <label>Unidade de Medida</label>

    <select
        name="unidade_id"
        required>

        <option value="">Selecione uma unidade</option>

        <?php foreach ($unidades as $unidade): ?>

            <option value="<?= $unidade['id']; ?>">

                <?= htmlspecialchars($unidade['sigla']); ?>
                -
                <?= htmlspecialchars($unidade['descricao']); ?>

            </option>

        <?php endforeach; ?>

    </select>

</div>

        </div>

    </div>

</div>

<!-- ==========================================
     FISCAL
=========================================== -->

<div
    class="tab-content"
    id="fiscal">

    <div class="panel">

        <h2>Dados Fiscais</h2>

        <div class="form-grid">

            <div class="form-group">

                <label>NCM</label>

                <input
                    type="text"
                    name="ncm"
                    maxlength="8">

            </div>

            <div class="form-group">

                <label>CFOP</label>

                <input
                    type="text"
                    name="cfop"
                    maxlength="4">

            </div>

            <div class="form-group">

                <label>CEST</label>

                <input
                    type="text"
                    name="cest">

            </div>

            <div class="form-group">

                <label>Origem</label>

                <select name="origem">

                    <option value="">Selecione</option>

                    <option value="0">0 - Nacional</option>

                    <option value="1">1 - Estrangeira - Importação Direta</option>

                    <option value="2">2 - Estrangeira - Mercado Interno</option>

                    <option value="3">3 - Nacional com conteúdo de importação superior a 40%</option>

                    <option value="4">4 - Nacional produzida conforme PPB</option>

                    <option value="5">5 - Nacional com conteúdo inferior ou igual a 40%</option>

                    <option value="6">6 - Estrangeira - Importação Direta sem similar nacional</option>

                    <option value="7">7 - Estrangeira - Mercado Interno sem similar nacional</option>

                    <option value="8">8 - Nacional com conteúdo de importação superior a 70%</option>

                </select>

            </div>

        </div>

    </div>

</div>

<!-- ==========================================
     COMERCIAL
=========================================== -->

<div
    class="tab-content"
    id="comercial">

    <div class="panel">

        <h2>Dados Comerciais</h2>

        <div class="form-grid">

            <div class="form-group">

                <label>Custo (R$)</label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    id="custo"
                    name="custo"
                    value="0.00">

            </div>

            <div class="form-group">

                <label>Percentual de Lucro (%)</label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    id="percentual_lucro"
                    name="percentual_lucro"
                    value="0.00">

            </div>

            <div class="form-group">

                <label>Preço de Venda (R$)</label>

                <input
                    type="number"
                    step="0.01"
                    min="0"
                    id="preco_venda"
                    name="preco_venda"
                    value="0.00">

            </div>

        </div>

    </div>

</div>

<!-- ==========================================
     ESTOQUE
=========================================== -->

<div
    class="tab-content"
    id="estoque">

    <div class="panel">

        <h2>Controle de Estoque</h2>

        <div class="form-grid">

            <div class="form-group">

                <label>Localização</label>

                <input
                    type="text"
                    name="localizacao"
                    placeholder="Ex.: Prateleira A01">

            </div>

        </div>

        <br>

        <div class="form-group">

            <label>

                <input
                    type="checkbox"
                    name="controla_estoque"
                    value="1"
                    checked>

                Controlar Estoque

            </label>

        </div>

        <div class="form-group">

            <label>

                <input
                    type="checkbox"
                    name="vende"
                    value="1"
                    checked>

                Produto disponível para Venda

            </label>

        </div>

        <div class="form-group">

            <label>

                <input
                    type="checkbox"
                    name="compra"
                    value="1"
                    checked>

                Produto disponível para Compra

            </label>

        </div>

        <div class="form-group">

            <label>

                <input
                    type="checkbox"
                    name="ativo"
                    value="1"
                    checked>

                Produto Ativo

            </label>

        </div>

    </div>

</div>

<!-- ==========================================
     OBSERVAÇÕES
=========================================== -->

<div
    class="tab-content"
    id="observacoes">

    <div class="panel">

        <h2>Observações</h2>

        <div class="form-group">

            <label>Observações Internas</label>

            <textarea
                name="observacoes"
                rows="8"
                placeholder="Digite informações importantes sobre o produto..."></textarea>

        </div>

    </div>

</div>

    <br>

    <button
        type="submit"
        class="btn btn-primary">

        💾 Salvar Produto

    </button>

</form>



<?php

require_once '../../includes/layout_fim.php';

?>