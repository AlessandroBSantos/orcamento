<?php
require_once __DIR__ . '/BaseModel.php';
class Estoque extends BaseModel
{
    /**
     * Lista o estoque de produtos
     */
    public function listar()
    {
        $sql = "SELECT
            e.id,
            p.id AS produto_id,
            p.codigo,
            p.nome,
            e.quantidade_atual,
            e.quantidade_reservada,
            (e.quantidade_atual - e.quantidade_reservada)
            AS disponivel,
            e.estoque_minimo,
            e.estoque_maximp,
            e.localizacao,
            e.loto,
            e.numero_serie,
            e.ultima_movimentcao,
            e.ativo
            FROM estoque e
            INNER JOIN produtos p ON e.produto_id = p.id
            WHERE e.ativo = 1
            ORDER BT p.name";

            return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
