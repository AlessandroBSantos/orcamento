<?php

$titulo = "Nova Ordem de Manutenção";

require_once '../../models/Database.php';

$db = Database::getConnection();

/*
|--------------------------------------------------------------------------
| Equipamentos
|--------------------------------------------------------------------------
*/

$equipamentos = $db->query("

SELECT

id,
codigo,
descricao

FROM equipamentos

WHERE ativo=1

ORDER BY descricao

")->fetchAll(PDO::FETCH_ASSOC);

/*
|--------------------------------------------------------------------------
| Técnicos
|--------------------------------------------------------------------------
*/

$tecnicos = $db->query("

SELECT

id,
nome

FROM usuarios

ORDER BY nome

")->fetchAll(PDO::FETCH_ASSOC);

require_once '../../includes/layout_inicio.php';

?>

<div class="container-fluid">

<div class="page-header">

<div>

<h1>Nova Ordem de Manutenção</h1>

<p>Abertura de Ordem de Serviço de Manutenção</p>

</div>

<div>

<a href="index.php" class="btn btn-secondary">

Voltar

</a>

</div>

</div>

<form action="salvar.php" method="POST">

<div class="card mb-4">

<div class="card-header">

Dados da Ordem

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<label>Equipamento</label>

<select
name="equipamento_id"
class="form-control"
required>

<option value="">Selecione...</option>

<?php foreach($equipamentos as $eq): ?>

<option value="<?= $eq['id'] ?>">

<?= $eq['codigo'] ?>

-

<?= $eq['descricao'] ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="col-md-3">

<label>Tipo</label>

<select
name="tipo"
class="form-control">

<option value="CORRETIVA">Corretiva</option>

<option value="PREVENTIVA">Preventiva</option>

<option value="GARANTIA">Garantia</option>

<option value="INSTALACAO">Instalação</option>

<option value="CALIBRACAO">Calibração</option>

<option value="OUTROS">Outros</option>

</select>

</div>

<div class="col-md-3">

<label>Prioridade</label>

<select
name="prioridade"
class="form-control">

<option value="BAIXA">Baixa</option>

<option value="MEDIA" selected>Média</option>

<option value="ALTA">Alta</option>

<option value="URGENTE">Urgente</option>

</select>

</div>

</div>

<br>

<div class="row">

<div class="col-md-6">

<label>Técnico Responsável</label>

<select
name="tecnico_id"
class="form-control">

<option value="">Selecione...</option>

<?php foreach($tecnicos as $tec): ?>

<option value="<?= $tec['id'] ?>">

<?= $tec['nome'] ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="col-md-6">

<label>Fornecedor (Opcional)</label>

<input
type="text"
name="fornecedor"
class="form-control">

</div>

</div>

</div>

</div>

<div class="card mb-4">

<div class="card-header">

Defeito Informado

</div>

<div class="card-body">

<textarea

name="defeito_informado"

rows="5"

class="form-control"

required

></textarea>

</div>

</div>

<div class="card mb-4">

<div class="card-header">

Diagnóstico Inicial

</div>

<div class="card-body">

<textarea

name="diagnostico"

rows="5"

class="form-control"

></textarea>

</div>

</div>

<div class="card mb-4">

<div class="card-header">

Serviço Executado

</div>

<div class="card-body">

<textarea

name="servico_executado"

rows="5"

class="form-control"

></textarea>

</div>

</div>

<div class="card mb-4">

<div class="card-header">

Custos

</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">

<label>Peças</label>

<input

type="number"

step="0.01"

value="0"

name="valor_pecas"

class="form-control">

</div>

<div class="col-md-4">

<label>Mão de Obra</label>

<input

type="number"

step="0.01"

value="0"

name="valor_mao_obra"

class="form-control">

</div>

<div class="col-md-4">

<label>Total</label>

<input

type="number"

step="0.01"

value="0"

name="valor_total"

class="form-control">

</div>

</div>

</div>

</div>

<div class="card mb-4">

<div class="card-header">

Observações

</div>

<div class="card-body">

<textarea

name="observacoes"

rows="5"

class="form-control"

></textarea>

</div>

</div>

<div class="text-end">

<button
type="submit"
class="btn btn-success btn-lg">

Abrir Ordem de Manutenção

</button>

</div>

</form>

</div>

<?php

require_once '../../includes/layout_fim.php';

?>