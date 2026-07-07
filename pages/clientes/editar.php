<?php

$titulo = "Editar Cliente";

require_once '../../includes/layout_inicio.php';
require_once '../../controllers/ClienteController.php';

if (!isset($_GET['id'])) {

    die("ID do cliente não informado.");

}

$id = (int) $_GET['id'];

$controller = new ClienteController();

$cliente = $controller->buscarPorId($id);

if (!$cliente) {

    die("Cliente não encontrado.");

}

?>

<div class="dashboard-header">

    <div>

        <h1>Editar Cliente</h1>

        <p>Teste de carregamento dos dados</p>

    </div>

    <a href="index.php" class="btn">

        ← Voltar

    </a>

</div>

<form action="atualizar.php" method="POST">

<input
    type="hidden"
    name="id"
    value="<?= $cliente['id'] ?>">

<div class="panel">

<h2>Dados Gerais</h2>

<div class="form-grid">

<div class="form-group">

<label>Tipo</label>

<select name="tipo">

<option value="PF" <?= $cliente['tipo']=="PF"?"selected":"" ?>>

Pessoa Física

</option>

<option value="PJ" <?= $cliente['tipo']=="PJ"?"selected":"" ?>>

Pessoa Jurídica

</option>

</select>

</div>

<div class="form-group">

<label>Status</label>

<select name="status">

<option value="Ativo" <?= $cliente['status']=="Ativo"?"selected":"" ?>>

Ativo

</option>

<option value="Inativo" <?= $cliente['status']=="Inativo"?"selected":"" ?>>

Inativo

</option>

</select>

</div>

<div class="form-group">

<label>Nome</label>

<input
type="text"
name="nome"
value="<?= htmlspecialchars($cliente['nome']) ?>">

</div>

<div class="form-group">

<label>Nome Fantasia</label>

<input
type="text"
name="nome_fantasia"
value="<?= htmlspecialchars($cliente['nome_fantasia']) ?>">

</div>

<div class="form-group">

<label>CPF/CNPJ</label>

<input
type="text"
name="cpf_cnpj"
value="<?= htmlspecialchars($cliente['cpf_cnpj']) ?>">

</div>

<div class="form-group">

<label>RG / IE</label>

<input
type="text"
name="rg_ie"
value="<?= htmlspecialchars($cliente['rg_ie']) ?>">

</div>

</div>

</div>

<br>

<button
type="submit"
class="btn">

💾 Salvar Alterações

</button>

</form>

<?php

require_once '../../includes/layout_fim.php';

?>