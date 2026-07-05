<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController extends BaseController
{

    private Cliente $cliente;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function index()
    {
        return $this->cliente->listar();
    }

    public function salvar(array $dados)
    {

        $resultado = $this->cliente->salvar($dados);

        return $resultado;

    }

}