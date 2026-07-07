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

    public function buscarPorId(int $id)
    {
        return $this->cliente->buscarPorId($id);
    }

    public function salvar(array $dados)
    {
        return $this->cliente->salvar($dados);
    }

    public function atualizar(array $dados)
    {
        return $this->cliente->atualizar($dados);
    }

    public function excluir(int $id)
    {
        return $this->cliente->excluir($id);
    }

}