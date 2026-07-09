<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/produto.php';

class ProdutoController extends BaseController
{
    private Produto $produto;

    public function __construct()
    {
        echo "Passo 1<br>";

        $this->produto = new produto();

        echo "Passo 2<br>";
    }

    public function index()
    {
        echo "Passo 3<br>";

        $dados = $this->produto->listar();

        echo "Passo 4<br>";

        return $dados;
    }
}