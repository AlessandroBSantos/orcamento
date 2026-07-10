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

<!-- ==========================================
     CLASSIFICAÇÃO
=========================================== -->

<div
    class="tab-content"
    id="classificacao">

    <div class="panel">

        <h2>Classificação</h2>

        <div class="form-grid">

            <!-- Categoria -->

            <div class="form-group">

                <label>Categoria</label>

                <select
                    name="categoria_id"
                    required>

                    <option value="">Selecione...</option>

                    <?php foreach ($categorias as $categoria): ?>

                        <option
                            value="<?= $categoria['id'] ?>"

                            <?= (($produto['categoria_id'] ?? '') == $categoria['id']) ? 'selected' : '' ?>>

                            <?= htmlspecialchars($categoria['nome']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <!-- Marca -->

            <div class="form-group">

                <label>Marca</label>

                <select
                    name="marca_id">

                    <option value="">Selecione...</option>

                    <?php foreach ($marcas as $marca): ?>

                        <option
                            value="<?= $marca['id'] ?>"

                            <?= (($produto['marca_id'] ?? '') == $marca['id']) ? 'selected' : '' ?>>

                            <?= htmlspecialchars($marca['nome']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <!-- Unidade -->

            <div class="form-group">

                <label>Unidade</label>

                <select
                    name="unidade_id"
                    required>

                    <option value="">Selecione...</option>

                    <?php foreach ($unidades as $unidade): ?>

                        <option
                            value="<?= $unidade['id'] ?>"

                            <?= (($produto['unidade_id'] ?? '') == $unidade['id']) ? 'selected' : '' ?>>

                            <?= htmlspecialchars($unidade['sigla']) ?>
                            -
                            <?= htmlspecialchars($unidade['descricao']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <!-- Fornecedor -->

            <div class="form-group">

                <label>Fornecedor</label>

                <select
                    name="fornecedor_id">

                    <option value="">Selecione...</option>

                    <?php foreach ($fornecedores as $fornecedor): ?>

                        <option
                            value="<?= $fornecedor['id'] ?>"

                            <?= (($produto['fornecedor_id'] ?? '') == $fornecedor['id']) ? 'selected' : '' ?>>

                            <?= htmlspecialchars($fornecedor['nome_fantasia']) ?>

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
                    maxlength="8"
                    value="<?= htmlspecialchars($produto['ncm'] ?? '') ?>">

            </div>

            <div class="form-group">

                <label>CFOP</label>

                <input
                    type="text"
                    name="cfop"
                    maxlength="4"
                    value="<?= htmlspecialchars($produto['cfop'] ?? '') ?>">

            </div>

            <div class="form-group">

                <label>CEST</label>

                <input
                    type="text"
                    name="cest"
                    value="<?= htmlspecialchars($produto['cest'] ?? '') ?>">

            </div>

            <div class="form-group">

                <label>Origem</label>

                <select name="origem">

                    <option value="">Selecione...</option>

                    <option value="0" <?= (($produto['origem'] ?? '') == '0') ? 'selected' : '' ?>>
                        0 - Nacional
                    </option>

                    <option value="1" <?= (($produto['origem'] ?? '') == '1') ? 'selected' : '' ?>>
                        1 - Estrangeira - Importação Direta
                    </option>

                    <option value="2" <?= (($produto['origem'] ?? '') == '2') ? 'selected' : '' ?>>
                        2 - Estrangeira - Mercado Interno
                    </option>

                    <option value="3" <?= (($produto['origem'] ?? '') == '3') ? 'selected' : '' ?>>
                        3 - Nacional com conteúdo superior a 40%
                    </option>

                    <option value="4" <?= (($produto['origem'] ?? '') == '4') ? 'selected' : '' ?>>
                        4 - Produzida conforme PPB
                    </option>

                    <option value="5" <?= (($produto['origem'] ?? '') == '5') ? 'selected' : '' ?>>
                        5 - Conteúdo inferior ou igual a 40%
                    </option>

                    <option value="6" <?= (($produto['origem'] ?? '') == '6') ? 'selected' : '' ?>>
                        6 - Importação direta sem similar nacional
                    </option>

                    <option value="7" <?= (($produto['origem'] ?? '') == '7') ? 'selected' : '' ?>>
                        7 - Mercado interno sem similar nacional
                    </option>

                    <option value="8" <?= (($produto['origem'] ?? '') == '8') ? 'selected' : '' ?>>
                        8 - Conteúdo de importação superior a 70%
                    </option>

                </select>

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