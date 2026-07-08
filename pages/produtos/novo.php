<?php

$titulo = "Novo Produto";

require_once '../../includes/layout_inicio.php';

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

<form action="salvar.php" method="POST">
    <!-- =========================
     ABAS
========================= -->

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

<!-- =========================
     DADOS GERAIS
========================= -->

<div
    class="tab-content active"
    id="dados">

    <div class="panel">

        <h2>Dados Gerais</h2>

        <div class="form-grid">

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

            <div class="form-group">

                <label>SKU</label>

                <input
                    type="text"
                    name="sku">

            </div>

            <div class="form-group">

                <label>Nome do Produto</label>

                <input
                    type="text"
                    name="nome"
                    required>

            </div>

            <div class="form-group"
                 style="grid-column:1/-1;">

                <label>Descrição</label>

                <textarea
                    name="descricao"
                    rows="5"></textarea>

            </div>

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

<script src="../../assets/js/tabs.js"></script>