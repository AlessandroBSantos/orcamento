<?php

/*
|--------------------------------------------------------------------------
| LLA ERP
|--------------------------------------------------------------------------
| ProdutoController
|--------------------------------------------------------------------------
|
| Controller responsável pelo gerenciamento dos
| produtos cadastrados no sistema.
|
| Segue o padrão MVC (Model-View-Controller),
| atuando como intermediário entre as Views
| e o Model Produto.
|
| Responsabilidades:
| - Listar produtos.
| - Cadastrar novos produtos.
| - Atualizar produtos.
| - Buscar produtos por ID.
| - Listar categorias.
| - Listar marcas.
| - Listar unidades de medida.
| - Listar fornecedores.
| - Excluir produtos.
|--------------------------------------------------------------------------
*/

//
// Carrega a classe base dos Controllers.
//
require_once __DIR__ . '/BaseController.php';

//
// Carrega o Model responsável pelos produtos.
//
require_once __DIR__ . '/../models/Produto.php';

class ProdutoController extends BaseController
{

    //
    // Instância do Model Produto.
    //
    private Produto $produto;

    /*
    |--------------------------------------------------------------------------
    | Construtor
    |--------------------------------------------------------------------------
    |
    | Instancia automaticamente o Model Produto
    | sempre que o Controller é criado.
    |--------------------------------------------------------------------------
    */
    public function __construct()
    {
        $this->produto = new Produto();
    }

    /**
     * Lista produtos
     *
     * Retorna todos os produtos cadastrados
     * no banco de dados.
     */
    public function index()
    {
        return $this->produto->listar();
    }

    /**
     * Salva um produto
     *
     * Recebe os dados do formulário e
     * encaminha para o Model realizar
     * o cadastro do produto.
     */
    public function salvar(array $dados)
    {
        return $this->produto->salvar($dados);
    }

    /**
     * Atualiza um produto
     *
     * Recebe os dados alterados e solicita
     * ao Model a atualização do registro.
     */
    public function atualizar(array $dados)
    {
        return $this->produto->atualizar($dados);
    }

    /**
     * Busca produto por ID
     *
     * Localiza um produto específico
     * através do seu identificador.
     */
    public function buscarPorId(int $id)
    {
        return $this->produto->buscarPorId($id);
    }

    /**
     * Lista categorias
     *
     * Retorna todas as categorias
     * cadastradas no sistema.
     */
    public function listarCategorias()
    {
        return $this->produto->listarCategorias();
    }

    /**
     * Lista marcas
     *
     * Retorna todas as marcas
     * cadastradas.
     */
    public function listarMarcas()
    {
        return $this->produto->listarMarcas();
    }

    /**
     * Lista unidades
     *
     * Retorna todas as unidades
     * de medida disponíveis.
     */
    public function listarUnidades()
    {
        return $this->produto->listarUnidades();
    }

    /**
     * Lista fornecedores
     *
     * Retorna todos os fornecedores
     * cadastrados no sistema.
     */
    public function listarFornecedores()
    {
        return $this->produto->listarFornecedores();
    }

    /**
     * Exclui um produto
     *
     * Remove um produto do banco de dados
     * através do seu identificador (ID).
     */
    public function excluir(int $id)
    {
        return $this->produto->excluir($id);
    }

}