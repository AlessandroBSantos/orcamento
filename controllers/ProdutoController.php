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
     * Lista os produtos
     */
    public function index()
    {
        return $this->produto->listar();
    }

    /**
     * Salva um novo produto
     */
    public function salvar(array $dados)
    {
        return $this->produto->salvar($dados);
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
 * Lista unidades de medida
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

    /**
     * Busca um produto pelo ID
     */
    public function buscarPorId(int $id)
    {
        return $this->produto->buscarPorId($id);
    }

}