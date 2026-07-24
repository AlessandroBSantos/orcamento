<?php

session_start();

require_once '../../config/app.php';
require_once '../../config/database.php';
require_once '../../controllers/ManutencaoController.php';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: index.php");
    exit;
}

$db = Database::getConnection();

try {

    $db->beginTransaction();

    /*
    |--------------------------------------------------------------------------
    | Validação
    |--------------------------------------------------------------------------
    */

    if (empty($_POST['equipamento_id'])) {
        throw new Exception("Selecione um equipamento.");
    }

    if (empty(trim($_POST['defeito_informado']))) {
        throw new Exception("Informe o defeito.");
    }

    /*
    |--------------------------------------------------------------------------
    | Dados
    |--------------------------------------------------------------------------
    */

    $dados = [

        'equipamento_id'     => (int)$_POST['equipamento_id'],
        'usuario_abertura'   => $_SESSION['usuario_id'] ?? 1,

        'tecnico_id'         => !empty($_POST['tecnico_id'])
                                    ? (int)$_POST['tecnico_id']
                                    : null,

        'fornecedor_id'      => null,

        'tipo'               => $_POST['tipo'] ?? 'CORRETIVA',

        'prioridade'         => $_POST['prioridade'] ?? 'MEDIA',

        'defeito_informado'  => trim($_POST['defeito_informado']),

        'diagnostico'        => trim($_POST['diagnostico']),

        'servico_executado'  => trim($_POST['servico_executado']),

        'observacoes'        => trim($_POST['observacoes']),

        'valor_pecas'        => (float)($_POST['valor_pecas'] ?? 0),

        'valor_mao_obra'     => (float)($_POST['valor_mao_obra'] ?? 0),

        'valor_total'        => (float)($_POST['valor_total'] ?? 0)

    ];

    /*
    |--------------------------------------------------------------------------
    | Controller
    |--------------------------------------------------------------------------
    */

    $controller = new ManutencaoController();

    $idManutencao = $controller->cadastrar($dados);

    /*
    |--------------------------------------------------------------------------
    | Histórico
    |--------------------------------------------------------------------------
    */

$sql = "

INSERT INTO manutencao_historico
(
    manutencao_id,
    usuario_id,
    status,
    descricao
)

VALUES
(
    :manutencao,
    :usuario,
    :status,
    :descricao
)

";

$stmt = $db->prepare($sql);

$stmt->execute([

    'manutencao' => $idManutencao,

    'usuario' => $_SESSION['usuario_id'] ?? null,

    'status' => 'ABERTA',

    'descricao' => 'Ordem de manutenção criada.'

]);

    $stmt = $db->prepare($sql);

    $stmt->execute([

        'manutencao' => $idManutencao,

        'usuario'    => $_SESSION['usuario_id'] ?? 1

    ]);

    /*
    |--------------------------------------------------------------------------
    | Atualiza equipamento
    |--------------------------------------------------------------------------
    */

    $sql = "

        UPDATE equipamentos

        SET

            status='MANUTENCAO'

        WHERE

            id=:id

    ";

    $stmt = $db->prepare($sql);

    $stmt->execute([

        'id'=>$dados['equipamento_id']

    ]);

    /*
    |--------------------------------------------------------------------------
    | Commit
    |--------------------------------------------------------------------------
    */

    $db->commit();

    header("Location:index.php?sucesso=1");

    exit;

}
catch(Exception $e){

    if($db->inTransaction()){
        $db->rollBack();
    }

    header("Location:nova.php?erro=".urlencode($e->getMessage()));

    exit;

}