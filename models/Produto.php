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

$stmt->bindValue(':codigo', $dados['codigo']);
$stmt->bindValue(':codigo_barras', $dados['codigo_barras']);
$stmt->bindValue(':sku', $dados['sku']);
$stmt->bindValue(':nome', $dados['nome']);
$stmt->bindValue(':descricao', $dados['descricao']);

$stmt->bindValue(':categoria_id', $dados['categoria_id'], PDO::PARAM_INT);
$stmt->bindValue(':marca_id', $dados['marca_id'], $dados['marca_id'] === null ? PDO::PARAM_NULL : PDO::PARAM_INT);
$stmt->bindValue(':unidade_id', $dados['unidade_id'], PDO::PARAM_INT);
$stmt->bindValue(':fornecedor_id', $dados['fornecedor_id'], $dados['fornecedor_id'] === null ? PDO::PARAM_NULL : PDO::PARAM_INT);

$stmt->bindValue(':ncm', $dados['ncm']);
$stmt->bindValue(':cfop', $dados['cfop']);
$stmt->bindValue(':cest', $dados['cest']);
$stmt->bindValue(':origem', $dados['origem']);

$stmt->bindValue(':peso', $dados['peso']);
$stmt->bindValue(':largura', $dados['largura']);
$stmt->bindValue(':altura', $dados['altura']);
$stmt->bindValue(':comprimento', $dados['comprimento']);

$stmt->bindValue(':custo', $dados['custo']);
$stmt->bindValue(':percentual_lucro', $dados['percentual_lucro']);
$stmt->bindValue(':preco_venda', $dados['preco_venda']);

$stmt->bindValue(':localizacao', $dados['localizacao']);

$stmt->bindValue(':controla_estoque', $dados['controla_estoque'], PDO::PARAM_INT);
$stmt->bindValue(':vende', $dados['vende'], PDO::PARAM_INT);
$stmt->bindValue(':compra', $dados['compra'], PDO::PARAM_INT);
$stmt->bindValue(':ativo', $dados['ativo'], PDO::PARAM_INT);

$stmt->bindValue(':observacoes', $dados['observacoes']);

return $stmt->execute();

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

/**
 * Busca um produto pelo ID
 */
public function buscarPorId(int $id)
{

    $sql = "
        SELECT *
        FROM produtos
        WHERE id = :id
        LIMIT 1
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);

}


}