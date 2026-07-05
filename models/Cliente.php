<?php

require_once __DIR__ . '/BaseModel.php';

class Cliente extends BaseModel
{

    public function listar()
    {
        $sql = "SELECT * FROM clientes ORDER BY nome";

        return $this->query($sql)->fetchAll();
    }

    public function salvar(array $dados)
    {

        $sql = "INSERT INTO clientes (

            tipo,
            nome,
            nome_fantasia,
            cpf_cnpj,
            rg_ie,
            inscricao_municipal,
            cep,
            endereco,
            numero,
            complemento,
            bairro,
            cidade,
            estado,
            status

        ) VALUES (

            :tipo,
            :nome,
            :nome_fantasia,
            :cpf_cnpj,
            :rg_ie,
            :inscricao_municipal,
            :cep,
            :endereco,
            :numero,
            :complemento,
            :bairro,
            :cidade,
            :estado,
            :status

        )";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute($dados);

    }

}