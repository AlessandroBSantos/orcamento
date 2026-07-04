<?php

require_once __DIR__ . '/BaseModel.php';

class Cliente extends BaseModel
{

    public function listar()
    {

        $sql = "SELECT * FROM clientes ORDER BY nome";

        return $this->query($sql)->fetchAll();

    }

}