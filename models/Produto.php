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
            preco_venda,
            ativo
        FROM produtos
        ORDER BY nome
    ";

    return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
/**
 * Salva um novo produto
 */
public function salvar(array $dados)
{

    $sql = "
        INSERT INTO produtos (

            codigo,
            codigo_barras,
            sku,
            nome,
            descricao,
            categoria_id,
            marca_id,
            unidade_id,
            fornecedor_id,
            ncm,
            cfop,
            cest,
            origem,
            peso,
            largura,
            altura,
            comprimento,
            custo,
            percentual_lucro,
            preco_venda,
            localizacao,
            controla_estoque,
            vende,
            compra,
            ativo,
            observacoes

        ) VALUES (

            :codigo,
            :codigo_barras,
            :sku,
            :nome,
            :descricao,
            :categoria_id,
            :marca_id,
            :unidade_id,
            :fornecedor_id,
            :ncm,
            :cfop,
            :cest,
            :origem,
            :peso,
            :largura,
            :altura,
            :comprimento,
            :custo,
            :percentual_lucro,
            :preco_venda,
            :localizacao,
            :controla_estoque,
            :vende,
            :compra,
            :ativo,
            :observacoes

        )
    ";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute($dados);

}
/**
 * Lista categorias
 */
public function listarCategorias()
{

    $sql = "
        SELECT
            id,
            nome
        FROM categorias
        WHERE status='Ativo'
        ORDER BY nome
    ";

    return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

}

/**
 * Lista as marcas
 */
public function listarMarcas()
{

    $sql = "
        SELECT
            id,
            nome
        FROM marcas
        WHERE status='Ativo'
        ORDER BY nome
    ";

    return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

}

/**
 * Lista as unidades de medida
 */
public function listarUnidades()
{

    $sql = "
        SELECT
            id,
            sigla,
            descricao
        FROM unidades_medida
        WHERE status='Ativo'
        ORDER BY descricao
    ";

    return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

}

/**
 * Lista os fornecedores
 */
public function listarFornecedores()
{

    $sql = "
        SELECT
            id,
            nome_fantasia
        FROM fornecedores
        WHERE status='Ativo'
        ORDER BY nome_fantasia
    ";

    return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

}




}