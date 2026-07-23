<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| EquipamentosController
|--------------------------------------------------------------------------
|
| Controller responsável pelo gerenciamento dos
| equipamentos cadastrados no sistema.
|
| Segue o padrão MVC (Model-View-Controller),
| atuando como intermediário entre as Views e o
| Model Equipamento.
|
| Responsabilidades:
| - Listar equipamentos.
| - Buscar equipamento por ID.
| - Cadastrar novos equipamentos.
| - Atualizar equipamentos.
| - Excluir equipamentos.
| - Consultar o total de equipamentos.
|--------------------------------------------------------------------------
*/

//
// Carrega o Model responsável pelos equipamentos.
//
require_once __DIR__ . '/../models/Equipamento.php';

//
// Carrega a classe base dos Controllers.
//
require_once __DIR__ . '/BaseController.php';

class EquipamentosController extends BaseController
{

    //
    // Instância do Model Equipamento.
    //
    private Equipamento $equipamento;

    /*
    |--------------------------------------------------------------------------
    | Construtor
    |--------------------------------------------------------------------------
    |
    | Instancia automaticamente o Model Equipamento
    | sempre que o Controller é criado.
    |--------------------------------------------------------------------------
    */
    public function __construct()
    {
        $this->equipamento = new Equipamento();
    }

    /**
     * Lista todos os equipamentos
     *
     * Retorna todos os registros cadastrados
     * no banco de dados.
     */
    public function index()
    {
        return $this->equipamento->listar();
    }

    /**
     * Busca equipamento pelo ID
     *
     * Recebe o identificador do equipamento
     * e retorna seus dados.
     */
    public function buscar(int $id)
    {
        return $this->equipamento->buscarPorId($id);
    }

    /**
     * Cadastra equipamento
     *
     * Realiza as validações básicas antes
     * de encaminhar os dados para o Model.
     */
    public function cadastrar(array $dados)
    {

        // Verifica se a descrição foi informada.
        if (empty($dados['descricao'])) {
            throw new Exception("Informe a descrição do equipamento.");
        }

        // Verifica se o código foi informado.
        if (empty($dados['codigo'])) {
            throw new Exception("Informe o código do equipamento.");
        }

        // Envia os dados para gravação no banco.
        return $this->equipamento->cadastrar($dados);

    }

    /**
     * Atualiza equipamento
     *
     * Valida os dados recebidos antes
     * de atualizar o registro.
     */
    public function atualizar(array $dados)
    {

        // Verifica se o ID foi informado.
        if (empty($dados['id'])) {
            throw new Exception("ID inválido.");
        }

        // Verifica se a descrição foi informada.
        if (empty($dados['descricao'])) {
            throw new Exception("Informe a descrição.");
        }

        // Atualiza o registro no banco de dados.
        return $this->equipamento->atualizar($dados);

    }

    /**
     * Exclui equipamento
     *
     * Remove um equipamento do banco
     * utilizando seu ID.
     */
    public function excluir(int $id)
    {

        // Verifica se o ID é válido.
        if ($id <= 0) {
            throw new Exception("ID inválido.");
        }

        // Solicita ao Model a exclusão do registro.
        return $this->equipamento->excluir($id);

    }

    /**
     * Total de equipamentos
     *
     * Retorna a quantidade total de
     * equipamentos cadastrados.
     */
    public function total()
    {
        return $this->equipamento->total();
    }

}