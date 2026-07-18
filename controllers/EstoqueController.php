<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Estoque.php';

class EstoqueController extends BaseController
{

    private Estoque $estoque;

    public function __construct()
    {
        $this->estoque = new Estoque();
    }

    /**
     * Lista o estoque
     */
    public function index()
    {
        return $this->estoque->listar();
    }

    /**
 * Busca um produto do estoque pelo ID do produto
 */
public function buscarPorProduto(int $produtoId)
{
    return $this->estoque->buscarPorProduto($produtoId);
}

}