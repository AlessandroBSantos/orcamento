<?php

session_start();

require_once '../../config/app.php';
require_once '../../models/Database.php';
require_once '../../controllers/ManutencaoController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$db = Database::getConnection();

try {

    $db->beginTransaction();

    $controller = new ManutencaoController();

    $dados = [

        'equipamento_id'      => (int)($_POST['equipamento_id'] ?? 0),
        'usuario_abertura'    => $_SESSION['usuario_id'],
        'tecnico_id'          => !empty($_POST['tecnico_id']) ? (int)$_POST['tecnico_id'] : null,
        'fornecedor_id'       => !empty($_POST['fornecedor_id']) ? (int)$_POST['fornecedor_id'] : null,

        'tipo'                => $_POST['tipo'] ?? 'CORRETIVA',
        'prioridade'          => $_POST['prioridade'] ?? 'MEDIA',

        'defeito_informado'   => trim($_POST['defeito_informado']),
        'diagnostico'         => trim($_POST['diagnostico']),
        'servico_executado'   => trim($_POST['servico_executado']),
        'observacoes'         => trim($_POST['observacoes']),

        'valor_pecas'         => (float)($_POST['valor_pecas'] ?? 0),
        'valor_mao_obra'      => (float)($_POST['valor_mao_obra'] ?? 0),
        'valor_total'         => (float)($_POST['valor_total'] ?? 0)

    ];

    /*
    |--------------------------------------------------------------------------
    | Salva Ordem
    |--------------------------------------------------------------------------
    */

    $manutencaoId = $controller->cadastrar($dados);

    /*
    |--------------------------------------------------------------------------
    | Histórico Inicial
    |--------------------------------------------------------------------------
    */

    $sql = "

        INSERT INTO manutencao_historico(

            manutencao_id,
            usuario_id,
            status,
            observacao,
            data_evento

        )

        VALUES(

            :manutencao,
            :usuario,
            'ABERTA',
            'Ordem aberta.',
            NOW()

        )

    ";

    $stmt = $db->prepare($sql);

    $stmt->execute([

        'manutencao' => $manutencaoId,
        'usuario'    => $_SESSION['usuario_id']

    ]);

    /*
    |--------------------------------------------------------------------------
    | Atualiza Equipamento
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

        'id' => $dados['equipamento_id']

    ]);

    /*
    |--------------------------------------------------------------------------
    | Commit
    |--------------------------------------------------------------------------
    */

    $db->commit();

    header("Location: index.php?sucesso=1");

    exit;

} catch (Exception $e) {

    if ($db->inTransaction()) {
        $db->rollBack();
    }

    header("Location: nova.php?erro=" . urlencode($e->getMessage()));

    exit;

}