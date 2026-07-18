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
     * Busca um produto pelo ID
     */
    public function buscarPorProduto(int $produtoId)
    {
        return $this->estoque->buscarPorProduto($produtoId);
    }

    /**
     * Entrada de estoque
     */
    public function entrada(array $dados)
    {
        return $this->estoque->entrada($dados);
    }

    /**
     * Saída de estoque
     */
    public function saida(array $dados)
    {
        return $this->estoque->saida($dados);
    }

    /**
     * Lista movimentações
     */
    public function listarMovimentacoes()
    {
        return $this->estoque->listarMovimentacoes();
    }
}