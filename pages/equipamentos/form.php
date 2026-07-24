<?php

session_start();

$titulo = "Cadastro de Equipamento";

require_once '../../config/app.php';
require_once '../../config/database.php';

$db = Database::getConnection();

/*
|--------------------------------------------------------------------------
| Fornecedores
|--------------------------------------------------------------------------
*/

$fornecedores = $db->query("
    SELECT
        id,
        razao_social
    FROM fornecedores
    ORDER BY razao_social
")->fetchAll(PDO::FETCH_ASSOC);

/*
|--------------------------------------------------------------------------
| Valores padrão
|--------------------------------------------------------------------------
*/

$equipamento = [

    'id' => '',
    'codigo' => '',
    'patrimonio' => '',
    'descricao' => '',
    'categoria' => '',
    'fabricante' => '',
    'marca' => '',
    'modelo' => '',
    'numero_serie' => '',
    'numero_patrimonio' => '',
    'localizacao' => '',
    'setor' => '',
    'responsavel' => '',
    'fornecedor_id' => '',
    'data_compra' => '',
    'garantia_ate' => '',
    'valor_compra' => '0.00',
    'observacoes' => '',
    'status' => 'OPERACAO'

];

/*
|--------------------------------------------------------------------------
| Editar
|--------------------------------------------------------------------------
*/

if (isset($_GET['id'])) {

    $stmt = $db->prepare("
        SELECT *
        FROM equipamentos
        WHERE id = ?
        LIMIT 1
    ");

    $stmt->execute([
        (int) $_GET['id']
    ]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {

        $equipamento = $resultado;

    }

}

require_once '../../includes/layout_inicio.php';

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2>

                <?= empty($equipamento['id'])
                    ? 'Novo Equipamento'
                    : 'Editar Equipamento'
                ?>

            </h2>

            <small class="text-muted">

                Cadastro dos equipamentos do ERP.

            </small>

        </div>

        <a
            href="index.php"
            class="btn btn-secondary">

            Voltar

        </a>

    </div>

    <?php if(isset($_GET['erro'])): ?>

        <div class="alert alert-danger">

            <?= htmlspecialchars($_GET['erro']) ?>

        </div>

    <?php endif; ?>

    <form
        action="salvar.php"
        method="POST">

        <input
            type="hidden"
            name="id"
            value="<?= $equipamento['id'] ?>">

        <!-- ======================================================= -->

        <div class="card shadow mb-4">

            <div class="card-header">

                Dados Gerais

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3 mb-3">

                        <label class="form-label">

                            Código

                        </label>

                        <input
                            type="text"
                            name="codigo"
                            maxlength="30"
                            required
                            class="form-control"
                            value="<?= htmlspecialchars($equipamento['codigo']) ?>">

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">

                            Patrimônio

                        </label>

                        <input
                            type="text"
                            name="patrimonio"
                            maxlength="30"
                            class="form-control"
                            value="<?= htmlspecialchars($equipamento['patrimonio']) ?>">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Descrição

                        </label>

                        <input
                            type="text"
                            name="descricao"
                            required
                            maxlength="150"
                            class="form-control"
                            value="<?= htmlspecialchars($equipamento['descricao']) ?>">

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Categoria

                        </label>

                        <input
                            type="text"
                            name="categoria"
                            maxlength="100"
                            class="form-control"
                            value="<?= htmlspecialchars($equipamento['categoria']) ?>">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Fabricante

                        </label>

                        <input
                            type="text"
                            name="fabricante"
                            maxlength="100"
                            class="form-control"
                            value="<?= htmlspecialchars($equipamento['fabricante']) ?>">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Marca

                        </label>

                        <input
                            type="text"
                            name="marca"
                            maxlength="100"
                            class="form-control"
                            value="<?= htmlspecialchars($equipamento['marca']) ?>">
                                                </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Modelo

                        </label>

                        <input
                            type="text"
                            name="modelo"
                            maxlength="100"
                            class="form-control"
                            value="<?= htmlspecialchars($equipamento['modelo']) ?>">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Número de Série

                        </label>

                        <input
                            type="text"
                            name="numero_serie"
                            maxlength="100"
                            class="form-control"
                            value="<?= htmlspecialchars($equipamento['numero_serie']) ?>">

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Número do Patrimônio

                        </label>

                        <input
                            type="text"
                            name="numero_patrimonio"
                            maxlength="100"
                            class="form-control"
                            value="<?= htmlspecialchars($equipamento['numero_patrimonio']) ?>">

                    </div>

                </div>

            </div>

        </div>

        <!-- ====================================================== -->

        <div class="card shadow mb-4">

            <div class="card-header">

                Localização

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Localização

                        </label>

                        <input
                            type="text"
                            name="localizacao"
                            maxlength="150"
                            class="form-control"
                            value="<?= htmlspecialchars($equipamento['localizacao']) ?>">

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">

                            Setor

                        </label>

                        <input
                            type="text"
                            name="setor"
                            maxlength="100"
                            class="form-control"
                            value="<?= htmlspecialchars($equipamento['setor']) ?>">

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">

                            Responsável

                        </label>

                        <input
                            type="text"
                            name="responsavel"
                            maxlength="150"
                            class="form-control"
                            value="<?= htmlspecialchars($equipamento['responsavel']) ?>">

                    </div>

                </div>

            </div>

        </div>

        <!-- ====================================================== -->

        <div class="card shadow mb-4">

            <div class="card-header">

                Aquisição

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Fornecedor

                        </label>

                        <select
                            name="fornecedor_id"
                            class="form-select">

                            <option value="">

                                Selecione...

                            </option>

                            <?php foreach($fornecedores as $fornecedor): ?>

                                <option
                                    value="<?= $fornecedor['id'] ?>"
                                    <?= ($equipamento['fornecedor_id'] == $fornecedor['id']) ? 'selected' : '' ?>>

                                    <?= htmlspecialchars($fornecedor['razao_social']) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">

                            Data da Compra

                        </label>

                        <input
                            type="date"
                            name="data_compra"
                            class="form-control"
                            value="<?= $equipamento['data_compra'] ?>">

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="form-label">

                            Garantia até

                        </label>

                        <input
                            type="date"
                            name="garantia_ate"
                            class="form-control"
                            value="<?= $equipamento['garantia_ate'] ?>">

                    </div>

                    <div class="col-md-2 mb-3">

                        <label class="form-label">

                            Valor Compra

                        </label>

                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            name="valor_compra"
                            class="form-control"
                            value="<?= $equipamento['valor_compra'] ?>">

                    </div>

                </div>

            </div>

        </div>
                <!-- ====================================================== -->

        <div class="card shadow mb-4">

            <div class="card-header">

                Informações Adicionais

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-8 mb-3">

                        <label class="form-label">

                            Observações

                        </label>

                        <textarea
                            name="observacoes"
                            rows="5"
                            class="form-control"><?= htmlspecialchars($equipamento['observacoes']) ?></textarea>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Status

                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="OPERACAO"
                                <?= ($equipamento['status']=='OPERACAO')?'selected':'' ?>>
                                Operação
                            </option>

                            <option value="MANUTENCAO"
                                <?= ($equipamento['status']=='MANUTENCAO')?'selected':'' ?>>
                                Manutenção
                            </option>

                            <option value="AGUARDANDO_PECA"
                                <?= ($equipamento['status']=='AGUARDANDO_PECA')?'selected':'' ?>>
                                Aguardando Peça
                            </option>

                            <option value="DESCARTADO"
                                <?= ($equipamento['status']=='DESCARTADO')?'selected':'' ?>>
                                Descartado
                            </option>

                            <option value="VENDIDO"
                                <?= ($equipamento['status']=='VENDIDO')?'selected':'' ?>>
                                Vendido
                            </option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

        <!-- ====================================================== -->

        <div class="d-flex justify-content-end gap-2 mb-5">

            <a
                href="index.php"
                class="btn btn-secondary">

                Cancelar

            </a>

            <button
                type="submit"
                class="btn btn-success">

                <i class="fas fa-save"></i>

                <?= empty($equipamento['id'])
                    ? 'Salvar Equipamento'
                    : 'Atualizar Equipamento'
                ?>

            </button>

        </div>

    </form>

</div>

<?php

require_once '../../includes/layout_fim.php';

?>