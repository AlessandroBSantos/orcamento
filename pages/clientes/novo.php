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

    <div class="panel">

<h2>Dados Gerais</h2>

<div class="form-grid">

    <div class="form-group">

        <label>Tipo de Cliente</label>

        <select name="tipo">

            <option value="PF">

                Pessoa Física

            </option>

            <option value="PJ">

                Pessoa Jurídica

            </option>

        </select>

    </div>

</div>

    </div>

    <br>

    <button class="btn">

        Salvar Cliente

    </button>

</form>

<?php

require_once '../../includes/layout_fim.php';

?>