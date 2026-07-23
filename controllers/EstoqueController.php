<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| EstoqueController
|--------------------------------------------------------------------------
|
| Controller responsável pelo gerenciamento do estoque
| do sistema seguindo o padrão MVC (Model-View-Controller).
|
| Responsabilidades:
| - Listar produtos em estoque.
| - Consultar estoque de um produto.
| - Registrar entradas de estoque.
| - Registrar saídas de estoque.
| - Listar movimentações do estoque.
|
| Todas as operações são encaminhadas para o
| Model Estoque, responsável pelas regras de
| negócio e acesso ao banco de dados.
|--------------------------------------------------------------------------
*/

//
// Carrega a classe base dos Controllers.
//
require_once __DIR__ . '/BaseController.php';

//
// Carrega o Model responsável pelo estoque.
//
require_once __DIR__ . '/../models/Estoque.php';

class EstoqueController extends BaseController
{
    //
    // Instância do Model Estoque.
    //
    private Estoque $estoque;

    /*
    |--------------------------------------------------------------------------
    | Construtor
    |--------------------------------------------------------------------------
    |
    | Instancia automaticamente o Model Estoque
    | sempre que o Controller é criado.
    |--------------------------------------------------------------------------
    */
    public function __construct()
    {
        $this->estoque = new Estoque();
    }

    /**
     * Lista o estoque
     *
     * Retorna todos os produtos cadastrados
     * juntamente com suas respectivas quantidades
     * em estoque.
     */
    public function index()
    {
        return $this->estoque->listar();
    }

    /**
     * Busca um produto pelo ID
     *
     * Recebe o identificador do produto
     * e retorna suas informações de estoque.
     */
    public function buscarPorProduto(int $produtoId)
    {
        return $this->estoque->buscarPorProduto($produtoId);
    }

    /**
     * Entrada de estoque
     *
     * Registra uma nova entrada de produtos
     * no estoque utilizando os dados recebidos.
     */
    public function entrada(array $dados)
    {
        return $this->estoque->entrada($dados);
    }

    /**
     * Saída de estoque
     *
     * Registra uma saída de produtos,
     * atualizando o saldo disponível.
     */
    public function saida(array $dados)
    {
        return $this->estoque->saida($dados);
    }

    /**
     * Lista movimentações
     *
     * Retorna o histórico completo das
     * movimentações de entrada e saída
     * registradas no estoque.
     */
    public function listarMovimentacoes()
    {
        return $this->estoque->listarMovimentacoes();
    }
}