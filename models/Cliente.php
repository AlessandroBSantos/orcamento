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

        echo "<h1>Lista de Clientes</h1>";

        if (empty($clientes)) {

            echo "<p>Nenhum cliente cadastrado.</p>";

            return;
        }

        echo "<table border='1' cellpadding='8'>";

        echo "<tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
              </tr>";

        foreach ($clientes as $cliente) {

            echo "<tr>";

            echo "<td>{$cliente['id']}</td>";

            echo "<td>{$cliente['nome']}</td>";

            echo "<td>{$cliente['email']}</td>";

            echo "</tr>";

        }

        echo "</table>";
    }

}