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

/*
|--------------------------------------------------------------------------
| Layout e Controller
|--------------------------------------------------------------------------
*/

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

<!-- =========================================================
     CABEÇALHO
========================================================= -->

<div class="dashboard-header">

    <div>

        <h1>Novo Produto</h1>

        <p>Cadastro de Produtos</p>

    </div>

    <a href="index.php" class="btn btn-primary">
        ← Voltar
    </a>

</div>

<!-- =========================================================
     FORMULÁRIO
========================================================= -->

<form method="POST" action="<?= htmlspecialchars($acao); ?>">

    <!-- =====================================================
         ABAS
    ====================================================== -->

    <div class="tabs">

        <button
            type="button"
            class="tab-button active"
            data-tab="dados"
        >
            📦 Dados Gerais
        </button>

        <button
            type="button"
            class="tab-button"
            data-tab="classificacao"
        >
            🏷️ Classificação
        </button>

        <button
            type="button"
            class="tab-button"
            data-tab="fiscal"
        >
            📄 Fiscal
        </button>

        <button
            type="button"
            class="tab-button"
            data-tab="comercial"
        >
            💰 Comercial
        </button>

        <button
            type="button"
            class="tab-button"
            data-tab="estoque"
        >
            📦 Estoque
        </button>

        <button
            type="button"
            class="tab-button"
            data-tab="observacoes"
        >
            📝 Observações
        </button>

    </div>


   <!-- ==========================================
     DADOS GERAIS
=========================================== -->

<div class="tab-content active" id="dados">

    <div class="panel">

        <h2>Dados Gerais</h2>

        <div class="form-grid">

            <!-- NOME DO PRODUTO -->

            <div class="form-group">

                <label for="nome">
                    Nome do Produto *
                </label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    required
                    maxlength="255"
                    value="<?= htmlspecialchars($produto['nome'] ?? '') ?>"
                    placeholder="Digite o nome do produto"
                >

            </div>


            <!-- NOME COMERCIAL -->

            <div class="form-group">

                <label for="nome_comercial">
                    Nome Comercial
                </label>

                <input
                    type="text"
                    id="nome_comercial"
                    name="nome_comercial"
                    maxlength="255"
                    value="<?= htmlspecialchars($produto['nome_comercial'] ?? '') ?>"
                    placeholder="Nome utilizado nos anúncios"
                >

            </div>


            <!-- SKU -->

            <div class="form-group">

                <label for="sku">
                    SKU
                </label>

                <input
                    type="text"
                    id="sku"
                    name="sku"
                    maxlength="100"
                    value="<?= htmlspecialchars($produto['sku'] ?? '') ?>"
                    placeholder="Ex.: SPT1003"
                >

            </div>


            <!-- CÓDIGO INTERNO -->

            <div class="form-group">

                <label for="codigo">
                    Código Interno
                </label>

                <input
                    type="text"
                    id="codigo"
                    name="codigo"
                    maxlength="100"
                    value="<?= htmlspecialchars($produto['codigo'] ?? '') ?>"
                    placeholder="Código interno do ERP"
                >

            </div>


            <!-- CÓDIGO DE BARRAS -->

            <div class="form-group">

                <label for="codigo_barras">
                    Código de Barras / EAN
                </label>

                <input
                    type="text"
                    id="codigo_barras"
                    name="codigo_barras"
                    maxlength="50"
                    value="<?= htmlspecialchars($produto['codigo_barras'] ?? '') ?>"
                    placeholder="Ex.: 7891234567890"
                >

            </div>


            <!-- GTIN -->

            <div class="form-group">

                <label for="gtin">
                    GTIN
                </label>

                <input
                    type="text"
                    id="gtin"
                    name="gtin"
                    maxlength="50"
                    value="<?= htmlspecialchars($produto['gtin'] ?? '') ?>"
                    placeholder="Código GTIN"
                >

            </div>


            <!-- MODELO -->

            <div class="form-group">

                <label for="modelo">
                    Modelo
                </label>

                <input
                    type="text"
                    id="modelo"
                    name="modelo"
                    maxlength="150"
                    value="<?= htmlspecialchars($produto['modelo'] ?? '') ?>"
                    placeholder="Modelo do produto"
                >

            </div>


            <!-- FABRICANTE -->

            <div class="form-group">

                <label for="fabricante">
                    Fabricante
                </label>

                <input
                    type="text"
                    id="fabricante"
                    name="fabricante"
                    maxlength="255"
                    value="<?= htmlspecialchars($produto['fabricante'] ?? '') ?>"
                    placeholder="Nome do fabricante"
                >

            </div>


            <!-- LINHA -->

            <div class="form-group">

                <label for="linha">
                    Linha / Coleção
                </label>

                <input
                    type="text"
                    id="linha"
                    name="linha"
                    maxlength="150"
                    value="<?= htmlspecialchars($produto['linha'] ?? '') ?>"
                    placeholder="Ex.: Premium, Profissional"
                >

            </div>


            <!-- QUANTIDADE POR EMBALAGEM -->

            <div class="form-group">

                <label for="quantidade_embalagem">
                    Quantidade por Embalagem
                </label>

                <input
                    type="number"
                    id="quantidade_embalagem"
                    name="quantidade_embalagem"
                    min="1"
                    step="1"
                    value="<?= htmlspecialchars($produto['quantidade_embalagem'] ?? '1') ?>"
                    placeholder="Ex.: 1"
                >

            </div>


            <!-- PAÍS DE ORIGEM -->

            <div class="form-group">

                <label for="pais_origem">
                    País de Origem
                </label>

                <input
                    type="text"
                    id="pais_origem"
                    name="pais_origem"
                    maxlength="100"
                    value="<?= htmlspecialchars($produto['pais_origem'] ?? 'Brasil') ?>"
                    placeholder="Ex.: Brasil"
                >

            </div>


            <!-- GARANTIA -->

            <div class="form-group">

                <label for="garantia">
                    Garantia
                </label>

                <input
                    type="text"
                    id="garantia"
                    name="garantia"
                    maxlength="100"
                    value="<?= htmlspecialchars($produto['garantia'] ?? '') ?>"
                    placeholder="Ex.: 90 dias"
                >

            </div>


            <!-- TIPO DO PRODUTO -->

            <div class="form-group">

                <label for="tipo_produto">
                    Tipo do Produto
                </label>

                <select
                    id="tipo_produto"
                    name="tipo_produto"
                >

                    <option value="">
                        Selecione
                    </option>

                    <option
                        value="produto"
                        <?= (($produto['tipo_produto'] ?? '') === 'produto') ? 'selected' : '' ?>
                    >
                        Produto
                    </option>

                    <option
                        value="servico"
                        <?= (($produto['tipo_produto'] ?? '') === 'servico') ? 'selected' : '' ?>
                    >
                        Serviço
                    </option>

                    <option
                        value="kit"
                        <?= (($produto['tipo_produto'] ?? '') === 'kit') ? 'selected' : '' ?>
                    >
                        Kit
                    </option>

                    <option
                        value="componente"
                        <?= (($produto['tipo_produto'] ?? '') === 'componente') ? 'selected' : '' ?>
                    >
                        Componente
                    </option>

                </select>

            </div>


            <!-- DESCRIÇÃO CURTA -->

            <div
                class="form-group"
                style="grid-column: 1 / -1;"
            >

                <label for="descricao_curta">
                    Descrição Curta
                </label>

                <textarea
                    id="descricao_curta"
                    name="descricao_curta"
                    rows="3"
                    maxlength="500"
                    placeholder="Resumo do produto para utilização em anúncios..."
                ><?= htmlspecialchars($produto['descricao_curta'] ?? '') ?></textarea>

            </div>


            <!-- DESCRIÇÃO INTERNA -->

            <div
                class="form-group"
                style="grid-column: 1 / -1;"
            >

                <label for="descricao">
                    Descrição Interna
                </label>

                <textarea
                    id="descricao"
                    name="descricao"
                    rows="5"
                    placeholder="Descrição completa do produto..."
                ><?= htmlspecialchars($produto['descricao'] ?? '') ?></textarea>

            </div>

        </div>

    </div>

</div>


    <!-- =====================================================
         CLASSIFICAÇÃO
    ====================================================== -->

    <div class="tab-content" id="classificacao">

        <div class="panel">

            <h2>Classificação</h2>

            <div class="form-grid">

                <!-- CATEGORIA -->

                <div class="form-group">

                    <label for="categoria_id">
                        Categoria
                    </label>

                    <select
                        id="categoria_id"
                        name="categoria_id"
                        required
                    >

                        <option value="">
                            Selecione uma categoria
                        </option>

                        <?php foreach ($categorias as $categoria): ?>

                            <option value="<?= $categoria['id']; ?>">

                                <?= htmlspecialchars(
                                    $categoria['nome']
                                ); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- MARCA -->

                <div class="form-group">

                    <label for="marca_id">
                        Marca
                    </label>

                    <select
                        id="marca_id"
                        name="marca_id"
                    >

                        <option value="">
                            Selecione uma marca
                        </option>

                        <?php foreach ($marcas as $marca): ?>

                            <option value="<?= $marca['id']; ?>">

                                <?= htmlspecialchars(
                                    $marca['nome']
                                ); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>


                <!-- UNIDADE -->

                <div class="form-group">

                    <label for="unidade_id">
                        Unidade de Medida
                    </label>

                    <select
                        id="unidade_id"
                        name="unidade_id"
                        required
                    >

                        <option value="">
                            Selecione uma unidade
                        </option>

                        <?php foreach ($unidades as $unidade): ?>

                            <option value="<?= $unidade['id']; ?>">

                                <?= htmlspecialchars(
                                    $unidade['sigla']
                                ); ?>

                                -

                                <?= htmlspecialchars(
                                    $unidade['descricao']
                                ); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         FISCAL
    ====================================================== -->

    <div class="tab-content" id="fiscal">

        <div class="panel">

            <h2>Dados Fiscais</h2>

            <div class="form-grid">

                <!-- NCM -->

                <div class="form-group">

                    <label for="ncm">
                        NCM
                    </label>

                    <input
                        type="text"
                        id="ncm"
                        name="ncm"
                        maxlength="8"
                    >

                </div>


                <!-- CFOP -->

                <div class="form-group">

                    <label for="cfop">
                        CFOP
                    </label>

                    <input
                        type="text"
                        id="cfop"
                        name="cfop"
                        maxlength="4"
                    >

                </div>


                <!-- CEST -->

                <div class="form-group">

                    <label for="cest">
                        CEST
                    </label>

                    <input
                        type="text"
                        id="cest"
                        name="cest"
                    >

                </div>


                <!-- ORIGEM -->

                <div class="form-group">

                    <label for="origem">
                        Origem
                    </label>

                    <select
                        id="origem"
                        name="origem"
                    >

                        <option value="">
                            Selecione
                        </option>

                        <option value="0">
                            0 - Nacional
                        </option>

                        <option value="1">
                            1 - Estrangeira - Importação Direta
                        </option>

                        <option value="2">
                            2 - Estrangeira - Mercado Interno
                        </option>

                        <option value="3">
                            3 - Nacional com conteúdo de importação superior a 40%
                        </option>

                        <option value="4">
                            4 - Nacional produzida conforme PPB
                        </option>

                        <option value="5">
                            5 - Nacional com conteúdo inferior ou igual a 40%
                        </option>

                        <option value="6">
                            6 - Estrangeira - Importação Direta sem similar nacional
                        </option>

                        <option value="7">
                            7 - Estrangeira - Mercado Interno sem similar nacional
                        </option>

                        <option value="8">
                            8 - Nacional com conteúdo de importação superior a 70%
                        </option>

                    </select>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         COMERCIAL
    ====================================================== -->

    <div class="tab-content" id="comercial">

        <div class="panel">

            <h2>Dados Comerciais</h2>

            <div class="form-grid">

                <!-- CUSTO -->

                <div class="form-group">

                    <label for="custo">
                        Custo (R$)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        id="custo"
                        name="custo"
                        value="0.00"
                    >

                </div>


                <!-- LUCRO -->

                <div class="form-group">

                    <label for="percentual_lucro">
                        Percentual de Lucro (%)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        id="percentual_lucro"
                        name="percentual_lucro"
                        value="0.00"
                    >

                </div>


                <!-- PREÇO DE VENDA -->

                <div class="form-group">

                    <label for="preco_venda">
                        Preço de Venda (R$)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        min="0"
                        id="preco_venda"
                        name="preco_venda"
                        value="0.00"
                    >

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         ESTOQUE
    ====================================================== -->

    <div class="tab-content" id="estoque">

        <div class="panel">

            <h2>Controle de Estoque</h2>

            <div class="form-grid">

                <!-- LOCALIZAÇÃO -->

                <div class="form-group">

                    <label for="localizacao">
                        Localização
                    </label>

                    <input
                        type="text"
                        id="localizacao"
                        name="localizacao"
                        placeholder="Ex.: Prateleira A01"
                    >

                </div>

            </div>

            <br>


            <!-- CONTROLAR ESTOQUE -->

            <div class="form-group">

                <label>

                    <input
                        type="checkbox"
                        name="controla_estoque"
                        value="1"
                        checked
                    >

                    Controlar Estoque

                </label>

            </div>


            <!-- VENDER -->

            <div class="form-group">

                <label>

                    <input
                        type="checkbox"
                        name="vende"
                        value="1"
                        checked
                    >

                    Produto disponível para Venda

                </label>

            </div>


            <!-- COMPRAR -->

            <div class="form-group">

                <label>

                    <input
                        type="checkbox"
                        name="compra"
                        value="1"
                        checked
                    >

                    Produto disponível para Compra

                </label>

            </div>


            <!-- ATIVO -->

            <div class="form-group">

                <label>

                    <input
                        type="checkbox"
                        name="ativo"
                        value="1"
                        checked
                    >

                    Produto Ativo

                </label>

            </div>

        </div>

    </div>


    <!-- =====================================================
         OBSERVAÇÕES
    ====================================================== -->

    <div class="tab-content" id="observacoes">

        <div class="panel">

            <h2>Observações</h2>

            <div class="form-group">

                <label for="observacoes">
                    Observações Internas
                </label>

                <textarea
                    id="observacoes"
                    name="observacoes"
                    rows="8"
                    placeholder="Digite informações importantes sobre o produto..."
                ></textarea>

            </div>

        </div>

    </div>


    <!-- =====================================================
         BOTÃO SALVAR
    ====================================================== -->

    <br>

    <button
        type="submit"
        class="btn btn-primary"
    >
        💾 Salvar Produto
    </button>

</form>


<?php

/*
|--------------------------------------------------------------------------
| Final do Layout
|--------------------------------------------------------------------------
*/

require_once '../../includes/layout_fim.php';

?>