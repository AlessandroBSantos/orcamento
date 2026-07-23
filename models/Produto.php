<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Model Produto
|--------------------------------------------------------------------------
|
| Esta classe é responsável pelo gerenciamento dos
| produtos cadastrados no sistema.
|
| Segue o padrão MVC (Model-View-Controller),
| sendo responsável exclusivamente pelo acesso
| e manipulação da tabela "produtos".
|
| Funcionalidades:
| - Listar produtos.
| - Cadastrar produtos.
| - Atualizar produtos.
| - Excluir produtos.
| - Buscar produto por ID.
| - Listar categorias.
| - Listar marcas.
| - Listar unidades de medida.
| - Listar fornecedores.
|--------------------------------------------------------------------------
*/

//
// Carrega a classe BaseModel,
// responsável pela conexão com o banco
// e pelos métodos comuns de acesso aos dados.
//
require_once __DIR__ . '/BaseModel.php';

class Produto extends BaseModel
{

    /**
     * Lista todos os produtos
     *
     * Retorna os principais dados dos
     * produtos cadastrados no sistema,
     * ordenados pelo nome.
     */
    public function listar()
    {

        //
        // Consulta SQL responsável por listar
        // os produtos cadastrados.
        //
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

        //
        // Executa a consulta e retorna
        // todos os registros encontrados.
        //
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Salva um novo produto
     *
     * Recebe um array contendo todas as
     * informações do produto e realiza
     * sua gravação na tabela "produtos".
     *
     * O método utiliza Prepared Statements
     * (PDO) para garantir maior segurança
     * contra SQL Injection.
     */
    public function salvar(array $dados)
    {

        //
        // Instrução SQL responsável por inserir
        // um novo produto no banco de dados.
        //
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

        //
        // Prepara a instrução SQL.
        //
        $stmt = $this->db->prepare($sql);

        //
        // Associação dos parâmetros
        // aos dados recebidos.
        //

        // Código interno do produto.
        $stmt->bindValue(':codigo', $dados['codigo']);

        // Código de barras.
        $stmt->bindValue(':codigo_barras', $dados['codigo_barras']);

        // SKU do produto.
        $stmt->bindValue(':sku', $dados['sku']);

        // Nome do produto.
        $stmt->bindValue(':nome', $dados['nome']);

        // Descrição detalhada.
        $stmt->bindValue(':descricao', $dados['descricao']);

        // Categoria do produto.
        $stmt->bindValue(':categoria_id', $dados['categoria_id'], PDO::PARAM_INT);

        // Marca do produto.
        $stmt->bindValue(
            ':marca_id',
            $dados['marca_id'],
            $dados['marca_id'] === null ? PDO::PARAM_NULL : PDO::PARAM_INT
        );

        // Unidade de medida.
        $stmt->bindValue(':unidade_id', $dados['unidade_id'], PDO::PARAM_INT);

        // Fornecedor.
        $stmt->bindValue(
            ':fornecedor_id',
            $dados['fornecedor_id'],
            $dados['fornecedor_id'] === null ? PDO::PARAM_NULL : PDO::PARAM_INT
        );

        // Código NCM.
        $stmt->bindValue(':ncm', $dados['ncm']);

        // Código CFOP.
        $stmt->bindValue(':cfop', $dados['cfop']);

        // Código CEST.
        $stmt->bindValue(':cest', $dados['cest']);

        // Origem fiscal.
        $stmt->bindValue(':origem', $dados['origem']);

        // Peso.
        $stmt->bindValue(':peso', $dados['peso']);

        // Largura.
        $stmt->bindValue(':largura', $dados['largura']);

        // Altura.
        $stmt->bindValue(':altura', $dados['altura']);

        // Comprimento.
        $stmt->bindValue(':comprimento', $dados['comprimento']);

        // Custo de aquisição.
        $stmt->bindValue(':custo', $dados['custo']);

        // Percentual de lucro.
        $stmt->bindValue(':percentual_lucro', $dados['percentual_lucro']);

        // Preço de venda.
        $stmt->bindValue(':preco_venda', $dados['preco_venda']);

        // Localização física.
        $stmt->bindValue(':localizacao', $dados['localizacao']);

        // Controla estoque.
        $stmt->bindValue(':controla_estoque', $dados['controla_estoque'], PDO::PARAM_INT);

        // Produto disponível para venda.
        $stmt->bindValue(':vende', $dados['vende'], PDO::PARAM_INT);

        // Produto disponível para compra.
        $stmt->bindValue(':compra', $dados['compra'], PDO::PARAM_INT);

        // Produto ativo.
        $stmt->bindValue(':ativo', $dados['ativo'], PDO::PARAM_INT);

        // Observações gerais.
        $stmt->bindValue(':observacoes', $dados['observacoes']);

        //
        // Executa a gravação do produto.
        //
        return $stmt->execute();

    }

    /**
     * Lista categorias
     */
        /**
     * Lista categorias
     *
     * Retorna todas as categorias
     * de produtos cadastradas e
     * ativas no sistema.
     */
    public function listarCategorias()
    {

        //
        // Consulta SQL responsável por listar
        // todas as categorias ativas.
        //
        $sql = "
        SELECT
            id,
            nome
        FROM categorias
        WHERE status='Ativo'
        ORDER BY nome
    ";

        //
        // Executa a consulta e retorna
        // todas as categorias encontradas.
        //
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Lista as marcas
     *
     * Retorna todas as marcas
     * cadastradas e ativas
     * no sistema.
     */
    public function listarMarcas()
    {

        //
        // Consulta SQL responsável por listar
        // todas as marcas ativas.
        //
        $sql = "
        SELECT
            id,
            nome
        FROM marcas
        WHERE status='Ativo'
        ORDER BY nome
    ";

        //
        // Executa a consulta e retorna
        // todas as marcas encontradas.
        //
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Lista as unidades de medida
     *
     * Retorna todas as unidades
     * de medida ativas cadastradas
     * no sistema.
     */
    public function listarUnidades()
    {

        //
        // Consulta SQL responsável por listar
        // todas as unidades de medida ativas.
        //
        $sql = "
        SELECT
            id,
            sigla,
            descricao
        FROM unidades_medida
        WHERE status='Ativo'
        ORDER BY descricao
    ";

        //
        // Executa a consulta e retorna
        // todas as unidades encontradas.
        //
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Lista os fornecedores
     *
     * Retorna todos os fornecedores
     * ativos disponíveis para
     * seleção no cadastro de produtos.
     */
    public function listarFornecedores()
    {

        //
        // Consulta SQL responsável por listar
        // todos os fornecedores ativos.
        //
        $sql = "
        SELECT
            id,
            nome_fantasia
        FROM fornecedores
        WHERE status='Ativo'
        ORDER BY nome_fantasia
    ";

        //
        // Executa a consulta e retorna
        // todos os fornecedores encontrados.
        //
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Busca um produto pelo ID
     */
        /**
     * Busca um produto pelo ID
     *
     * Localiza um produto específico
     * através do seu identificador
     * único (ID).
     *
     * Retorna todos os campos do
     * cadastro do produto.
     */
    public function buscarPorId(int $id)
    {

        //
        // Consulta SQL responsável por localizar
        // um produto pelo seu identificador.
        //
        $sql = "
        SELECT *
        FROM produtos
        WHERE id = :id
        LIMIT 1
    ";

        //
        // Prepara a instrução SQL.
        //
        $stmt = $this->db->prepare($sql);

        //
        // Associa o parâmetro ID
        // informado à consulta.
        //
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        //
        // Executa a consulta.
        //
        $stmt->execute();

        //
        // Retorna os dados do produto.
        //
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Atualiza um produto
     *
     * Atualiza todas as informações
     * de um produto previamente
     * cadastrado no sistema.
     *
     * O método utiliza Prepared Statements
     * (PDO) para garantir maior segurança
     * durante a atualização.
     */
    public function atualizar(array $dados)
    {

        //
        // Instrução SQL responsável por atualizar
        // os dados do produto.
        //
        $sql = "

        UPDATE produtos SET

            codigo               = :codigo,
            codigo_barras        = :codigo_barras,
            sku                  = :sku,
            nome                 = :nome,
            descricao            = :descricao,

            categoria_id         = :categoria_id,
            marca_id             = :marca_id,
            unidade_id           = :unidade_id,
            fornecedor_id        = :fornecedor_id,

            ncm                  = :ncm,
            cfop                 = :cfop,
            cest                 = :cest,
            origem               = :origem,

            peso                 = :peso,
            largura              = :largura,
            altura               = :altura,
            comprimento          = :comprimento,

            custo                = :custo,
            percentual_lucro     = :percentual_lucro,
            preco_venda          = :preco_venda,

            localizacao          = :localizacao,

            controla_estoque     = :controla_estoque,
            vende                = :vende,
            compra               = :compra,
            ativo                = :ativo,

            observacoes          = :observacoes

        WHERE id = :id

    ";

        //
        // Prepara a instrução SQL.
        //
        $stmt = $this->db->prepare($sql);

        //
        // Executa a atualização associando
        // cada parâmetro aos dados recebidos.
        //
        return $stmt->execute([

            // Identificador do produto.
            ':id'                 => $dados['id'],

            // Código interno.
            ':codigo'             => $dados['codigo'],

            // Código de barras.
            ':codigo_barras'      => $dados['codigo_barras'],

            // SKU.
            ':sku'                => $dados['sku'],

            // Nome do produto.
            ':nome'               => $dados['nome'],

            // Descrição.
            ':descricao'          => $dados['descricao'],

            // Categoria.
            ':categoria_id'       => $dados['categoria_id'],

            // Marca.
            ':marca_id'           => $dados['marca_id'],

            // Unidade de medida.
            ':unidade_id'         => $dados['unidade_id'],

            // Fornecedor.
            ':fornecedor_id'      => $dados['fornecedor_id'],

            // Código NCM.
            ':ncm'                => $dados['ncm'],

            // Código CFOP.
            ':cfop'               => $dados['cfop'],

            // Código CEST.
            ':cest'               => $dados['cest'],

            // Origem fiscal.
            ':origem'             => $dados['origem'],

            // Peso.
            ':peso'               => $dados['peso'],

            // Largura.
            ':largura'            => $dados['largura'],

            // Altura.
            ':altura'             => $dados['altura'],

            // Comprimento.
            ':comprimento'        => $dados['comprimento'],

            // Custo de aquisição.
            ':custo'              => $dados['custo'],

            // Percentual de lucro.
            ':percentual_lucro'   => $dados['percentual_lucro'],

            // Preço de venda.
            ':preco_venda'        => $dados['preco_venda'],

            // Localização física.
            ':localizacao'        => $dados['localizacao'],

            // Controle de estoque.
            ':controla_estoque'   => $dados['controla_estoque'],

            // Disponível para venda.
            ':vende'              => $dados['vende'],

            // Disponível para compra.
            ':compra'             => $dados['compra'],

            // Situação do produto.
            ':ativo'              => $dados['ativo'],

            // Observações.
            ':observacoes'        => $dados['observacoes']

        ]);

    }

    /**
     * Exclui um produto
     */
        /**
     * Exclui um produto
     *
     * Remove um produto da tabela
     * "produtos" utilizando seu ID.
     *
     * Observação:
     * Este método realiza uma exclusão física
     * (DELETE). Caso o sistema utilize
     * exclusão lógica, este método deverá
     * ser adaptado futuramente para atualizar
     * apenas o campo "ativo".
     */
    public function excluir(int $id)
    {

        //
        // Consulta SQL responsável por remover
        // o produto do banco de dados.
        //
        $sql = "
        DELETE FROM produtos
        WHERE id = :id
    ";

        //
        // Prepara a instrução SQL.
        //
        $stmt = $this->db->prepare($sql);

        //
        // Executa a exclusão utilizando
        // o identificador informado.
        //
        return $stmt->execute([

            // Identificador do produto.
            ':id' => $id

        ]);

    }

}

/*
|--------------------------------------------------------------------------
| Fim da Classe Produto
|--------------------------------------------------------------------------
|
| Este Model concentra todas as operações relacionadas
| ao cadastro de produtos do LLA ERP, incluindo:
|
| • Listagem de produtos
| • Cadastro de novos produtos
| • Atualização de produtos
| • Exclusão de produtos
| • Consulta de produto por ID
| • Listagem de categorias
| • Listagem de marcas
| • Listagem de unidades de medida
| • Listagem de fornecedores
|
| O cadastro contempla informações comerciais,
| fiscais, logísticas e de controle de estoque,
| permitindo o gerenciamento completo do ciclo
| de vida dos produtos.
|
| A classe herda BaseModel, reutilizando a
| conexão PDO e os métodos comuns de acesso
| ao banco de dados do LLA ERP.
|--------------------------------------------------------------------------
*/
