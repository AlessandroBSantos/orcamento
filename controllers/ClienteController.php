<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| ClienteController
|--------------------------------------------------------------------------
|
| Controller responsável pelo gerenciamento dos clientes
| do sistema seguindo o padrão MVC (Model-View-Controller).
|
| Responsabilidades:
| - Listar clientes.
| - Buscar cliente por ID.
| - Salvar novos clientes.
| - Atualizar clientes existentes.
| - Excluir clientes.
|
| Todas as operações são encaminhadas para a classe
| Cliente (Model), responsável pelo acesso ao banco
| de dados.
|--------------------------------------------------------------------------
*/

//
// Carrega a classe base dos Controllers.
//
require_once __DIR__ . '/BaseController.php';

//
// Carrega o Model de Clientes.
//
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController extends BaseController
{

    //
    // Instância do Model Cliente.
    //
    private Cliente $cliente;

    /*
    |--------------------------------------------------------------------------
    | Construtor
    |--------------------------------------------------------------------------
    |
    | Instancia automaticamente o Model Cliente
    | sempre que o Controller é criado.
    |--------------------------------------------------------------------------
    */
    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    /*
    |--------------------------------------------------------------------------
    | Listar Clientes
    |--------------------------------------------------------------------------
    |
    | Retorna todos os clientes cadastrados
    | no banco de dados.
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        return $this->cliente->listar();
    }

    /*
    |--------------------------------------------------------------------------
    | Buscar Cliente por ID
    |--------------------------------------------------------------------------
    |
    | Recebe o código do cliente e retorna
    | seus dados cadastrados.
    |--------------------------------------------------------------------------
    */
    public function buscarPorId(int $id)
    {
        return $this->cliente->buscarPorId($id);
    }

    /*
    |--------------------------------------------------------------------------
    | Salvar Cliente
    |--------------------------------------------------------------------------
    |
    | Recebe um array contendo os dados do cliente
    | e envia essas informações ao Model para
    | gravação no banco de dados.
    |--------------------------------------------------------------------------
    */
    public function salvar(array $dados)
    {
        return $this->cliente->salvar($dados);
    }

    /*
    |--------------------------------------------------------------------------
    | Atualizar Cliente
    |--------------------------------------------------------------------------
    |
    | Recebe os dados alterados do cliente
    | e solicita ao Model que atualize
    | o registro no banco de dados.
    |--------------------------------------------------------------------------
    */
    public function atualizar(array $dados)
    {
        return $this->cliente->atualizar($dados);
    }

    /*
    |--------------------------------------------------------------------------
    | Excluir Cliente
    |--------------------------------------------------------------------------
    |
    | Remove um cliente do banco de dados
    | através do seu identificador (ID).
    |--------------------------------------------------------------------------
    */
    public function excluir(int $id)
    {
        return $this->cliente->excluir($id);
    }

}