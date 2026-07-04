<?php

require_once __DIR__ . '/BaseModel.php';

class Cliente extends BaseModel
{

public function listar()
{

    $sql = "SELECT * FROM clientes ORDER BY nome";

    return $this->query($sql)->fetchAll();

    echo "<h1>Lista de Clientes</h1>";

    echo "<table border='1' cellpadding='8'>";

    echo "<tr>";

    echo "<th>ID</th>";

    echo "<th>Nome</th>";

    echo "<th>Email</th>";

    echo "</tr>";

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