<?php

session_start();

$titulo = "Nova Ordem de Manutenção";

require_once '../../config/app.php';
require_once '../../models/Database.php';

$db = Database::getConnection();

/*
|--------------------------------------------------------------------------
| Equipamentos
|--------------------------------------------------------------------------
*/

$sql = "
SELECT
    id,
    codigo,
    descricao,
    marca,
    modelo
FROM equipamentos
WHERE ativo = 1
ORDER BY descricao
";

$equipamentos = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

/*
|--------------------------------------------------------------------------
| Técnicos
|--------------------------------------------------------------------------
*/

$sql = "
SELECT
    id,
    nome
FROM usuarios
WHERE ativo = 1
ORDER BY nome
";

$tecnicos = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

require_once '../../includes/layout_inicio.php';

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>Nova Ordem de Manutenção</h2>

            <small class="text-muted">
                Cadastro de Ordem de Serviço
            </small>

        </div>

        <a href="index.php" class="btn btn-secondary">

            Voltar

        </a>

    </div>

    <?php if(isset($_GET['erro'])): ?>

        <div class="alert alert-danger">

            <?= htmlspecialchars($_GET['erro']) ?>

        </div>

    <?php endif; ?>

    <form action="salvar.php" method="POST">

        <!-- ========================================= -->

        <div class="card shadow mb-4">

            <div class="card-header">

                Dados da Ordem

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Equipamento

                        </label>

                        <select
                            name="equipamento_id"
                            class="form-select"
                            required>

                            <option value="">Selecione...</option>

                            <?php foreach($equipamentos as $eq): ?>

                                <option value="<?= $eq['id'] ?>">

                                    <?= htmlspecialchars($eq['codigo']) ?>

                                    -

                                    <?= htmlspecialchars($eq['descricao']) ?>

                                    <?php if(!empty($eq['marca'])): ?>

                                        (<?= htmlspecialchars($eq['marca']) ?>

                                        <?= htmlspecialchars($eq['modelo']) ?>)

                                    <?php endif; ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">

                            Tipo

                        </label>

                        <select
                            name="tipo"
                            class="form-select">

                            <option value="CORRETIVA">

                                Corretiva

                            </option>

                            <option value="PREVENTIVA">

                                Preventiva

                            </option>

                            <option value="PREDITIVA">

                                Preditiva

                            </option>

                            <option value="INSTALACAO">

                                Instalação

                            </option>

                            <option value="GARANTIA">

                                Garantia

                            </option>

                        </select>

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">

                            Prioridade

                        </label>

                        <select
                            name="prioridade"
                            class="form-select">

                            <option value="BAIXA">

                                Baixa

                            </option>

                            <option
                                value="MEDIA"
                                selected>

                                Média

                            </option>

                            <option value="ALTA">

                                Alta

                            </option>

                            <option value="URGENTE">

                                Urgente

                            </option>

                        </select>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Técnico Responsável

                        </label>

                        <select
                            name="tecnico_id"
                            class="form-select">

                            <option value="">

                                Não definido

                            </option>

                            <?php foreach($tecnicos as $tec): ?>

                                <option value="<?= $tec['id'] ?>">

                                    <?= htmlspecialchars($tec['nome']) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Status Inicial

                        </label>

                        <input
                            type="text"
                            class="form-control"
                            value="ABERTA"
                            readonly>

                    </div>

                </div>

            </div>

        </div>

        <!-- ========================================= -->

        <div class="card shadow mb-4">

            <div class="card-header">

                Defeito Informado

            </div>

            <div class="card-body">

                <textarea

                    name="defeito_informado"

                    rows="5"

                    class="form-control"

                    required

                    placeholder="Descreva o problema informado pelo cliente..."></textarea>

            </div>

        </div>

        <!-- ========================================= -->

        <div class="card shadow mb-4">

            <div class="card-header">

                Diagnóstico Inicial

            </div>

            <div class="card-body">

                <textarea

                    name="diagnostico"

                    rows="5"

                    class="form-control"

                    placeholder="Diagnóstico realizado pelo técnico..."></textarea>

            </div>

        </div>

        <!-- ========================================= -->

        <div class="card shadow mb-4">

            <div class="card-header">

                Serviço Executado

            </div>

            <div class="card-body">

                <textarea

                    name="servico_executado"

                    rows="5"

                    class="form-control"

                    placeholder="Serviço realizado..."></textarea>

            </div>

        </div>

        <!-- ========================================= -->

        <div class="card shadow mb-4">

            <div class="card-header">

                Custos

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4">

                        <label class="form-label">

                            Peças

                        </label>

                        <input

                            type="number"

                            step="0.01"

                            min="0"

                            value="0.00"

                            name="valor_pecas"

                            class="form-control">

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">

                            Mão de Obra

                        </label>

                        <input

                            type="number"

                            step="0.01"

                            min="0"

                            value="0.00"

                            name="valor_mao_obra"

                            class="form-control">

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">

                            Valor Total

                        </label>

                        <input

                            type="number"

                            step="0.01"

                            min="0"

                            value="0.00"

                            name="valor_total"

                            class="form-control">

                    </div>

                </div>

            </div>

        </div>

        <!-- ========================================= -->

        <div class="card shadow mb-4">

            <div class="card-header">

                Observações

            </div>

            <div class="card-body">

                <textarea

                    name="observacoes"

                    rows="4"

                    class="form-control"

                    placeholder="Observações adicionais..."></textarea>

            </div>

        </div>

        <div class="text-end mb-5">

            <a href="index.php" class="btn btn-secondary">

                Cancelar

            </a>

            <button
                type="submit"
                class="btn btn-success">

                Salvar Ordem de Manutenção

            </button>

        </div>

    </form>

</div>

<?php require_once '../../includes/layout_fim.php'; ?>