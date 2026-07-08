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

}