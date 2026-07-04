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

        $clientes = $this->cliente->listar();

        echo "<pre>";

         print_r($clientes);

        echo "</pre>";

    }

}