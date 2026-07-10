<form action="<?= $acao ?>" method="POST">

<?php if (!empty($produto['id'])): ?>

<input
    type="hidden"
    name="id"
    value="<?= $produto['id'] ?>">

<?php endif; ?>

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
                    required
                    value="<?= htmlspecialchars($produto['nome'] ?? '') ?>">

            </div>

            <div class="form-group">

                <label>SKU</label>

                <input
                    type="text"
                    name="sku"
                    value="<?= htmlspecialchars($produto['sku'] ?? '') ?>">

            </div>

            <div class="form-group">

                <label>Código</label>

                <input
                    type="text"
                    name="codigo"
                    value="<?= htmlspecialchars($produto['codigo'] ?? '') ?>">

            </div>

            <div class="form-group">

                <label>Código de Barras</label>

                <input
                    type="text"
                    name="codigo_barras"
                    value="<?= htmlspecialchars($produto['codigo_barras'] ?? '') ?>">

            </div>

            <div
                class="form-group"
                style="grid-column:1/-1;">

                <label>Descrição</label>

                <textarea
                    name="descricao"
                    rows="5"><?= htmlspecialchars($produto['descricao'] ?? '') ?></textarea>

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