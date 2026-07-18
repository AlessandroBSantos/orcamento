<?php

require_once '../../config/config.php';
require_once '../../models/BaseModel.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$produtoId      = (int) $_POST['produto_id'];
$quantidade     = (float) $_POST['quantidade'];

if ($produtoId <= 0 || $quantidade <= 0) {
    die('Dados inválidos.');
}

try {

    $pdo->beginTransaction();

    // Busca o estoque atual
    $sql = "SELECT quantidade_atual
            FROM estoque
            WHERE produto_id = :produto_id
            FOR UPDATE";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'produto_id' => $produtoId
    ]);

    $estoque = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$estoque) {
        throw new Exception("Produto não encontrado no estoque.");
    }

    $novoEstoque = $estoque['quantidade_atual'] + $quantidade;

    // Atualiza o estoque
    $sql = "UPDATE estoque
            SET quantidade_atual = :quantidade,
                ultima_movimentacao = NOW()
            WHERE produto_id = :produto_id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'quantidade' => $novoEstoque,
        'produto_id' => $produtoId
    ]);

    $pdo->commit();

    header("Location: index.php?sucesso=entrada");
    exit;

    /**
 * Realiza uma entrada de estoque
 */
public function entrada(array $dados)
{
    $this->pdo->beginTransaction();

    try {

        // Busca o estoque atual
        $sql = "SELECT quantidade_atual
                FROM estoque
                WHERE produto_id = :produto_id
                FOR UPDATE";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'produto_id' => $dados['produto_id']
        ]);

        $estoque = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$estoque) {
            throw new Exception("Produto não encontrado no estoque.");
        }

        $estoqueAnterior = (float)$estoque['quantidade_atual'];

        $estoqueAtual = $estoqueAnterior + $dados['quantidade'];

        // Atualiza estoque
        $sql = "UPDATE estoque
                SET quantidade_atual = :quantidade,
                    ultima_movimentacao = NOW()
                WHERE produto_id = :produto_id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'quantidade' => $estoqueAtual,
            'produto_id' => $dados['produto_id']
        ]);

        // Registra movimentação
        $sql = "INSERT INTO movimentacoes_estoque (

            produto_id,
            usuario_id,
            fornecedor_id,

            tipo,

            documento,

            quantidade,

            valor_unitario,
            valor_total,

            estoque_anterior,
            estoque_atual,

            lote,
            numero_serie,

            observacoes,

            data_movimentacao

        ) VALUES (

            :produto_id,
            :usuario_id,
            :fornecedor_id,

            'ENTRADA',

            :documento,

            :quantidade,

            :valor_unitario,
            :valor_total,

            :estoque_anterior,
            :estoque_atual,

            :lote,
            :numero_serie,

            :observacoes,

            NOW()

        )";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([

            'produto_id' => $dados['produto_id'],

            'usuario_id' => $dados['usuario_id'],

            'fornecedor_id' => $dados['fornecedor_id'],

            'documento' => $dados['documento'],

            'quantidade' => $dados['quantidade'],

            'valor_unitario' => $dados['valor_unitario'],

            'valor_total' => $dados['valor_unitario'] * $dados['quantidade'],

            'estoque_anterior' => $estoqueAnterior,

            'estoque_atual' => $estoqueAtual,

            'lote' => $dados['lote'],

            'numero_serie' => $dados['numero_serie'],

            'observacoes' => $dados['observacoes']

        ]);

        $this->pdo->commit();

        return true;

    } catch (Exception $e) {

        $this->pdo->rollBack();

        throw $e;

    }
}

} catch (Exception $e) {

    $pdo->rollBack();

    die($e->getMessage());

}