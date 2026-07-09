<?php

require_once __DIR__ . '/BaseModel.php';

class Produto extends BaseModel
{

    /**
     * Lista todos os produtos
     */
    public function listar()
    {

        $sql = "
            SELECT
                id,
                codigo,
                nome,
                categoria,
                marca,
                preco_venda,
                estoque_atual,
                status
            FROM produtos
            ORDER BY nome
        ";

        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

}