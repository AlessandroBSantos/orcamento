<?php

require_once __DIR__ . '/BaseModel.php';

class Estoque extends BaseModel
{

    /**
     * Lista o estoque de produtos
     */
    public function listar()
    {

        $sql = "

            SELECT

                e.id,

                p.id AS produto_id,
                p.codigo,
                p.nome,

                e.quantidade_atual,
                e.quantidade_reservada,

                (
                    e.quantidade_atual -
                    e.quantidade_reservada
                ) AS disponivel,

                e.estoque_minimo,
                e.estoque_maximo,

                e.localizacao,
                e.lote,
                e.numero_serie,

                e.ultima_movimentacao

            FROM estoque e

            INNER JOIN produtos p
                ON e.produto_id = p.id

            WHERE p.ativo = 1

            ORDER BY p.nome

        ";

        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

}