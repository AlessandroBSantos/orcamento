<?php

require_once __DIR__ . '/BaseModel.php';

class Estoque extends BaseModel
{

    /**
     * Lista todos os produtos do estoque
     */
    public function listar()
    {
        $sql = "
            SELECT

                e.id,

                e.produto_id,

                p.codigo,
                p.nome,

                e.quantidade_atual,
                e.quantidade_reservada,

                (e.quantidade_atual - e.quantidade_reservada) AS disponivel,

                e.estoque_minimo,
                e.estoque_maximo,

                e.localizacao,
                e.lote,
                e.numero_serie,
                e.ultima_movimentacao

            FROM estoque e

            INNER JOIN produtos p
                ON p.id = e.produto_id

            WHERE p.ativo = 1

            ORDER BY p.nome
        ";

        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca um produto do estoque
     */
    public function buscarPorProduto(int $produtoId)
    {
        $sql = "
            SELECT

                e.*,

                e.produto_id,

                p.codigo,
                p.nome

            FROM estoque e

            INNER JOIN produtos p
                ON p.id = e.produto_id

            WHERE e.produto_id = :produto_id

            LIMIT 1
        ";

        return $this->query($sql, [
            'produto_id' => $produtoId
        ])->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Entrada de estoque
     */
    public function entrada(array $dados)
    {

        $this->db->beginTransaction();

        try {

            $sql = "
                SELECT quantidade_atual

                FROM estoque

                WHERE produto_id = :produto_id

                FOR UPDATE
            ";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                'produto_id' => $dados['produto_id']
            ]);

            $estoque = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$estoque) {
                throw new Exception("Produto não encontrado.");
            }

            $estoqueAnterior = (float)$estoque['quantidade_atual'];

            $estoqueAtual = $estoqueAnterior + $dados['quantidade'];

            $sql = "
                UPDATE estoque

                SET

                    quantidade_atual = :quantidade,

                    ultima_movimentacao = NOW()

                WHERE produto_id = :produto_id
            ";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([

                'quantidade' => $estoqueAtual,

                'produto_id' => $dados['produto_id']

            ]);

            $sql = "
                INSERT INTO movimentacoes_estoque (

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

                )

                VALUES (

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

                )
            ";

            $stmt = $this->db->prepare($sql);

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

            $this->db->commit();

            return true;

        } catch (Exception $e) {

            $this->db->rollBack();

            throw $e;

        }

    }

    /**
     * Saída de estoque
     */
    public function saida(array $dados)
    {

        $this->db->beginTransaction();

        try {

            $sql = "
                SELECT quantidade_atual

                FROM estoque

                WHERE produto_id = :produto_id

                FOR UPDATE
            ";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                'produto_id' => $dados['produto_id']
            ]);

            $estoque = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$estoque) {
                throw new Exception("Produto não encontrado.");
            }

            $estoqueAnterior = (float)$estoque['quantidade_atual'];

            if ($dados['quantidade'] > $estoqueAnterior) {
                throw new Exception("Estoque insuficiente.");
            }

            $estoqueAtual = $estoqueAnterior - $dados['quantidade'];

            $sql = "
                UPDATE estoque

                SET

                    quantidade_atual = :quantidade,

                    ultima_movimentacao = NOW()

                WHERE produto_id = :produto_id
            ";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([

                'quantidade' => $estoqueAtual,

                'produto_id' => $dados['produto_id']

            ]);

            $sql = "
                INSERT INTO movimentacoes_estoque (

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

                )

                VALUES (

                    :produto_id,

                    :usuario_id,

                    :fornecedor_id,

                    'SAIDA',

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

                )
            ";

            $stmt = $this->db->prepare($sql);

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

            $this->db->commit();

            return true;

        } catch (Exception $e) {

            $this->db->rollBack();

            throw $e;

        }

    }

    /**
     * Histórico das movimentações
     */
    public function listarMovimentacoes()
    {
        $sql = "

            SELECT

                m.*,

                p.codigo,
                p.nome,

                u.nome AS usuario,

                f.nome AS fornecedor

            FROM movimentacoes_estoque m

            INNER JOIN produtos p
                ON p.id = m.produto_id

            LEFT JOIN usuarios u
                ON u.id = m.usuario_id

            LEFT JOIN fornecedores f
                ON f.id = m.fornecedor_id

            ORDER BY

                m.data_movimentacao DESC,

                m.id DESC

        ";

        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

}