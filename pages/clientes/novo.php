<?php

$titulo = "Novo Cliente";

require_once '../../includes/layout_inicio.php';

?>

<div class="dashboard-header">

    <div>

        <h1>Novo Cliente</h1>

        <p>Cadastro de Clientes</p>

    </div>

    <a href="index.php" class="btn">

        ← Voltar

    </a>

</div>

<form action="salvar.php" method="POST">

<div class="tabs">

    <button
        type="button"
        class="tab-button active"
        data-tab="dados">

        Dados Gerais

    </button>

    <button
        type="button"
        class="tab-button"
        data-tab="endereco">

        Endereço

    </button>

    <button
        type="button"
        class="tab-button"
        data-tab="contato">

        Contato

    </button>

    <button
        type="button"
        class="tab-button"
        data-tab="financeiro">

        Financeiro

    </button>

    <button
        type="button"
        class="tab-button"
        data-tab="observacoes">

        Observações

    </button>

</div>


    <!-- =========================
         DADOS GERAIS
    ========================== -->

   <div
    class="tab-content active"
    id="dados">

<div class="panel">

        <h2>Dados Gerais</h2>

        <div class="form-grid">

            <div class="form-group">

                <label>Tipo de Cliente</label>

                <select name="tipo">

                    <option value="PF">Pessoa Física</option>

                    <option value="PJ">Pessoa Jurídica</option>

                </select>

            </div>
            

            <div class="form-group">

                <label>Status</label>

                <select name="status">

                    <option value="Ativo">Ativo</option>

                    <option value="Inativo">Inativo</option>

                </select>

            </div>

            <div class="form-group">

                <label>Nome / Razão Social</label>

                <input
                    type="text"
                    name="nome"
                    required>

            </div>

            <div class="form-group">

                <label>Nome Fantasia</label>

                <input
                    type="text"
                    name="nome_fantasia">

            </div>

            <div class="form-group">

                <label>CPF / CNPJ</label>

                <input
                    type="text"
                    name="cpf_cnpj">

            </div>

            <div class="form-group">

                <label>RG / Inscrição Estadual</label>

                <input
                    type="text"
                    name="rg_ie">

            </div>

            <div class="form-group">

                <label>Inscrição Municipal</label>

                <input
                    type="text"
                    name="inscricao_municipal">

            </div>

        </div>

    </div>

    <br>

    <!-- =========================
         ENDEREÇO
    ========================== -->


<div
    class="tab-content"
    id="endereco">

<div class="panel">


        <h2>Endereço</h2>

        <div class="form-grid">

            <div class="form-group">

                <label>CEP</label>

                <input
                    type="text"
                    id="cep"
                    name="cep"
                    maxlength="9">

            </div>

            <div class="form-group">

                <label>Endereço</label>

                <input
                    type="text"
                    id="endereco"
                    name="endereco">

            </div>

            <div class="form-group">

                <label>Número</label>

                <input
                    type="text"
                    name="numero">

            </div>

            <div class="form-group">

                <label>Complemento</label>

                <input
                    type="text"
                    name="complemento">

            </div>

            <div class="form-group">

                <label>Bairro</label>

                <input
                    type="text"
                    id="bairro"
                    name="bairro">

            </div>

            <div class="form-group">

                <label>Cidade</label>

                <input
                    type="text"
                    id="cidade"
                    name="cidade">

            </div>

            <div class="form-group">

                <label>Estado</label>

                <input
                    type="text"
                    id="estado"
                    name="estado"
                    maxlength="2">

            </div>

        </div>

    </div>

    <br>

    <button type="submit" class="btn">

        💾 Salvar Cliente

    </button>

</form>

<script src="../../assets/js/clientes.js"></script>

<script src="../../assets/js/tabs.js"></script>

<?php

require_once '../../includes/layout_fim.php';

?>