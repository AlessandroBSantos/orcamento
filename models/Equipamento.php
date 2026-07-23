<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Model Equipamento
|--------------------------------------------------------------------------
|
| Esta classe é responsável pelo gerenciamento dos
| equipamentos cadastrados no sistema.
|
| Segue o padrão MVC (Model-View-Controller),
| sendo responsável exclusivamente pelo acesso
| e manipulação dos dados da tabela "equipamentos".
|
| Funcionalidades:
| - Listar equipamentos ativos.
| - Buscar equipamento por ID.
| - Cadastrar equipamentos.
| - Atualizar equipamentos.
| - Realizar exclusão lógica.
| - Consultar o total de equipamentos ativos.
|--------------------------------------------------------------------------
*/

//
// Carrega a classe BaseModel,
// responsável pela conexão com o banco
// e pelos métodos comuns de consulta.
//
require_once __DIR__ . '/BaseModel.php';

class Equipamento extends BaseModel
{

    /**
     * Lista todos os equipamentos
     *
     * Retorna todos os equipamentos
     * ativos cadastrados no sistema,
     * ordenados pela descrição.
     */
    public function listar()
    {

        //
        // Consulta SQL responsável por
        // listar todos os equipamentos
        // ativos do sistema.
        //
        $sql = "

            SELECT *

            FROM equipamentos

            WHERE ativo = 1

            ORDER BY descricao

        ";

        //
        // Executa a consulta e retorna
        // todos os registros encontrados.
        //
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Busca equipamento pelo ID
     *
     * Recebe o identificador do equipamento
     * e retorna todas as suas informações.
     */
    public function buscarPorId(int $id)
    {

        //
        // Consulta SQL responsável por
        // localizar um equipamento
        // através do seu ID.
        //
        $sql = "

            SELECT *

            FROM equipamentos

            WHERE id = :id

            LIMIT 1

        ";

        //
        // Executa a consulta utilizando
        // o parâmetro informado e retorna
        // apenas um registro.
        //
        return $this->query($sql, [

            'id' => $id

        ])->fetch(PDO::FETCH_ASSOC);

    }

    /**
     * Cadastra equipamento
     */
        /**
     * Cadastra equipamento
     *
     * Recebe um array contendo os dados do
     * equipamento e realiza a gravação
     * na tabela "equipamentos".
     *
     * O método utiliza Prepared Statements
     * (PDO) para garantir maior segurança
     * contra SQL Injection.
     */
    public function cadastrar(array $dados)
    {

        //
        // Instrução SQL responsável por inserir
        // um novo equipamento no banco de dados.
        //
        $sql = "

            INSERT INTO equipamentos (

                codigo,
                patrimonio,
                descricao,
                categoria,
                fabricante,
                marca,
                modelo,
                numero_serie,
                numero_patrimonio,
                localizacao,
                setor,
                responsavel,
                fornecedor_id,
                data_compra,
                garantia_ate,
                valor_compra,
                observacoes,
                status

            )

            VALUES (

                :codigo,
                :patrimonio,
                :descricao,
                :categoria,
                :fabricante,
                :marca,
                :modelo,
                :numero_serie,
                :numero_patrimonio,
                :localizacao,
                :setor,
                :responsavel,
                :fornecedor_id,
                :data_compra,
                :garantia_ate,
                :valor_compra,
                :observacoes,
                :status

            )

        ";

        //
        // Executa a instrução SQL associando
        // cada parâmetro aos dados recebidos.
        //
        return $this->query($sql, [

            // Código interno do equipamento
            'codigo' => $dados['codigo'],

            // Número do patrimônio
            'patrimonio' => $dados['patrimonio'],

            // Descrição do equipamento
            'descricao' => $dados['descricao'],

            // Categoria
            'categoria' => $dados['categoria'],

            // Fabricante
            'fabricante' => $dados['fabricante'],

            // Marca
            'marca' => $dados['marca'],

            // Modelo
            'modelo' => $dados['modelo'],

            // Número de série
            'numero_serie' => $dados['numero_serie'],

            // Número patrimonial
            'numero_patrimonio' => $dados['numero_patrimonio'],

            // Localização física
            'localizacao' => $dados['localizacao'],

            // Setor onde está instalado
            'setor' => $dados['setor'],

            // Responsável pelo equipamento
            'responsavel' => $dados['responsavel'],

            // Fornecedor relacionado
            'fornecedor_id' => $dados['fornecedor_id'],

            // Data da compra
            'data_compra' => $dados['data_compra'],

            // Data final da garantia
            'garantia_ate' => $dados['garantia_ate'],

            // Valor de aquisição
            'valor_compra' => $dados['valor_compra'],

            // Observações gerais
            'observacoes' => $dados['observacoes'],

            // Situação do equipamento
            'status' => $dados['status']

        ]);

    }

    /**
     * Atualiza equipamento
     */
        /**
     * Atualiza equipamento
     *
     * Recebe um array contendo os dados
     * atualizados do equipamento e realiza
     * a alteração do registro existente
     * na tabela "equipamentos".
     *
     * O método utiliza Prepared Statements
     * (PDO), garantindo maior segurança
     * contra SQL Injection.
     */
    public function atualizar(array $dados)
    {

        //
        // Instrução SQL responsável por atualizar
        // os dados do equipamento.
        //
        $sql = "

            UPDATE equipamentos

            SET

                codigo = :codigo,
                patrimonio = :patrimonio,
                descricao = :descricao,
                categoria = :categoria,
                fabricante = :fabricante,
                marca = :marca,
                modelo = :modelo,
                numero_serie = :numero_serie,
                numero_patrimonio = :numero_patrimonio,
                localizacao = :localizacao,
                setor = :setor,
                responsavel = :responsavel,
                fornecedor_id = :fornecedor_id,
                data_compra = :data_compra,
                garantia_ate = :garantia_ate,
                valor_compra = :valor_compra,
                observacoes = :observacoes,
                status = :status

            WHERE id = :id

        ";

        //
        // Executa a atualização associando
        // cada parâmetro aos dados recebidos.
        //
        return $this->query($sql, [

            // Identificador do equipamento
            'id' => $dados['id'],

            // Código interno
            'codigo' => $dados['codigo'],

            // Número do patrimônio
            'patrimonio' => $dados['patrimonio'],

            // Descrição do equipamento
            'descricao' => $dados['descricao'],

            // Categoria
            'categoria' => $dados['categoria'],

            // Fabricante
            'fabricante' => $dados['fabricante'],

            // Marca
            'marca' => $dados['marca'],

            // Modelo
            'modelo' => $dados['modelo'],

            // Número de série
            'numero_serie' => $dados['numero_serie'],

            // Número patrimonial
            'numero_patrimonio' => $dados['numero_patrimonio'],

            // Localização física
            'localizacao' => $dados['localizacao'],

            // Setor responsável
            'setor' => $dados['setor'],

            // Responsável pelo equipamento
            'responsavel' => $dados['responsavel'],

            // Fornecedor vinculado
            'fornecedor_id' => $dados['fornecedor_id'],

            // Data da compra
            'data_compra' => $dados['data_compra'],

            // Data de término da garantia
            'garantia_ate' => $dados['garantia_ate'],

            // Valor de aquisição
            'valor_compra' => $dados['valor_compra'],

            // Observações adicionais
            'observacoes' => $dados['observacoes'],

            // Situação atual do equipamento
            'status' => $dados['status']

        ]);

    }

    /**
     * Exclusão lógica
     */
    