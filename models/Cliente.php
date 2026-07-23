<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| Model Cliente
|--------------------------------------------------------------------------
|
| Esta classe é responsável por todas as operações
| relacionadas à tabela de clientes do banco de dados.
|
| Segue o padrão MVC (Model-View-Controller),
| sendo responsável pelo acesso e manipulação
| dos dados dos clientes.
|
| Funcionalidades:
| - Listar clientes.
| - Buscar cliente por ID.
| - Cadastrar clientes.
| - Atualizar clientes.
| - Excluir clientes.
|--------------------------------------------------------------------------
*/

//
// Carrega a classe BaseModel,
// responsável pela conexão com o banco.
//
require_once __DIR__ . '/BaseModel.php';

class Cliente extends BaseModel
{

    /**
     * Lista todos os clientes
     *
     * Retorna uma lista contendo os principais
     * dados dos clientes cadastrados,
     * ordenados pelo nome.
     */
    public function listar()
    {

        //
        // Consulta SQL utilizada para listar
        // os clientes cadastrados.
        //
        $sql = "
            SELECT
                id,
                tipo,
                nome,
                nome_fantasia,
                cpf_cnpj,
                cidade,
                status
            FROM clientes
            ORDER BY nome
        ";

        //
        // Executa a consulta e retorna
        // todos os registros encontrados.
        //
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * Busca um cliente pelo ID
     *
     * Recebe o identificador do cliente
     * e retorna seus dados completos.
     */
    public function buscarPorId(int $id)
    {

        //
        // Consulta SQL para localizar
        // um cliente específico.
        //
        $sql = "
            SELECT *
            FROM clientes
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
     * Salva um novo cliente
     */


    /**
     * Salva um novo cliente
     *
     * Recebe um array contendo todos os
     * dados do cliente e realiza a gravação
     * no banco de dados.
     *
     * O método utiliza Prepared Statements
     * (PDO) para garantir maior segurança
     * contra SQL Injection.
     */
    public function salvar(array $dados)
    {

        //
        // Instrução SQL responsável por inserir
        // um novo registro na tabela clientes.
        //
        $sql = "INSERT INTO clientes (

            tipo,
            nome,
            nome_fantasia,
            cpf_cnpj,
            rg_ie,
            inscricao_municipal,
            cep,
            endereco,
            numero,
            complemento,
            bairro,
            cidade,
            estado,
            status

        ) VALUES (

            :tipo,
            :nome,
            :nome_fantasia,
            :cpf_cnpj,
            :rg_ie,
            :inscricao_municipal,
            :cep,
            :endereco,
            :numero,
            :complemento,
            :bairro,
            :cidade,
            :estado,
            :status

        )";

        //
        // Prepara a instrução SQL para execução.
        //
        $stmt = $this->db->prepare($sql);

        //
        // Executa o INSERT associando cada
        // parâmetro aos valores recebidos
        // pelo formulário.
        //
        return $stmt->execute([

            // Tipo de cliente
            'tipo' => $dados['tipo'],

            // Nome ou Razão Social
            'nome' => $dados['nome'],

            // Nome Fantasia
            'nome_fantasia' => $dados['nome_fantasia'],

            // CPF ou CNPJ
            'cpf_cnpj' => $dados['cpf_cnpj'],

            // RG ou Inscrição Estadual
            'rg_ie' => $dados['rg_ie'],

            // Inscrição Municipal
            'inscricao_municipal' => $dados['inscricao_municipal'],

            // CEP
            'cep' => $dados['cep'],

            // Endereço
            'endereco' => $dados['endereco'],

            // Número
            'numero' => $dados['numero'],

            // Complemento
            'complemento' => $dados['complemento'],

            // Bairro
            'bairro' => $dados['bairro'],

            // Cidade
            'cidade' => $dados['cidade'],

            // Estado (UF)
            'estado' => $dados['estado'],

            // Status do cadastro
            'status' => $dados['status']

        ]);

    }

    /**
     * Atualiza um cliente
     */

        /**
     * Atualiza um cliente
     *
     * Recebe um array contendo os dados
     * atualizados do cliente e realiza
     * a alteração do registro no banco
     * de dados.
     *
     * Também atualiza automaticamente o
     * campo "atualizado_em" com a data
     * e hora da alteração.
     *
     * O método utiliza Prepared Statements
     * (PDO) para maior segurança contra
     * SQL Injection.
     */
    public function atualizar(array $dados)
    {

        //
        // Instrução SQL responsável por atualizar
        // os dados do cliente.
        //
        $sql = "
            UPDATE clientes SET

                tipo = :tipo,
                status = :status,
                nome = :nome,
                nome_fantasia = :nome_fantasia,
                cpf_cnpj = :cpf_cnpj,
                rg_ie = :rg_ie,
                inscricao_municipal = :inscricao_municipal,
                cep = :cep,
                endereco = :endereco,
                numero = :numero,
                complemento = :complemento,
                bairro = :bairro,
                cidade = :cidade,
                estado = :estado,
                telefone = :telefone,
                celular = :celular,
                whatsapp = :whatsapp,
                email = :email,
                contato = :contato,
                cargo_contato = :cargo_contato,
                limite_credito = :limite_credito,
                desconto_padrao = :desconto_padrao,
                vendedor_id = :vendedor_id,
                observacoes = :observacoes,
                atualizado_em = NOW()

            WHERE id = :id
        ";

        //
        // Prepara a instrução SQL.
        //
        $stmt = $this->db->prepare($sql);

        //
        // Executa a atualização associando
        // cada parâmetro aos valores recebidos.
        //
        return $stmt->execute([

            // Identificador do cliente
            'id' => $dados['id'],

            // Tipo de cliente
            'tipo' => $dados['tipo'],

            // Situação do cadastro
            'status' => $dados['status'],

            // Nome ou Razão Social
            'nome' => $dados['nome'],

            // Nome Fantasia
            'nome_fantasia' => $dados['nome_fantasia'],

            // CPF ou CNPJ
            'cpf_cnpj' => $dados['cpf_cnpj'],

            // RG ou Inscrição Estadual
            'rg_ie' => $dados['rg_ie'],

            // Inscrição Municipal
            'inscricao_municipal' => $dados['inscricao_municipal'],

            // CEP
            'cep' => $dados['cep'],

            // Endereço
            'endereco' => $dados['endereco'],

            // Número
            'numero' => $dados['numero'],

            // Complemento
            'complemento' => $dados['complemento'],

            // Bairro
            'bairro' => $dados['bairro'],

            // Cidade
            'cidade' => $dados['cidade'],

            // Estado (UF)
            'estado' => $dados['estado'],

            // Telefone fixo
            'telefone' => $dados['telefone'],

            // Celular
            'celular' => $dados['celular'],

            // WhatsApp
            'whatsapp' => $dados['whatsapp'],

            // E-mail
            'email' => $dados['email'],

            // Pessoa de contato
            'contato' => $dados['contato'],

            // Cargo do contato
            'cargo_contato' => $dados['cargo_contato'],

            // Limite de crédito
            'limite_credito' => $dados['limite_credito'],

            // Percentual de desconto padrão
            'desconto_padrao' => $dados['desconto_padrao'],

            // Vendedor responsável
            'vendedor_id' => $dados['vendedor_id'],

            // Observações adicionais
            'observacoes' => $dados['observacoes']

        ]);

    }

    /**
     * Exclui um cliente
     */

        /**
     * Exclui um cliente
     *
     * Remove definitivamente um cliente
     * da tabela "clientes" utilizando
     * o identificador (ID) informado.
     *
     * O método utiliza Prepared Statements
     * (PDO) para garantir maior segurança
     * durante a execução da consulta.
     */
    public function excluir(int $id)
    {

        //
        // Instrução SQL responsável por remover
        // um cliente da base de dados.
        //
        $sql = "

        DELETE FROM clientes

        WHERE id = :id

    ";

        //
        // Prepara a instrução SQL.
        //
        $stmt = $this->db->prepare($sql);

        //
        // Executa a exclusão utilizando
        // o ID informado como parâmetro.
        //
        return $stmt->execute([

            // Identificador do cliente.
            'id' => $id

        ]);

    }

}

/*
|--------------------------------------------------------------------------
| Fim da Classe Cliente
|--------------------------------------------------------------------------
|
| Este Model concentra todas as operações de
| acesso à tabela "clientes", incluindo:
|
| • Listagem de clientes
| • Consulta por ID
| • Cadastro de novos clientes
| • Atualização de registros
| • Exclusão de clientes
|
| A classe herda BaseModel, reutilizando a
| conexão PDO e os métodos comuns de acesso
| ao banco de dados do LLA ERP.
|--------------------------------------------------------------------------
*/
