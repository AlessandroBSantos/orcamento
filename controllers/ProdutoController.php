<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Produto.php';

class ProdutoController extends BaseController
{

    private Produto $produto;

    public function __construct()
    {
        $this->produto = new Produto();
    }

    /**
     * Lista produtos
     */
    public function index()
    {
        return $this->produto->listar();
    }

    /**
     * Salva um produto
     */
    public function salvar(array $dados)
    {
        return $this->produto->salvar($dados);
    }

    /**
     * Atualiza um produto
     */
    public function atualizar(array $dados)
    {
        return $this->produto->atualizar($dados);
    }

    /**
     * Busca produto por ID
     */
    public function buscarPorId(int $id)
    {
        return $this->produto->buscarPorId($id);
    }

    /**
     * Lista categorias
     */
    public function listarCategorias()
    {
        return $this->produto->listarCategorias();
    }

    /**
     * Lista marcas
     */
    public function listarMarcas()
    {
        return $this->produto->listarMarcas();
    }

    /**
     * Lista unidades
     */
    public function listarUnidades()
    {
        return $this->produto->listarUnidades();
    }

    /**
     * Lista fornecedores
     */
    public function listarFornecedores()
    {
        return $this->produto->listarFornecedores();
    }

}